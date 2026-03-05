<?php

namespace App\Models;

use Log;
use Laravel\Jetstream\HasProfilePhoto;
use App\Notifications\CustomVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- très important


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function sendEmailVerificationNotification()
    {

        $this->notify(new CustomVerifyEmail());
    }
    public function sendPasswordResetNotification($token)
{
    $this->notify(new CustomResetPassword($token));
}

    use HasProfilePhoto;

}
