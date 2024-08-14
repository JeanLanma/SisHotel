<?php

namespace App\Resources\Guests;

use App\Models\Guest\Guest;

class StoreGuests {


    public static function FromReservationRequest($request): int
    {
        $guest = Guest::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'second_lastname' => $request->second_lastname,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return isset($guest->id) ? $guest->id : 0;
    }
}