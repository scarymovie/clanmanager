<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CharactersController;
use App\Http\Controllers\ClansController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuildWarsController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\SignaturesController;
use App\Http\Controllers\SignaturesEventsController;
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

Route::middleware(['auth'])->group(function (){

    // Достаточно авторизации
    Route::get('/dashboard', [ClansController::class, 'index'])
        ->name('clans.index');

    Route::get('/clan/create', [ClansController::class, 'create'])
        ->name('clans.create');

    Route::post('/clan/store', [ClansController::class, 'store'])
        ->name('clans.store');

    Route::get('/clan/{clan}/invited/{token}', [MembersController::class, 'getInvitedUserData'])
        ->name('invited_user');

    Route::post('/clan/{clan}/characters_newbie', [CharactersController::class, 'createNewbie'])
        ->name('characters.newbie.store');

    // Проверка на принадлежность к клану
    Route::middleware('clan')->group(function (){

        Route::post('/clan/{clan}/master', [MembersController::class, 'createMaster'])
            ->name('master.create');

        Route::post('clan/{clan}/characters/{member}', [CharactersController::class, 'store'])
            ->name('characters.store');

        // Проверка на наличие персонажа в клане, не является кандидатом в клан
        Route::middleware(['checkCharacter', 'checkRole'])->group(function (){

            Route::get('/clan/{clan}/show', [ClansController::class, 'show'])
                ->name('clans.show');

            Route::get('/clan/{clan}/members', [MembersController::class, 'index'])
                ->name('members.index');

            Route::get('/clan/{clan}/events', [EventController::class, 'index'])
                ->name('events.index');

            Route::get('/clan/{clan}/events/{event}/{difference}', [EventController::class, 'show'])
                ->name('events.show');

            Route::get('/clan/{clan}/events_status/{event}/{difference}', [EventController::class, 'eventStatus'])
                ->name('events.status');

            Route::get('/clan/{clan}/event_details', [EventController::class, 'showDetails'])
                ->name('events.show_details');

            Route::get('/clan/{clan}/gvg', [GuildWarsController::class, 'index'])
                ->name('gvg.index');

            Route::get('/clan/{clan}/gvg_details', [GuildWarsController::class, 'showDetails'])
                ->name('gvg.show_details');

            Route::get('clan/{clan}/gvg/{guildWar}/status', [GuildWarsController::class, 'gvgStatus'])
                ->name('gvg.status');

            Route::get('clan/{clan}/gvg/{guildWar}/show', [GuildWarsController::class, 'show'])
                ->name('gvg.show');

            Route::get('clan/{clan}/characters', [CharactersController::class, 'index'])
                ->name('characters.index');

            Route::get('clan/{clan}/characters/create', [CharactersController::class, 'create'])
                ->name('characters.create');

            Route::get('clan/{clan}/characters/{character}/edit', [CharactersController::class, 'edit'])
                ->name('characters.edit');

            Route::put('clan/{clan}/characters/{character}', [CharactersController::class, 'update'])
                ->name('characters.update');

            Route::delete('clan/{clan}/characters/{character}', [CharactersController::class, 'destroy'])
                ->name('characters.delete');

            Route::get('/clan/{clan}/activity', [ActivityController::class, 'index'])
                ->name('activity.index');


            // Доступно только для мастера клана или других ролей, которые будут добавлены позже
            Route::middleware('checkRole:Master')->group(function (){

                Route::get('/clan/{clan}/members/{member}/create', [MembersController::class, 'create'])
                    ->name('members.create');

                Route::delete('/clan/{clan}/members/{member}', [MembersController::class, 'destroy'])
                    ->name('members.delete');

                Route::get('/clan/{clan}/events/create', [EventController::class, 'create'])
                    ->name('events.create');

                Route::post('/clan/{clan}/events', [EventController::class, 'store'])
                    ->name('events.store');

                Route::get('/clan/{clan}/gvg/create', [GuildWarsController::class, 'create'])
                    ->name('gvg.create');

                Route::post('/clan/{clan}/gvg', [GuildWarsController::class, 'store'])
                    ->name('gvg.store');

                Route::get('clan/{clan}/link/refresh', [ClansController::class, 'setNewInviteLink'])
                    ->name('refresh_invite_link');

                Route::get('/clan/{clan}/{member}', [MembersController::class, 'changeCandidateStatus'])
                    ->name('candidate.status');

                Route::get('/clan/{clan}/signatures/gvg', [SignaturesController::class, 'index'])
                    ->name('signatures.index');

                Route::get('/clan/{clan}/signatures/gvg/{guildWar}', [SignaturesController::class, 'show'])
                    ->name('signatures.show');

                Route::get('/clan/{clan}/signatures/gvg/{guildWar}/{member}', [GuildWarsController::class, 'gvgMasterStatus'])
                    ->name('gvg.masterUpdate');

                Route::get('/clan/{clan}/signatures/events', [SignaturesEventsController::class, 'index'])
                    ->name('signaturesEvents.index');

                Route::get('/clan/{clan}/signatures/events/{event}', [SignaturesEventsController::class, 'show'])
                    ->name('signaturesEvents.show');

                Route::get('/clan/{clan}/signatures/events/update/{event}/{member}', [EventController::class, 'eventMasterStatus'])
                    ->name('events.masterUpdate');
            });
        });

    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfilesController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfilesController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfilesController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
