<?php

namespace app\admin\model;

use think\Exception;
use think\Model;
class Test extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_test';
    protected $field = ['title','content','status','add_time'];
    protected $insert = ['add_time'];
    protected $update = ['add_time'];
    protected function setAddTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }
    protected $veri=[
        'content|试题内容'=>'require',
    ];

    public function add($param){
        try{
            $adminLog=new Log;
            if(isset($param['id'])){

                $result = (new Test)
                    ->allowField(true)
                    ->validate($this->veri)
                    ->save($param,['id'=>$param['id']]);

                if(false === $result){
                    // 验证失败 输出错误信息
                    return rejson(0,$this->getError());
                }
                return $adminLog->admin_log(1,'修改成功','edit',$param,UID);
            }else{
                $result =$this->allowField(true)->validate($this->veri)->save($param);
                if(false === $result){
                    // 验证失败 输出错误信息
                    return rejson(0,$this->getError());
                }
                return $adminLog->admin_log(1,'提交成功','add',$param,UID);
            }
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }

    public function dele($param){
        try{
            $adminLog=new Log;
            $ids=implode(',',$param);
            $this::destroy($ids);
            return $adminLog->admin_log(1,'删除成功','delete',$param,UID);
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }

}