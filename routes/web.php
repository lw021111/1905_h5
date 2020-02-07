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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/info', function () {
    phpinfo();
});

Route::any('/','Index\IndexController@index'); //网站首页
Route::any('/user/reg','User\IndexController@reg'); //注册页面
Route::any('/user/regdo','User\IndexController@regdo'); //注册
Route::any('/user/login','User\IndexController@login'); //登陆页面
Route::any('/user/logindo','User\IndexController@logindo'); //登陆


