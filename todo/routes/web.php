<?php

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

//Route::get('/', function () {
  //  return view('welcome');
//});

//Route::get('/top', function () {
    //return view('top');
//});

//view
Route::get('/', function () {
    return view('top');
});

Route::post('/login', function () {
    return view('top');
});

Route::post('public/register', function(){
    return view('register');
});

Route::post('public/loginform', function(){
    return view('login');
});

Route::post('public/tasktop', function () {
    return view('tasktop');
});

Route::post('public/addtask', function(){
    return view('addtask');
});

//Route::get('public/details/{taskname?}', function($taskname){
 //   return view('details',compact('taskname'));
//});

Route::get('public/details/{taskname?}',function($taskname){
    return view('test',compact('taskname'));
});

Route::get('public/eachother',function(){
    return view('eachother');
});

Route::get('public/gantt',function(){
    return view('gantt');
});

Route::post('public/grid',function(){
    return view('grid');
});

//controller

Route::post('public/adduser', 'FormController@adduser');

Route::get('public/login', 'FormController@login');

Route::post('public/addprocess', 'AddprocessController@addprocess');

Route::post('public/details', 'DetailsController@details');

Route::post('public/catchprocess','CatchprocessController@catchprocess');

Route::post('public/getdb','GetdbController@getdb');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
