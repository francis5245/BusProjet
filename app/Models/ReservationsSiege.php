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
    //  public function sieges()
    // {
    //     return $this->belongsToMany(Siege::class,'reservation_siege')->withPivot('code_ticket')->withTimestamps();
    // }
}
