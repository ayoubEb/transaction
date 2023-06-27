<?php

namespace App\Http\Controllers;
use App\Models\FactureProduit;
use App\Models\Facture;

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
      $facture = Facture::find($id);
      return view('facture_produit.index',['facture'=>$facture]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $facture=Facture::find($id);
      return view('facture_produit.create',['facture'=>$facture]);
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


    public function store(Request $request,FactureProduit $factureProduit)
    {
        $prix_ht = 0;

        foreach ($request->reference as $k => $value) {
            if($request->remise[$k]==0){
              $montant = $request->prix_unitaire[$k] * $request->quantite[$k];
            }
            else{

                $montant = ($request->prix_unitaire[$k] * $request->quantite[$k]) -  $request->quantite[$k] * $request->prix_unitaire[$k] * ($request->remise[$k]/100);
            }
            FactureProduit::create([
                "facture_id"=>$request->facture_id,
                "reference" => $request->reference[$k],
                "designation" => $request->designation[$k],
                "quantite" => $request->quantite[$k],
                "prix_unitaire" => $request->prix_unitaire[$k],
                "remise" => $request->remise[$k],
                "montant" => $montant,
            ]);

            $prix_ht += $request->prix_unitaire[$k] * $request->quantite[$k];
        }

    $facture = Facture::where('id',$request->facture_id)->first();
    $facture->prix_ht = $prix_ht;


      Session()->flash('success','Les produits qui est ajouter effectuée');
      return redirect()->back();
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
        $factureProduit->update([
            "reference"=>$request->reference,
            "designation"=>$request->designation,
            "quantite"=>$request->quantite,
            "prix_unitaire"=>$request->prix_unitaire,
            "montant"=>$request->prix_unitaire * $request->quantite,
        ]);
        $facture = Facture::where("id",$factureProduit->facture_id)->first();
        $sum_produit = FactureProduit::where('facture_id',$facture->id)->sum("montant");
        $tva = $factureProduit->facture->taux_tva;
        $facture->prix_ht = $sum_produit;
        $facture->prix_ttc = ($sum_produit) * (1 - ( $tva /100 ));
        $facture->save();
        Session()->flash("update-produit","La notification du produit effectuée");
        return back();
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
        $facture = Facture::where("id",$factureProduit->facture_id)->first();
        $sum_produit = FactureProduit::where('facture_id',$facture->id)->sum("montant");
        $tva = $factureProduit->facture->taux_tva;
        $facture->prix_ht = $sum_produit;
        $facture->prix_ttc = ($sum_produit) * (1 - ( $tva /100 ));
        $facture->save();
        Session()->flash('delete','La suppression du group effectuté');
        return redirect()->back();

    }

}
