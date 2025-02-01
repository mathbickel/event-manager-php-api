<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ScheduleController;

Route::group(['prefix' => 'organizer'], function () {
    Route::get('/all', [OrganizerController::class, 'index'])->name('organizer.index');
    Route::get('/{id}', [OrganizerController::class, 'show'])->name('organizer.show');
    Route::post('/', [OrganizerController::class, 'store'])->name('organizer.store');
    Route::put('/{id}', [OrganizerController::class, 'update'])->name('organizer.update');
    Route::delete('/{id}', [OrganizerController::class, 'delete'])->name('organizer.delete');
});

Route::group(['prefix' => 'event'], function () {
    Route::get('/all', [EventController::class, 'index'])->name('event.index');
    Route::get('/{id}', [EventController::class, 'show'])->name('event.show');
    Route::post('/', [EventController::class, 'store'])->name('event.store');
    Route::put('/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/{id}', [EventController::class, 'delete'])->name('event.delete');
});

Route::group(['prefix' => 'ticket'], function () {
    Route::get('/all', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/{id}', [TicketController::class, 'show'])->name('ticket.show');
    Route::post('/', [TicketController::class, 'store'])->name('ticket.store');
    Route::put('/{id}', [TicketController::class, 'update'])->name('ticket.update');
    Route::delete('/{id}', [TicketController::class, 'delete'])->name('ticket.delete');
});

Route::group(['prefix' => 'schedule'], function () {
    Route::get('/all', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/{id}', [ScheduleController::class, 'show'])->name('schedule.show');
    Route::post('/', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::put('/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/{id}', [ScheduleController::class, 'delete'])->name('schedule.delete');
});