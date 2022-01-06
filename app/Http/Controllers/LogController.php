<?php

namespace App\Http\Controllers;

use App\Models\log;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Log::all()->sortByDesc('created_at');
        foreach ($logs as $log){
            $v = new Verta($log->created_at);
            $t = $v->formatDifference();
            $log->when = $t;
        }
        $pageTitle = 'فعالیت ها';
        return view('log',compact('logs','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\log  $log
     * @return \Illuminate\Http\Response
     */
    public function edit(log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\log  $log
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(log $log)
    {
        //
    }

    public function myActivities()
    {
        $logs = Log::all()->where('user_id', Auth::id())->sortByDesc('created_at')->take(5);
        foreach ($logs as $log){

            $v = new Verta($log->created_at);
            $t = $v->formatDifference();
            $log->when = $t;
        }
        $user = Auth::user();
        $pageTitle = 'فعالیت های من';
        return view('log',compact('logs','user','pageTitle'));
    }

}
