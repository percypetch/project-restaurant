<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MenuController;

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

Route::get('/category', [CategoryController::class, 'list'])->name('category-list');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category-view');

Route::get('/ingredient', [IngredientController::class, 'list'])->name('ingredient-list')->middleware('is_admin');;
Route::get('/ingredient/{ingredient}', [IngredientController::class, 'show'])
->name('ingredient-view');


Route::get('/menu', [MenuController::class, 'list'])
->name('menu-list');

Route::get('/menu/{menu}', [MenuController::class, 'show'])
->name('menu-view');

