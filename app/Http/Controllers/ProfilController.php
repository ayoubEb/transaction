<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Contracts\Session\Session;

;

class ProfilController extends Controller
{
//     public function __construct()
//     {
//         $this->middleware('auth');
//     }
    public function show(User $profil)
    {

      return view('profil',
      [
        'user'=>$profil,
      ]);
    }

    public function edit(User $profil){
      return view('setting',['profil'=>$profil]);
    }

    public function update(Request $request,User $profil){

        $request->validate([
            'name'=>['required'],
            'email'=>['required'],
          ]);
          if($request->password_u != null ){
            $request->validate([ 'password_u' => ['string', 'min:8', 'confirmed'] ]);
            // $user->password = Hash::make($request->password_u);
          }
          $profil->update([
            "name"=>$request->name,

            "email"=>$request->email,
            "password"=>$request->password ?? "",
          ]);
          Session()->flash("update","La notification d'utilisateur effectuée");
        return redirect()->back();

  }
}
