<?php

namespace app\index\model;

use think\Exception;
use think\Model;
class Msg extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_msg';
    protected $field = ['open_id','status','add_time'];
    protected $insert = ['add_time'];
    protected function setAddTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }


    public function addMsg($data){
        $result = $this->allowField(true)->save($data);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }


}