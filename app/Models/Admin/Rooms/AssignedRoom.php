<?php

namespace App\Models\Admin\Rooms;

use App\Models\Reservation\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'reservation_id',
        'user_id',
        'checkin',
        'checkout',
        'departure_time',
        'status',
        'observations',
        'items',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
