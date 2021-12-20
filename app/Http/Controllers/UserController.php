<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use DateTime;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  
    public function showRegisterForm(){
        return view('register');
    }

    public function showLoginForm(){
        return view('login');
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember;
        if($remember){
            $remember = true;
        }
        $loginSuccess = Auth::attempt(['username' => $username, 'password' => $password], $remember);
        if($loginSuccess == true){
            if($remember){
                $userCookieKey = Auth::getRecallerName();
                $userCookieValue = Auth::user()->getRememberToken();
                $userCookie = Cookie::make($userCookieKey, $userCookieValue, 120);
                return redirect('/')->withCookie($userCookie);
            }
            return redirect('/');
        }else{
            return back()->withErrors([
                'username' => 'The username does not exist',
                'password' => 'The password is incorrect'
            ]);
        }
    }

    public function register(Request $request){
        $validation = Validator::make($request->all(),[
            'username'=>['required','min:6','unique:users,username'],
            'fullname'=>['required'],
            'password'=>['required','min:6','alpha_num'],
            'role'=>['required',
                Rule::in(['member','admin']),
            ],
        ]);
        if($validation->fails()){
            return back()->withErrors($validation->errors());
        }else{
            $password = $request -> password;
            $user = new User();
            $user -> username = $request -> username; 
            $user -> fullname = $request -> fullname;
            $user -> password = Hash::make($password);
            $user -> role = $request -> role;
            $user -> level = 1;
            $user -> profile_picture = 'public/images/default_picture';
            
            $user->save();
            return redirect('/');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function showCheckAgePage($game_id){
        $game = Game::where('game_id', $game_id)->first();
        return view('pages.checkage',['game'=>$game]);
    }

    public function checkage(Request $request){
        $dob = new DateTime($request->dob);
        $now = new DateTime();
        $dayDiff = $now->diff($dob)->format('%a');
        // 17 tahun == 6209.25 hari
        if($dayDiff>=6209.25){//dia 17 tahun keatas
            return redirect()->intended();
        }else{// dibawah 17 tahun
            return redirect('/')->withErrors('Sorry but this content is not appropriate for you');
        }
    }

    // public function updateUser(Request $request, $user_id){
    //     $user = User::where('user_id', $user_id)->first();
    //     $validation = Validator::make($request->all(),[
    //         'fullname'=>['required'],
    //         'current_password'=>['required', 'min:6','alpha_num'],
    //         'new_password'=>['nullable','min:6','alpha_num'],
    //         'confirm_new_password'=>['nullable','min:6','alpha_num','confirmed'],
    //         'profile_picture'=>['nullable', 'mimes:jpg,png', 'max:100']
    //     ]);
    //     if($validation->fails()){
    //         return back()->withErrors($validation->errors());
    //     }
    //     $new_fullname = $request->fullname;
    //     $new_password = $request->new_password;
    //     $new_profile_picture = $request->profile_picture;
    // }

    // public function showCheckAgePage($game_id){
    //     $game = Game::where('game_id',$game_id)->first();
    //     return view('checkAge', ['game'=>$game]);
    // }

    // public function checkAge(Request $request, $game_id){
    //     $dob = new DateTime($request->dob);
    //     $now = new DateTime();
    //     $dayDiff = $now->diff($dob)->format('%a');
    //     // 17 tahun == 6209.25 hari
    //     if($dayDiff>=6209.25){//dia 17 tahun keatas
    //         return redirect('/game/'.$game_id);
    //     }else{// dibawah 17 tahun
    //         return redirect('/home');
    //     }
    //     dd($dayDiff);
    // }
}
