<?php

Route::get('/login','LoginController@login');
Route::get('/login/callback','LoginController@doLogin');


Route::get('/',HomeController::class);
Route::get('/pull-request/{id}','PullRequestsController@show');
Route::get('/author/{name}','AuthorsController@show')->name('authors.show');
Route::get('/r/{id}', 'HomeController@redirect')->name('pr_view');