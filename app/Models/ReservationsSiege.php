<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationsSiege extends Model
{
    //
     use HasFactory;
    protected $fillable = [
        'reservation_id',
        'siege_id',
    ];
}
