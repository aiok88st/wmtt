<?php

namespace app\admin\model;

use think\Model;

class Prize extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_prize';
    protected $field =['pid','open_id','status','number','add_time'];

    public function getPidAttr($value){
        $p = Product::get($value);
        return $p['title'];
    }

    public function getOpenIdAttr($value){
        $u = User::get(['open_id'=>$value]);
        if($u){
            return '<ul><li>姓名：'.$u['name'].'</li><li>电话：'.$u['phone'].'</li><li>地址：'.$u['addr'].'</li></ul>';
        }else{
            return '';
        }
    }

}