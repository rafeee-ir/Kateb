<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class WelcomeController extends Controller
{
    public function index(){
        $portfolios = Portfolio::whereNotNull('pic')->inRandomOrder()->with(['project' => function ($query) {
            $query->select('id', 'title');
        }])->take(6)->get();
            return view('welcome',compact('portfolios'));

    }
}
