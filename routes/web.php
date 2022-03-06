<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (!Auth::check()) {
        return view('auth.login');
    }
    return redirect(url('/dashboard'));
});

Route::get('/dashboard', 'dashboardController@index');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
