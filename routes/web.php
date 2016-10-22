<?php

use App\Mail\ConfirmRegister;


Auth::routes();
Route::get('/register/confirm/{token}', 'Auth\RegisterController@confirm');

//Post
Route::get('/', 'PostController@index');
Route::get('/post/{slug}', [
    'uses' => 'PostController@show',
    'as' => 'post.show'
]);


//Admin
Route::group(['namespace' => 'Admin', 'roles' => 'Admin'], function() {
    Route::resource('admin', 'AdminController');
    Route::resource('categories', 'CategoryController', ['except' => 'show']);
    Route::resource('tags', 'TagController', ['expect' => 'show']);
});

//Cabinet
Route::group(['namespace' => 'Cabinet', 'roles' => ['Admin', 'User']], function() {
    //Settings
    Route::resource('cabinet', 'CabinetController', ['except' => 'show']);
    Route::get('cabinet/settings', ['as' => 'cabinet.settings', 'uses' => 'CabinetController@edit']);

    //Password
    Route::get('password/change', ['as' => 'password.change', 'uses' => 'PasswordController@change']);
    Route::put('password/update', ['as' => 'password.update', 'uses' => 'PasswordController@update']);

    //E-mail
    Route::get('email/change', ['as' => 'email.change', 'uses' => 'EmailController@change']);
    Route::post('email/update', ['as' => 'email.update', 'uses' => 'EmailController@update']);
    Route::get('email/confirm/{token}', ['as' => 'email.confirm', 'uses' => 'EmailController@confirm']);
    Route::get('email/new/confirm/{token}', ['as' => 'new_email.confirm', 'uses' => 'EmailController@confirmNewEmail']);
});

/*
Route::group(['prefix' => 'cabinet', 'roles' => ['Admin', 'User']], function() {
    Route::get('/', 'CabinetController@index');
    Route::get('settings', ['as' => 'cabinet.settings', 'uses' => 'CabinetController@edit']);

});*/

Route::get('/tag/{tag}', [
   'uses' => 'PostController@showPostsByTag',
    'as' => 'tag.show'
]);
Route::get('/category/{category}', [
    'uses' => 'PostController@showPostsByCategory',
    'as' => 'category.show'
]);



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
