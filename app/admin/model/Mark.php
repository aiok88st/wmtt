<?php

namespace app\admin\model;

use think\Exception;
use think\Model;
class Mark extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_mark';
    protected $field = ['open_id','user_sum'];
    public function getOpenIdAttr($value){
        $open=Open::get($value);

        return '<img src="'.$open['open_face'].'" width="50" title="'.$open['open_id'].'" date-name="'.$open['open_name'].'"/>&nbsp;&nbsp;'.$open['open_name'];
    }

}