<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //定义$fillable属性
    protected $fillable = ['content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
