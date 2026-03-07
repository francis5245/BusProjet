<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'voyage_id',
        'nombre_places',
        'montant_total',
        'status'
    ];
    public function voyage()
{
    return $this->belongsTo(Voyage::class);
}
}
