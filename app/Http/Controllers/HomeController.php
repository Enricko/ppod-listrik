<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function pelangganHome()
    {
        return view('home',["msg"=>"I'm User"]);
    }
    public function administrasiHome()
    {
        return view('home',["msg"=>"I have access in Admin"]);
    }
    public function bankHome()
    {
        return view('home',["msg"=>"Aku Bank"]);
    }
}
