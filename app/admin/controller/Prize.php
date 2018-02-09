<?php

namespace app\admin\controller;

use think\Controller;
use think\Exception;
use think\Request;
use app\common\controller\From;
use app\admin\model\Prize as AdminPrize;
class Prize extends Fater
{
    //兑奖管理
    public function index(Request $request){
        $where=[];
        $status=$request->get('status');
        $sreach=[
            'type'=>$status?$status:0,
            'key'=>'',
        ];
        $where['status']=['eq',$status?$status:0];
        $key=$request->get('key');
        $uid=[];
        if($key){
            $map['name|phone']=['LIKE',"%{$key}%"];
            $netid=db('user')->where($map)->field('open_id')->select();
            foreach($netid as $k=>$v){
                $uid[] = $v['open_id'];
            }
            $where['open_id'] = ['IN',$uid];
            $sreach['key']=$key;
        }
        $list=(new AdminPrize)->where($where)->order('id asc')->paginate(15);
        $page = $list->render();//获取分页
        $data = $list->all();//获取数组;
        $types=[
            ['id'=>0,'type'=>'未处理'],
            ['id'=>1,'type'=>'已处理'],
        ];
        return view('',[
            'list'=>$data,
            'page'=>$page,
            'token'=>$request->token(),
            'types'=>$types,
            'sreach'=>$sreach
        ]);
    }

    public function changeS(AdminPrize $adminPrize){
        $id = input('id');
        $s = $adminPrize->where('id',$id)->value('status');
        if($s == 0){
            $data['status'] = 1;
            $adminPrize->where('id',$id)->setField($data);
        }else{
            $data['status'] = 0;
            $adminPrize->where('id',$id)->setField($data);
        }
        $data['code'] = 1;
        return $data;
    }


    public function delete(Request $request,From $from,AdminPrize $adminPrize){
        $param=$request->param()['ids'];
        return $from->dele($param,$adminPrize);
    }

    //导出数据
    public function e_csv(){
        $file_name='完美年货.csv';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$file_name);
        header('Cache-Control: max-age=0');
        //接收条件，查询表
        $where =[];
        $status = input('status');
        $where['status'] = ['eq',$status];
        $data='奖品名称,奖品数量,用户名,用户电话,用户地址,兑奖时间,状态'."\r\n";
        $arr = db('prize')->where($where)->order('add_time desc')->select();
        if(!$arr){
            $data .='没有找到相应的数据'."\r\n";
        }
        foreach($arr as $k=>$v){
            $p = db('product')->where('id',$v['pid'])->field('title,number')->find();
            $u = db('user')->where('open_id',$v['open_id'])->field('name,phone,addr')->find();
            $addr=$this->strG($u['addr']);
            if($v['status'] == 0){
                $type = '未处理';
            }else{
                $type = '已处理';
            }
            $data .= "{$p['title']},{$v['number']},{$u['name']},{$u['phone']},{$addr},{$v['add_time']},{$type}"."\r\n";
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