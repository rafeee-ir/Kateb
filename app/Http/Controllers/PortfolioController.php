<?php

namespace App\Http\Controllers;

use App\Models\log;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
//        $this->middleware('auth');

//        $this->middleware('permission:portfolio-list|portfolio-create|portfolio-edit|portfolio-delete', ['only' => ['index','show']]);
        $this->middleware('permission:portfolio-create', ['only' => ['create','store']]);
        $this->middleware('permission:portfolio-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:portfolio-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::all()->sortByDesc('created_at');
        $pageTitle = 'نمونه کارها';
        return (view('portfolios.index',compact('portfolios','pageTitle')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->sortBy('name');
        $projects = Project::all()->sortBy('title');
        $pageTitle = 'افزودن نمونه کار';
        return view('portfolios.create',compact('pageTitle','projects','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pic' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);
        $portfolio = Portfolio::create($request->all());

//        $name = $request->file('pic')->getClientOriginalName();
        $path = $request->file('pic')->store('portfolios/images');
//        $save = new Portfolio();
//        $save->name = $name;
        $portfolio->pic = $path;

        $portfolio->save();
        Log::create([
            'code' => 103,
            'log' => 'افزودن نمونه کار '.$portfolio->id.' توسط '.Auth::user()->name,
            'project_id' => $portfolio->project_id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('portfolios.index')
            ->with('status','Portfolio created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}
