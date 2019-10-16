<?php

namespace App\Http\Controllers;

use App\Sprint;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Sprint $sprint)
    {
        return $sprint->tasks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Sprint $sprint)
    {
        $arguments = request()->validate([
            'title'=>'required',
            'description'=>'required'
        ],
        [
            'title.required'=>'Enter a valid title',
            'description.required'=>'Enter a valid description'
        ]);

        $task = $sprint->tasks()->create($arguments);

        return [
            'id'=>$task->id,
            'message'=>'Task Created',
            'status'=>true
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $arguments = request()->validate([
            'title'=>'required',
            'description'=>'required',
            'is_done'=>'nullable'
        ],
        [
            'title.required'=>'Enter a valid title',
            'description.required'=>'Enter a valid description'
        ]);

        $task->update($arguments);

        return [
            'message'=>'Task Updated',
            'status'=>true
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return [
            'message'=>'Task Deleted',
            'status'=>true
        ];
    }
}
