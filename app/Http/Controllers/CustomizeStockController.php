<?php

namespace App\Http\Controllers;

use App\Models\CustomizeStock;
use Illuminate\Http\Request;

class CustomizeStockController extends Controller
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
     * @param  \App\Models\CustomizeStock  $customizeStock
     * @return \Illuminate\Http\Response
     */
    public function show(CustomizeStock $customizeStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomizeStock  $customizeStock
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomizeStock $customizeStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomizeStock  $customizeStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomizeStock $customize_stock)
    {
        $customize_stock->update([
            "reference"=>$request->reference_stock,
            "numero"=>$request->numero_stock,
        ]);
        toast("La notification du stock effectuée","success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomizeStock  $customizeStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomizeStock $customizeStock)
    {
        //
    }
}
