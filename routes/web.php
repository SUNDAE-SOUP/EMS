<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Middleware\RedirectIfAuthenticated;

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



Route::middleware(['auth'])->controller(UserController::class)->group(function () {
    Route::get('/users', 'index');

    Route::get('/users/admin-user-tab', 'adminUserTab')->name('admin.userTab');

    Route::post('/users/store', 'store')->name('userAdmin.store');

    Route::get('/users/{user}/edit', 'edit')->whereNumber('user')->name('userAdmin.edit');

    Route::get('/users/{id}', 'show')->whereNumber('id');

    Route::put('/users/{user}/softDelete', 'softDelete')->whereNumber('user')->name('userAdmin.softDelete');

    Route::put('/users/{user}/update', 'update')->whereNumber('user')->name('userAdmin.update');
});

Route::middleware(['auth'])->controller(RoleController::class)->group(function () {
    Route::get('/roles/admin-role-tab', 'roleTab')->name('admin.roleTab');

    Route::post('/roles/store', 'store');

    Route::get('/roles/{role}/edit', 'edit')->whereNumber('role')->name('role.edit');

    Route::get('/roles/{id}', 'show')->whereNumber('id');

    Route::put('/roles/{role}/softDelete', 'softDelete')->whereNumber('role')->name('role.softDelete');

    Route::put('/roles/{role}/update', 'update')->whereNumber('role')->name('role.update');
});

Route::middleware(['auth'])->controller(ExpenseCategoryController::class)->group(function () {
    Route::get('/expenseCategories', 'index')->name('admin.expenseCatTab');

    Route::post('/expenseCategories/store', 'store');

    Route::get('/expenseCategories/{expenseCategory}/edit', 'edit')->whereNumber('expenseCategory')->name('expenseCategory.edit');

    Route::put('/expenseCategories/{expenseCategory}/softDelete', 'softDelete')->whereNumber('expenseCategory')->name('expenseCategory.softDelete');

    Route::put('/expenseCategories/{expenseCategory}/update', 'update')->whereNumber('expenseCategory')->name('expenseCategory.update');
});

Route::middleware(['auth'])->controller(ExpenseController::class)->group(function () {
    Route::get('/expenses', 'index')->name('admin.expensesTab');

    Route::get('/expenses/adminView', 'dashboard')->name('admin.view');

    Route::post('/expenses/store', 'store');

    Route::get('/expenses/{expense}/edit', 'edit')->whereNumber('expense')->name('expense.edit');

    Route::get('/expenses/{user_id}', 'show')->whereNumber('user_id');

    Route::put('/expenses/{expense}/softDelete', 'softDelete')->whereNumber('expense')->name('expense.softDelete');

    Route::put('/expenses/{expense}/update', 'update')->whereNumber('expense')->name('expense.update');

});
