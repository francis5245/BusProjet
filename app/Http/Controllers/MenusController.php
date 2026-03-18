<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Trajet;
use App\Models\Ville;
use App\Models\Voyage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MenusController extends Controller
{
    //
    public function Accueil()
    {
        $villes = Ville::all();
        $bus = Bus::latest()->take(6)->get();

        return view('component.acceuil', compact('bus', 'villes'));
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
  
public function Recherche(Request $request)
{
    // 1) Vérification des données envoyées
    $request->validate([
        'villeDepart' => 'required|exists:villes,id',
        'villeArrivee' => 'required|exists:villes,id',
        'dateDepart' => 'required|date',
    ]);

    $depart = $request->input('villeDepart');
    $arrivee = $request->input('villeArrivee');
    $date = $request->input('dateDepart');

    // 2) Vérification du trajet disponible
    $trajet = Trajet::where('ville_depart_id', $depart)
        ->where('ville_arrivee_id', $arrivee)->first();

    if (!$trajet) {
        return response()->json([
            'success' => false,
            'message' => "Désolé, nous ne disposons pas encore cette ligne."
        ]);
    }

    // 3) Les voyages prévus pour ce trajet à cette date
    $voyages = Voyage::with(['bus', 'trajet.villeDepart', 'trajet.villeArrivee'])
        ->whereHas('trajet', function ($q) use ($depart, $arrivee) {
            $q->where('ville_depart_id', $depart)
              ->where('ville_arrivee_id', $arrivee);
        })
        ->whereDate('date_depart', $date)
        ->where('status', 'disponible')
        ->orderBy('heure_depart')
        ->get();

    if ($voyages->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => "Aucun bus disponible pour ce trajet à cette date."
        ]);
    }

    // 4) Génération du token sécurisé
    $token = Crypt::encryptString(json_encode([
        'villeDepart' => $depart,
        'villeArrivee' => $arrivee,
        'dateDepart' => $date
    ]));

    return response()->json([
        'success' => true,
        'voyages' => $voyages,
        'token' => $token  // <-- ici on envoie le token côté JS
    ]);
}
}
