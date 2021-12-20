<?php

namespace App\Http\Controllers;

use App\Models\Game;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class GameController extends Controller
{
    public function showHomePage(){
        $games = Game::all();
        if(count($games)>8){
            $games = $games->random(8);
        }
        return view('pages.home',["games"=>$games]);
    }

    public function showCreateGamePage(){
        if(Auth::user() && Auth::user()->role == 'admin'){
            return view('pages.createGame');
        }
        return back();
    }

    public function createGame(Request $request){
        $validation = Validator::make($request->all(),[
            'name'=>['required','unique:games,name'],
            'description'=>['required','max:500'],
            'description_long'=>['required','max:2000'],
            'category'=>['required',
                Rule::in(['Idle','Strategy','Horror','Role-Playing','Adventure','Puzzle','Action','Simulation','Sports']),
            ],
            'developer'=>['required'],
            'publisher'=>['required'],
            'price'=>['required','numeric','max:1000000'],
            'cover'=>['required','mimes:jpg','max:100'],
            'trailer'=>['required','mimes:webm','max:100000'],
        ]);
        if($validation->fails()){
            return back()->withErrors($validation->errors());
        }

        $name = $request->name;
        $description = $request->description;
        $description_long = $request ->description_long;
        $category = $request -> category;
        $developer = $request -> developer;
        $publisher = $request -> publisher;
        $price = $request -> price;
        $pathCover = $request->file('cover')->store('public/images');
        $pathTrailer = $request->file('trailer')->store('public/images');
        $adult = $request->adult;
        if($adult==null){
            $adult = false;
        }else{
            $adult = true;
        }

        $game = new Game();
        $game->name = $name;
        $game->description = $description;
        $game->description_long = $description_long;
        $game->category = $category;
        $game->developer = $developer;
        $game->publisher = $publisher;
        $game->price = $price;
        $game->cover = $pathCover;
        $game->trailer = $pathTrailer;
        $game->adult = $adult;
        $game->release_date = new DateTime();

        $game->save();
        return redirect('/manageGame');
    }

    public function searchGame(Request $request){
        $name = $request -> search;
        $games = Game::where('name','like', '%'.$name.'%')->paginate(8);

        return view('pages.search',["games"=>$games]);
    }

    public function gameDetail($game_id){
        $game = Game::where('game_id', $game_id)->first();
        return view('pages.gameDetail', ['game'=>$game]);
    }

    public function addCart($game_id){
        $game = Game::where('game_id', $game_id)->first();
        $user_id = Auth::user()->user_id;
        $cookie = Cookie::get('cart'.$user_id);
        if(!$cookie){
            $cookie = Cookie::make('cart'.$user_id, json_encode([$game]), 120);
        }else{
            $carts = json_decode($cookie);
            // foreach($carts as $game){
            //     if($game->game_id == $game_id){
            //         return back()->withErrors('The game already in your cart');
            //     }
            // }
            // dd($carts);
            array_push($carts, $game);
            // dd($carts);
            // dd($carts);
            $cookie = Cookie::make('cart'.$user_id, json_encode([$carts]), 120);
        }
        return back()->withCookie($cookie);
    }

    // public function checkGameAdult($game_id){
    //     $game = Game::where('game_id',$game_id)->first();
    //     if($game->adult == 1){
    //         return redirect('/checkage/'.$game_id);
    //     }else{
    //         return redirect('/game/'.$game_id);
    //     } 
    // }


    // public function manageGamePage(){
    //     // $games = Game::all()->paginate(8);
    //     $games = Game::all();
    //     return view('manageGame', ['games'=>$games]);
    // }

    // public function updateGamePage($game_id){
    //     $game = Game::where('game_id', $game_id)->first();
    //     // dd($game, $game_id);
    //     return view('updateGame', ['game'=>$game]);
    // }

    // public function updateGame(Request $request, $game_id){
    //     $validation = Validator::make($request->all(),[
    //         'description'=>['required','max:500'],
    //         'description_long'=>['required','max:2000'],
    //         'category'=>['required',
    //         Rule::in(['Idle','Strategy','Horror','Role-Playing','Adventure','Puzzle','Action','Simulation','Sports']),
    //         ],
    //         'price'=>['required','numeric','max:1000000'],
    //         'cover'=>['nullable','mimes:jpg','max:100'],
    //         'trailer'=>['nullable','mimes:webm','max:100000'],
    //     ]);

    //     if($validation->fails()){
    //         return back()->withErrors($validation->errors());
    //     }

    //     $game = Game::where('game_id', $game_id)->first();
    //     $new_description = $request->description;
    //     $new_description_long = $request->description_long;
    //     $new_category = $request->category;
    //     $new_price = $request->price;
    //     $new_path_cover = null;
    //     $new_path_trailer = null;

    //     $game->description = $new_description;
    //     $game->description_long = $new_description_long;
    //     $game->category = $new_category;
    //     $game->price = $new_price;
    //     if($request->cover){
    //         $new_path_cover = $request->file('cover')->store('public/images');
    //         $game->cover = $new_path_cover;
    //     }
    //    if($request->trailer){
    //         $new_path_trailer = $request->file('trailer')->store('public/images');
    //         $game->trailer = $new_path_trailer;
    //    }

    //    $game->save();
    //    return redirect('/manageGame');
        
    // }

    // public function deleteGame($game_id){
    //     $game = Game::where('game_id', $game_id)->first();
    //     $game->delete();
    //     return back();
    // }
}
