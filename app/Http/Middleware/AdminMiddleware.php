<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Middleware pour sécuriser les routes admin
     * Vérifie que l'utilisateur est authentifié ET possède le rôle admin
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Vérifier l'authentification
        if (!auth()->check()) {
            Log::warning('Tentative d\'accès admin non authentifiée', [
                'ip' => $request->ip(),
                'url' => $request->url(),
                'user_agent' => $request->userAgent(),
            ]);
            return redirect()->route('login')->with('error', 'Vous devez être connecté.');
        }

        $user = auth()->user();

        // 2. Vérifier le rôle admin
        if ($user->role !== 'admin') {
            Log::warning('Tentative d\'accès admin par utilisateur non-admin', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'user_role' => $user->role,
                'ip' => $request->ip(),
                'url' => $request->url(),
            ]);

            // Retourner une page 403 (plus sécurisé que 404 pour éviter les énumérations)
            abort(403, 'Accès non autorisé. Seuls les administrateurs peuvent accéder à cette ressource.');
        }

        // 3. Vérifier que l'email est vérifié (sécurité supplémentaire)
        if (!$user->hasVerifiedEmail()) {
            Log::info('Accès admin bloqué : email non vérifié', [
                'user_id' => $user->id,
                'user_email' => $user->email,
            ]);
            abort(403, 'Votre email doit être vérifié pour accéder à cette zone.');
        }

        // 4. Tout est OK, continuer le traitement
        Log::info('Accès admin autorisé', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'url' => $request->url(),
        ]);

        return $next($request);
    }
}
