<?php

namespace App\Http\Middleware;

use App\Models\Game;
use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $game_id = $request->game_id;
        $safe = session()->get('safe');
        $game = Game::where('game_id', $game_id)->first();
        if($game->adult == 1 && !$safe){
            return redirect('/checkage/'.$game_id);
        }
        return $next($request);
    }
}
