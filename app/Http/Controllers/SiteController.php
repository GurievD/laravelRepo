<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {
        if (auth()->check())
            $categories = Category::query()
                ->where('user_id', auth()->id())
                ->get();

        return view('index', [
            'categories' => $categories ?? []
        ]);
    }

    public function about()
    {
        return view('about');
    }
}
