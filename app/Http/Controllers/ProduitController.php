<?php

namespace App\Http\Controllers;

use App\Models\Caracteristique;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\ProduitCategorie;
use App\Models\ProduitSousCategorie;
use App\Models\SousCategorie;
use App\Models\Stock;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class ProduitController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:produit-list|produit-create|produit-edit|produit-delete', ['only' => ['index','show']]);
         $this->middleware('permission:produit-create', ['only' => ['create','store']]);
         $this->middleware('permission:produit-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:produit-destroy', ['only' => ['destroy']]);
    }
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
        $produits = Produit::get(
            [
                "id",
                "image",
                "reference",
                "designation",
                "description",
                "prix_vente",
                "prix_achat",
                "prix_revient",
                "quantite",
                "code"
            ]
        );

        return view('catalogue.produit.index',['produits'=>$produits]);
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
        $categories = Categorie::get(['id','nom']);
        $sous_categories = sousCategorie::get(['id','nom']);
        $caracteristiques = Caracteristique::get(
            [
                "id",
                "nom",
            ]
            );
        return view("catalogue.produit.create",
            [
                "categories"=>$categories,
                "sous_categories"=>$sous_categories,
                "caracteristiques"=>$caracteristiques
            ]
        );
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
          "reference"=>["required","unique:produits,reference"],
          "designation"=>["required"],
          "prix_vente"=>["regex:/^([0-9](.[0-9])?)+$/"],
          "prix_achat"=>["regex:/^([0-9](.[0-9])?)+$/"],
          "code"=>["nullable","unique:produits,code"],
          "prix_revient"=>["regex:/^([0-9](.[0-9])?)+$/"],

        ]);



        if($request->hasFile("img")){
            $destination_path = 'public/images/produits/';
            $image_produit = $request->file("img");
            $filename = $image_produit->getClientOriginalName();
            $request->file("img")->storeAs($destination_path,$filename);
            $resu = $filename;

        }




        $produit = Produit::create([
            "image"=>$resu ?? "",
            "reference"=>$request->reference,
            "designation"=>Str::upper($request->designation),
            "description"=>$request->description,
            "prix_vente"=>$request->prix_vente,
            "prix_achat"=>$request->prix_achat,
            "prix_revient"=>$request->prix_revient,
            "quantite"=>0,
            "code"=>Str::upper($request->code),
        ]);
        if(isset($request->sous))
        {
            foreach($request->sous as $k => $row){
                SousCategorie::where("id",$row)->first();
                ProduitSousCategorie::create([
                    "sous_categorie_id"=>$row,
                    "produit_id"=>$produit->id,

                ]);

            }

        }

        if(isset($request->categorie)){

            foreach($request->categorie as $k => $row){

                ProduitCategorie::create([
                    "produit_id"=>$produit->id,
                    "categorie_id"=>$row,
                ]);
            }
        }


        foreach($request->valeur as $k => $row){
            if($request->valeur[$k] != ''){
                $produit->caracteristiques()->create([
                    "produit_id"=>$produit->id,
                    "caracteristique_id"=>$request->caracteristique_id[$k],
                    "valeur"=>$row,
                    "quantite"=>$request->quantite_caracteristique[$k],
                    "prix"=>$request->prix_caracteristique[$k],
                ]);

            }
        }
        toast("L'enregistrement du produit effectuée","success");
        return redirect()->route('produit.index');
      }

      /**
       * Display the specified resource.
       *
       * @param  \App\Models\Produit  $produit
       * @return \Illuminate\Http\Response
       */
      public function show($id)
      {

      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  \App\Models\produit  $produit
       * @return \Illuminate\Http\Response
       */
      public function edit(Produit $produit)
      {
        $categories = Categorie::select('id','nom')->get();
        $sous_categories = SousCategorie::select('id','nom')->get();

        $caracteristiques = Caracteristique::get(
            [
                "id",
                "nom",
            ]
        );
        return view("catalogue.produit.edit",
            [
                "produit"=>$produit,
                "categories"=>$categories,
                "sous_categories"=>$sous_categories,
                "caracteristiques"=>$caracteristiques,
            ]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  \App\Models\Produit  $produit
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request, Produit $produit)
      {
        $request->validate([
          "reference"=>["required"],
          "designation"=>["required"],
          "prix_vente"=>["regex:/^([0-9](.[0-9])?)+$/"],
          "prix_achat"=>["regex:/^([0-9](.[0-9])?)+$/"],
        ]);

        if (File::exists(storage_path().'/app/public/images/produits/'.$produit->image)) {
          File::delete(storage_path().'/app/public/images/produits/'.$produit->image);
          }
        $img_produit = "";
            if($request->hasFile("img")){
            $destination_path_produit = 'public/images/produits';
            $image_produit = $request->file("img");
            $img_produit = $image_produit->getClientOriginalName();
            $request->file("img")->storeAs($destination_path_produit,$img_produit);
        }

            $produit->update([

              "image"=>$img_produit ?? "",
              "reference"=>Str::upper($request->reference),
              "designation"=>Str::upper($request->designation),
              "description"=>$request->description,
              "prix_vente"=>$request->prix_vente,
              "prix_achat"=>$request->prix_achat,
              "code"=>$request->prix_revient,
              "prix_revient"=>$request->code,
            ]);

            $stock =  Stock::where("produit_id",$produit->id)->first();
            // Stock::where("produit_id",$produit->id)->update([
            //     "entre"=>$stock->entre
            // ]);
            toast("La motification du produit effectuée","success");
            return back();
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  \App\Models\Produit  $produit
       * @return \Illuminate\Http\Response
       */
      public function destroy(Produit $produit,Request $request)
      {
        if(isset($request->force)){
            $produit->forceDelete();
            $produit->categories()->forceDelete();
            $produit->sous_categories()->forceDelete();
            if (File::exists(storage_path().'/app/public/images/produits/'.$produit->image)) {
                File::delete(storage_path().'/app/public/images/produits/'.$produit->image);
            }
            toast("La suppression du produit effectuée","success");
        }
        else{
            $produit->delete();
            $produit->categories()->delete();
            $produit->sous_categories()->delete();
            $produit->delete();
            toast("La déplacement du corbeille du produit effectuée","success");

        }
        return back();
      }
    //
}




