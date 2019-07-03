<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('students', ['students' => Student::paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NIM' => 'required|unique:students',
            'name' => 'required', 
            'student_id' => 'required|unique:students',
            'class' => 'required'
        ]);

        $student = \App\Student::create($validatedData);
        
        $user = new \App\User;
        $user->NIM = $validatedData['NIM'];
        $user->fill(['NIM' => $validatedData['NIM'], 'password' => bcrypt('password')]);
        $user->save();

        $request->session()->flash('student_added', true);

        return redirect("/students/".$student->id."/edit");
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('students.edit', ['student'=> \App\Student::findOrFail($id)]);
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
        $validatedData = $request->validate([
            'name' => 'required', 
            'class' => 'required'
        ]);

        $student = \App\Student::findOrFail($id);
        $student->fill($validatedData)->save();

        return redirect("/students/".$id."/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        \App\Student::destroy($id);

        $request->session()->flash('student_deleted', true);

        return redirect("/students");
    }
}
