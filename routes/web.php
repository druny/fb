<?php

use App\Mail\ConfirmRegister;
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

Auth::routes();
Route::get('/register/confirm/{token}', 'Auth\RegisterController@confirm');

//Post
Route::get('/', 'PostController@index');
Route::get('/post/{slug}', [
    'uses' => 'PostController@show',
    'as' => 'post.show'
]);


//Admin
Route::group(['namespace' => 'Admin', 'role' => 'Admin'], function() {
    Route::resource('/admin', 'AdminController');
});

//Cabinet
Route::group(['prefix' => 'cabinet', 'roles' => ['Admin', 'User']], function() {
    Route::get('/', 'CabinetController@index');
    Route::get('/settings', 'CabinetController@settings');
});



//test

/*Route::group(['prefix' => 'home', 'roles' => ['Admin', 'User']], function () {

    Route::get('/', 'HomeController@index');
    Route::get('/test', 'HomeController@test');

});*/


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
