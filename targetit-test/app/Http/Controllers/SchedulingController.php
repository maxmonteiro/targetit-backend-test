<?php

namespace App\Http\Controllers;

use App\Http\Resources\Scheduling as SchedulingResource;
use App\Scheduling;
use Illuminate\Http\Request;

class SchedulingController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scheduling = new Scheduling;
        $scheduling->date_scheduling = $request->input('date_scheduling');
        $scheduling->time_start = $request->input('time_start');
        $scheduling->time_end = $request->input('time_end');
        $scheduling->user_id = $request->input('user_id');
        $scheduling->room_id = $request->input('room_id');

        if ($scheduling->save()) {
            return new SchedulingResource($scheduling);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
