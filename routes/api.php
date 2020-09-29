<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('me', 'AuthController@me');

Route::post('login', 'AuthController@login');

Route::get('demo', function(){
    echo "Api working";
});
Route::resource('user', 'UserController');

Route::resource('Grade', 'GradeController');
Route::resource('School', 'SchoolController');
Route::resource('GradesOffered', 'GradesOfferedController');


Route::get('admins', 'UserController@admins');
Route::post('change_password/{id}', 'UserController@change_password');
Route::resource('role', 'RoleController');
Route::resource('status', 'StatusController');
Route::resource('department', 'DepartmentController');

Route::get('approve_reject/{job_id}/{action}', 'JobController@approve_reject');