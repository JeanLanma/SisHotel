<?php

namespace App\Models\Admin\Rooms;

use App\Models\Reservation\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type_id',
        'room',
        'status',
        'cleaning_status',
        'pax',
        'ext_number',
        'cleaning_time',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
