<?php

namespace App\Http\Controllers;

use App\Models\log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        Log::create([
            'code' => 1,
            'log' => 'visit home',
            'user_id' => Auth::id()
        ]);
        return view('home');
    }

}
