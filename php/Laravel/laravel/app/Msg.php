<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    protected $table = 'msgs'; //修改该Model控制的表
    protected $primaryKey = 'id'; //修改主键列名
    public $timestamps = false;
}
