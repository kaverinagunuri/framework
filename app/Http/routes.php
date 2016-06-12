<?php

Route::get('/', array(
    'as' => 'index',
    'uses' => function () {
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
    'middleware' => 'auth',
    'as' => 'Dashboard',
    'uses' => function () {
        return view('Login/Dashboard');
    }));
Route::get('login', array(
    'as' => 'login',
    'uses' => function () {
        return view('Layouts/login');
    }));
Route::get('forgotpassword', array(
    'as' => 'forgotpassword',
    //'middleware' => 'auth',
    'uses' => function () {
        return view('Layouts/Forgot');
    }));
Route::post('loggedIn', array(
    'as' => 'loggedIn',
    'uses' => 'FrameworkController@loggedIn'
));
Route::post('retrivepassword', array(
    'as' => 'retrivepassword',
    'uses' => 'FrameworkController@retrivepassword'
));
Route::get('changepassword', array(
    'as' => 'changepassword',
    'uses' => 'FrameworkController@changepassword'));
Route::post('resetpassword', array(
    'as' => 'resetpassword',
    'uses' => 'FrameworkController@resetpassword'
));
Route::get('logout', array(
    'as' => 'logout',
    'uses' => 'FrameworkController@logout'
));
