<?php

namespace App\Http\Controllers;

use Auth;
//引用模型，否则找不到数据
use App\Models\User;
//引用Request请求
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //过滤未登录用户操作用户资料，将未登录用户重定向到登录界面
    public function __construct()
    {
        //公开权限，允许游客访问的路由
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index']
        ]);

        //只让未登录用户访问登录界面
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //列出所有用户
    public function index()
    {
        //指定每页生成的数据数量为 10 条
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

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

    //用户修改个人资料
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    //更新数据库的用户信息
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user->id);
    }

    //删除用户
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }


}
