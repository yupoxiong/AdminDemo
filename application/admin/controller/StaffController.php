<?php
/**
 * 员工控制器
 */

namespace app\admin\controller;

use think\Request;
use app\common\model\Staff;
use app\common\model\Department;
use app\common\model\Position;

use app\common\validate\StaffValidate;

class StaffController extends Controller
{

    //列表
    public function index(Request $request, Staff $model)
    {
        $param = $request->param();
        $model = $model->with('department,position')->scope('where', $param);
        if (isset($param['export_data']) && $param['export_data'] == 1) {
            $header = ['ID', '照片', '姓名', '部门', '职位', '工号', '手机号', '邮箱', '生日', '入职日期', '是否为老板', '是否所属部门领导', '排序', '是否启用', '创建时间',];
            $body   = [];
            $data   = $model->select();
            foreach ($data as $item) {
                $record                  = [];
                $record['id']            = $item->id;
                $record['avatar']        = $item->avatar;
                $record['name']          = $item->name;
                $record['department_id'] = $item->department->name ?? '';
                $record['position_id']   = $item->position->name ?? '';
                $record['job_number']    = $item->job_number;
                $record['mobile']        = $item->mobile;
                $record['email']         = $item->email;
                $record['birthday']      = $item->birthday;
                $record['hired_date']    = $item->hired_date;
                $record['is_boss']       = $item->is_boss_text;
                $record['is_leader']     = $item->is_leader_text;
                $record['sort_number']   = $item->sort_number;
                $record['status']        = $item->status_text;
                $record['create_time']   = $item->create_time;

                $body[] = $record;
            }
            return $this->exportData($header, $body, 'staff-' . date('Y-m-d-H-i-s'));
        }
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
    public function add(Request $request, Staff $model, StaffValidate $validate)
    {
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('add')->check($param);
            if (!$validate_result) {
                return error($validate->getError());
            }
            //处理照片上传
            $attachment_avatar = new \app\common\model\Attachment;
            $file_avatar       = $attachment_avatar->upload('avatar');
            if ($file_avatar) {
                $param['avatar'] = $file_avatar->url;
            } else {
                return error($attachment_avatar->getError());
            }


            $result = $model::create($param);

            $url = URL_BACK;
            if (isset($param['_create']) && $param['_create'] == 1) {
                $url = URL_RELOAD;
            }

            return $result ? success('添加成功', $url) : error();
        }

        $this->assign([
            'department_list' => $this->getSelectList(new Department),
            'position_list'   => Position::all(),

        ]);


        return $this->fetch();
    }

    //修改
    public function edit($id, Request $request, Staff $model, StaffValidate $validate)
    {

        $data = $model::get($id);
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('edit')->check($param);
            if (!$validate_result) {
                return error($validate->getError());
            }
            //处理照片上传
            if (!empty($_FILES['avatar']['name'])) {
                $attachment_avatar = new \app\common\model\Attachment;
                $file_avatar       = $attachment_avatar->upload('avatar');
                if ($file_avatar) {
                    $param['avatar'] = $file_avatar->url;
                }
            }


            $result = $data->save($param);
            return $result ? success() : error();
        }

        $this->assign([
            'data'            => $data,
            'department_list' => $this->getSelectList(new Department, $data->department_id),
            'position_list'   => Position::all(),

        ]);
        return $this->fetch('add');

    }

    //删除
    public function del($id, Staff $model)
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

    //启用
    public function enable($id, Staff $model)
    {
        $result = $model->whereIn('id', $id)->update(['status' => 1]);
        return $result ? success('操作成功', URL_RELOAD) : error();
    }

    //禁用
    public function disable($id, Staff $model)
    {
        $result = $model->whereIn('id', $id)->update(['status' => 0]);
        return $result ? success('操作成功', URL_RELOAD) : error();
    }
}
