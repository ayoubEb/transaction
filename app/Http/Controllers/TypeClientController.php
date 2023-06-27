<?php

namespace App\Http\Controllers;

use App\Models\TypeClient;
use Illuminate\Http\Request;

class TypeClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_clients = TypeClient::all();
        return view("type-clients",compact("type_clients"));
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
        $request->validate([
            "nom"=>["required","not_regex:/^([a-z]+[0-9]+)|([A-Z]+[0-9]+)|([0-9]+)|([0-9]+[a-z]+)|([0-9]+[A-Z]+)$/"],
        ]);
         TypeClient::create([
            "nom"=>$request->nom,
        ]);
        return back()->with("success","L'enregistrement du type client effectuée");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function show(TypeClient $typeClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeClient $typeClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeClient $type_client)
    {
        $request->validate([
            "nom_u"=>["required","not_regex:/^([a-z]+[0-9]+)|([A-Z]+[0-9]+)|([0-9]+)|([0-9]+[a-z]+)|([0-9]+[A-Z]+)$/"],
        ]);
         $type_client->update([
            "nom"=>$request->nom_u,
        ]);
        return back()->with("update","La notification du type effectuée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeClient $type_client)
    {
        $type_client->delete();
        return back()->with("update","La suppression du type effectuée");
    }
}
