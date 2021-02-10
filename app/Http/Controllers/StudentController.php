<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\students;

class StudentController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('studentregistration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $students = new students;
        $students->stu_name = $request->stu_name;
        $students->fath_name = $request->fath_name;
        $students->class = $request->class;
        $students->phone_no = $request->phone_no;
        $students->email = $request->email;
        $students->save();
        return redirect('registration');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $students = students::paginate(2);
        return view('student_details', compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = students::find($id);
        return view('student_edit', compact('student'));
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
        $student = students::find($id);
        $student->stu_name = $request->stu_name;
        $student->fath_name = $request->fath_name;
        $student->class = $request->class;
        $student->phone_no = $request->phone_no;
        $student->email = $request->email;
        $student->save();
        return redirect('student_details');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = students::find($id);
        $student->delete();
        return redirect('student_details');
    }
}
