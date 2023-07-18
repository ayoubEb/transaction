<?php

namespace App\Http\Controllers;

use App\Models\CustomizeFacture;
use Illuminate\Http\Request;

class CustomizeFactureController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomizeFacture  $customizeFacture
     * @return \Illuminate\Http\Response
     */
    public function show(CustomizeFacture $customizeFacture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomizeFacture  $customizeFacture
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomizeFacture $customizeFacture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomizeFacture  $customizeFacture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomizeFacture $customize_facture)
    {
        $customize_facture->update([
            "reference"=>$request->reference_facture,
            "numero"=>$request->numero_facture,
            "tva"=>$request->tva,
        ]);
        toast("La notification du facture effectuée","success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomizeFacture  $customizeFacture
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomizeFacture $customizeFacture)
    {
        //
    }
}
