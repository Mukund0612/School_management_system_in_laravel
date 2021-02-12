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

// fetch course data using select by branch
Route::post('/student/courses', 'StudentController@courses');

// searching data with ajax
Route::get('student_details_ajax', 'StudentController@ajax_show');

// short by column asendind or desending
Route::post('student_details_2', 'StudentController@show');

// Single student data view
Route::get('/single_student/{id}', ['as'=>'single-student', 'uses'=>'StudentController@single_student']);

// Single student data view
Route::get('/student_fees/{id}', ['as'=>'student-fees', 'uses'=>'StudentController@fees_form']);

// Befor fees form submit
Route::post('pay_fees', 'StudentController@pay_fees');

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

########################### FOR COURSE #######################

// Course details
Route::get('add_course', 'CourseController@create');

// Course Data Insert
Route::post('course_insert', 'CourseController@store');

// Course Data Insert
Route::get('course_details', 'CourseController@show');

// Branch Data edit
Route::get('/course_edit/{id}', ['as'=>'course-edit' , 'uses'=>'CourseController@edit']);

// Branch Data update
Route::post('/course-update/{id}', ['as'=>'course-update' , 'uses'=>'CourseController@update']);

// Branch Data edit
Route::get('/course_delete/{id}', ['as'=>'course-delete' , 'uses'=>'CourseController@destroy']);