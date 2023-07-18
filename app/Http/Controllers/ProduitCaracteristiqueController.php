<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\ProduitCaracteristique;
use Illuminate\Http\Request;

class ProduitCaracteristiqueController extends Controller
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

        ProduitCaracteristique::create([
            "produit_id"=>$request->produit,
            "caracteristique_id"=>$request->caracteristique,
            "valeur"=>$request->valeur,
            "prix"=>$request->prix,
            "quantite"=>$request->quantite,
        ]);
        $quantite = ProduitCaracteristique::where("produit_id",$request->produit)->sum("quantite");
        Produit::where("id",$request->produit)->update([
            "quantite"=>$quantite,
        ]);
        toast("L'enregistrement du caractéristique effectuée","success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProduitCaracteristique  $produitCaracteristique
     * @return \Illuminate\Http\Response
     */
    public function show(ProduitCaracteristique $produitCaracteristique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProduitCaracteristique  $produitCaracteristique
     * @return \Illuminate\Http\Response
     */
    public function edit(ProduitCaracteristique $produitCaracteristique)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProduitCaracteristique  $produitCaracteristique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProduitCaracteristique $produitCaracteristique)
    {

        $quantite = ProduitCaracteristique::where("produit_id",$request->produit)->sum("quantite");
        $produitCaracteristique->update([
            "caracteristique_id"=>$request->caracteristique_u,
            "valeur"=>$request->valeur_u,
            "prix"=>$request->prix_u,
            "quantite"=>$request->quantite_u,
        ]);
        $produitCaracteristique->produit()->update([
            "quantite"=>$quantite,
        ]);
        toast("La notification du caractéristique effectuée","success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProduitCaracteristique  $produitCaracteristique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,ProduitCaracteristique $produitCaracteristique)
    {

        if(isset($request->force)){
            $produitCaracteristique->forceDelete();
            toast("La suppression du caractéristique effectuée","success");
        }
        else{
            $produitCaracteristique->delete();
            toast("La déplacement du corbeille du caractéristique effectuée","success");

        }
        return back();

        // $produit_caracteristique->delete();
        // $quantite = ProduitCaracteristique::where("produit_id",$request->produit)->sum("quantite");
        // $produit_caracteristique->produit()->update([
        //     "quantite"=>$quantite,
        // ]);
        // toast("La suppression du caractéristique du produit effectuée","success");
    }
}
