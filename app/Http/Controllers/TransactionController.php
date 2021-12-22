<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\CardNumberFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function showTransactionInformationPage(){
        if(Auth::user() && Auth::user()->role == 'member'){
            $user_id = Auth::user()->user_id;
            $cookie = Cookie::get('cart'.$user_id);
            if($cookie){
                $games = json_decode($cookie);
                if(count($games)==0){
                    return redirect('/cart');
                }else{
                    return view('pages.transactionInformation', ['games'=>$games]);
                }
            }else{
                return redirect('/cart');
            }
        }else{
            return redirect('/');
        }
    }

    public function checkout(Request $request){
        $validation = Validator::make($request->all(),[
            'cardName'=>['required','min:6'],
            'cardNumber'=>['required', new CardNumberFormat],
            'expiredDateMonth'=>['required','numeric','min:1','max:12'],
            'expiredDateYear'=>['required','numeric','min:2021','max:2050'],
            'cvccvv'=>['required','digits_between:3,4'],
            'cardCountry'=>['required'],
            'zip'=>['required','numeric']
        ]);
        if($validation->fails()){
            return back()->withErrors($validation->errors());
        }
        $user_id = Auth::user()->user_id;
        $cookie = Cookie::get('cart'.$user_id);
        $games = json_decode($cookie);
        $user = User::where('user_id',$user_id)->first();
    }
    //
}
