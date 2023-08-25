<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\SousCategorie;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CategorieController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:categorie-list|categorie-create|categorie-edit|categorie-delete', ['only' => ['index','show']]);
         $this->middleware('permission:categorie-create', ['only' => ['create','store']]);
         $this->middleware('permission:categorie-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:categorie-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::select('id','nom','description')->get();
        // $sous_categories = SousCategorie::select('id','nom','categorie_id')->get();
        // $categories_corbeille = Categorie::onlyTrashed()->select('id','nom')->get();
        // $cat = Categorie::all();
        // dd($cat);
        // dd($categories_corbeille);
        return view('catalogue.categories',
            [
                'categories'=>$categories,
                // 'categories_corbeille'=>$categories_corbeille,
                // 'sous_categories'=>$sous_categories
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


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
            "nom"=>["required"],

        ]);
        $cat_existe = Categorie::where("nom",$request->nom)->exists();
        if($cat_existe == false){
            Categorie::create([
                "nom"=>$request->nom,
                "description"=>$request->description,
            ]);
            toast("L'enregistrement du catégorie effectuée","success");
        }
        else{
            toast("S'il voûs plaît la catégorie déja existe","warning");

        }



        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            "nom_u"=>["required"],
        ]);
        $categorie->update([
        "nom"=>$request->nom_u,
        "description"=>$request->description_u,
        ]);
        toast("La motification du catégories effectuée","success");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        toast("La déplacement du corbeille du catégorie effectuée","success");
        return back();
    }
    // public function destroyDefinitivement($id)
    // {
    //     $categorie = Categorie::withTrashed()->find($id);


    //     if($categorie->trashed())
    //     {
    //         $categorie->forceDelete();
    //     }

    //     toast("La suppression définitivement du catégorie effectuée","success");
    //     return back();

    // }

    // public function restore($id){
    //     $categorie = Categorie::withTrashed()->find($id);


    //     if($categorie->trashed())
    //     {
    //         $categorie->restore();
    //     }

    //     toast("La catégorie a été restaurée avec succès","success");
    //     return back();
    // }

}