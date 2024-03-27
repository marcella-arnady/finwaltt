<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function indexProfile(){
        $user = User::find(Auth::user()->id);
        return view('/profile/indexProfile', compact('user'));
    }

    public function editProfilePage($id)
    {
        $user = User::find($id);
        return view('/profile/editProfile', compact('user'));
    }

    public function editProfile(Request $req, $id)
    {
        $user = User::find($id);

        $user->name = $req->name != null ? $req->name : $user->name;
        $user->email = $req->email != null ? $req->email : $user->email;

        $user->save();

        return redirect('/indexProfile');

    }

    public function deleteProfile($id)
    {
        $user = User::find($id);

        if(isset($user)){
            $user->delete();
        }

        return redirect('/login');

    }
}
