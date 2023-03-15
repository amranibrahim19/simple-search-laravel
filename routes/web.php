<?php
use App\Semakan;
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

Route::get('/', function () {
    return view('welcome');
});
Route::any('/search', function () {
    $q = Input::get('q');
    $semakan = Semakan::where('name', 'LIKE', '%' . $q . '%')->orWhere('email', 'LIKE', '%' . $q . '%')->get();
    if (count($semakan) > 0)
        return view('welcome')->withDetails($semakan)->withQuery($q);
    else
        return view('welcome')->withMessage('No Details found. Try to search again !');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');