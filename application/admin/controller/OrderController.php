<?php
/**
 * 订单控制器
 */

namespace app\admin\controller;

use app\common\model\DeliverAddress;
use app\common\model\Goods;
use app\common\model\OrderGoods;
use think\Db;
use think\Request;
use app\common\model\Order;
use app\common\model\User;
use app\common\model\Express;

use app\common\validate\OrderValidate;

class OrderController extends Controller
{

    protected $authExcept = [
        'admin/order/test'
    ];

    //列表
    public function index(Request $request, Order $model)
    {
        $param = $request->param();
        $model = $model->with('user,express')->scope('where', $param);

        $data = $model->paginate($this->admin['per_page'], false, ['query' => $request->get()]);
        //关键词，排序等赋值
        $this->assign($request->get());

        $this->assign([
            'data'  => $data,
            'page'  => $data->render(),
            'total' => $data->total(),
        ]);
        return $this->fetch();
    }

    //添加
    public function add(Request $request, Order $model, OrderValidate $validate)
    {
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('add')->check($param);
            if (!$validate_result) {
                return error($validate->getError());
            }

            $result = $model::create($param);

            $url = URL_BACK;
            if (isset($param['_create']) && $param['_create'] == 1) {
                $url = URL_RELOAD;
            }

            return $result ? success('添加成功', $url) : error();
        }

        $this->assign([
            'user_list'    => User::all(),
            'express_list' => Express::all(),

        ]);


        return $this->fetch();
    }

    //修改
    public function edit($id, Request $request, Order $model, OrderValidate $validate)
    {

        $data = $model::get($id);
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('edit')->check($param);
            if (!$validate_result) {
                return error($validate->getError());
            }

            $result = $data->save($param);
            return $result ? success() : error();
        }

        $this->assign([
            'data'         => $data,
            'user_list'    => User::all(),
            'express_list' => Express::all(),

        ]);
        return $this->fetch('add');

    }

    //删除
    public function del($id, Order $model)
    {
        if (count($model->noDeletionId) > 0) {
            if (is_array($id)) {
                if (array_intersect($model->noDeletionId, $id)) {
                    return error('ID为' . implode(',', $model->noDeletionId) . '的数据无法删除');
                }
            } else if (in_array($id, $model->noDeletionId)) {
                return error('ID为' . $id . '的数据无法删除');
            }
        }

        if ($model->softDelete) {
            $result = $model->whereIn('id', $id)->useSoftDelete('delete_time', time())->delete();
        } else {
            $result = $model->whereIn('id', $id)->delete();
        }

        return $result ? success('操作成功', URL_RELOAD) : error();
    }


    //生成假数据
    public function create()
    {
        ini_set('memory_limit', '10240M');
        $users = User::all();

        $goods = Goods::all();

        $goods_count = count($goods);


        Db::startTrans();
        try {


            foreach ($users as $user) {

                $need_count  = random_int(1, $goods_count);
                $order_goods = [];
                $order_money = 0;
                for ($i = 1; $i <= $need_count; $i++) {
                    $index          = random_int(0, $goods_count - 1);
                    $current_number = random_int(1, 5);

                    $order_goods[] = [
                        'number' => $current_number,
                        'goods'  => $goods[$index],
                    ];
                    $order_money   += $goods[$index]->price * $current_number;
                }

                $address = DeliverAddress::get(function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });

                $expresses     = Express::all();
                $express_count = count($expresses);
                $express_index = random_int(0, $express_count - 1);
                $express       = $expresses[$express_index];

                $order = Order::create([
                    'user_id'     => $user->id,
                    'order_no'    => date('ymdHis') . random_int(100, 999) . $user->id,
                    'order_price' => $order_money,
                    'pay_price'   => $order_money,
                    'goods_price' => $order_money,
                    'name'        => $address->name,
                    'mobile'      => $address->mobile,
                    'address'     => $address->detail,
                    'express_id'  => $express->id,
                    'express_no'  => random_int(99999999, 999999999),
                    'pay_time'    => time() + random_int(1, 200),
                ]);

                foreach ($order_goods as $item) {
                    OrderGoods::create([
                        'order_id'    => $order->id,
                        'goods_id'    => $item['goods']->id,
                        'number'      => $item['number'],
                        'price'       => $item['goods']->price,
                        'total_price' => $item['goods']->price * $item['number'],
                    ]);
                }

            }

            Db::commit();
            $result = true;
            $msg    = '成功';
        } catch (\Exception $exception) {
            Db::rollback();
            $result = false;
            $msg    = $exception;
        }


        return $msg;
    }

    //订单详情
    public function detail($id, Order $model)
    {
        $data = $model::get($id);
        $this->assign([
            'data' => $data
        ]);

        return $this->fetch();
    }

    public function updateAddress()
    {

        Db::startTrans();
        try {

            $order = Order::all();
            foreach ($order as $item) {
                $addr = DeliverAddress::where('mobile', $item->mobile)->where('name', 'like', '%' . $item->name . '%')->find();
                if ($addr) {
                    $item->deliver_address_id = $addr->id;
                    $item->province_id        = $addr->province_id;
                    $item->city_id            = $addr->city_id;
                    $item->district_id        = $addr->district_id;
                    $item->street_id          = $addr->street_id;
                    $item->full_address       = $addr->province->name . $addr->city->name . $addr->district->name . $addr->street->name . $addr->detail;
                    $item->save();

                } else {
                    echo $item->name . '--' . $item->mobile . '<br/>';
                }

            }


            Db::commit();
            $result = true;
            $msg    = '成功';
        } catch (\Exception $exception) {
            Db::rollback();
            $result = false;
            $msg    = $exception->getMessage();
        }

        return $msg;

    }

    public function updateOrderGoods()
    {
        $orderGoods = OrderGoods::all();

        foreach ($orderGoods as $item) {
            $item->name = $item->goods->name;
            $item->save();
        }
    }

    public function test(Order $order)
    {
        $data = $order::with(['user' => function ($query) {
            $query->with(['userLevel' => function ($querySub) {
                    $querySub->visible(['id', 'name']);
                }]
            )->visible(['id', 'nickname', 'mobile']);
        }])->where('id', 'in', '1,5,9,13,17,21,25,29')->visible(['id', 'order_no', 'user_id'])->limit(5)->select();


        $list = $order::with(['user' => function ($query) {
            $query->with('userLevel')->visible(['user_level' => ['id', 'name']]);
        }])->visible(['id', 'order_no', 'user' => ['id', 'nickname', 'mobile']])->select();




        dump($list);


        //return '';
        return json($data);
    }

}
