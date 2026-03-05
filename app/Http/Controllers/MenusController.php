<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenusController extends Controller
{
    //
    public function Accueil()
    {
        return view('component.Acceuil');
    }
    public function Dashboard()
    {
        // Vérification du rôle de l'utilisateur connecté
        $user = auth()->user();
        if ($user) {
            switch ($user->role) {
                case 'admin':
                    return view('Admin.components.dashboard');
                case 'chauffeur':
                    return view('component.DashboardChauffeur');
                case 'client':
                    return view('Client.client-dashboard');
                default:
                    return view('component.Dashboard');
            }
        }
        return redirect()->route('login');
    }
}
