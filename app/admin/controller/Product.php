<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Product as ProductModel;
class Product extends Fater
{
    //奖品管理
    public function index(Request $request)
    {
        $key=$request->get('key');
        $sreach['key']=$key?$key:'';
        $where=[];
        if($key){
            $where['title']=['LIKE','%'.$key.'%'];
        }

        $list=(new ProductModel)->where($where)->order('id asc')->paginate(15);
        return view('',[
            'list'=>$list,
            'token'=>$request->token(),
            'sreach'=>$sreach
        ]);
    }

    public function create(Request $request)
    {
        $this->userauth('system');
        return view('',[
            'token'=>$request->token(),
        ]);
    }

    public function edit(Request $request)
    {
        $this->userauth('system');
        $id=$request->param()['id'];
        $data=ProductModel::get($id);
        if(!$data){
            $this->error('查询的数据为空');
        }
        return view('',[
            'token'=>$request->token(),
            'data'=>$data,
        ]);
    }

    public function save(Request $request,ProductModel $product)
    {
        $param=$request->post();
        $param['add_time'] = time();
        return $product->add($param);
    }

    public function delete(Request $request,ProductModel $product)
    {
        $this->userauth('system');
        $param=$request->param()['ids'];
        return $product->dele($param);
    }


}