<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    use HasFactory;
     protected $fillable = [
        
    ]; 
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
     public function siege()
    {
        return $this->belongsTo(Siege::class,'reservation_siege');
    }
    
}
