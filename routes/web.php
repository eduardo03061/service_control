<?php

use Illuminate\Support\Facades\Route;
use App\User;
 

Route::get('api/users', function() { 
    $users = User::all(); 

    return response()->json([
        'status'=> 'OK', 
        'data' => [
            'users' => $users
        ],
    ]);  
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');





Route::group(['middleware' => 'auth'], function () {
 
    Route::get('/services', 'ServiceController@list')->name('service.list');

    Route::get('/service/edit/{idService}', 'ServiceController@edit')->name('service.edit');

    Route::patch('/service/update/{idService}', 'ServiceController@update')->name('service.update');
    
    Route::delete('/service/delete/{idService}', 'ServiceController@delete')->name('service.delete');

    Route::get('/service/create', 'ServiceController@create')->name('service.create');

    Route::post('/service/storage', 'ServiceController@storage')->name('service.storage');
    

    //Rutas de admin
    
    Route::get('/users', 'AdminController@list')->name('users.list');
    
    Route::get('/user/edit/{idUser}', 'AdminController@edit')->name('users.edit'); 

    Route::get('/user/listServices/{idUser}', 'AdminController@servicesOfUser')->name('users.listServices');

    Route::patch('/user/update/{idUser}', 'AdminController@update')->name('users.update');
    
    Route::delete('/user/delete/{idUser}', 'AdminController@delete')->name('users.delete');
});