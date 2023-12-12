<?php

namespace App\Http\Controllers;

use App\Models\AchatPaiement;
use App\Http\Controllers\Controller;
use App\Models\AchatCheque;
use App\Models\LigneAchat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AchatPaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $achatPaiements = AchatPaiement::select("id","ligne_achat_id","fournisseur_id","type_paiement","payer","reste","date_paiement")->get();
        $paiementCheques = AchatPaiement::where("type_paiement","chèque")->get();
        return view("paiements.achat",["achatPaiements"=>$achatPaiements,"paiementCheques"=>$paiementCheques]);
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
        $ligne = LigneAchat::where("id",$request->ligne_achat_id)->first();

        $achat_paiement = AchatPaiement::create([
            "ligne_achat_id"=>$ligne->id,
            "fournisseur_id"=>$request->fournisseur_id,
            "payer"=>$request->payer,
            "reste"=>$request->reste,
            "type_paiement"=>$request->type,
            "date_paiement"=>Carbon::now(),
        ]);
        if($request->type == "chèque"){
                AchatCheque::create([
                "achat_paiement_id"=>$achat_paiement->id,
                "numero"=>$request->numero,
                "bank_id"=>$request->nom_bank,
                "date_cheque"=>$request->date_cheque,
                "date_enquisement"=>$request->date_enquisement,
            ]);
        }

        $sum_payer = AchatPaiement::where("ligne_achat_id",$ligne->id)->sum("payer");


        if($sum_payer == $ligne->payer){
            $ligne->update([
                "payer"=>$ligne->payer + $request->payer,
                "reste"=>$request->reste,
                "etat_paiement"=>"en complément",
            ]);
        }
        else{
            $ligne->update([
                "payer"=>$ligne->payer + $request->payer,
                "reste"=>$request->reste,
                "etat_paiement"=>"avance",
            ]);

        }
        toast("L'enregistrement du paiement effectuée","success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AchatPaiement  $achatPaiement
     * @return \Illuminate\Http\Response
     */
    public function show(AchatPaiement $achatPaiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AchatPaiement  $achatPaiement
     * @return \Illuminate\Http\Response
     */
    public function edit(AchatPaiement $achatPaiement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AchatPaiement  $achatPaiement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AchatPaiement $achatPaiement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AchatPaiement  $achatPaiement
     * @return \Illuminate\Http\Response
     */
    public function destroy(AchatPaiement $achatPaiement)
    {
        //
    }
}
