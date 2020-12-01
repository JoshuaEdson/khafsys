<?php
use Illuminate\Support\Facades\Schema;
use App\Questionnaire;
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

Route::get('home/{table}', 'DataController@index')->name('admin.dashboard');
Route::post('home/', 'DataController@getAdminDashboardData')->name('analysis.getAdminDashboardData');
Route::post('/analysis_tools', 'DataController@postData')->name('analysis.postData');
Route::post('/analysis/', 'DataController@uploadData')->name('analysis.uploadData');
Route::get('/analysis/{table}', 'DataController@analysis')->name('analysis');
Route::get('/analysis_tools/{table}', 'DataController@analysis_tools')->name('analysis.tools');

//datatables
// Route::get ( '/analysis', function () {
//     $data = Questionnaire::paginate(50);
//     $allColumnsname = Schema::getColumnListing('masterdata');
//     // return $allColumnsname;
//     return view ( 'analysis', compact('allColumnsname', 'data') ); //->withData ($data);
// } );
?>