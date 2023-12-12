<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:fournisseur-list|fournisseur-create|fournisseur-edit|fournisseur-destroy', ['only' => ['index','show']]);
         $this->middleware('permission:fournisseur-create', ['only' => ['create','store']]);
         $this->middleware('permission:fournisseur-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:fournisseur-destroy', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::select("id","raison_sociale",'email','ice','rc','phone','fix','adresse','ville','code_postal','pays')->get();

        return view("crm.fournisseur",
            [
                "fournisseurs"=>$fournisseurs,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "raison_sociale"=>["required"],
            // ""=>["required"],
            "code_postal"=>["numeric","digits:5"],
            "ice"=>["nullable", "digits_between:1,16"],
            "rc"=>["nullable", "digits_between:1,16"],
        ]);
        // if(empty($request->raison_sociale) || empty($request->ice) || empty($request->rc) ||   )
        Fournisseur::create([
            "raison_sociale"=>$request->raison_sociale,
            "ice"=>$request->ice,
            "rc"=>$request->rc,
            "email"=>$request->email,
            "phone"=>$request->phone,
            "fix"=>$request->fix,
            "adresse"=>$request->adresse,
            "ville"=>$request->ville,
            "pays"=>$request->pays,
            "code_postal"=>$request->code_postal,
        ]);
        toast("L'enregistrement du fournisseur effectuée","success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            "code_postal_u"=>["numeric","digits:5"],
            "ice_u"=>["nullable", "digits_between:1,16"],
            "rc_u"=>["nullable", "digits_between:1,16"],
        ]);
        $fournisseur->update([
            "raison_sociale"=>$request->raison_sociale_u,
            "ice"=>$request->ice_u,
            "rc"=>$request->rc_u,
            "email"=>$request->email_u,
            "phone"=>$request->phone_u,
            "fix"=>$request->fix_u,
            "adresse"=>$request->adresse_u,
            "ville"=>$request->ville_u,
            "pays"=>$request->pays_u,
            "code_postal"=>$request->code_postal_u,
        ]);
        toast("La notification du fournisseur effectuée","success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur,Request $request)
    {
        $fournisseur->delete();
        toast("La suppression du fournisseur effectuée","success");

        return back();
    }
}
