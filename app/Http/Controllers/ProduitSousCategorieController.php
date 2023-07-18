<?php

namespace App\Http\Controllers;

use App\Models\ProduitSousCategorie;
use Illuminate\Http\Request;

class ProduitSousCategorieController extends Controller
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
        foreach ($request->sous as $key => $value) {
            ProduitSousCategorie::create([
                "produit_id"=>$request->produit_id,
                "sous_categorie_id"=>$value,
            ]);

        }
        toast("L'enregistrement des sous-catégorie du produit effectuée","success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProduitSousCategorie  $produitSousCategorie
     * @return \Illuminate\Http\Response
     */
    public function show(ProduitSousCategorie $produitSousCategorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProduitSousCategorie  $produitSousCategorie
     * @return \Illuminate\Http\Response
     */
    public function edit(ProduitSousCategorie $produitSousCategorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProduitSousCategorie  $produitSousCategorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProduitSousCategorie $produit_sous_categorie)
    {
        if(!ProduitSousCategorie::where("sous_categorie_id",$request->sous_u)->exists()){
            $produit_sous_categorie->update([
                "categorie_id"=>$request->sous_u,
            ]);
            toast("La notification du sous-catégorie effectuée","success");
        }
        else{

            toast("Le nom du sous-catégorie déja existe","warning");
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProduitSousCategorie  $produitSousCategorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProduitSousCategorie $produitSousCategorie,Request $request)
    {
        if(isset($request->force)){
            $produitSousCategorie->forceDelete();
            toast("La suppression du caractéristique effectuée","success");
        }
        else{
            $produitSousCategorie->delete();
            toast("La déplacement du corbeille du caractéristique effectuée","success");

        }
        return back();
    }
}
