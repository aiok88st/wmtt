<?php

namespace app\index\controller;

use think\Controller;
use think\Exception;
use think\Request;
use app\index\model\Open;
use app\index\model\Mark;
use app\index\model\Product;
use app\index\model\Test;
use app\index\model\User;
use app\index\model\Prize;
class Index extends Fater
{
    public function _initialize(){
        parent::_initialize();
        if(!UID) {
            $this->redirect(url('Weixin/index'));
        }
    }

    public function index(Open $open)
    {
        $toDay=strtotime(date('Y-m-d'));
        $MC=db('open')->where('id',UID)->field('count,update_time,status,guide_id')->find();
        if($toDay >= $MC['update_time']){
            //重置
            $M = [
                'count'=>3,
                'status'=>1,
                'guide_id'=>1,
                'update_time'=>time()
            ];
            $m = 3;
            $t = 1;
            $open->where('id',UID)->update($M);
        }else{
            $m = $MC['count'];
            $t = $MC['status'];
        }
        $this->assign('t',$t);
        $this->assign('m',$m);
        return $this->fetch();
    }
    //个人页面
    public function person(Mark $mark, Product $product,Prize $prize){
        //我的年货数
        $mr = $mark->where('open_id',UID)->find();
        $this->assign('mr',$mr);
        //奖品
        $p = $product->select();
        $this->assign('data',$p);
        //兑奖名单
//        $po = db('prize')->order('id desc')->limit(10)->select();
//        foreach($po as $k=>$v){
//            $po[$k]['open'] = db('open')->where('id',$v['open_id'])->field('open_name,open_face')->find();
//            $po[$k]['product'] = db('product')->where('id',$v['pid'])->field('title')->find();
//        }
//        $this->assign('po',$po);
        //排行榜
        $mArr = db('mark')->order('user_sum desc')->limit(10)->select();
        foreach($mArr as $k=>$v){
            $mArr[$k]['open'] = db('open')->where('id',$v['open_id'])->field('open_name,open_face')->find();
        }
        $this->assign('mArr',$mArr);
        return $this->fetch();
    }
    //添加积分
    public function add(Open $open,Mark $mark){
        try{
            $num = input('num');
            $data = [
                'user_sum'=>$num,
                'open_id'=>UID
            ];
            $mark->addMsg($data);
            //次数减少
            $open->where('id',UID)->setDec('count');
            $mr = $open->where('id',UID)->value('count');
            return json(['code'=>1,'m'=>$mr]);
        }catch (\Exception $e){
            return json(['code'=>0, 'msg'=>$e->getMessage()]);
        }
    }

    //保存个人信息
    public function add_user(Request $request,User $user){
        $param=$request->post();
        $param['open_id'] = UID;
        $re = $user->addUser($param);
        if($re == 1){
            return json(['code'=>1,'msg'=>'提交成功']);
        }else{
            return json(['code'=>0,'msg'=>'提交失败']);
        }
    }

    //兑奖
    public function add_prize(Product $product,Prize $prize,Mark $mark){
        $id = input('id');
        $data = [
            'pid'=>$id,
            'open_id'=>UID
        ];
        $re = $prize->addPr($data);
        if($re == 1){
            $product->where('id',$id)->setDec('number');
            $po = $product->where('id',$id)->find();
            $m = $mark->where('open_id',UID)->find();
            $m_sum = $m['user_sum']-$po['integral'];
            $mark->where('id',$m['id'])->update(['user_sum'=>$m_sum]);
            return json(['code'=>1,'msg'=>'提交成功','sy'=>$po['number'],'su'=>$m_sum]);
        }else{
            return json(['code'=>0,'msg'=>'提交失败']);
        }
    }



    //试题
    public function test(Open $open,Test $test){
        header("Access-Control-Allow-Origin: *");
        $list = $test->order('rand()')->limit(3)->select();
//        $open->where(['id'=>UID])->update(['status'=>2,'update_time'=>time()]);
        return json($list);

//        foreach($list as $k=>$v){
//            $list[$k]['content']=json_decode($v['content'],true);
//        }
//
//        $this->assign('list',$list);
//        $open->where(['id'=>UID])->update(['status'=>2,'update_time'=>time()]);
//        return $this->fetch();
    }
    public function getListOne($where){
        $test = db('test')->where($where)->find();
        $test['content']=json_decode($test['content'],true);
        return $test;
    }
    //答题
    public function addTest(Request $request,Open $open){
        $tests = $request->param();
        $where['id']=['=',$tests['id']];
        $test=$this->getListOne($where);
        $tcontent = $test['content'];
        $standard=[];
        foreach($tcontent as $key=>$val){
            $answer=[];
            foreach($val['input'] as $k=>$v){
                if($v['answer']==1){
                    array_push($answer,$v['val']);
                }
            }
            $standard[$key]['answer']=$answer;
        }

        $standard2=[];
        foreach($tests['content'] as $key=>$val){
            $answer=[];
            foreach($val['input'] as $k=>$v){
                if($v['answer']==1){
                    array_push($answer,$v['val']);
                }
            }
            $standard2[$key]['answer']=$answer;
        }

        foreach($standard2 as $key=>$value){
            if(empty(array_diff($value['answer'],$standard[$key]['answer']))){
                //次数增加
                $open->where('id',UID)->setInc('count');
            }
        }
    }


    //微信分享
    public function jssdk_all(){
        $wxapi=new \org\Wxapi;
        $url=$_SERVER['HTTP_REFERER'];
        $signPackage=$wxapi->getSignPackage($url);
        return json($signPackage);
    }

    //分享成功
    public function fen(Open $open){
        $MC=db('open')->where('id',UID)->field('count,update_time,status,guide_id')->find();
        if($MC['guide_id'] != 0){
            $open->where('id',UID)->setInc('count',2);
            $open->where(['id'=>UID])->update(['guide_id'=>0,'update_time'=>time()]);
        }
    }

}
