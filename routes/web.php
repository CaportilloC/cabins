<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//RUTAS CAP
Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::put('/users/{id}/desactivar', [UserController::class, 'desactivarUsuario'])->name('desactivarUsuario');
Route::get('/users/create', [UserController::class, 'showCreate'])->name('users.showCreate');
Route::post('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class, 'show'])->name('password.change');
Route::post('change-password',[App\Http\Controllers\ChangePasswordController::class, 'update'])->name('password.update');





//RUTAS OJEDAS

// Route::get('/users/create', [App\Http\Controllers\UserController::class, 'createUser'])->name('users.create');



?>

