<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', '犯二青年') - Laravel 练习项目</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>

{{--引入头部视图定义--}}
@include('layouts._header')

<div class="container">
    <div class="offset-md-1 col-md-10">
        {{--消息提醒视图--}}
        @include('shared._messages')

        @yield('content')

        {{--引入底部试图定义--}}
        @include('layouts._footer')
    </div>
</div>
{{--引入js文件--}}
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>