<?php

namespace app\index\model;

use think\Exception;
use think\Model;
class Mark extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_mark';
    protected $field = ['open_id','user_sum'];

    public function addMsg($data){
        $result = $this->where('open_id',$data['open_id'])->find();
        if($result){
            $new = $data['user_sum']+$result['user_sum'];
            $re = $this->where('open_id',$data['open_id'])->update(['user_sum'=>$new]);
        }else{
            $re = $this->insert($data);
        }
        if($re){
            return 1;
        }else{
            return 0;
        }
    }
}