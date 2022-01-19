<?php

namespace App\Http\Controllers;

use App\Models\log;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return Task[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function getTasksOfTheProject($project)
    {
        Return Task::all()->where('project_id',$project)->sortByDesc('created_at');

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $task = Task::create($request->all());
        Log::create([
            'code' => 118,
            'log' => 'افزودن وظیفه به کار '.$task->project_id.' توسط '.Auth::user()->name,
            'project_id' => $task->project_id,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()
            ->with('status','Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return Task
     */
    public function update(Request $request, Task $task)
    {
        $task->update($request->all());

        return $task;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return Task
     */
    public function doneTask(Request $request)
    {
        $task = Task::find($request->id);
        $task->update($request->all());
        if ($task->is_done===true){
            $done = 'انجام شده';
        }else{
            $done = 'انجام نشده';
        }
        Log::create([
            'code' => 180,
            'log' => 'تغییر وضعیت وظیفه '.$task->task.' توسط '. Auth::user()->name.' به '.$done,
            'project_id' => $task->project_id,
            'user_id' => Auth::id()
        ]);
//        return $task;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return Task
     */
    public function addTask(Request $request)
    {
        $task = Task::create($request->all());

        Log::create([
            'code' => 181,
            'log' => 'ثبت وظیفه '.$task->task.' توسط '. Auth::user()->name,
            'project_id' => $request->project_id,
            'user_id' => Auth::id()
        ]);
//        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }


}
