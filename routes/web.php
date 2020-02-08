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
//this is where you can route all of the request into the appropriate web page.


Route::get('/', 'LoginController@loginpage');
Route::get('/signup', 'LoginController@signup');
Route::get('/myaccount', 'LoginController@myaccount');
Route::get('/acct_dept', 'LoginController@acct_dept');
Route::get('/acct_dept_ori', 'LoginController@acct_dept_ori');

Route::get('/invoice', 'LoginController@invoice');
Route::get('/admin_dashboard', 'LoginController@admin_dashboard');
Route::get('/staff_dashboard', 'LoginController@staff_dashboard');
Route::get('/sales', 'LoginController@sales');



// Route::get('/', function () {
//     return view('welcome');
// });

