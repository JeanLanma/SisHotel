<?php

namespace App\Models\Admin\Rooms;

use App\Models\Reservation\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'room_type',
        'description',
        'base_occupancy',
        'max_occupancy',
        'base_occupancy_kids',
        'max_occupancy_kids',
        'base_price',
        'extra_adult_price',
        'extra_kid_price',
        'base_availability',
        'status'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
