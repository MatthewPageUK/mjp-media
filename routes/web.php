<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\Users\{
    CreateUser,
    DeleteUser,
    UpdateUser,
    ReadUser,
    ListUsers,
};
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\User\Explorer;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users', ListUsers::class)->middleware(['auth', 'verified'])->name('users');
Route::get('/user/create', CreateUser::class)->middleware(['auth', 'verified'])->name('user.create');
Route::get('/user/{user}', ReadUser::class)->middleware(['auth', 'verified'])->name('user.read');
Route::get('/user/{user}/edit', UpdateUser::class)->middleware(['auth', 'verified'])->name('user.update');
Route::get('/user/{user}/delete', DeleteUser::class)->middleware(['auth', 'verified'])->name('user.delete');


Route::get('/ui/explorer', Explorer::class)->middleware(['auth', 'verified'])->name('ui.explorer');

require __DIR__.'/auth.php';
