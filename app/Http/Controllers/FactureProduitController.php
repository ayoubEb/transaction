<?php

namespace App\Http\Controllers;
use App\Models\FactureProduit;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\StockHistorique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FactureProduitController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //   // $facture_id=Facture::find($id);
    //   $facture_id=$request->facture_id;
    //   foreach($request->reference as $k =>  $ref){
    //     $fp = new FactureProduit();
    //     $fp->reference = $request->reference[$k];
    //     $fp->designation = $request->designation[$k];
    //     $fp->quantite = $request->quantite[$k];
    //     $fp->prix_unitaire = $request->prix_unitaire[$k];
    //     $fp->remise = $request->remise[$k];
    //     $fp->facture_id = $facture_id;
    //     $fp->save();

    //   }
    //   return redirect()->route('facture-pro.index',['id',$id]);
    // }


    public function store(Request $request)
    {

        // $array_produit = Produit::whereIn("reference",$request->reference)->get();
        // $total = 0;
        $facture = Facture::where("id",$request->facture_id)->first();

        foreach($request->pro as $row => $val){

            FactureProduit::create([
                "facture_id"=>$request->facture_id,
                "produit_id"=>$val,
                "quantite"=>$request->quantite[$row],
                "remise"=>$request->remise[$row],
                "montant"=>$request->montant[$row],
            ]);
            $stock = Produit::join("stocks","produits.id","=","stocks.produit_id")
            ->select('stocks.produit_id',"stocks.entre","stocks.sortie","stocks.reste")
            ->where("stocks.produit_id",$request->pro[$row])
            ->first();
            if(isset($stock)){
                Produit::join("stocks","produits.id","=","stocks.produit_id")
                ->select('stocks.produit_id',"stocks.reste","stocks.sortie","produits.quantite")
                ->where("stocks.produit_id",$request->pro[$row])
                ->update([
                    "sortie"=>$request->quantite[$row] + $stock->sortie,
                    "reste"=>$stock->entre - ($request->quantite[$row] + $stock->sortie),
                    "quantite"=>$stock->entre - ($request->quantite[$row] + $stock->sortie),
                ]);
            }

        }
        // let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);

        $ht = $request->ht_new + $facture->prix_ht;
        $ttc = ($ht + ($ht * ($facture->taux_tva/100))) * (1 - ($facture->remise / 100));
        Facture::where("id",$request->facture_id)->update([
            "prix_ttc"=>$ttc,
            "prix_ht"=>$ht,
            "reste"=>$ttc,
        ]);

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FactureProduit  $factureProduit
     * @return \Illuminate\Http\Response
     */
    public function show(FactureProduit $factureProduit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FactureProduit  $factureProduit
     * @return \Illuminate\Http\Response
     */
    public function edit(FactureProduit $factureProduit)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FactureProduit  $factureProduit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FactureProduit $factureProduit)
    {

        $facture = Facture::where("id",$factureProduit->facture->id)->first();
        $sum_montant = FactureProduit::where("facture_id",$facture->id)->sum("montant");
        // calculer produit
            $montant_remise = ($request->quantite_u * $request->pv) * ( 1 - ($request->remise_u/100));
            $montant = $request->quantite_u * $request->pv;

        // calculer ttc


        $ttc = ($sum_montant + ($sum_montant * ($facture->taux_tva / 100))) * (1 - ($facture->remise / 100));


        $factureProduit->update([
            "produit_id"=>$request->produit_u,
            "quantite"=>$request->quantite_u,
            "remise"=>$request->remise_u,
            "montant"=> $request->remise_u <= 0 ? $montant : $montant_remise,
        ]);





        $facture->update([
            "prix_ht"=>$sum_montant,
            "prix_ttc"=>$ttc,
            "reste"=>$ttc,
        ]);


        toast("La motification du produit effectuée","success");
        return back();







        // $factureProduit->update([
        //     "reference"=>$request->reference,
        //     "designation"=>$request->designation,
        //     "quantite"=>$request->quantite,
        //     "prix_unitaire"=>$request->prix_unitaire,
        //     "montant"=>$request->prix_unitaire * $request->quantite,
        // ]);
        // $facture = Facture::where("id",$factureProduit->facture_id)->first();
        // $sum_produit = FactureProduit::where('facture_id',$facture->id)->sum("montant");
        // $tva = $factureProduit->facture->taux_tva;
        // $facture->prix_ht = $sum_produit;
        // $facture->prix_ttc = ($sum_produit) * (1 - ( $tva /100 ));
        // $facture->save();
        // Session()->flash("update-produit","La notification du produit effectuée");
        // return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FactureProduit  $factureProduit
     * @return \Illuminate\Http\Response
     */
    public function destroy(FactureProduit $factureProduit)
    {

        $factureProduit->delete();

        $facture = Facture::where("id",$factureProduit->facture->id)->first();
        $sum_montant = FactureProduit::where("facture_id",$facture->id)->sum("montant");
        $ttc = ($sum_montant + ($sum_montant * ($facture->taux_tva / 100))) * (1 - ($facture->remise / 100));
        $facture->update([
            "prix_ht"=>$sum_montant,
            "prix_ttc"=>$ttc,
            "reste"=>$ttc,
            "payer"=>0
        ]);


        // StockHistorique::where("stock_id",$st_pro->id)->delete();



        Session()->flash('delete','La suppression du group effectuté');
        return redirect()->back();

    }

}
