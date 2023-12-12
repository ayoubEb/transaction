<?php

namespace App\Http\Controllers;

use App\Models\LigneAchat;
use App\Http\Controllers\Controller;
use App\Models\Achat;
use App\Models\Bank;
use App\Models\CustomizeAchat;
use App\Models\Entreprise;
use App\Models\Fournisseur;
use App\Models\Produit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
class LigneAchatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ligneAchats    = LigneAchat::withTrashed()
                        ->join("fournisseurs","fournisseurs.id","ligne_achats.fournisseur_id")
                        ->select('ligne_achats.*',"fournisseurs.raison_sociale","fournisseurs.deleted_at as cli_del" )
                        ->get();
        $banks          = Bank::select('id',"nom_bank")->get();
        $fournisseurs = Fournisseur::withTrashed()->get();
        return view("achats.ligne.index",[
            "ligneAchats"=>$ligneAchats,
            "banks"=>$banks,
            "fournisseurs"=>$fournisseurs
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $fournisseurs = Fournisseur::select("id","raison_sociale")->get();
        $produits = Produit::select("id","designation","prix_achat","reference")->get();
        $entreprises = Entreprise::get(["id","raison_sociale"]);
        $banks = Bank::select("id","nom_bank")->get();
        $tva = CustomizeAchat::select("tva")->first()->tva;
        return view("achats.ligne.create",[
            "fournisseurs"=>$fournisseurs,
            "produits"=>$produits,
            "entreprises"=>$entreprises,
            "banks"=>$banks,
            "tva"=>$tva,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customize_achat = CustomizeAchat::select("reference","numero","tva")->first();
        $count_achat = LigneAchat::withTrashed()->count();
        $reference = strval($count_achat + $customize_achat->numero);
        $ligne = LigneAchat::create([
            "fournisseur_id"=>$request->client_id,
            "num_achat"=>$customize_achat->reference.$reference,
            "statut"=>$request->statut,
            "date"=>$request->date ?? Carbon::today(),
            "prix_ht"=>$request->total,
            "taux_tva"=>$request->tva,
            "prix_ttc" => $request->ttc,
            "entreprise_id" => $request->entreprise_id,
            "payer"=>0,
            "reste"=>$request->ttc,
            "nombre_achats"=>count($request->pro),
            "etat_paiement"=>"en attente",
            "etat_livraison"=>"en attente",
        ]);
        foreach($request->pro as $k =>  $value){

            Achat::create([
                "ligne_achat_id"=>$ligne->id,
                "produit_id"=>$request->pro[$k] ,
                "quantite" => $request->quantite[$k],
                "remise" => $request->remise[$k],
                "montant" => $request->montant[$k],
            ]);



            $stock = Produit::join("stocks","produits.id","=","stocks.produit_id")
            ->select('stocks.produit_id',"stocks.entre","stocks.sortie","stocks.reste","stocks.id","stocks.date_stock")
            ->where("stocks.produit_id",$value)
            ->first();
            if(isset($stock)){
                Produit::join("stocks","produits.id","=","stocks.produit_id")
                ->select('stocks.produit_id',"stocks.reste","stocks.sortie","produits.quantite","stocks.reserverAttente")
                ->where("stocks.produit_id",$value)
                ->update([
                    "reserverAttente"=>$stock->reserverAttente +$request->quantite[$k],
                ]);

            }
        }
        toast("L'enregistrement du facture effectuée","success");
        return redirect()->route('ligneAchat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LigneAchat  $ligneAchat
     * @return \Illuminate\Http\Response
     */
    public function show(LigneAchat $ligneAchat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LigneAchat  $ligneAchat
     * @return \Illuminate\Http\Response
     */
    public function edit(LigneAchat $ligneAchat)
    {
        $produits = Produit::select("id","reference","designation","prix_achat")->get();
        $fournisseurs = Fournisseur::select("id","raison_sociale")->get();
        return view("achats.ligne.edit",[
            "ligneAchat"=>$ligneAchat,
            "fournisseurs"=>$fournisseurs,
            "produits"=>$produits
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LigneAchat  $ligneAchat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LigneAchat $ligneAchat)
    {
        $ligneAchat->update([
            "fournisseur_id"=>$request->fournisseur_id,
            "statut"=>$request->statut,
        ]);
        toast("La modification du facture effectuée","success");
        if($ligneAchat->statut == "valider")
        {
                return redirect()->route('facture.index');
        }
        else
        {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LigneAchat  $ligneAchat
     * @return \Illuminate\Http\Response
     */
    public function destroy(LigneAchat $ligneAchat)
    {
        //
    }


    public function valider(LigneAchat $ligneAchat) {
        $ligneAchat->update([
            "statut"=>"validé",
        ]);
        toast("La validation d'achat effectuée","success");
        return back();
    }

    public function bon(LigneAchat $ligneAchat){
        $pdf = PDF::loadview('achats.bon.pdf',compact('ligneAchat'));
        return $pdf->stream();
    }
    public function liste_bon(){
        $ligneAchats = LigneAchat::all();
        return view('achats.bon.liste',["ligneAchats"=>$ligneAchats]);
    }

}
