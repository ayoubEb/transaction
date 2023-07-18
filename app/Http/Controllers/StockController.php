<?php

namespace App\Http\Controllers;

use App\Models\CustomizeStock;
use App\Models\Produit;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::groupBy("produit_id")->get();
        $produits = Produit::select("id","reference","code","designation","prix_achat")->paginate(10);
        $produits_reference = Produit::select("reference")->get();
        return view("catalogue.stock",[
            "produits"=>$produits,
            "references"=>$produits_reference,
        ]);
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

        $customize_stock = CustomizeStock::select("reference","numero")->first();
        $count_stock = Stock::count();
        $reference = $count_stock + $customize_stock->numero;
        $stock = Stock::create([
            "num"=>$customize_stock->reference.$reference,
            "produit_id"=>$request->produit,
            "entre"=>$request->entre,
            "sortie"=>0,
            "reste"=>$request->entre,
            "initial"=>$request->entre,
            "montant"=>$request->entre * $request->prix_achat,
            "date_stock"=>Carbon::now(),
            "min"=>$request->min ?? 1,
            "reserverAttente"=>0,
            "reserverValider"=>0,
        ]);
        $stock->history()->create([
            "stock_id"=>$stock->id,
            "fonction"=>"qte_entre",
            "quantite"=>$request->entre,
            "date_mouvement"=>Carbon::today(),
        ]);
        $produit = Produit::where("id",$stock->produit_id )->first();
        $produit->update([
            "quantite"=>$produit->quantite + $request->entre,
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $produit_actuel = Produit::where("id",$stock->produit_id)->first()->id;
        $produit_nouveau = Produit::where("id",$request->produit_u)->first()->id;
        if($produit_actuel == $produit_nouveau) {
            Produit::where("id",$stock->produit_id)->update([
                "quantite"=>$request->entre_u,
            ]);
        }
        else{
            Produit::where("id",$request->produit_u)->update([
                "quantite"=>$request->entre_u,
            ]);
            Produit::where("id",$stock->produit_id)->update([
                "quantite"=>$stock->produit->quantite - $request->entre_u,
            ]);
        }
        $stock->update([
            "produit_id"=>$request->produit_u,
        ]);
        toast("La notification du stock effectuée","success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock,Request $request)
    {
        if(isset($request->force)){
            $stock->forceDelete();
            $stock->history()->forceDelete();
            toast("La déplacement du corbeille du stock effectuée","success");
            Produit::where("id",$stock->produit_id)->update([
                "quantite"=>$stock->produit->quantite - $stock->entre,
            ]);

        }
        else{

            $stock->delete();
            $stock->history()->delete();
            Produit::where("id",$stock->produit_id)->update([
                "quantite"=>$stock->produit->quantite - $stock->entre,
            ]);
        }
        toast("La suppression du stock effectuée","success");

        return back();
    }
}
