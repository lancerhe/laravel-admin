<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile', 'ProfileController@update')->name('profile.update');

// users
Route::get('/admin/users', 'Admin\UsersController@index')->middleware('permission:user-view')->name('admin.users.index');
Route::get('/admin/users/{user}', 'Admin\UsersController@show')->middleware('permission:user-view')->name('admin.users.show');
Route::get('/admin/users/{user}/edit', 'Admin\UsersController@edit')->middleware('permission:user-update')->name('admin.users.edit');
Route::patch('/admin/users/{user}', 'Admin\UsersController@update')->middleware('permission:user-update')->name('admin.users.update');

// roles
Route::get('/admin/roles', 'Admin\RolesController@index')->middleware('permission:role-view')->name('admin.roles.index');
Route::post('/admin/roles', 'Admin\RolesController@store')->middleware('permission:role-update')->name('admin.roles.store');
Route::get('/admin/roles/create', 'Admin\RolesController@create')->middleware('permission:role-update')->name('admin.roles.create');
Route::patch('/admin/roles/{role}', 'Admin\RolesController@update')->middleware('permission:role-update')->name('admin.roles.update');
Route::get('/admin/roles/{role}', 'Admin\RolesController@show')->middleware('permission:role-view')->name('admin.roles.show');
Route::get('/admin/roles/{role}/edit', 'Admin\RolesController@edit')->middleware('permission:role-update')->name('admin.roles.edit');

// permissions
Route::get('/admin/permissions', 'Admin\PermissionsController@index')->middleware('permission:permission-view')->name('admin.permissions.index');
Route::post('/admin/permissions', 'Admin\PermissionsController@store')->middleware('permission:permission-update')->name('admin.permissions.store');
Route::get('/admin/permissions/create', 'Admin\PermissionsController@create')->middleware('permission:permission-update')->name('admin.permissions.create');
Route::patch('/admin/permissions/{permission}', 'Admin\PermissionsController@update')->middleware('permission:permission-update')->name('admin.permissions.update');
Route::get('/admin/permissions/{permission}', 'Admin\PermissionsController@show')->middleware('permission:permission-view')->name('admin.permissions.show');
Route::get('/admin/permissions/{permission}/edit', 'Admin\PermissionsController@edit')->middleware('permission:permission-update')->name('admin.permissions.edit');
