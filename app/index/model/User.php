<?php

namespace app\index\model;

use think\Exception;
use think\Model;
class User extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_user';
    protected $field = ['name','phone','addr','add_time','open_id'];
    protected $insert = ['add_time'];
    protected function setAddTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }
    protected $veri=[
        'name|姓名'=>'require|max:255',
        'addr|地址'=>'require|max:255',
    ];

    public function addUser($param){
        try{
            $param['phone']=trim($param['phone']);
            if(!empty($param['phone'])){
                $this->veri['phone|手机号码']='regex:/^1[34578]\d{9}$/';
            }

            if(isset($param['id'])){
                $result = (new User)
                    ->allowField(true)
                    ->validate($this->veri)
                    ->save($param,['id'=>$param['id']]);
                if(false === $result){
                    return 0;
                }else{
                    return 1;
                }
            }else{
                $result =$this->allowField(true)->validate($this->veri)->save($param);
                if(false === $result){
                    return 0;
                }else{
                    return 1;
                }
            }
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }

}