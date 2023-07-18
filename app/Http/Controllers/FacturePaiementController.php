<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\FacturePaiement;
use App\Models\FacturePaiementCheque;
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
        $facture = Facture::where("id",$request->facture_id)->first();
        $facture_paiement = FacturePaiement::create([
            "facture_id"=>$facture->id,
            "client_id"=>$facture->client->id,
            "payer"=>$request->payer,
            "reste"=>$request->reste,
            "type_paiement"=>$request->type,
            "date_paiement"=>Carbon::now(),
        ]);
        if($request->type == "cheque"){
            FacturePaiementCheque::create([
                "facture_paiement_id"=>$facture_paiement->id,
                "numero"=>$request->numero,
                "bank_id"=>$request->nom_bank,
                "date_enquisement"=>$request->date_enquisement,
            ]);
        }

        $sum_payer = FacturePaiement::where("facture_id",$facture->id)->sum("payer");

        $facture->update([
            "payer"=>$sum_payer,
            "reste"=>$request->reste,
        ]);
        toast("L'enregistrement du paiement effectuée","success");
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
    public function destroy(FacturePaiement $facture_paiement)
    {
        $facture = Facture::where("id",$facture_paiement->facture->id)->first();

        $facture->update([
            "reste"=>$facture->reste + $facture_paiement->payer,
            "payer"=>$facture->payer - $facture_paiement->payer,
        ]);
        $facture_paiement->delete();
        toast("La suppression du paiement effectuée","success");
        return back();
    }







}
