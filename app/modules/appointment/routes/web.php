<?php

namespace App\modules\appointment\routes;

use Illuminate\Support\Facades\Route;
use App\modules\appointment\controllers\AppointmentController;

Route::get('/appointment/slots', [AppointmentController::class, 'availableSlots'])
    ->name('appointment.available-slots');
Route::post('/appointment/store', [AppointmentController::class, 'store'])
    ->name('appointment.store');

Route::middleware('auth')->prefix('appointment')->group(function () {
    Route::get('/time-slots', [AppointmentController::class, 'timeSlots'])
        ->name('appointment.slots');

    Route::get('/time-slots/add-time-slot', [AppointmentController::class, 'creatTimeSlot'])
        ->name('timeslots.create');
    Route::post('/time-slots', [AppointmentController::class, 'storeTimeSlot']);



    Route::get('/dash-appointment', [AppointmentController::class, 'showAppointment'])->name('dash-appointment');

    Route::get('/create', [AppointmentController::class, 'create'])
        ->name('appointment.create');

    Route::delete('/time-slots/{id}/delete', [AppointmentController::class, 'deleteTimeSlot'])
        ->name('appointment.slots.delete');
    Route::get('/time-slots/{id}/update', [AppointmentController::class, 'updateTimeSlot']);
    Route::put('/time-slots/{id}', [AppointmentController::class, 'updateTimeSlot'])
        ->name('appointment.slots.update');

    Route::get('/time-slots/{id}', [AppointmentController::class, 'ShowTimeSlot'])
        ->name('appointment.slot.show');
    Route::get('/{appointment}/edit', [AppointmentController::class, 'edit'])
        ->name('appointment.edit');
    Route::get('/{appointment}', [AppointmentController::class, 'show'])
        ->name('appointment.show');
    Route::delete('/{appointment}', [AppointmentController::class, 'destroy'])
        ->name('appointment.destroy');
    Route::put('/{appointment}', [AppointmentController::class, 'update'])
        ->name('appointment.update');
});
