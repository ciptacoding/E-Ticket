<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BlacklistController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\EntranceController;
use App\Http\Controllers\QuotaController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\DashboardSuggestionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingController::class, 'pay'])->name('booking.pay');
    Route::get('/invoice/{id}', [BookingController::class, 'invoice'])->name('booking.invoice');
    route::get('/history', [BookingController::class, 'transactionHistory'])->name('booking.history');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/quota', [QuotaController::class, 'index'])->name('quota.index');
    Route::post('/quota', [QuotaController::class, 'check'])->name('quota.check');
});

Route::middleware(['auth','verified'])->group(function (){
    Route::get('/suggestion', [SuggestionController::class, 'index'])->name('suggestion.index');
    Route::post('/suggestion', [SuggestionController::class, 'store'])->name('suggestion.store');
});

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['admin', 'auth', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['admin', 'auth', 'verified'])->group(function () {
    Route::resource('posts', PostController::class);
});

Route::middleware(['admin', 'auth', 'verified'])->group(function (){
    Route::resource('blacklists', BlacklistController::class);
});

Route::middleware(['auth', 'admin','verified'])->group(function (){
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transaction/{id}', [TransactionController::class, 'show'])->name('transaction.show');
});

Route::middleware(['auth','admin','verified'])->group(function (){
    Route::get('/entrance', [EntranceController::class, 'index'])->name('entrance.index');
    Route::post('/checkin', [EntranceController::class, 'checkin'])->name('entrance.checkin');
    Route::post('/checkout', [EntranceController::class, 'checkout'])->name('entrance.checkout');
    Route::post('/entrance', [EntranceController::class, 'blacklist'])->name('entrance.blacklist');
});

Route::middleware(['auth', 'admin','verified'])->group(function () {
    Route::get('/suggestions', [DashboardSuggestionController::class, 'index'])->name('suggestions.index');
    Route::delete('/suggestions/{id}', [DashboardSuggestionController::class, 'delete'])->name('suggestions.delete');
});

require __DIR__.'/auth.php';
