<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColorController extends Controller
{
    public static $setting = ['default','primary','success','info','warning','danger'];

    public static function getSetting(){
        return array_random(self::$setting);
    }
}
