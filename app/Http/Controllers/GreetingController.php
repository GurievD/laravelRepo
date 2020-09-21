<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingController extends Controller
{
    function hello($name) {
        return view('greeting.hello', ['name' => $name]);
    }
}
