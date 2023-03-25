<?php

use App\Http\Controllers\AcitivityController;
use App\Http\Controllers\CharactersController;
use App\Http\Controllers\ClansController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuildWarsController;
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
    Route::delete('clan/{clan}/member/{member}', [MembersController::class, 'destroy'])->name('members.delete');
    Route::get('clan/{clan}/events', [EventController::class, 'index'])->name('events');
    Route::get('clan/{clan}/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('clan/{clan}/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/clan/{clan}/event/{event}/show', [EventController::class, 'show'])->name('event.show');
    Route::get('/ajax/clan/{clan}/event_details', [EventController::class, 'showDetails'])->name('events.show_details');
    Route::get('clan/{clan}/event/{event}', [EventController::class, 'eventStatus'])->name('event.status');
    Route::delete('/clan/{clan}/characters/{character}/destroy', [CharactersController::class, 'destroyAll'])->name('character.delete');
    Route::resource('clan.activity', AcitivityController::class);
    Route::resource('clan.gvg', GuildWarsController::class)->names([
        'store' => 'clan.gvg.storegvg'
    ]);
    Route::get('/ajax/clan/{clan}/gvg_details', [GuildWarsController::class, 'showDetails'])->name('gvg.show_details');
    Route::get('clan/{clan}/gvg/{guildWar}/status', [GuildWarsController::class, 'gvgStatus'])->name('gvg.status');
//    Route::get('clan/{clan}/gvg/{guildWar}/show', [GuildWarsController::class, 'show'])->name('gvg.show');
});

Route::middleware(['auth'])->group(function (){
    Route::resource('clan.characters', CharactersController::class);
    Route::post('clan/{clan}/members', [MembersController::class, 'store'])->name('members.store');
    Route::get('invited/{token}', [MembersController::class, 'getInvitedUserData'])->name('invited_user');
    Route::resource('clan', ClansController::class);
    Route::post('clan/{clan}/master', [MembersController::class, 'createMaster'])->name('master.create');
    Route::get('clan/{clan}/link/refresh', [ClansController::class, 'setNewInviteLink'])->name('refresh_invite_link');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfilesController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfilesController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfilesController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
