<?php

use App\Http\Controllers\CharactersController;
use App\Http\Controllers\ClansController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfilesController;
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

Route::middleware(['auth', 'clan'])->group(function (){
    Route::get('clan/{clan}/members', [MembersController::class, 'index'])->name('members');
    Route::get('clan/{clan}/members/create', [MembersController::class, 'create'])->name('members.create');
    Route::post('clan/{clan}/members', [MembersController::class, 'store'])->name('members.store');
    Route::delete('clan/{clan}/member/{member}', [MembersController::class, 'destroy'])->name('members.delete');
    Route::get('clan/{clan}/events', [EventController::class, 'index'])->name('events');
    Route::get('/ajax/clan/{clan}/event', [EventController::class, 'show'])->name('events.show');
    Route::get('clan/{clan}/event/{event}', [EventController::class, 'eventStatus'])->name('event.status');
    Route::delete('/clan/{clan}/characters/{character}/destroy', [CharactersController::class, 'destroyAll'])->name('character.delete');
    Route::resource('clan.characters', CharactersController::class);
});

Route::middleware(['auth'])->group(function (){
    Route::resource('clan', ClansController::class);
    Route::post('clan/{clan}/master', [MembersController::class, 'createMaster'])->name('master.create');
    Route::get('getusers', [AjaxController::class, 'index'])->name('getusers');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfilesController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfilesController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfilesController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
