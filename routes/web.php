<?php
namespace App\Http\Controllers;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();

//Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/list', [UserController::class, 'index'])->name('list');

Route::get('/', [UserController::class, 'add'])->name('add');

Route::post('/store', [UserController::class, 'store'])->name('store_user');

Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit_user');

Route::put('/update', [UserController::class, 'update'])->name('update_user');

Route::post('/delete/{id}', [UserController::class, 'destroy'])->name('delete_user');

Route::post('/user/checkEmail', [UserController::class, 'checkEmail'])->name('checkmail');