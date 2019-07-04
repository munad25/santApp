<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/loginAdmin', 'admin@signin');
Route::post('/loginAdminPost', 'admin@login');
Route::get('/pageAdmin', 'admin@index');

Route::get('/logout', 'admin@logout');

Route::get('/ordered', 'admin@ordered');
Route::get('/orderby', 'admin@orderedNeh');
Route::get('/orderby/{id_project}', 'admin@orderedNeh');
Route::get('/orderby/{id_project}/{status}', 'admin@orderedkuy');
Route::post('/ordered', 'admin@orderedPost');

Route::get('/nego', 'admin@nego');
Route::get('/nego/{id_project}', 'admin@nego');
Route::get('/nego/{id_project}/{status_nego}', 'admin@negokuy');
Route::post('/nego/{id_project}', 'admin@masukNego');


Route::get('/progress/{id_project}', 'admin@progress');
Route::post('/progress/{id_project}', 'admin@Input');

Route::get('/finish', 'admin@kelar');

Route::get('/dataMember', 'admin@data');
