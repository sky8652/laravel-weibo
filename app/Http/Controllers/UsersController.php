<?php

namespace App\Http\Controllers;

//引用模型，否则找不到数据
use App\Models\User;
//引用Request请求
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //用户注册方法
    public function create()
    {
        return view('users.create');
    }

    //用户注册页面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
}
