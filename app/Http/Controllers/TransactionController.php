<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class TransactionController extends Controller
{
    public function showShoppingCartPage(){
        if(Auth::user() && Auth::user()->role == 'member'){
            $user_id = Auth::user()->user_id;
            $cookie = Cookie::get('cart'.$user_id);
            $games = json_decode($cookie);
            return view('pages.shoppingcart', ['games'=>$games]);
        }else{
            return redirect('/');
        }
    }

    public function deleteGameFromCart($game_id){
        if(Auth::user() && Auth::user()->role == 'member'){
            $user_id = Auth::user()->user_id;
            $cookie = Cookie::get('cart'.$user_id);
            $games = json_decode($cookie);
            $deletedIndex = null;
            for($i = 0; $i<count($games);$i++){
                if($games[$i]->game_id==$game_id){
                    $deletedIndex = $i;
                }
            }
            array_splice($games, $deletedIndex, 1);
            $cookie = Cookie::make('cart'.$user_id, json_encode($games), 120);
            return back()->withCookie($cookie);
        }else{
            return redirect('/');
        }
    }
    //
}
