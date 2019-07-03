<?php

namespace App\Http\Controllers;

use App\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    use BasicRestTrait;

    public function __construct(){
        $this->model = 'lecturers';
        $this->model_single = 'lecturer';
        $this->model_object = Lecturer::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->model, [$this->model => $this->model_object::paginate()]);
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
            'NIP' => 'required|unique:lecturers',
            'name' => 'required', 
            'lecturer_id' => 'required|unique:lecturers'
        ], function ($lecturer) {
            $user = new \App\User;
            $user->NIP = $lecturer->NIP;
            $user->fill(['NIP' => $lecturer->NIP, 'password' => bcrypt('password')]);
            $user->save();
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function show(Lecturer $lecturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Lecturer $lecturer)
    {
        return $this->basicEdit($request, $lecturer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        return $this->basicUpdate($request, $lecturer, [
            'name' => 'required', 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecturer $lecturer, Request $request)
    {
        return $this->basicDestroy($request, $lecturer);
    }
}
