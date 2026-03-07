<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    //
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Récupérer l'email depuis l'URL
        $email = $request->query('email');

        $status = Password::reset(
            array_merge(
                $request->only('password', 'password_confirmation', 'token'),
                ['email' => $email]
            ),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Mot de passe réinitialisé avec succès.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
