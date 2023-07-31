<?php

use App\Http\Controllers\SearchController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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

Route::get('/', [SearchController::class, 'index'])->name('index');
Route::any('/search', [SearchController::class, 'search'])->name('search');
Route::get('/result', [SearchController::class, 'result'])->name('result');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
