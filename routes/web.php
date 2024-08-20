<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Calendar\CalendarController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Frontend/Dashboard/IndexDashboard');
    })->name('dashboard');


    // Admin Rooms

    #Room Types
    Route::prefix('admin/rooms')->group(function () {
        Route::get('/room-types', [App\Http\Controllers\Admin\Rooms\RoomTypeController::class, 'index'])->name('admin.rooms.room-types.index');
        // Route::get('/room-types/create', [App\Http\Controllers\Admin\Rooms\RoomTypeController::class, 'create'])->name('admin.rooms.room-types.create');
        Route::post('/room-types', [App\Http\Controllers\Admin\Rooms\RoomTypeController::class, 'store'])->name('admin.rooms.room-types.store');
        Route::get('/room-types/{roomType}/edit', [App\Http\Controllers\Admin\Rooms\RoomTypeController::class, 'edit'])->name('admin.rooms.room-types.edit');
        // Route::put('/room-types/{roomType}', [App\Http\Controllers\Admin\Rooms\RoomTypeController::class, 'update'])->name('admin.rooms.room-types.update');
        Route::delete('/room-types/{roomType}', [App\Http\Controllers\Admin\Rooms\RoomTypeController::class, 'destroy'])->name('admin.rooms.room-types.destroy');
    });
    #Rooms
    Route::prefix('admin/rooms')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'index'])->name('admin.rooms.rooms.index');
        Route::get('/api/rooms/{room_type_id}', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'getRoomsJson'])->name('admin.rooms.rooms.get.json');
        Route::post('/api/rooms/{room_type_id}/store', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'storeRoomsJson'])->name('admin.rooms.rooms.store.json');
        // Route::get('/rooms/create', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'create'])->name('admin.rooms.rooms.create');
        Route::post('/rooms', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'store'])->name('admin.rooms.rooms.store');
        Route::get('/rooms/{room}/edit', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'edit'])->name('admin.rooms.rooms.edit');
        // Route::put('/rooms/{room}', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'update'])->name('admin.rooms.rooms.update');
        Route::delete('/rooms/{room}', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'destroy'])->name('admin.rooms.rooms.destroy');
    });
    #Rooms Availability
    Route::get('/api/rooms/availability/', [App\Http\Controllers\Admin\Rooms\RoomsAvailabilityController::class, 'index'])->name('admin.rooms.rooms.availability.json');

    #Reservations
    Route::get('/reservations/', [App\Http\Controllers\Reservations\NewReservationController::class, 'index'])->name('admin.reservations.index');
    Route::get('/reservations/new', [App\Http\Controllers\Reservations\NewReservationController::class, 'create'])->name('admin.reservations.create');
    Route::post('/reservations/new', [App\Http\Controllers\Reservations\NewReservationController::class, 'store'])->name('admin.reservations.store');
    Route::get('/reservations/show/{reservation}', [App\Http\Controllers\Reservations\NewReservationController::class, 'show'])->name('admin.reservations.show');

    #Calendar
    Route::get('/calendar/{from_date?}/{to_date?}', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/{from_date?}/{to_date?}/store', [CalendarController::class, 'store'])->name('calendar.store');
});
