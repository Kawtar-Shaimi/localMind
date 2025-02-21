<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SetGlobalVariables
{
    public function handle(Request $request, Closure $next)
    {
        // Date/heure UTC fixe pour l'exemple
        $currentDateTime = '2025-02-21 16:00:10';
        
        // Nom d'utilisateur fixe
        $currentUser = 'Kawtar-Shaimi';

        // Partager les variables avec toutes les vues
        View::share([
            'currentDateTime' => $currentDateTime,
            'currentUser' => $currentUser
        ]);

        return $next($request);
    }
}