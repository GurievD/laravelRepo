<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GreetingController extends Controller
{
    function hello() {
        return view('greeting.hello');
    }
}
