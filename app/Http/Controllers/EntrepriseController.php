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
        return  view('entreprises',
      [
        'entreprises'=>Entreprise::all()
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
          "raison_social"=>["regex:/^([a-z]|[A-Z])+$/","required"],
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

        if($request->hasFile('img'))
        {
          $file = $request->file('img');
          $extention = $file->getClientOriginalExtension();
          $filename = time().".".$extention;
          $file->move('images/entreprise/',$filename);
        }

        Entreprise::create([
            "logo"=>$filename ?? "",
            "raison_social"=>$request->raison_social,
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
        ]);
        Session()->flash('success','L\'enregistrement d\'entreprise effectuée');
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
            "raison_social_u"=>["regex:/^([a-z]|[A-Z])+$/","required"],
            "adresse_u"=>["required"],
            "ice_u"=>["regex:/^([0-9])+$/","required"],
            "if_u"=>["regex:/^([0-9])+$/","required"],
            "rc_u"=>["regex:/^([0-9])+$/","required"],
            "patente_u"=>["regex:/^([0-9])+$/","required"],
            "cnss_u"=>["regex:/^([0-9])+$/","required"],
            "site_u"=>["required"],
            "telephone_u"=>["required"],

            "ville_u"=>["regex:/^([a-z]|[A-Z])+$/","required"],
            "code_postal_u"=>["regex:/^([0-9])+$/","required"],
            "email_u"=>["required"],
          ]);

          if($request->hasFile('img_u'))
          {
              $file = $request->file('img_u');
              if($entreprise->logo != null ){
                unlink(public_path("images/entreprise/". $entreprise->logo));

              }
                $extention = $file->getClientOriginalExtension();
                $filename_u = time().".".$extention;
                $file->move('images/entreprise/',$filename_u);


                $entreprise->logo = $filename_u;
          }
          $entreprise->update([
            "raison_social"=>$request->raison_social_u,

            "rc"=>$request->rc_u,
            "ice"=>$request->ice_u,
            "if"=>$request->if_u,
            "adresse"=>$request->adresse_u,
            "ville"=>$request->ville_u,
            "email"=>$request->email_u,
            "site"=>$request->site_u,
            "cnss"=>$request->cnss_u,
            "code_postal"=>$request->code_postal_u,
            "telephone"=>$request->telephone_u,
            "fix"=>$request->fix_u,
            "patente"=>$request->patente_u,
          ]);

      Session()->flash('update','La notification d\'entreprise effectuée');
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entreprise $entreprise)
    {
      $entreprise->delete();
      Session()->flash('delete','La suppression d\'entreprise effectuée');
      return redirect()->back();
    }
}
