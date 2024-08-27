<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Dashboard\DashboardController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


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
        
        // Rooms API
        Route::get('/api/rooms/{room_type_id}', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'getRoomsJson'])->name('admin.rooms.rooms.get.json');
        Route::get('/api/rooms/availability/{room_type_id}/{checkin}/{checkout}', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'getRoomAvailabilityJson'])->name('admin.rooms.rooms.get.availability.json');
        Route::get('/api/rooms/room-type/availability/{room_type_id}/{checkin}/{checkout}', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'getRoomTypeAvailabilityJson'])->name('admin.rooms.rooms.get.room-type.availability.json');
        Route::post('/api/rooms/{room}/update', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'updateRoomJson'])->name('admin.rooms.rooms.update.json');
        Route::post('/api/rooms/{room_type_id}/store', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'storeRoomsJson'])->name('admin.rooms.rooms.store.json');
        
        Route::post('/rooms', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'store'])->name('admin.rooms.rooms.store');
        Route::get('/rooms/{room}/edit', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'edit'])->name('admin.rooms.rooms.edit');
        Route::delete('/rooms/{room}', [App\Http\Controllers\Admin\Rooms\RoomsController::class, 'destroy'])->name('admin.rooms.rooms.destroy');
    });
    #Rooms Availability
    Route::get('/api/rooms/availability/', [App\Http\Controllers\Admin\Rooms\RoomsAvailabilityController::class, 'index'])->name('admin.rooms.rooms.availability.json');

    #Reservations
    Route::get('/reservations/', [App\Http\Controllers\Reservations\NewReservationController::class, 'index'])->name('admin.reservations.index');
    Route::get('/reservations/new', [App\Http\Controllers\Reservations\NewReservationController::class, 'create'])->name('admin.reservations.create');
    Route::post('/reservations/new', [App\Http\Controllers\Reservations\NewReservationController::class, 'store'])->name('admin.reservations.store');
    Route::get('/reservations/show/{reservation}', [App\Http\Controllers\Reservations\NewReservationController::class, 'show'])->name('admin.reservations.show');
    #Reservations API
    ## Arrivals
    Route::get('/api/reservations/arrivals/', [App\Http\Controllers\Reservations\ArrivalsController::class, 'getArrivalsJson'])->name('admin.reservations.arrivals.json');
    #Calendar
    Route::get('/calendar/{from_date?}/{to_date?}', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/{from_date?}/{to_date?}/store', [CalendarController::class, 'store'])->name('calendar.store');
    #Checkin
    Route::get('reservations/arrivals/checkin/{reservation}', [App\Http\Controllers\Arrivals\ArrivalsController::class, 'checkin'])->name('admin.reservations.arrivals.checkin');
    Route::post('reservations/arrivals/checkin/{reservation}', [App\Http\Controllers\Arrivals\ArrivalsController::class, 'makeCheckin'])->name('admin.reservations.arrivals.checkin.make');
    #Checkout
    Route::get('reservations/arrivals/checkout/{reservation}', [App\Http\Controllers\Arrivals\ArrivalsController::class, 'makeCheckout'])->name('admin.reservations.arrivals.checkout');
    #Users
    Route::get('/admin/users/register', [App\Http\Controllers\Admin\Users\RegisterUserController::class, 'index'])->name('admin.users.register');
    Route::post('/admin/users/register', [App\Http\Controllers\Admin\Users\RegisterUserController::class, 'store'])->name('admin.users.register.store');
    #Support
    Route::get('/support-send', [App\Http\Controllers\Contact\SupportContactController::class, 'send'])->name('admin.support.send');
});
