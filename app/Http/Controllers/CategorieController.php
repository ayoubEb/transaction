<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CategorieController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:categorie-list|categorie-create|categorie-edit|categorie-delete', ['only' => ['index','show']]);
         $this->middleware('permission:categorie-create', ['only' => ['create','store']]);
         $this->middleware('permission:categorie-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:categorie-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::select('id','nom','description')->get();
        return view('categories',['categories'=>$categories]);
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




        $categorie = Categorie::create([
            "nom"=>$request->nom,
            "description"=>$request->description,
        ]);
        foreach ($request->nom_sous as $k => $val) {
            $categorie->sous_categorie()->create([
                "categorie_id"=>$categorie->id,
                "nom"=>$val
            ]);

        }


    toast("L'enregistrement du catégorie effectuée","success");
      return redirect()->route('categorie.index');
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
      $edit_categorie=Categorie::find($id);

      return view('categories.edit',['edit_categorie'=>$edit_categorie]);

      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        "nom"=>["required"],
      ]);
      $update_categorie=Categorie::find($id);
      $update_categorie->nom           =     $request->nom;
      $update_categorie->description   =     $request->description;
      $update_categorie->save();


      Session()->flash('update','La notification du categorie effectuée');
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Categorie::find($id);
        $del->delete();
        Session()->flash('delete','La suppression du categorie effectuée');
        toast("La suppression du catégorie effectuée","success");
        return redirect()->route('categorie.index');

    }
    // public function destroyAll(Request $request)
    // {
    //     $id=$requestcat_id;
    //     Categorie::where('id',$id)->delete();
    //     // Session()->flash('delete','La suppression du categorie effectuée');
    //     return redirect()->route('categorie.index');

    // }


    public function add_product(Request $request){
        $request->validate([

              "reference"=>["required","unique:produits,reference"],
              "nom_cat"=>["required"],

              "designation"=>["required"],
              "prix_vente"=>["regex:/^([0-9](.[0-9])?)+$/"],
              "prix_achat"=>["regex:/^([0-9](.[0-9])?)+$/"],
              "prix_unitaire"=>["regex:/^([0-9](.[0-9])?)+$/"],
              "quantite"=>["required"],

            ]);
            if($request->hasFile('img'))
            {
              $file = $request->file('img');
              $extention = $file->getClientOriginalExtension();
              $filename = time().".".$extention;
              $file->move('images/produits/',$filename);

            }
            $categorie = Categorie::create([
                "nom"=>$request->nom_cat,
                "description"=>$request->desc_cat,
            ]);
            Produit::create([
                "categorie_id"=>$categorie->id,
                "image"=>$filename ?? "",
                "reference"=>$request->reference,
                "designation"=>$request->designation,
                "prix_vente"=>$request->prix_vente,
                "prix_achat"=>$request->prix_achat,
                "prix_unitaire"=>$request->prix_unitaire,
                "quantite"=>$request->quantite ?? 1,
            ]);
            Session()->flash('success',"L'enregistrement produit du catégorie effectuée");
            return back();
    }
  }
