<?php

namespace App\Http\Controllers;

use App\Models\log;
use App\Models\Project;
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
        $projects_active = Project::all()->where('ended',0)->count();
        $projects_ended = Project::all()->where('ended',1)->count();
        return view('home',compact('projects_active','projects_ended'));
    }

}
