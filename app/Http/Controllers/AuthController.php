<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function loginPage(){
        return view('login');
    }

    public function registerPage(){
        return view('register');
    }

    public function login(Request $req){
        $credentials = [
            'email' => $req->email,
            'password' => $req->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function register(Request $req){
        $rules = [
            'name' => 'required|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:20'
        ];

        $validator = Validator::make($req->all(), $rules);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $customID = User::generateID();

        User::create([
            'id' => $customID,
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);

        return redirect('/login');
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user_google = Socialite::driver('google')->user();
            $user = User::where('email', $user_google->getEmail())->first();

            if ($user != null) {
                Auth::login($user);
                return redirect('/');
            } else {
                $customID = User::generateID();
                $create = User::create([
                    'id' => $customID,
                    'name' => $user_google->getName(),
                    'email' => $user_google->getEmail(),
                    'password' => 0,
                ]);

                Auth::login($create);
                return redirect('/');
            }
        } catch (\Exception $e) {
            return redirect('/login');
        }
    }

    public function logout(Request $req){
        $req->session()->forget('user_id');
        Auth::logout();
        return redirect('/');
    }
}
