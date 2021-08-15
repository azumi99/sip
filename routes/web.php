<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionControler;
use GuzzleHttp\Promise\Create;
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
    return view('welcome');
});

Route::get('/test', function () {
    return view('test', ['message' => 'hello laravel']);
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin', 'DashboardController@index');

    Route::get('/category/create', 'CategoryController@create');

    Route::post('/category/store', 'CategoryController@store');

    Route::get('/category', 'CategoryController@index');

    Route::get('/category/show/{id}', 'CategoryController@show');

    Route::get('/category/edit/{id}', 'CategoryController@edit');

    Route::post('/category/update/{id}', 'CategoryController@update');

    Route::delete('/category/delete/{id}', 'CategoryController@destroy');

    Route::resource('/product', 'ProductController');

    Route::get('transaction/create', 'TransactionControler@Create')->name('transaction.create');
    Route::post('transaction/import', 'TransactionControler@import')->name('transaction.store');
    Route::get('transaction', 'TransactionControler@index')->name('transaction.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
