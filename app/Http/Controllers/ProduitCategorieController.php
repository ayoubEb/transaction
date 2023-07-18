<?php

namespace App\Http\Controllers;

use App\Models\ProduitCategorie;
use Illuminate\Http\Request;

class ProduitCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $array = [];
        foreach ($request->categorie as $key => $value) {
            // $cat_actuel = ProduitCategorie::where("categorie_id",$request->categorie[$key])->exists();
                if(!ProduitCategorie::where("categorie_id",$request->categorie[$key])->exists()){
                    ProduitCategorie::create([
                        "produit_id"=>$request->produit,
                        "categorie_id"=>$request->categorie[$key],

                    ]);
                }

            $array[]= $request->categorie[$key];
        }

        if(ProduitCategorie::where("categorie_id",$array)->exists()){
            toast("S'il voûs plaît les catégorie sélectionner déja existe","warning");
        }
        else{
            toast("L'enregistrement du catégoruie de produit effectuée","success");
        }
        return back();
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProduitCategorie  $produitCategorie
     * @return \Illuminate\Http\Response
     */
    public function show(ProduitCategorie $produitCategorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProduitCategorie  $produitCategorie
     * @return \Illuminate\Http\Response
     */
    public function edit(ProduitCategorie $produitCategorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProduitCategorie  $produitCategorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProduitCategorie $produitCategorie)
    {
        if(!ProduitCategorie::where("categorie_id",$request->categorie_u)->exists()){
            $produitCategorie->update([
                "categorie_id"=>$request->categorie_u,
            ]);
            toast("La notification du catégorie effectuée","success");
        }
        else{

            toast("Le nom du catégorie déja existe","warning");
        }

        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProduitCategorie  $produitCategorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProduitCategorie $produitCategorie,Request $request)
    {
        if(isset($request->force)){
            $produitCategorie->forceDelete();
            toast("La suppression du catégorie effectuée","success");
        }
        else{
            $produitCategorie->delete();
            toast("La déplacement du corbeille du catégorie effectuée","success");

        }

        return back();
    }
}
