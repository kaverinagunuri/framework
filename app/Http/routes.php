<?php

Route::get('/', array(
    'as'=>'index',
    'uses'=>function () {
    return view('Layouts/register');
}));
Route::post('Register', array(
    'as' => 'Register',
    'uses' => 'FrameworkController@Register'
));
Route::get('/verifyEmail/{ValidationToken}', array(
    'as' => 'Login',
    'uses' => 'FrameworkController@Login'
));
Route::get('Dashboard', array(
    'as' => 'Dashboard',
    'uses' => function () {
        return view('Login/Dashboard');
    }));
    Route::get('Login', array(
    'as' => 'Login',
    'uses' => function () {
        return view('Layouts/login');
    }));
     Route::get('forgotpassword', array(
    'as' => 'forgotpassword',
    'uses' => function () {
        return view('Layouts/Forgot');
    }));
    Route::post('Login',array(
        'as'=>'loggedIn',
        'uses'=>'FrameworkController@loggedIn'
    ));
    Route::post('retrivepassword',array(
        'as'=>'retrivepassword',
        'uses'=>'FrameworkController@retrivepassword'
    ));
    

Route::auth();

Route::get('/home', 'HomeController@index');
