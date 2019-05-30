<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Weibo App') - Laravel 入门教程</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

<!--引入头部视图定义-->
@include('layouts._header')

<div class="container">

    {{--消息提醒视图   --}}
    @include('shared._messages')

    @yield('content')

    <!--引入底部试图定义-->
    @include('layouts._footer')
</div>
</body>
</html>