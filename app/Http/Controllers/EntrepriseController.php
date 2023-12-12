<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreprise = Entreprise::first();
        $entreprise_existe  = Entreprise::exists();
        return  view('parametre.entreprises',
      [
        'entreprise'=>$entreprise,
        "entreprise_existe"=>$entreprise_existe,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entreprise.create');
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
          "adresse"=>["required"],
          "ice"=>["regex:/^([0-9])+$/","required"],
          "if"=>["regex:/^([0-9])+$/","required"],
          "rc"=>["regex:/^([0-9])+$/","required"],
          "patente"=>["regex:/^([0-9])+$/","required"],
          "cnss"=>["regex:/^([0-9])+$/","required"],
          "site"=>["required"],
          "telephone"=>["required"],
          "ville"=>["regex:/^([a-z]|[A-Z])+$/","required"],
          "code_postal"=>["regex:/^([0-9])+$/","required"],
          "email"=>["required"],
        //   "fix"=>["nullable"]
        ]);



        Entreprise::create([
            "logo"=>$filename ?? "logo.jpg",
            "raison_sociale"=>$request->raison_sociale,
            "rc"=>$request->rc,
            "ice"=>$request->ice,
            "if"=>$request->if,
            "adresse"=>$request->adresse,
            "ville"=>$request->ville,
            "email"=>$request->email,
            "site"=>$request->site,
            "cnss"=>$request->cnss,
            "code_postal"=>$request->code_postal,
            "telephone"=>$request->telephone,
            "patente"=>$request->patente,
            "fix"=>$request->fix,
        ]);
        toast("L'enregistrement d'entreprise effectuée","success");
        return redirect()->route('entreprise.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show_entreprise = Entreprise::find($id);
        return view('entreprise.show',['show_entreprise'=>$show_entreprise]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_entreprise = Entreprise::find($id);
        return view('entreprise.edit',
          [
            "edit_entreprise"=>$edit_entreprise
          ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Entreprise $entreprise)
    {
        $request->validate([
            "raison_sociale"=>["required"],
            "adresse"=>["required"],
            "ice"=>["regex:/^([0-9])+$/","required"],
            "if"=>["regex:/^([0-9])+$/","required"],
            "rc"=>["regex:/^([0-9])+$/","required"],
            "patente"=>["regex:/^([0-9])+$/","required"],
            "cnss"=>["regex:/^([0-9])+$/","required"],
            "site"=>["required"],
            "telephone"=>["required"],
            "ville"=>["regex:/^([a-z]|[A-Z])+$/","required"],
            "code_postal"=>["regex:/^([0-9])+$/","required"],
            "email"=>["required"],
        ]);


        $entreprise->update([
            "raison_sociale"=>$request->raison_sociale,
            "rc"=>$request->rc,
            "ice"=>$request->ice,
            "if"=>$request->if,
            "adresse"=>$request->adresse,
            "ville"=>$request->ville,
            "email"=>$request->email,
            "site"=>$request->site,
            "cnss"=>$request->cnss,
            "code_postal"=>$request->code_postal,
            "telephone"=>$request->telephone,
            "fix"=>$request->fix,
            "patente"=>$request->patente,
        ]);
        toast("La motification d'ntreprise effectuée","success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entreprise $entreprise,Request $request)
    {

    }
}
