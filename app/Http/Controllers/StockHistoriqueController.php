<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Stock;
use App\Models\StockHistorique;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockHistoriqueController extends Controller
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
        $stock = Stock::where("id",$request->stock_id)->first();
        $stock_his = StockHistorique::create([
            "stock_id"=>$request->stock_id,
            "fonction"=>$request->fonction,
            "quantite"=>$request->quantite,
            "date_mouvement"=>Carbon::today(),
        ]);

        if($request->fonction == "augmentation")
        {
            $stock_his->stock()->update([
                
                "entre"=>$stock->entre + $request->quantite,
                "reste"=>($stock->entre + $request->quantite) - $stock->sortie,
            ]);

            $pro =  $stock->produit->id;
            Produit::where("id",$pro)->update([
                "quantite"=>$stock->entre + $request->quantite,
            ]);
        }
        else
        {
            $stock_his->stock()->update([
                "entre"=>$stock->entre - $request->quantite,
                "reste"=>($stock->entre - $request->quantite) - $stock->sortie,
            ]);
            $pro =  $stock->produit->id;
            Produit::where("id",$pro)->update([
                "quantite"=>$stock->entre - $request->quantite,
            ]);

        }

        toast("L'augmentation du stock effectuée","success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockHistorique  $stockHistorique
     * @return \Illuminate\Http\Response
     */
    public function show(StockHistorique $stockHistorique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockHistorique  $stockHistorique
     * @return \Illuminate\Http\Response
     */
    public function edit(StockHistorique $stockHistorique)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StockHistorique  $stockHistorique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockHistorique $stockHistorique)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockHistorique  $stockHistorique
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockHistorique $stockHistorique , Request $request)
    {
        $pro = $stockHistorique->stock->produit->id;
        $stockHistorique->delete();
        $stock = Stock::where("id",$request->stock_id)->first();
        if($stockHistorique->fonction == "augmentation"){
            $stockHistorique->stock()->update([
                "entre"=>$stock->entre - $request->quantite_n,
                "reste"=>$stock->reste - $request->quantite_n
            ]);
            Produit::where("id",$pro)->update([
                "quantite"=>$stock->entre - $request->quantite_n,
            ]);
        }
        else{
            $stockHistorique->stock()->update([
                "entre"=>$stock->entre + $request->quantite_n,
                "reste"=>$stock->reste + $request->quantite_n
            ]);
            Produit::where("id",$pro)->update([
                "quantite"=>$stock->entre + $request->quantite_n,
            ]);

        }
        toast("La suppression du mouvement effectuée","success");
        return back();
    }
}
