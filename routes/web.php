<?php

Route::group(['middleware' => 'auth.basic'], function () {
    Route::get('/', 'DashboardController@index');
});

// Route::get('/', 'DashboardController@index');
Route::post('/webhook/github', 'GitHubWebhookController@gitRepoReceivedPush');

Auth::routes();

Route::get('/home', 'HomeController@index');
