<?php

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::get('/login', 'loginClient@index')->name('login');
Route::get('/logout-client', 'loginClient@logout')->name('logout-client');
Route::post('/validate', 'loginClient@login')->name('validate');
Route::get('/regist', 'loginClient@regist')->name('regist');
Route::post('/store-regist', 'loginClient@storeRegist')->name('store-regist');
Route::get('/user-setting', 'loginClient@userSetting')->name('store-regist');


// Route::get('/home', 'Home@index')->name('home');

// Route::get('/pageAdmin', 'admin@index');

Route::get('/pageClient', 'client@index')->name('client-index')->middleware('isLogedIn');
Route::get('/', 'client@index')->name('client-index')->middleware('isLogedIn');

Route::get('/project', 'projectController@index')->name('project-index')->middleware('isLogedIn');
Route::get('/project-getall', 'projectController@getAll')->middleware('isLogedIn');
Route::post('/add-project', 'projectController@addProject')->middleware('isLogedIn');
Route::get('/project-detail/{id}', 'projectController@getOne')->middleware('isLogedIn');
Route::get('/get-progress/{id}', 'projectController@getProgress')->middleware('isLogedIn');


Route::get('/negoa', 'nego@index')->name('nego-index')->middleware('isLogedIn');
Route::get('/nego-getall', 'nego@getAll')->name('nego-getall')->middleware('isLogedIn');
Route::get('/nego-getone/{id}', 'nego@getOne')->middleware('isLogedIn');
Route::get('/nego-update/{id}/{harga}', 'nego@negoUpdate')->middleware('isLogedIn');
Route::get('/nego-jadi/{id}', 'nego@negoJadi')->middleware('isLogedIn');
Route::get('/nego-cancel/{id}', 'nego@negocancel')->middleware('isLogedIn');

//admin
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

