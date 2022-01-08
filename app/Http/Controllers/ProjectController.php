<?php

namespace App\Http\Controllers;

use App\Models\log;
use App\Models\Project;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all()->sortByDesc('created_at');
        foreach ($projects as $p){
            $v = new Verta($p->created_at);
            $t = $v->formatDifference();
            $p->when = $t;
            $p->created_at = new Verta($p->created_at);
            $p->start = new Verta($p->start_date);
            $p->end = new Verta($p->end_date);
        }
        $pageTitle = 'پروژه ها';

        return view('projects.index',compact('projects','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->sortBy('name');
        $pageTitle = 'افزودن پروژه';
        return view('projects.create',compact('pageTitle','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $project = Project::create($request->all());
        Log::create([
            'code' => 100,
            'log' => 'ایجاد پروژه توسط '.Auth::user()->name,
            'project_id' => $project->id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('projects.show',$project->id)
            ->with('status','Project created successfully.');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findorfail($id);
        $pageTitle = $project->title;
        $project->start = new Verta($project->start_date);
        $project->end = new Verta($project->end_date);
        $project->when = new Verta($project->created_at);
        $project->when = $project->when->formatDifference();
        $logs = Log::all()->where('project_id',$project->id)->sortByDesc('created_at');
        foreach ($logs as $log){
            $log->when = new Verta($log->created_at);
            $log->when = $log->when->formatDifference();
        }
        return (view('projects.show' , compact('pageTitle','project','logs')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project)
    {
        $alert = '';
        if ($request->exists('ended')&&$project->ended === 0) {
            Log::create([
                'code' => 109,
                'log' => 'اعلام پایان پروژه توسط ' . Auth::user()->name,
                'project_id' => $project->id,
                'user_id' => Auth::id()
            ]);
            $alert = 'پروژه با موفقیت به پایان رسید';
        }elseif ($request->exists('ended')&&$project->ended === 1){
            Log::create([
                'code' => 101,
                'log' => 'شروع مجدد پروژه توسط ' . Auth::user()->name,
                'project_id' => $project->id,
                'user_id' => Auth::id()
            ]);
            $alert = 'ثبت سروع مجدد پروژه با موفقیت  انجام گرفت';
        }

        $project->update($request->all());

        return redirect()->route('projects.show',$project->id)
            ->with('status',$alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('status','Projects deleted successfully');
    }
}
