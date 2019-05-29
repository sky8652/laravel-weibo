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