<?php

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

Route::get('/', function () {
    return view('index');
});
Route::get('/camp', function () {
    return view('camp-map');
});
Route::resource('/reservation', "ReservationController");
Route::get('/mypage/delete_resv', "MyPageController@delete");
Route::get('/mypage/delete_ord', "MyPageController@orderDelete");
Route::resource('/mypage', "MyPageController");
Route::resource('/user', "UserController");
Route::resource('/manage/reserv', 'ResvManageController');
Route::resource('/manage/order', 'OrderManageController');

Route::get('/logout', 'UserController@logout');
