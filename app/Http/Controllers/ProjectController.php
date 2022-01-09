<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\log;
use App\Models\Portfolio;
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
        $projects = Project::all()->where('ended',0)->sortByDesc('created_at');
        foreach ($projects as $p){
            $v = new Verta($p->created_at);
            $t = $v->formatDifference();
            $p->when = $t;
            $p->created_at = new Verta($p->created_at);
            $p->start = new Verta($p->start_date);
            $p->end = new Verta($p->end_date);
        }
        $projects_ended = Project::all()->where('ended',1)->sortByDesc('created_at');
        foreach ($projects_ended as $p){
            $v = new Verta($p->created_at);
            $t = $v->formatDifference();
            $p->when = $t;
            $p->created_at = new Verta($p->created_at);
            $p->start = new Verta($p->start_date);
            $p->end = new Verta($p->end_date);
        }
        $pageTitle = 'پروژه ها';

        return view('projects.index',compact('projects','projects_ended','pageTitle'));
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
            'log' => 'ایجاد پروژه '.$project->id.' توسط '.Auth::user()->name,
            'project_id' => $project->id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('projects.show',$project->id)
            ->with('status','Project created successfully.');
    }

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
        $comments = Comment::all()->where('project_id',$id)->sortByDesc('created_at');
        foreach ($comments as $c){
            $c->when = new Verta($c->created_at);
            $c->when = $c->when->formatDifference();
        }
        $portfolios = Portfolio::all()->where('project_id',$id)->sortByDesc('created_at');
        return (view('projects.show' , compact('pageTitle','portfolios','comments','project','logs')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $users = User::all()->sortBy('name');
        $pageTitle = 'ویرایش پروژه';

        return view('projects.edit',compact('pageTitle','users','project'));
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
        if ($request->exists('ended')&&$project->ended === 0) {
            Log::create([
                'code' => 109,
                'log' => 'اعلام پایان پروژه '.$project->id.' توسط '. Auth::user()->name,
                'project_id' => $project->id,
                'user_id' => Auth::id()
            ]);
            $alert = 'پروژه با موفقیت به پایان رسید';
        }elseif ($request->exists('ended')&&$project->ended === 1){
            Log::create([
                'code' => 101,
                'log' => 'شروع مجدد پروژه '.$project->id.' توسط '. Auth::user()->name,
                'project_id' => $project->id,
                'user_id' => Auth::id()
            ]);
            $alert = 'ثبت سروع مجدد پروژه با موفقیت  انجام گرفت';
        }else{
            Log::create([
                'code' => 102,
                'log' => 'ویرایش پروژه '.$project->id.' توسط '. Auth::user()->name,
                'project_id' => $project->id,
                'user_id' => Auth::id()
            ]);
            $alert = 'پروژه با موفقیت ویرایش شد';

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
        Log::create([
            'code' => 108,
            'log' => 'حذف پروژه توسط ' . Auth::user()->name,
            'project_id' => $project->id,
            'user_id' => Auth::id()
        ]);
        return redirect()->route('projects.index')
            ->with('status','Projects deleted successfully');
    }
}
