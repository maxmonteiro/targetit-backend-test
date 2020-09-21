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
        $schedulings = Scheduling::all();
        foreach ($schedulings as $value) {
            $value->room->local;
        }

        return SchedulingResource::collection($schedulings);
    }

    public function schedulingsDay(Request $request)
    {
        $date = $request->input('date_scheduling');
        $schedulings = Scheduling::where('date_scheduling', $date)->get();
        foreach ($schedulings as $value) {
            $value->room->local;
        }

        return SchedulingResource::collection($schedulings);
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
        $scheduling = Scheduling::findOrFail($id);
        return new SchedulingResource($scheduling);
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
        $scheduling = Scheduling::findOrFail($id);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scheduling = Scheduling::findOrFail($id);
        $scheduling->delete();

        return new SchedulingResource($scheduling);
    }
}
