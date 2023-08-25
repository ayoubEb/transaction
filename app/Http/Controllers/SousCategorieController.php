<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\SousCategorie;
use Illuminate\Http\Request;

class SousCategorieController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:sousCategorie-list|sousCategorie-create|sousCategorie-edit|sousCategorie-delete', ['only' => ['index']]);
         $this->middleware('permission:sousCategorie-create', ['only' => ['create','store']]);
         $this->middleware('permission:sousCategorie-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sousCategorie-destroy', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

            SousCategorie::create([
                "categorie_id"=>$request->categorie,
                "nom"=>$request->sous,
            ]);


        toast("L'enregistrement du sous catégories effectuée","success");
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SousCategorie  $sousCategorie
     * @return \Illuminate\Http\Response
     */
    public function show(SousCategorie $sousCategorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SousCategorie  $sousCategorie
     * @return \Illuminate\Http\Response
     */
    public function edit(SousCategorie $sousCategorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SousCategorie  $sousCategorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SousCategorie $sousCategorie)
    {
        $sousCategorie->update([
            "nom"=>$request->sous_u,
        ]);
        toast("La motification du sous-catégorie effectuée","success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SousCategorie  $sousCategorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(SousCategorie $sousCategorie,Request $request)
    {

        if(isset($request->force)){
            $sousCategorie->forceDelete();
            toast("La suppression du sous-catégorie effectuée","success");
        }
        else{
            toast("La déplacement du corbeille du sous-catégorie effectuée","success");
            $sousCategorie->delete();

        }
        return back();
    }
}
