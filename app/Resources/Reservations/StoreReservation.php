<?php

namespace App\Resources\Reservations;

use App\Models\Reservation\Reservation;
use App\Resources\Guests\StoreGuests;

class StoreReservation
{
    public static function FromRequest($request)
    {
        $lastReservation = Reservation::latest()->first();

        $guests = StoreGuests::FromReservationRequest($request);

        $reservation = Reservation::create([
            'serie' => $request->serie ?? 'A',
            'folio' => $request->folio ?? isset($lastReservation->folio) ? $lastReservation->folio + 1 : 1,
            'guests_name' => $request->name,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'arrival_time' => $request->arrival_time ?? '15:00',
            'status' => $request->status ?? 'pending',
            'expiration_date' => $request->checkin,
            'adults' => $request->adults,
            'kids' => $request->kids,
            'person_booking_name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'observations' => $request->observations,
            'reservation_type' => $request->reservation_type,
            'rooms' => $request->rooms,
            'room_type_id' => $request->room_type,
            'room_id' => $request->room_id,
            'user_id' => request()->user()->id,
            'shift' => null,
            'guests_id' => $guests,
            'tax_free_account' => $request->tax_free_account ?? false,
            'total' => $request->total ?? false,
            'mail_sent' => 0,

        ]);
        return $reservation;
    }
}