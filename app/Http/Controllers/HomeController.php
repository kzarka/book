<?php

namespace App\Http\Controllers;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Posts;
use App\Models\ImagesSetting;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index1');
    }
}
