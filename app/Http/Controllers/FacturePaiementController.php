<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\FacturePaiement;
use App\Models\FactureReglement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FacturePaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

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
        $facture = Facture::where('id',$request->facture_id)->first();
        $ht = $facture->payer + $request->payer;
        FacturePaiement::create([
            "facture_id"=>$request->facture_id,
            "type_paiement"=>$request->type,
            "payer"=>$request->payer,
            "reste"=>$request->reste,
            "date_paiement"=>Carbon::today(),

        ]);
        $facture->update([
            "payer"=>$facture->payer + $request->payer,
            "reste"=>$facture->reste - $ht,
        ]);
        toast("l'enregistrement du facture paiement effectuée","success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacturePaiement  $facturePaiement
     * @return \Illuminate\Http\Response
     */
    public function show(FacturePaiement $facturePaiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacturePaiement  $facturePaiement
     * @return \Illuminate\Http\Response
     */
    public function edit(FacturePaiement $facturePaiement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacturePaiement  $facturePaiement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacturePaiement $facture_paiement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacturePaiement  $facturePaiement
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacturePaiement $facturePaiement)
    {
        //
    }


    public function facture_paiement(Request $request)
    {
        $facture_paiements = FacturePaiement::all();
        $paiement = $request->facture_paiement;
        $min_reste = FactureReglement::where("facture_paiement_id",$paiement)->min("montant_reste");
        return view("apps.paiements.facture",["facture_paiements"=>$facture_paiements,"min_reste"=>$min_reste]);
    }
    public function client_paiement()
    {

        $client_paiments =Client::join("factures","clients.id","=","factures.client_id")
        ->join("facture_paiements","factures.id","=","facture_paiements.facture_id")
        ->select("clients.ice","clients.raison_sociale","clients.id as cli","clients.email","factures.*","facture_paiements.*")
        ->groupBy("factures.client_id")
        // ->selectRaw("SUM(factures.prix_ttc) as sum_ttc")
        ->selectRaw("SUM(factures.prix_ht) as sum_ht")
        ->selectRaw("SUM(factures.prix_ttc) as sum_ttc")
        ->selectRaw("SUM(facture_paiements.payer) as sum_payer")
        ->selectRaw("SUM(facture_paiements.reste) as sum_reste")
        ->get();

        return view("apps.paiements.client",["client_paiements"=>$client_paiments]);
    }
    public function cp_details($client)
    {
        $cli = Client::where("id",$client)->first();
        return view("apps.paiements.client-info",["client"=>$cli]);
    }



}
