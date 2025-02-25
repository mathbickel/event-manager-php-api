<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\NotificationsController;

Route::group(['prefix' => 'organizer'], function () {
    Route::get('/all', [OrganizerController::class, 'index'])->name('organizer.index');
    Route::get('/{id}', [OrganizerController::class, 'show'])->name('organizer.show');
    Route::post('/store', [OrganizerController::class, 'store'])->name('organizer.store');
    Route::put('/{id}', [OrganizerController::class, 'update'])->name('organizer.update');
    Route::delete('/{id}', [OrganizerController::class, 'delete'])->name('organizer.delete');
});

Route::group(['prefix' => 'event'], function () {
    Route::get('/all', [EventController::class, 'index'])->name('event.index');
    Route::get('/{id}', [EventController::class, 'show'])->name('event.show');
    Route::post('/store', [EventController::class, 'store'])->name('event.store');
    Route::put('/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/{id}', [EventController::class, 'delete'])->name('event.delete');
});

Route::group(['prefix' => 'ticket'], function () {
    Route::get('/all', [TicketController::class, 'index'])->name('ticket.index');
    Route::get('/{id}', [TicketController::class, 'show'])->name('ticket.show');
    Route::post('/store', [TicketController::class, 'store'])->name('ticket.store');
    Route::put('/{id}', [TicketController::class, 'update'])->name('ticket.update');
    Route::delete('/{id}', [TicketController::class, 'delete'])->name('ticket.delete');
});

Route::group(['prefix' => 'schedule'], function () {
    Route::get('/all', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/{id}', [ScheduleController::class, 'show'])->name('schedule.show');
    Route::post('/store', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::put('/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/{id}', [ScheduleController::class, 'delete'])->name('schedule.delete');
});

Route::group(['prefix' => 'attendee'], function () {
    Route::get('/all', [AttendeeController::class, 'index'])->name('attendee.index');
    Route::get('/{id}', [AttendeeController::class, 'show'])->name('attendee.show');
    Route::post('/store', [AttendeeController::class, 'store'])->name('attendee.store');
    Route::put('/{id}', [AttendeeController::class, 'update'])->name('attendee.update');
    Route::delete('/{id}', [AttendeeController::class, 'delete'])->name('attendee.delete');
});

Route::group(['prefix' => 'notifications'], function () {
    Route::get('/all', [NotificationsController::class, 'index'])->name('notifications.index');
    Route::get('/{id}', [NotificationsController::class, 'show'])->name('notifications.show');
    Route::post('/store', [NotificationsController::class, 'store'])->name('notifications.store');
    Route::put('/{id}', [NotificationsController::class, 'update'])->name('notifications.update');
    Route::delete('/{id}', [NotificationsController::class, 'delete'])->name('notifications.delete');
});