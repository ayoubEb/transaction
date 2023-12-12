<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Http\Controllers\Controller;
use App\Models\LigneAchat;
use App\Models\Produit;
use Illuminate\Http\Request;

class AchatController extends Controller
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
        foreach($request->pro_add as $row => $val){

            Achat::create([
                "ligne_achat_id"=>$request->ligne_id,
                "produit_id"=>$val,
                "quantite"=>$request->quantite[$row],
                "remise"=>$request->remise[$row],
                "montant"=>$request->montant[$row],
            ]);


            $stock = Produit::join("stocks","produits.id","=","stocks.produit_id")
            ->select('stocks.produit_id',"stocks.entre","stocks.sortie","stocks.reste","stocks.id","stocks.date_stock")
            ->where("stocks.produit_id",$val)
            ->first();
            if(isset($stock)){
                Produit::join("stocks","produits.id","=","stocks.produit_id")
                ->select('stocks.produit_id',"stocks.reste","stocks.sortie","produits.quantite","stocks.reserverAttente")
                ->where("stocks.produit_id",$val)
                ->update([
                    "reserverAttente"=>$request->quantite[$row],
                ]);

            }





        }
        toast("L'enregisrtrement des produits effectuée","success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function show(Achat $achat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function edit(Achat $achat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Achat $achat)
    {

        $ligne = LigneAchat::where("id",$achat->ligne_achat_id)->first();
        $sum_montant = Achat::where("ligne_achat_id",$ligne->id)->sum("montant");
        // calculer produit
            $montant_remise = ($request->quantite_u * $request->ph) * ( 1 - ($request->remise_u/100));
            $montant = $request->quantite_u * $request->ph;

        // calculer ttc


        $ttc = ($sum_montant + ($sum_montant * ($ligne->taux_tva / 100)));


        $achat->update([
            "produit_id"=>$request->pro_id,
            "quantite"=>$request->quantite_u,
            "remise"=>$request->remise_u,
            "montant"=> $request->remise_u <= 0 ? $montant : $montant_remise,
        ]);





        $ligne->update([
            "prix_ht"=>$sum_montant,
            "prix_ttc"=>$ttc,
            "reste"=>$ttc,
        ]);


        toast("La motification du produit effectuée","success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Achat  $achat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Achat $achat)
    {
        $achat->delete();

        $ligne = LigneAchat::where("id",$achat->ligne_achat_id)->first();
        $sum_montant = Achat::where("ligne_achat_id",$achat->ligne_achat_id)->sum("montant");
        $ttc = $sum_montant + ($sum_montant * ($ligne->taux_tva / 100));
        $ligne->update([
            "prix_ht"=>$sum_montant,
            "prix_ttc"=>$ttc,
            "reste"=>$ttc,
            "payer"=>0
        ]);
    }
}
