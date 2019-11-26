<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photos;

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
        $photo = Photos::photo()->get();

        return view('home')->with('photo', $photo);
    }
}
