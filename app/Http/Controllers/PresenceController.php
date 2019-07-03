<?php

namespace App\Http\Controllers;

use App\Presence;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PresenceController extends Controller
{
    use BasicRestTrait;

    public function __construct(){
        $this->model = 'presences';
        $this->model_single = 'presence';
        $this->model_object = Presence::class;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if($request->lecture_id){
        $presences = Presence::whereDate('date', \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->toDateString())
          ->whereHas('schedule', function ($query) use($request){
            $query->where('lecture_id', '=', $request->lecture_id);   
          });
        if($request->type == 'student'){
          $presences = $presences->whereHas('student');
        }
        if($request->type == 'lecturer'){
          $presences = $presences->whereHas('lecturer');
        }
        $presences = $presences->paginate(); 
      }
      if(!$request->lecture_id && !$request->date){
        $presences = Presence::paginate();
      }
      return view('student_presences', [
        $this->model => $presences, 
        'lectures' => $this->modelToSelectData(\App\Lecture::all())
        ]);
    }

    protected function modelToSelectData($model){
      return $model
        ->mapWithKeys(
          function ($data) {
            return [$data->id => $data['name']];})->toArray(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student_presences.create', [
          'lectures' => $this->modelToSelectData(\App\Lecture::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = \Validator::make($request->all(), 
      [
        'type' => ['required', Rule::in(['lecturer', 'student'])],
        'date' => 'required|date',
        'nim_or_nip' => 'required',
        'entry_hour' => 'required',
        'schedule_id' => 'required'
      ]);
      $validator->sometimes('nim_or_nip', 'exists:lecturers,NIP', function($input){
        return $input->type == 'lecturer'; 
      });
      $validator->sometimes('nim_or_nip', 'exists:students,NIM', function($input){
        return $input->type == 'student'; 
      });
      $validator->validate();

      $date = new \Carbon\Carbon($request->date);
      $presence_data = [
      'date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->toDateString(),
        'entry_hour' => $request->entry_hour,
        'schedule_id' => \App\Schedule::where('schedule_id', '=', $request->schedule_id)->first()->id
      ];

      if($request->type == 'student') {
        $presence_data['student_id'] =  \App\Student::where('NIM', '=', $request->nim_or_nip)
        ->first()
        ->id; 
      }

      if($request->type == 'lecturer') {
        $presence_data['lecturer_id'] =  \App\Lecturer::where('NIP', '=', $request->nim_or_nip)
        ->first()
        ->id; 
      }

      /* dd($presence_data); */

      $presence_model = Presence::create($presence_data);

      $this->basicStoreFlash();
      return $this->basicStoreRedirect($presence_model);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function show(Presence $presence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function edit(Presence $presence)
    {
      $date = new \Carbon\Carbon($presence->date);
      /* $presence->date = \Carbon\Carbon::createFromFormat(, $request->date)->toDateString(); */
      $presence->date = $date->format('d/m/Y');
      /* dd($presence); */
      return view('student_presences.edit', [
        'presence' => $presence
      ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presence $presence)
    {
        $validator = \Validator::make($request->all(), 
      [
        'type' => ['required', Rule::in(['lecturer', 'student'])],
        'date' => 'required|date',
        'nim_or_nip' => 'required',
        'entry_hour' => 'required',
        'schedule_id' => 'required'
      ]);
      $validator->sometimes('nim_or_nip', 'exists:lecturers,NIP', function($input){
        return $input->type == 'lecturer'; 
      });
      $validator->sometimes('nim_or_nip', 'exists:students,NIM', function($input){
        return $input->type == 'student'; 
      });
      $validator->validate();

      $date = new \Carbon\Carbon($request->date);
      $presence_data = [
      'date' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->toDateString(),
        'entry_hour' => $request->entry_hour,
        'schedule_id' => \App\Schedule::where('schedule_id', '=', $request->schedule_id)->first()->id
      ];

      if($request->type == 'student') {
        $presence_data['student_id'] =  \App\Student::where('NIM', '=', $request->nim_or_nip)
        ->first()
        ->id; 
      }

      if($request->type == 'lecturer') {
        $presence_data['lecturer_id'] =  \App\Lecturer::where('NIP', '=', $request->nim_or_nip)
        ->first()
        ->id; 
      }

      $presence_model = $presence->fill($presence_data)->save();

      $this->basicUpdateFlash();

      return $this->basicUpdateRedirect($presence);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presence  $presence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presence $presence, Request $request)
    {
        return $this->basicDestroy($request, $presence);
    }
}
