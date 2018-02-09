<?php
namespace app\admin\controller;


use think\Controller;
use think\Request;
use app\common\controller\Table;
use app\common\controller\Search;
use app\common\controller\Tool;
use app\common\controller\From;
use app\admin\model\Mark as AdminMark;
class Mark extends Fater{
    //积分管理
    public function index(Table $table,AdminMark $mark,Search $search,Tool $tool){
        $this->userauth('activity');
        $table->init($mark);  //传入一个模型
        $table->editAction();  //禁用修改按钮
        $table->deleteAction(); //禁用删除按钮
        $table->createAction=false; //禁用添加按钮
        $table->column('open_id','用户');
        $table->column('user_sum','积分');
        $table->order('user_sum desc');
        $table->tool(function() use ($tool){
            $tool->export(url('Mark/e_csv'));
        },$tool);
        return $table->start();
    }

    //导出数据
    public function e_csv(){
        $file_name='用户信息.csv';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$file_name);
        header('Cache-Control: max-age=0');
        //查询表
        $data='微信昵称,积分,用户名,用户电话,用户地址'."\r\n";
        $arr = db('mark')->order('user_sum desc')->select();
        if(!$arr){
            $data .='没有找到相应的数据'."\r\n";
        }
        foreach($arr as $k=>$v){
            $o = db('open')->where('id',$v['open_id'])->field('open_name')->find();
            $m = db('user')->where('open_id',$v['open_id'])->field('name,phone,addr')->find();
            $addr = $this->strG($m['addr']);
            $data .= "{$o['open_name']},{$v['user_sum']},{$m['name']},{$m['phone']},{$addr}"."\r\n";
        }
        return $data;
    }

    public function strG($data){
        $data=str_replace(',','，',$data);
        $data=str_replace("\r\n",'',$data);
        $data=str_replace("\r",'',$data);
        $data=str_replace("\n",'',$data);
        $data=str_replace("\"",'',$data);
        return $data;
    }



}
