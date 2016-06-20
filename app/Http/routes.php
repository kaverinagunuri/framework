<?php

Route::group(['middlewareGroups' => 'web'], function () {
    Route::get('index', array(
        'as' => 'index',
         'middleware'=>'Admin',
        'uses' => function(){
         return view('Layouts/register');
        }
    ));
    Route::post('Register', array(
        'as' => 'Register',
        'uses' => 'FrameworkController@Register'
    ));
    Route::get('/verifyEmail/{ValidationToken}', array(
        'as' => 'verifyEmail',
        'uses' => 'FrameworkController@ValidationToken'
    ));
    Route::get('/', array(
        'as' => 'Dashboard',
        'middleware' => 'auth',
        'uses' => 'FrameworkController@Dashboard'
    ));

    Route::get('login', array(
        'as' => 'login',
        'middleware'=>'Admin',
        'uses' => function(){
          return view('Layouts/login');
        }
    ));
    Route::get('forgotpassword', array(
        'as' => 'forgotpassword',
             'middleware'=>'Admin',
        'uses' => 'FrameworkController@forgotpassword'
    ));
    Route::post('loggedIn', array(
        'as' => 'loggedIn',
        'uses' => 'FrameworkController@loggedIn'
    ));
    Route::post('retrivepassword', array(
        'as' => 'retrivepassword',
        'uses' => 'FrameworkController@retrivepassword'
    ));
    Route::get('changepassword', array(
        'middleware' => 'auth',
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
    Route::get('updateprofile', array(
        'middleware' => 'auth',
        'as' => 'updateprofile',
        'uses' => 'FrameworkController@updateprofile'
    ));
    Route::post('modifiedprofile',array(
        'as'=>'modifiedprofile',
        'uses'=>'FrameworkController@modifiedprofile'
    ));
});
Route::get('Formwithajax',array(
    'as'=>'ajax',
    'uses'=>function(){
    return view('Layouts.regwithajax');
    }));
Route::post('submit',array(
    'as'=>'submit',
    'uses'=>'FrameworkController@submit'));
Route::get('service' ,array(
    'as'=>'service',
    'uses'=>function(helper $email){
    $result=$email->Email('hai','hello','kaveri.nagunuri@karmanya.co.in');
  
    }
));


