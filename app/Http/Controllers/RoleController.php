<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
class RoleController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-destroy', ['only' => ['index']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('roles.index')->with([
           'roles'=>Role::all()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        $categories = Permission::where("name","like","categorie-%")->get();
        $sous_categories = Permission::where("name","like","sousCategorie-%")->get();
        $caracteristiques = Permission::where("name","like","caracteristique-%")->get();
        $customizes = Permission::where("name","like","customize-%")->get();
        $stocks = Permission::where("name","like","stock-%")->get();
        $groupes = Permission::where("name","like","groupe-%")->get();
        $clients = Permission::where("name","like","client-%")->get();
        $produits = Permission::where("name","like","produit-%")->get();
        $factures = Permission::where("name","like","facture-%")->get();
        $users = Permission::where("name","like","user-%")->get();
        $roles = Permission::where("name","like","role-%")->get();
        $entreprises = Permission::where("name","like","entreprise-%")->get();
        $transactions = Permission::where("name","like","transaction-%")->get();
        $vente_semaines = Permission::where("name","like","venteSemaine-%")->get();
        $type_clients = Permission::where("name","like","typeClient-%")->get();


        return view('roles.create',
            [
                "permission"=>$permission,
                "categories"=>$categories,
                "sous_categories"=>$sous_categories,
                "caracteristiques"=>$caracteristiques,
                "customizes"=>$customizes,
                "stocks"=>$stocks,
                "groupes"=>$groupes,
                "clients"=>$clients,
                "produits"=>$produits,
                "factures"=>$factures,
                "users"=>$users,
                "roles"=>$roles,
                "entreprises"=>$entreprises,
                "transactions"=>$transactions,
                "vente_semaines"=>$vente_semaines,
                "type_clients"=>$type_clients,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        // foreach($permissions as $permission){
        //     Permission::create(["name"=>$permission]);
        // }
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);

        // foreach()
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        return view('roles.show',compact('role','rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $categories = Permission::select('id','name')->where("name","like","categorie-%")->get();
        $role = Role::find($id);
        // $permission = Permission::get();


        $categories = Permission::where("name","like","categorie-%")->orderBy("name","ASC")->get();
        $sous_categories = Permission::where("name","like","sousCategorie-%")->orderBy("name","ASC")->get();
        $caracteristiques = Permission::where("name","like","caracteristique-%")->orderBy("name","ASC")->get();
        $customizes = Permission::where("name","like","customize-%")->orderBy("name","ASC")->get();
        $stocks = Permission::where("name","like","stock-%")->orderBy("name","ASC")->get();
        $groupes = Permission::where("name","like","groupe-%")->orderBy("name","ASC")->get();
        $clients = Permission::where("name","like","client-%")->orderBy("name","ASC")->get();
        $produits = Permission::where("name","like","produit-%")->orderBy("name","ASC")->get();
        $factures = Permission::where("name","like","facture-%")->orderBy("name","ASC")->get();
        $users = Permission::where("name","like","user-%")->orderBy("name","ASC")->get();
        $roles = Permission::where("name","like","role-%")->orderBy("name","ASC")->get();
        $entreprises = Permission::where("name","like","entreprise-%")->orderBy("name","ASC")->get();
        $transactions = Permission::where("name","like","transaction-%")->orderBy("name","ASC")->get();
        $vente_semaines = Permission::where("name","like","venteSemaine-%")->orderBy("name","ASC")->get();
        $type_clients = Permission::where("name","like","typeClient-%")->orderBy("name","ASC")->get();


        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        // dd($rolePermissions);
        return view('roles.edit',[
            "role"=>$role,
            "rolePermissions"=>$rolePermissions,
            "categories"=>$categories,
            "sous_categories"=>$sous_categories,
            "caracteristiques"=>$caracteristiques,
            "customizes"=>$customizes,
            "stocks"=>$stocks,
            "groupes"=>$groupes,
            "clients"=>$clients,
            "produits"=>$produits,
            "factures"=>$factures,
            "users"=>$users,
            "roles"=>$roles,
            "entreprises"=>$entreprises,
            "transactions"=>$transactions,
            "vente_semaines"=>$vente_semaines,
            "type_clients"=>$type_clients,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }

}
