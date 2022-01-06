<?php

namespace App\Http\Controllers;

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
        return view('home');
    }
    /**
     * Show the user setting
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function setting()
    {
        $user = Auth::user();
        $pageTitle = 'تنظیمات کاربری ' . Auth::user()->name;
        return view('setting', compact('user','pageTitle'));
    }
    /**
     * Show all users
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        $users = User::all();
        $pageTitle = 'لیست کاربران';
        return view('users', compact('users','pageTitle'));
    }
    /**
     * Show a user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user($id)
    {
        $user = User::findorfail($id);
        $pageTitle= 'پروفایل ' . $user->name;
        return view('setting', compact('user','pageTitle'));
    }
}
