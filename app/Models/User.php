<?php

//命名空间
namespace App\Models;

//消息通知相关功能引用
use Illuminate\Notifications\Notifiable;
//邮箱验证功能
use Illuminate\Contracts\Auth\MustVerifyEmail;
//授权相关功能的引用
use Illuminate\Foundation\Auth\User as Authenticatable;

    /**
     * laravel默认的用户模型文件
     *
     * @var array
     */

class User extends Authenticatable
{
    use Notifiable;

    //指明要进行数据库交互的数据库表名称
    protected $table = 'users';


    //过滤用户提交的字段，只有包含在该属性中的字段才能够被正常更新

    protected $fillable = [
        'name', 'email', 'password',
    ];

    //需要对用户密码或其它敏感信息在用户实例通过数组或 JSON 显示时进行隐藏
    protected $hidden = [
        'password', 'remember_token',
    ];

    //邮箱验证的时间
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
