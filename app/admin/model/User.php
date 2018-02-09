<?php

namespace app\admin\model;

use think\Exception;
use think\Model;
class User extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_user';
    protected $field = ['name','phone','addr','add_time','open_id'];
    protected $insert = ['add_time'];

    public function getOpenIdAttr($value){
        $open=Open::get($value);
        $m=Mark::get($value);
        return '<div style="float: left;"><img src="'.$open['open_face'].'" width="50" title="'.$open['open_id'].'" date-name="'.$open['open_name'].'"/></div><div style="float: left;margin-left:5px"><ul><li>'.$open['open_name'].'</li><li>积分：'.$m['user_sum'].'</li></ul></div>';
    }


}