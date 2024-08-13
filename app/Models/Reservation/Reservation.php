<?php

namespace App\Models\Reservation;

use App\Models\Admin\Rooms\RoomType;
use App\Models\Guest\Guest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'serie',
        'folio',
        'guests_name',
        'checkin',
        'checkout',
        'arrival_time',
        'status',
        'expiration_date',
        'adults',
        'kids',
        'person_booking_name',
        'phone',
        'email',
        'observations',
        'reservation_type',
        'rooms',
        'room_type_id',
        'room_id',
        'user_id',
        'shift',
        'guests_id',
        'tax_free_account',
        'total',
        'mail_sent',
    ];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function guests()
    {
        return $this->belongsTo(Guest::class);
    }
}
