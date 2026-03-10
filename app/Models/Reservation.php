<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Framework\Attributes\Ticket;

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
     public function client()
    {
        return $this->belongsTo(User::class,'user_id');
    }
     public function voyage()
    {
        return $this->belongsTo(Voyage::class);
    }
     public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
}
