<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(){
      return view("users",['users'=> User::all(),"roles"=>Role::pluck('name','name')->all()]);
    }
    public function destroy(User $user){
      $user->delete();
      Session()->flash("delete","La suppression d'entreprise effectuée");
      return redirect()->back();
    }

    public function create(){

    }
    public function store(Request $request){
     $request->validate([
        'name'=>['required'],
        'email'=>['required'],
        'password'=>['min:8','confirmed'],
        "roles"=>["required"],
        "statut"=>["required"],
      ]);

    //   if($request->hasFile('img'))
    //   {
    //     $file = $request->file('img');
    //     $extention = $file->getClientOriginalExtension();
    //     $filename = time().".".$extention;
    //     $file->move('images/users/',$filename);
    //     $new_user->image=$filename;
    //   }
        $user = User::create([
            "image"=>"user.jpg",
            "name"=>$request->name,
            "email"=>$request->email,
            "statut"=>$request->statut,
            "role"=>"user",
            "password"=>Hash::make($request->password),

        ]);
        $user->assignRole($request->input('roles'));
        Session()->flash("success","L'enregistrement d'utilisateur effectuée");

        return back();

    }
    public function show($id)
    {

    }

    public function edit($id){
    //   $edit_user = User::find($id);
    //   $roles = Role::pluck('name','name')->all();
    //   $userRole = $edit_user->roles->pluck('name','name')->all();
    //   return view('user.edit',['edit_user'=>$edit_user,'roles'=>$roles,'userRole'=>$userRole]);
    }

    public function update(Request $request,User $user){

      $request->validate([
        'name_u'=>['required'],
        'email_u'=>['required'],
        "statut_u"=>["required"],
        'roles_u' => ['required'],

      ]);
      if($request->password_u != null ){
        $request->validate([ 'password_u' => ['string', 'min:8', 'confirmed'] ]);
        // $user->password = Hash::make($request->password_u);
      }
      $user->update([
        "name"=>$request->name_u,
        "role"=>"user",
        "email"=>$request->email_u,
        "statut"=>$request->statut_u,
        "password"=>$request->password_u ?? "",
      ]);


        //   if($request->hasFile('img'))
        //   {
        //     $file = $request->file('img');
        //     $extention = $file->getClientOriginalExtension();
        //     $filename = time().".".$extention;
        //     $file->move('images/users/',$filename);
        //     $user->image=$filename;
        //   }

          DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->input('roles_u'));
          Session()->flash("update","La notification d'utilisateur effectuée");
        return redirect()->back();

  }
}
