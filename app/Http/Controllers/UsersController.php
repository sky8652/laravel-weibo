<?php

namespace App\Http\Controllers;

use Auth;
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

    //处理表单数据的提交验证
    public function store(Request $request)
    {
        //表单输入验证的具体规则
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        //验证通过将信息插入数据库
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //用户注册成功后自动登录
        Auth::login($user);
        //在页面顶部位置显示注册成功的提示信息
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        //返回信息到路由，在前端展示
        return redirect()->route('users.show', [$user]);
    }

    //用户编辑个人资料页面
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    //用户更新的信息保存到数据库
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        //允许用户不填写密码字段，这样就采取用户之前的密码放入数据库
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user);
    }
}
