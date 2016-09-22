<?php

use App\Mail\ForgotPassword;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/lol', function () {
    Mail::to('druny195@rambler.ru')->send(new ForgotPassword);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'home'], function () {

    Route::get('/', 'HomeController@index')->middleware('auth', 'role:user');
    Route::get('/test', 'HomeController@test')->middleware('auth');

});


Route::get('/test/{id?}', function($id) {

	var_dump(Route::currentroutename());
    if(isset($id)) {
        echo $id;
    }

})->name('test');

/*Route::group([
        'middleware' => 'auth',
        'domain' => 'google.com'
    ], function (){
    echo 123;
} );*/
