<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\branch;
use App\course;

class CourseController extends Controller
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
        return view('add_cource', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // set validation
        $request->validate([
            'branch_id' => 'required',
            'course_name' => 'required | min:2'
        ]);

        $course = new course;
        $course->branch_id = $request->branch_id;
        $course->course_name = $request->course_name;
        $course->save();

        // add flash message
            session()->flash('insert', 'Insert Course SuccessFully..');

        return redirect('add_course');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $courses = course::select('branches.branch_full_name', 'courses.*')
                        ->join('branches', 'courses.branch_id', 'branches.id')
                        ->orderBy('id', 'ASC')
                        ->paginate(2);
        #
        # For Query Print
        #

        // DB::enableQueryLog();

        # Second method to join
        // $courses = DB::table('courses')
        //                 ->select('branches.branch_full_name', 'courses.*')
        //                 ->join('branches', 'courses.branch_id', 'branches.id')
        //                 ->paginate(2);
        // dd(DB::getQueryLog());
        // $courses = $course['data'];

        // echo "<pre>";
        // print_r($courses);
        // exit;
        return view('course_details', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses['courses'] = course::find($id);
        $courses['branches'] = course::select('branches.branch_full_name', 'courses.*')
                            ->join('branches', 'courses.branch_id', 'branches.id')
                            ->orderBy('id', 'ASC')
                            ->get();
        // echo "<pre>";
        // print_r($courses['courses']);
        // exit;
        return view('edit_course', compact('courses'));
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
        // set validation
        $request->validate([
            'branch_id' => 'required',
            'course_name' => 'required | min:2'
        ]);

        $courses = course::find($id);
        $courses->branch_id = $request->branch_id;
        $courses->course_name = $request->course_name;
        $courses->save();

        // add flash message
        session()->flash('update', 'Update Course SuccessFully..');

        return redirect('course_details');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courses = course::find($id);
        $courses->delete();

        // add flash message
        session()->flash('delete', 'Delete Course SuccessFully..');

        return redirect('course_details');
    }
}
