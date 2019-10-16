<?php

namespace App\Http\Controllers;

use App\Project;
use App\Sprint;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        return $project->sprints;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Project $project)
    {
        $arguments = request()->validate([
            'title'=>'required',
            'description'=>'required'
        ],
        [
            'title.required'=>'Enter a valid title',
            'description.required'=>'Enter a valid description'
        ]);

        $sprint=$project->sprints()->create($arguments);

        return [
            'id'=> $sprint->id,
            'message'=>'Sprint Created',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sprint  $sprint
     * @return \Illuminate\Http\Response
     */
    public function show(Sprint $sprint)
    {
        return $sprint;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sprint  $sprint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sprint $sprint)
    {
        $arguments = request()->validate([
            'title'=>'required',
            'description'=>'required'
        ],
        [
            'title.required'=>'Enter a valid title',
            'description.required'=>'Enter a valid description'
        ]);

        $sprint->update($arguments);

        return [
            'message'=>'Sprint Updated',
            'status'=>true
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sprint  $sprint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sprint $sprint)
    {
        $sprint->delete();
        return [
            'message'=>'Sprint Deleted',
            'status'=>true
        ];
    }
}
