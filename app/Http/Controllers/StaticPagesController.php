<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    //主页方法
    public function home()
    {
        return view('static_pages/home');
    }

    //帮助页方法
    public function help()
    {
        return view('static_pages/help');
    }

    //关于页方法
    public function about()
    {
        return view('static_pages/about');
    }
}
