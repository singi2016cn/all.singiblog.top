<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DemandsConfig extends Controller
{
    public static $type_settings = [
        1 => '小程序',
        2 => '电商',
        3 => '门户',
        4 => '官网',
        5 => '平台',
        6 => '博客',
        7 => '其他',
    ];

    public static $platform_settings = [
        1 => 'android',
        2 => 'ios',
        3 => 'pad',
        4 => 'pc',
        5 => '其他',
    ];
}
