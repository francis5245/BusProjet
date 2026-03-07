<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voyage extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'trajet_id',
        'bus_id',
        'chauffeur_id',
        'date_depart',
        'heure_depart',
        'prix',
        'places_disponibles',
        'status'
    ];
    public function bus()
{
    return $this->belongsTo(Bus::class);
}
}
