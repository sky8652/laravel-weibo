<?php

/*
|--------------------------------------------------------------------------
| 路由文件
|--------------------------------------------------------------------------
|
|
*/
//主页
Route::get('/', 'StaticPagesController@home')->name('home');

//帮助
Route::get('/help', 'StaticPagesController@help')->name('help');

//关于
Route::get('/about', 'StaticPagesController@about')->name('about');

//登录(laravel兼容这种写法，和/signup并无区别)
Route::get('signup', 'UsersController@create')->name('signup');