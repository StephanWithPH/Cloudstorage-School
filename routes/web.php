<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/', 'HomeController@loadHomePage');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/dashboard', 'DashboardController@loadDashboardPage')->middleware('auth');
Route::get('/dashboard/files', 'DashboardController@loadFilesPage')->middleware('auth');



Route::post('/dashboard/files/upload', 'FileController@store')->middleware('auth');
Route::get('/dashboard/files/download/{id}', 'FileController@get')->middleware('auth');
Route::get('/dashboard/files/remove/{id}', 'FileController@remove')->middleware('auth');

/* Shared files */
Route::get('/dashboard/files/shared', 'DashboardController@loadSharedFilesPage')->middleware('auth', 'verified', 'password.confirm');
Route::get('/dashboard/files/shared/download/{id}', 'FileController@getShared')->middleware('auth');
Route::get('/dashboard/files/shared/remove/{id}', 'FileController@removeShared')->middleware('auth');
Route::get('/dashboard/files/shared/owner/remove/{id}/{userid}', 'FileController@removeSharedOwner')->middleware('auth');
/* Add share from files page */
Route::post('/dashboard/files/shared/owner/add', 'FileController@addSharedOwner')->middleware('auth', 'verified');


/* Admin */
Route::get('/admin', 'AdminController@loadAdminStatisticsPage')->middleware('auth', 'admin');
Route::get('/admin/users', 'AdminController@loadAdminUsersPage')->middleware('auth', 'admin');
Route::get('/admin/users/edit/{id}', 'AdminController@loadEditUserPage')->middleware('auth', 'admin');
Route::post('/admin/users/edit/submit', 'AdminController@editUserSubmit')->middleware('auth', 'admin');
Route::get('/admin/users/delete/{id}', 'AdminController@deleteUser')->middleware('auth', 'admin');


Auth::routes(['verify' => true]);

//Route::get('/home', 'HomeController@index')->name('home');
