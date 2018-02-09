<?php

namespace app\index\model;

use think\Exception;
use think\Model;
class Test extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_test';
    protected $field = ['title','content','status','add_time'];

}