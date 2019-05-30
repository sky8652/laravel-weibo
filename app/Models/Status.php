<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //定义$fillable属性，修复批量赋值的报错
    protected $fillable = ['content'];

    public function user()
    {
        //一对一的关系
        return $this->belongsTo(User::class);
    }
}
