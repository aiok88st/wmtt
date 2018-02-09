<?php

namespace app\admin\model;

use think\Exception;
use think\Model;
class Product extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_product';
    protected $field = ['title', 'img', 'integral','number','add_time'];
    protected $veri=[
        'title|产品名称' => 'require|max:255',
        'integral|可兑换' => 'require',
        'number|剩余数' => 'require',
        'img|产品图片' => 'require',
    ];

    public function add($param){
        try{
            $adminLog=new Log;
            if(isset($param['id'])){
                $result = (new Product)
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