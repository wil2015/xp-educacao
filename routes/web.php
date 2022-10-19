<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Nessus;
use App\Http\Controllers\Nmap;


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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
route::get('/', function () {
    return view('index');
});
Route::post('/nessus', Nessus::class);
Route::post('/nmap', Nmap::class);



