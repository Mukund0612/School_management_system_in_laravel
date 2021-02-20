<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\admin;
use Session;

class AdminController extends Controller
{
    public function adminlogin()
    {
        return view('adminlogin');
    }

    public function adminloged(Request $request)
    {
        $request->validate([
            'username' => 'required | min:5 | alpha',
            'password' => 'required'
        ]);

        $admin = admin::where('username', $request->username)->where('password', $request->password)->get()->toArray();
        
        if ($admin) {
            $request->session()->put('admin_session', $admin[0]['id']);
            return redirect('dashboard');
        } else {
            session::flash('coc', 'Email and Password Not Match.');
            return redirect('/')->withInput();
        }
    }

}
