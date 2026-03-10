<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'ville_depart_id',
        'ville_arrivee_id',
        'distance',
        'duree',
    ];
    public function villeDepart(){
        return
        $this->belongsTo(Ville::class,'ville_depart_id');
    }
     public function villeArrivee(){
        return
        $this->belongsTo(Ville::class,'ville_arrivee_id');
    }
}
