<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class ProduitController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:produit-list|produit-create|produit-edit|produit-delete', ['only' => ['index','show']]);
         $this->middleware('permission:produit-create', ['only' => ['create','store']]);
         $this->middleware('permission:produit-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:produit-delete', ['only' => ['destroy']]);
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
                "categorie_id",
                "image",
                "reference",
                "designation",
                "description",
                "prix_vente",
                "prix_achat",
                "prix_unitaire",
                "quantite"
            ]
        );

        return view('produit.index',['produits'=>$produits]);
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
        $categories = Categorie::get(['id','nom','description']);

        return view("produit.create",["categories"=>$categories]);
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
          "reference"=>["required"],
          "designation"=>["required"],
          "prix_vente"=>["regex:/^([0-9](.[0-9])?)+$/"],
          "prix_achat"=>["regex:/^([0-9](.[0-9])?)+$/"],
          "prix_unitaire"=>["regex:/^([0-9](.[0-9])?)+$/"],
          "categorie_id"=>["required"],
        ]);

        $img_produit = "";
            if($request->hasFile("img")){
            $destination_path_produit = 'public/img/produits';
            $image_produit = $request->file("img");
            $img_produit = $image_produit->getClientOriginalName();
            $request->file("img")->storeAs($destination_path_produit,$img_produit);
        }


        Produit::create([
            "categorie_id"=>$request->categorie_id,
            "image"=>$img_produit ?? "",
            "reference"=>$request->reference,
            "designation"=>Str::upper($request->designation),
            "description"=>$request->description,
            "prix_vente"=>$request->prix_vente,
            "prix_achat"=>$request->prix_achat,
            "prix_unitaire"=>$request->prix_unitaire,
            "quantite"=>$request->quantite ?? 1,
        ]);

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
        return view("produit.edit",["produit"=>$produit,"categories"=>$categories]);
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
          "prix_unitaire"=>["regex:/^([0-9](.[0-9])?)+$/"],
          "categorie_id"=>["required"],
        ]);

        if (File::exists(storage_path().'/app/public/images/produits/'.$produit->image)) {
          File::delete(storage_path().'/app/public/images/produits/'.$produit->image);
          }
        $img_produit = "";
            if($request->hasFile("img")){
            $destination_path_produit = 'public/img/produits';
            $image_produit = $request->file("img");
            $img_produit = $image_produit->getClientOriginalName();
            $request->file("img")->storeAs($destination_path_produit,$img_produit);
        }

            $produit->update([
              "categorie_id"=>$request->categorie_id,
              "image"=>$img_produit ?? "",
              "reference"=>Str::upper($request->reference),
              "designation"=>Str::upper($request->designation),
              "description"=>$request->description,
              "prix_vente"=>$request->prix_vente,
              "prix_achat"=>$request->prix_achat,
              "prix_unitaire"=>$request->prix_unitaire,
              "quantite"=>$request->quantite ?? 1,
            ]);


        return redirect()->back();
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  \App\Models\Produit  $produit
       * @return \Illuminate\Http\Response
       */
      public function destroy(Produit $produit)
      {

        $produit->delete();
        if (File::exists(storage_path().'/app/public/images/produits/'.$produit->image)) {
        File::delete(storage_path().'/app/public/images/produits/'.$produit->image);
        }
        return back();
      }
    //
}




