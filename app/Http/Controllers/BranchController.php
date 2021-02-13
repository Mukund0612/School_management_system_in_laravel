<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\branch;

class BranchController extends Controller
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
        return view('add_branch');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation of form
        $request->validate([
            'branch_short_name' => 'required | min:2',
            'branch_full_name' => 'required | min:2'
        ]);

        $branch = new branch;
        $branch->branch_short_name = $request->branch_short_name;
        $branch->branch_full_name = $request->branch_full_name;
        $branch->save();

        // set flash message
        session()->flash('insert', 'Insert Branch SuccessFully.');

        return redirect('add_branch');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $branches = branch::paginate(2);
        return view('branch_details', compact('branches'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branches = branch::find($id);
        return view('edit_branch', compact('branches'));
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
        // validation
        $request->validate([
            'branch_short_name' => 'required | min:2',
            'branch_full_name' => 'required | min:2'
        ]);

        $branch = branch::find($id);
        $branch->branch_short_name = $request->branch_short_name;
        $branch->branch_full_name = $request->branch_full_name;
        $branch->save();

        // set flash message for update branch
        session()->flash('update', 'Update Branch SuccessFully.');

        return redirect('branch_details');
    }

    /**
     * Remove the specified resource from storage.
     *
     * DELETE BRANCH
     * -------------
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = branch::find($id);
        $branch->delete();

        // set flash message for delete branch
        session()->flash('delete', 'Branch Delete SuccessFully..');
        return redirect('branch_details');
    }
}
