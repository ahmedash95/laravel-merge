<?php

Route::get('/login','LoginController@login');
Route::get('/login/callback','LoginController@doLogin');


Route::get('/',HomeController::class);
Route::get('/r/{id}', 'HomeController@redirect')->name('pr_view');
