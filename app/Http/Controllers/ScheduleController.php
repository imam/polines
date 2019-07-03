<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use BasicRestTrait;

    public function __construct(){
        $this->model = 'schedules';
        $this->model_single = 'schedule';
        $this->model_object = Schedule::class;
    }
    protected $validation = [
      'schedule_id' => 'required|unique:schedules',
      'day' => 'required',
      'entry_hour' => 'required',
      'lecture_id' => 'required',
      'lecturer_id' => 'required',
      'classroom_id' => 'required',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->basicIndex();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view($this->model.'.create', [
        'lecture'=> $this->modelToSelectData(\App\Lecture::all()),
        'lecturer'=> $this->modelToSelectData(\App\Lecturer::all()),
        'classroom'=> $this->modelToSelectData(\App\Classroom::all()),
        ]
      );
    }

    protected function modelToSelectData($model){
      return $model
        ->mapWithKeys(
          function ($data) {
            return [$data->id => $data['name']];})->toArray(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->basicStore($request, [
          'schedule_id' => 'required|unique:schedules',
          'day' => 'required',
          'entry_hour' => 'required',
          'lecture_id' => 'required',
          'lecturer_id' => 'required',
          'classroom_id' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedules  $schedules
     * @return \Illuminate\Http\Response
     */
    public function show(Schedules $schedules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedules  $schedules
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule, Request $request)
    {
        return $this->basicEdit($request, $schedule, [
        'lecture'=> $this->modelToSelectData(\App\Lecture::all()),
        'lecturer'=> $this->modelToSelectData(\App\Lecturer::all()),
        'classroom'=> $this->modelToSelectData(\App\Classroom::all()),
        ]
);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedules  $schedules
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
      return $this->basicUpdate($request, $schedule, collect($this->validation)->forget('schedule_id')->toArray()); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedules  $schedules
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule, Request $request)
    {
        return $this->basicDestroy($request, $schedule);
    }
}
