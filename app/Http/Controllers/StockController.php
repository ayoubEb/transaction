<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Stock;
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
        $produits = Produit::all();
        return view("apps.stock",compact("stocks","produits"));
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
        // dd($request->produit);
        $produit = Produit::where("id",$request->produit)->first();
        Stock::create([
            "produit_id"=>$request->produit,
            "type"=>$request->type,
            "entre"=>$request->quantite,
            "reste"=>$request->quantite,
            "date_mouvement"=>$request->date,
            "montant"=>$request->quantite * $produit->prix_achat,
            "date_stock"=>date("Y/m/d"),
        ]);
        $produit->update([
            "quantite"=>$produit->quantite + $request->quantite,
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
