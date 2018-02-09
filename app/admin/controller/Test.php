<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Test as TestModel;
class Test extends Fater
{
    //试题管理
    public function index(Request $request)
    {
        $this->userauth('system');
        $where=[];
        $list=(new TestModel)->where($where)->order('id asc')->paginate(15);
        $page = $list->render();//获取分页
        $data = $list->all();//获取数组;
        return view('',[
            'list'=>$data,
            'page'=>$page,
            'token'=>$request->token(),
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
        $data=TestModel::get($id);
        if(!$data){
            $this->error('查询的数据为空');
        }
        $content = json_decode($data['content'],true);
        return view('',[
            'token'=>$request->token(),
            'info'=>$data,
            'content'=>$content
        ]);
    }

    public function save(Request $request,TestModel $test)
    {
        $param=$request->post();
        $param['content'] = json_encode($param['content']);
        return $test->add($param);
    }

    public function delete(Request $request,TestModel $test)
    {
        $this->userauth('system');
        $param=$request->param()['ids'];
        return $test->dele($param);
    }
}