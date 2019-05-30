<?php

//命名空间
namespace App\Models;

use Illuminate\Support\Str;
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

    //监听模型被创建之前的事件
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = Str::random(10);
        });
    }

    //邮箱验证的时间
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //使用gravatar方法生成用户的头像
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    //指明一个用户拥有多条微博
    public function statuses()
    {
        //一对多的关系
        return $this->hasMany(Status::class);
    }

    //获取当前用户关注的人发布过的所有微博动态,发布即更新
    public function feed()
    {
        return $this->statuses()
            ->orderBy('created_at', 'desc');
    }

    //多对多关系
    public function followers()
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
    }

    //多对多关系
    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }

    //关注
    public function follow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }

    //取消关注
    public function unfollow($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    //判断A用户是否关注了B用户
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
}
