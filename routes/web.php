<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
<<<<<<< HEAD
use App\Http\Controllers\IngredientController;
=======
use App\Http\Controllers\MenuController;
>>>>>>> c26972e048a73bac9685fd3dfdf5cd1f9aad6741

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
/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

<<<<<<< HEAD
Route::get('/admin/ingredient', [IngredientController::class, 'list'])->name('admin.ingredient')->middleware('is_admin');;


=======
Route::get('/menu', [MenuController::class, 'list'])->name('menu-list');
>>>>>>> c26972e048a73bac9685fd3dfdf5cd1f9aad6741
/*test Petch
//restadf
