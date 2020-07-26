<?php

namespace App\Http\Middleware;

use Closure;
use App\Invitation;

class CreateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $invitation_token = $request->invitation_token;
        $invitation = Invitation::where('invitation_token', $invitation_token)->firstOrFail();
        if($request->email !== $invitation->email){
            return redirect(route('register',['invitation_token' => $invitation_token]))
                ->with('error', "L'adresse e-mail donnée est invalide !");
        }

        return $next($request);
    }
}
