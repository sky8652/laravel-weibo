<?php

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        //用户名
        'name' => $faker->name,
        //邮箱
        'email' => $faker->unique()->safeEmail,
        //验证邮箱日期
        'email_verified_at' => now(),
        //密码
        'password' => '$2y$10$HBu3tKorjSwhj/2kcZm/Luzvxo2Zj3DLv7GjYswHsItzUUtdm/53q', // 123456
        //是否记住密码
        'remember_token' => Str::random(10),
        //注册日期
        'created_at' => $date_time,
        //更新日期
        'updated_at' => $date_time,
    ];
});