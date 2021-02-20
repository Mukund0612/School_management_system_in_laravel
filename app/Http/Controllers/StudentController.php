<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\students;
use App\branch;
use App\course;
use App\student_fees;

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
        $varification_code = generate_varification_code();

        $request->validate([
            'stu_name' => 'required | alpha | min:2',
            'fath_name' => 'required | alpha | min:2',
            'class' => 'required | numeric',
            'phone_no' => 'required | numeric | digits:10',
            'email' => 'required | email',
            'branch_id' => 'required',
            'course_id' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $students = new students;
        $students->stu_name = $request->stu_name;
        $students->fath_name = $request->fath_name;
        $students->class = $request->class;
        $students->phone_no = $request->phone_no;
        $students->email = $request->email;
        $students->course_id = $request->course_id;
        $students->branch_id = $request->branch_id;
        $students->verification_code = $varification_code;

        // instert file name in database with extention 
        $students->profile_image = $request->file('profile_image')->getClientOriginalName();
        $students->save();

        // Move image to the our folder
        $request->profile_image->move(public_path('profile_images'), $students->profile_image);

        // send mail to register studend
        $varification_link = "http://127.0.0.1:8000/emailvarification/".$varification_code;
        
        $details = [
            'title' => "Verify your Account.",
            'body' => 'Click on this link to Verify your account.',
            'varification_link' => $varification_link
        ];

        \Mail::to($students->email)->send(new \App\Mail\RegisterUser($details));

        session()->flash('mailsend', 'Verify mail send your Mail check and Verify it.');

        return redirect('registration');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $student_cols = $request->get('filter');

        if ($request->ajax()) {
            if ($student_cols) {
                $columns = explode(',', $student_cols);
                $student = students::select('id', 'stu_name');

                foreach ($columns as $key => $value) {
                    $student->addselect($value);
                }

                $students = $student->paginate(2);
                return view('student_details_ajax', compact('students'));
            } else {
                $students = students::select('id', 'stu_name')->paginate(2);
                return view('student_details_ajax', compact('students'));
            }
        } else {
            $students = students::select('id', 'stu_name')->paginate(2);
            return view('student_details', compact('students'));
        }
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
        $branches = branch::all();
        return view('student_edit', compact('student', 'branches'));
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
        // form validation
        $request->validate([
            'stu_name' => 'required | alpha | min:2',
            'fath_name' => 'required | alpha | min:2',
            'class' => 'required | numeric',
            'phone_no' => 'required|digits:10',
            'email' => 'required | email',
            'branch_id' => 'required',
            'course_id' => 'required',
        ]);

        $student = students::find($id);
        $student->stu_name = $request->stu_name;
        $student->fath_name = $request->fath_name;
        $student->class = $request->class;
        $student->phone_no = $request->phone_no;
        $student->email = $request->email;
        $student->course_id = $request->course_id;
        $student->branch_id = $request->branch_id;
        $student->save();

        // Set flash message and redirect last url
        session()->flash('update', 'Profile Update SuccessFull..');

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

        // Set flash message and redirect last url
        session()->flash('delete', 'Profile delete SuccessFull..');

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
            $short_by = $request->get('short_by'); 
            $short_type = $request->get('short_type'); 
            $search = $request->get('search');
            $search = str_replace(' ', '%', $search);

            $students = students::where('stu_name', 'like', '%'.$search.'%')
                                ->orWhere('fath_name', 'like', '%'.$search.'%')
                                ->orderBy($short_by, $short_type)
                                ->paginate(2);

            // $student = students::paginate(2);
            return view('student_details_ajax', compact('students'));
        }
    }
    
    /**
     * View single student profile
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function single_student(Request $request)
    {
        $id = $request->id;
        $student = students::where(['id' => $id])->get();

        return view('student_profile', compact('student'));
    }
    
    /**
     * View single student profile
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fees_form(Request $request)
    {
        $id = $request->id;
        $fees = student_fees::where(['student_id' => $id])->get();
        return view('fees_form', compact('fees', 'id'));
    }
    
    /**
     * View single student profile
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pay_fees(Request $request)
    {
        $id = $request->id;
        $fees = new student_fees;
        $fees->student_id = $id;
        $fees->amount = $request->amount;
        $fees->save();
        return redirect( route('student-fees', ['id' => $id]));
    }

    public function email_varification($code)
    {
        $student = students::where('verification_code', $code)->get();
        $students = students::find($student[0]->id);
        if ($student) {
            $students->verification_status = 1;
        }
        $students->save();
        // Set flash message and redirect last url
        session()->flash('verification', 'Email Verification SuccessFull..');

        return redirect('student_details');
    }
}
