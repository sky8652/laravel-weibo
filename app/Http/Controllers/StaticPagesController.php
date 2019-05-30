<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;

class StaticPagesController extends Controller
{
    //主页方法
    public function home()
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }

        return view('static_pages/home', compact('feed_items'));
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
