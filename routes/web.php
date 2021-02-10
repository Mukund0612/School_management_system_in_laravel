<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'AdminController@adminlogin');
Route::post('islogin', 'AdminController@adminloged');

Route::view('dashboard', 'dashboard');

########################### FOR STUDENTS #######################

// Student Registration
Route::get('registration', 'StudentController@create');

// Student Data Insert
Route::post('student_insert', 'StudentController@store');

// Student Data View
Route::get('student_details', 'StudentController@show');

// Student data Edit and Sequrity perpese route
Route::get('/student_edit/{id}', ['as'=>'student-edit', 'uses'=>'StudentController@edit']);

// student data update
Route::post('/student_update/{id}', ['as'=>'student-update', 'uses'=>'StudentController@update']);

// student data delete
Route::get('/student_delete/{id}', ['as'=>'student-delete', 'uses'=>'StudentController@destroy']);

########################### FOR Branch #######################

// branch details
Route::get('add_branch', 'BranchController@create');

// Branch Data Insert
Route::post('branch_insert', 'BranchController@store');

// Branch Data Insert
Route::get('branch_details', 'BranchController@show');

// Branch Data edit
Route::get('/branch_edit/{id}', ['as'=>'branch-edit' , 'uses'=>'BranchController@edit']);

// Branch Data update
Route::post('/branch_update/{id}', ['as'=>'branch-update' , 'uses'=>'BranchController@update']);

// Branch Data edit
Route::get('/branch_delete/{id}', ['as'=>'branch-delete' , 'uses'=>'BranchController@destroy']);