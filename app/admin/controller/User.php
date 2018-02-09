<?php
namespace app\admin\controller;


use think\Controller;
use think\Request;
use app\common\controller\From;
use app\admin\model\User as UserModel;
class User extends Fater{
    //积分管理
    public function index(Request $request){
        $where=[];
        $key=$request->get('key');
        $sreach=[
            'key'=>'',
        ];
        $uid=[];
        if($key){
            $map['open_name']=['LIKE',"%{$key}%"];
            $o=db('open')->where($map)->field('id')->select();
            foreach($o as $k=>$v){
                $uid[] = $v['id'];
            }
            $where['open_id'] = ['IN',$uid];
            $sreach['key']=$key;
        }
        $list=(new UserModel)->where($where)->order('id asc')->paginate(15);
        $page = $list->render();//获取分页
        $data = $list->all();//获取数组;

        return view('',[
            'list'=>$data,
            'page'=>$page,
            'token'=>$request->token(),
            'sreach'=>$sreach
        ]);
    }

    public function delete(Request $request,From $from,UserModel $user){
        $param=$request->param()['ids'];
        return $from->dele($param,$user);
    }

    //导出数据
    public function e_csv(){
        $file_name='用户信息.csv';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$file_name);
        header('Cache-Control: max-age=0');
        //查询表
        $data='微信昵称,积分,用户名,用户电话,用户地址'."\r\n";
        $arr = db('user')->order('add_time desc')->select();
        if(!$arr){
            $data .='没有找到相应的数据'."\r\n";
        }
        foreach($arr as $k=>$v){
            $o = db('open')->where('id',$v['open_id'])->field('open_name')->find();
            $m = db('mark')->where('open_id',$v['open_id'])->field('user_sum')->find();
            $addr = $this->strG($v['addr']);
            $data .= "{$o['open_name']},{$m['user_sum']},{$v['name']},{$v['phone']},{$addr}"."\r\n";
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
