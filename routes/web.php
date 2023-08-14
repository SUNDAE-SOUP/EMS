<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');

    Route::post('/users/store', 'store');

    Route::get('/users/{id}', 'show')->whereNumber('id');

    Route::get('/users/{id}/softDelete', 'softDelete')->whereNumber('id');

    Route::put('/users/{id}/update', 'update')->whereNumber('id');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('/roles', 'index');

    Route::post('/roles/store', 'store');

    Route::get('/roles/{id}', 'show')->whereNumber('id');

    Route::get('/roles/{id}/softDelete', 'softDelete')->whereNumber('id');

    Route::put('/roles/{id}/update', 'update')->whereNumber('id');
});

Route::controller(ExpenseCategoryController::class)->group(function () {
    Route::get('/expenseCategories', 'index');

    Route::post('/expenseCategories/store', 'store');

    Route::get('/expenseCategories/{id}/softDelete', 'softDelete')->whereNumber('id');

    Route::put('/expenseCategories/{id}/update', 'update')->whereNumber('id');
});

Route::controller(ExpenseController::class)->group(function () {
    Route::get('/expenses', 'index');

    Route::post('/expenses/store', 'store');

    Route::get('/expenses/{user_id}', 'show')->whereNumber('user_id');

    Route::get('/expenses/{id}/softDelete', 'softDelete')->whereNumber('id');

    Route::put('/expenses/{id}/update', 'update')->whereNumber('id');
});
