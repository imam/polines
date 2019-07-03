<?php

namespace App\Http\Controllers;

use App\Lecture;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    use BasicRestTrait;

    public function __construct(){
        $this->model = 'lectures';
        $this->model_single = 'lecture';
        $this->model_object = Lecture::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->basicIndex();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view($this->model.'.create');
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
        'lecture_id' => 'required|unique:lectures',
        'name' => 'required',
        'sks' => 'required'
      ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function show(Lecture $lecture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Lecture $lecture)
    {
        return $this->basicEdit($request, $lecture);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecture $lecture)
    {
        return $this->basicUpdate($request, $lecture, [
            'name' => 'required', 
            'sks' => 'required'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lecture  $lecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecture $lecture, Request $request)
    {
        return $this->basicDestroy($request, $lecture);
    }
}
