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

Route::get('/', function () {
    Breadcrumbs::register('federaist', function ($breadcrumbs) {
        $breadcrumbs->push('Início', route('home'));
    });
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin', 'as'=>'admin', 'middleware' => 'admin'],function(){
    //Authentication Rotes
    $this->get('login','Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

    //Password Reset
    $this->get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset','Auth\ResetPasswordController@reset');

    Route::get('/home', 'HomeController@index')->name('home');
});