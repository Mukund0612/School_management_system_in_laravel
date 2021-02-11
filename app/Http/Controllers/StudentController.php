<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\students;
use App\branch;
use App\course;

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
        $branches = branch::all();
        $courses = course::all();
        return view('studentregistration', compact(['branches', 'courses']));
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
        $students->course_id = $request->course_id;
        $students->branch_id = $request->branch_id;
        // instert file name in database with extention 
        $students->profile_image = $request->file('profile_image')->getClientOriginalName();
        $students->save();
        
        // Move image to the our folder
        $request->profile_image->move(public_path('profile_images'), $students->profile_image);
        
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
        $students->course_id = $request->course_id;
        $students->branch_id = $request->branch_id;
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

    /**
     * Get data using ajax
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function courses(Request $request)
    {
        $id = $request->id;
        $data['courses'] = course::where('branch_id', $id)->get();
        echo json_encode($data);
    }
    
    /**
     * searching data usign ajax
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajax_show(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('short_by'); 
            $sort_by = $request->get('short_type'); 
            $search = $request->get('search');
            $search = str_replace(' ', '%', $search);

            $students = students::where('stu_name', 'like', '%'.$search.'%')
                                ->orWhere('fath_name', 'like', '%'.$search.'%')
                                ->orderBy($short_by, $short_type)
                                ->paginate(3);

            // $student = students::paginate(2);
            return view('student_details_ajax', compact('student'));
        }
    }
}
