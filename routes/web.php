<?php

/*
|--------------------------------------------------------------------------
| 路由文件
|--------------------------------------------------------------------------
*/
//主页
Route::get('/', 'StaticPagesController@home')->name('home');

//帮助
Route::get('/help', 'StaticPagesController@help')->name('help');

//关于
Route::get('/about', 'StaticPagesController@about')->name('about');

//登录(laravel兼容这种写法，和/signup并无区别)
Route::get('signup', 'UsersController@create')->name('signup');

//用户注册
Route::resource('users', 'UsersController');

//显示登录页面
Route::get('login', 'SessionsController@create')->name('login');

//创建新会话（登录）
Route::post('login', 'SessionsController@store')->name('login');

//销毁会话（退出登录）
Route::delete('logout', 'SessionsController@destroy')->name('logout');

//邮件激活
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//显示重置密码的邮箱发送页面
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

//邮箱发送重设链接
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

//密码更新页面
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

//执行密码更新操作
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//POST处理创建微博的请求,DELETE处理删除微博的请求
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);