<?php

namespace app\index\model;

use think\Model;

class Prize extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_prize';
    protected $field =['pid','open_id','status','number','add_time'];
    protected $insert = ['add_time'];
    protected function setAddTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }

    protected function getOpenIdAttr($value)
    {
        $pro=Open::get($value);
        return [
            'id'=>$value,
            'name'=>$pro['open_name'],
            'face'=>$pro['open_face']
        ];
    }

    public function addPr($param){
        try{
            $result = $this->save($param);
            if($result){
                return 1;
            }else{
                return 0;
            }
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }


}