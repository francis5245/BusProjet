<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Ville;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    //
    public function Accueil()
    {
        $villes=Ville::all();
        $bus = Bus::latest()->take(6)->get();

        return view('component.acceuil', compact('bus','villes'));
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
