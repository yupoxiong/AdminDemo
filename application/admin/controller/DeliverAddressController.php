<?php
/**
 * 收货地址控制器
 */

namespace app\admin\controller;

use think\Request;
use app\common\model\DeliverAddress;
use app\common\model\User;
use yupoxiong\region\model\Region;


use app\common\validate\DeliverAddressValidate;

class DeliverAddressController extends Controller
{

    //列表
    public function index(Request $request, DeliverAddress $model)
    {
        $param = $request->param();
        $model = $model->with('user,province,city,district,street')->scope('where', $param);

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
    public function add(Request $request, DeliverAddress $model, DeliverAddressValidate $validate, Region $region)
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
            'user_list'     => User::all(),
            'province_list' => $region->getProvince(),
            'city_list'     => $region->getCity(1),
            'district_list' => $region->getDistrict(1),
            'street_list'   => $region->getStreet(1),

        ]);


        return $this->fetch();
    }

    //修改
    public function edit($id, Request $request, DeliverAddress $model, DeliverAddressValidate $validate, Region $region)
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
            'data'          => $data,
            'user_list'     => User::all(),
            'province_list' => $region->getProvince(),
            'city_list'     => $region->getCity(1),
            'district_list' => $region->getDistrict(1),
            'street_list'   => $region->getStreet(1),


        ]);
        return $this->fetch('add');

    }

    //删除
    public function del($id, DeliverAddress $model)
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


}
