<?php

use App\Http\Controllers\ClanController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\AjaxController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('clan', ClanController::class);

Route::post('clan/{clan}/master', [MemberController::class, 'createMaster'])->name('master.create');

Route::get('clan/{clan}/members', [MemberController::class, 'index'])->name('members');
Route::get('clan/{clan}/members/create', [MemberController::class, 'create'])->name('members.create');
Route::post('clan/{clan}/members', [MemberController::class, 'store'])->name('members.store');
Route::delete('clan/{clan}/member/{member}', [MemberController::class, 'destroy'])->name('members.delete');

Route::get('clan/{clan}/events', [EventController::class, 'index'])->name('events');
Route::get('clan/{clan}/event/{event}', [EventController::class, 'eventStatus'])->name('event.status');
//Route::resource('events', \App\Http\Controllers\EventController::class);


Route::get('getusers', [AjaxController::class, 'index'])->name('getusers');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
