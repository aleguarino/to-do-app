<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Project;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $projectId = $request->route('id');

        // Verifica si el usuario tiene algun proyecto asociado en la tabla intermedia
        $isMember = $user->projects->contains($projectId);
        if (!$isMember) {
            // Redirige o lanza un error si el usuario no es miembro del proyecto
            return redirect('/')->with('error', 'No tienes acceso a este proyecto.');
        }

        return $next($request);
    }
}
