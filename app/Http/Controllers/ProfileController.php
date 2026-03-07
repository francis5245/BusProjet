<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;

class ProfileController extends Controller
{
    //
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation du nom
        $rules = [
            'name' => 'required|string|max:255',
        ];

        // Ajouter l'email uniquement si l'utilisateur n'a pas encore vérifié son email
        if (!$user->hasVerifiedEmail()) {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $user->id;
        }

        $request->validate($rules);

        // Mise à jour du nom
        $user->name = $request->input('name');

        // Mise à jour de l'email seulement si non vérifié
        if (!$user->hasVerifiedEmail() && $request->filled('email')) {
            $user->email = $request->input('email');
            $user->email_verified_at = null; // réinitialiser la vérification
            $user->sendEmailVerificationNotification(); // envoyer le mail de vérification
        }

        $user->save();

        return redirect()->back()->with('status', 'Profil mis à jour avec succès.');
    }



    public function updatePassword(Request $request)
    {
        // Validation des données
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Le mot de passe actuel est requis.',
            'password.required' => 'Le nouveau mot de passe est requis.',
            'password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les nouveaux mots de passe ne sont pas identiques.',
        ]);

        $user = Auth::user();

        // Vérification de l'ancien mot de passe
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mise à jour du mot de passe
        $user->password = Hash::make($request->input('password'));
        $user->save();

        // Redirection avec message de succès
        return redirect()->back()->with('status', 'Mot de passe mis à jour avec succès.');
    }


    public function updatePhoto(Request $request)
    {
        $user = Auth::user();

        // Validation uniquement du fichier
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Supprimer l'ancienne photo si elle existe
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Enregistrer la nouvelle photo
        $path = $request->file('photo')->store('profiles', 'public');
        $user->profile_photo_path = $path;
        $user->save();

        return redirect()->back()->with('success', 'Photo de profil mise à jour avec succès.');
    }
}
