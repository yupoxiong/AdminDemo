<?php
/**
 * 文章控制器
 */

namespace app\admin\controller;

use app\common\model\Tag;
use think\Request;
use app\common\model\Article;
use app\common\model\User;
use app\common\model\ArticleCategory;

use app\common\validate\ArticleValidate;

class ArticleController extends Controller
{

    //列表
    public function index(Request $request, Article $model)
    {
        $param = $request->param();
        $model = $model->with('user,article_category')->scope('where', $param);

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
    public function add(Request $request, Article $model, ArticleValidate $validate)
    {
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('add')->check($param);
            if (!$validate_result) {
                return error($validate->getError());
            }
            $param['content'] = $request->param(false)['content'];

            //处理缩略图上传
            $attachment_img = new \app\common\model\Attachment;
            $file_img       = $attachment_img->upload('img');
            if ($file_img) {
                $param['img'] = $file_img->url;
            } else {
                return error($attachment_img->getError());
            }


            $result = $model::create($param);

            $result->tag()->saveAll($param['tag']);


            $url = URL_BACK;
            if (isset($param['_create']) && $param['_create'] == 1) {
                $url = URL_RELOAD;
            }

            return $result ? success('添加成功', $url) : error();
        }

        $this->assign([
            'user_list'             => User::all(),
            'article_category_list' => $this->getSelectList(new ArticleCategory),
            'tag_list'              => Tag::all(),
        ]);


        return $this->fetch();
    }

    //修改
    public function edit($id, Request $request, Article $model, ArticleValidate $validate)
    {

        $data = $model::get($id);
        if ($request->isPost()) {
            $param           = $request->param();
            $validate_result = $validate->scene('edit')->check($param);
            if (!$validate_result) {
                return error($validate->getError());
            }
            $param['content'] = $request->param(false)['content'];

            //处理缩略图上传
            if (!empty($_FILES['img']['name'])) {
                $attachment_img = new \app\common\model\Attachment;
                $file_img       = $attachment_img->upload('img');
                if ($file_img) {
                    $param['img'] = $file_img->url;
                }
            }


            $result = $data->save($param);

            $data->tag()->saveAll($param['tag']);
            return $result ? success() : error();
        }

        $this->assign([
            'data'                  => $data,
            'user_list'             => User::all(),
            'article_category_list' => $this->getSelectList(new ArticleCategory, $data->article_category_id),
            'tag_list'              => Tag::all(),

        ]);
        return $this->fetch('add');

    }

    //删除
    public function del($id, Article $model)
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
