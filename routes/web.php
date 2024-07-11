<?php


Route::redirect('/', '/login');
Route::get('/home', function () {
    return redirect()->route('tasks.index');
})->name('home');

Auth::routes(['register' => false]);


Route::resource('tasks','TaskController');
Route::patch('change-status/{task}','TaskController@changeStatus')->name('tasks.changeStatus');

Route::resource('departments','DepartmentController');

Route::resource('users','UserController');
