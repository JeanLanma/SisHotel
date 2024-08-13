<?php

namespace App\Models\Guest;

use App\Models\Reservation\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'second_lastname',
        'birthday',
        'gender',
        'nationality',
        'phone',
        'fax',
        'email',
        'client_id',
        'address',
        'state',
        'city',
        'id_document',
        'no_id_document',
        'occupation',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
