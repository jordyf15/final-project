<?php

namespace App\Http\Controllers;

use App\Models\GameLibraryDetail;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\User;
use App\Rules\CardNumberFormat;
use DateTime;
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
        $cardName = $request->cardName;
        $cardNumber = $request->cardNumber;
        $cvccvv = $request->cvccvv;
        $cardCountry = $request->cardCountry;
        $zip = $request->zip;

        $user_id = Auth::user()->user_id;
        $cookie = Cookie::get('cart'.$user_id);
        $games = json_decode($cookie);
        $user = User::where('user_id',$user_id)->first();
        $user->level +=count($games);
        $user->save();
        
        $gameLibrary = $user->gameLibrary;
        $totalPrice = 0;
        for($i = 0;$i<count($games);$i++){
            $gameLibraryDetail = new GameLibraryDetail();
            $gameLibraryDetail->library_id = $gameLibrary->library_id;
            $gameLibraryDetail->game_id = $games[$i]->game_id;
            $totalPrice += $games[$i]->price;
            $gameLibraryDetail->save();
        }
        $transactionHeader = new TransactionHeader();
        $transactionHeader->user_id = $user_id;
        $transactionHeader->card_name = $cardName;
        $transactionHeader->card_number = $cardNumber;
        $transactionHeader->cvccvv = $cvccvv;
        $transactionHeader->country = $cardCountry;
        $transactionHeader->zip_code = $zip;
        $transactionHeader->total_price = $totalPrice;
        $transactionHeader->purchase_date = new DateTime();
        $transactionHeader->save();
//ada error disini jadi test dlu
        for($i = 0;$i<count($games);$i++){
            $transactionDetail = new TransactionDetail();
            $transactionDetail->price = $games[$i]->price;
            $transactionDetail->transaction_header_id = $transactionHeader->transaction_header_id;
            $transactionDetail->game_id = $games[$i]->game_id;
            $transactionDetail->save();
        }

        $cookie = Cookie::make('cart'.$user_id, json_encode([]), 120);

        return redirect('/receipt')->with('transactionId',$transactionHeader->transaction_header_id)->withCookie($cookie);
    }

    public function showTransactionReceiptPage(){
        if(Auth::user() && Auth::user()->role == 'member'){
            $transactionId = session()->get('transactionId');
            $transactionHeader = TransactionHeader::where('transaction_header_id', $transactionId)->first();
            return view('pages.transactionReceipt',['transactionHeader'=>$transactionHeader]);
        }else{
            return redirect('/');
        }
    }
    //
}
