<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\FactureProduit;
use App\Models\Client;
use App\Models\ClientPaiement;
use App\Models\Entreprise;
use App\Models\FacturePaiement;
use App\Models\FactureReglement;
use App\Models\Group;
use App\Models\Produit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
// use Barryvdh\DomPDF\PDF;
// use App\Post;


class FactureController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('factures.index',['factures'=>Facture::all(),"clients"=>Client::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if($request->ajax()){
            $data = Produit::where('reference', 'LIKE', $request->ref. '%')->get();
            $output = '';
            if (count ($data) >0){
                $output = '<ul class="list-group" style="display:block;position:relative;z-indez:1;">';
                foreach($data as $row) {
                    $output .= '<li class="list-group-item py-1">';
                        $output .= '<input class="form-check-input me-1 select-produit refer" type="radio" name="refere" value="'.$row->reference.'" >';
                        $output .= '<label>'.$row->reference.'</label>';
                    $output .= '</li>';
                    }
                $output .= '</ul>';
            }

            return $output;
            }
        $clients = Client::get(["id","raison_sociale"]);

        $groupes = Group::get(["id","nom"]);
        $entreprises = Entreprise::get(["id","raison_sociale"]);
        return  view('factures.create',['clients'=>$clients,"entreprises"=>$entreprises,"groupes"=>$groupes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $i=0;
        $facture = Facture::create([
            "client_id"=>$request->client_id,
            "remise"=>$request->remise_facture,
            "num_facture"=>"FAC-00"."4",
            "statut"=>$request->statut,
            "date"=>$request->date ?? Carbon::today(),
            "prix_ht"=>$request->total,
            "taux_tva"=>$request->tva,
            "prix_ttc" => $request->ttc,
            "remise" => $request->remise_facture ?? 0,
            "entreprise_id" => $request->entreprise_id,
            "payer"=>$request->payer,
            "reste"=>$request->reste,

        ]);
        foreach($request->reference as $k =>  $value){
          if($request->remise[$k]==0){
            $montant_produit = $request->prix_unitaire[$k] * $request->quantite[$k];
        }
        else{
            $prix_total = $request->prix_unitaire[$k] * $request->quantite[$k];

            $montant_produit = $prix_total * (1 - ($request->remise[$k]/100) );
        }
        FactureProduit::create([
            "facture_id"=>$facture->id,
            "reference" => $request->reference[$k],
            "designation" => $request->designation[$k],
            "quantite" => $request->quantite[$k],
            "prix_unitaire" => $request->prix_unitaire[$k],
            "remise" => $request->remise[$k],
            "montant" => $montant_produit,
        ]);
    }
    FacturePaiement::create([
        "client_id"=>$request->client_id,
        "facture_id"=>$facture->id,
        "payer"=>$request->payer ?? 0,
        "reste"=>$request->reste,
        "date_paiement"=>Carbon::today(),
        "type_paiement"=>$request->type,
        ]);



      Session()->flash("success","L'enregistrement du facture success");
      return redirect()->route("facture.index");
      }

      /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture,Request $request)
    {
        // $sum_ht = FactureProduit::where('facture_id',$facture->id)->sum("")
        if($request->ajax()){
            $data = Produit::where('reference', 'LIKE', $request->ref. '%')->get();

            $output = '';
            if (count ($data) >0){
                $output = '<ul class="list-group" style="display:block;position:relative;z-indez:1;">';
                foreach($data as $row) {
                    $output .= '<li class="list-group-item py-1">';
                        $output .= '<input class="form-check-input me-1 select-produit" type="checkbox" name="reference[]" value="'.$row->reference.'" >';
                        $output .= $row->reference;
                    $output .= '</li>';
                    }
                $output .= '</ul>';
            }

            return $output;
            }
        return view('factures.edit',
        [
          'facture'=>$facture,
          'sum_ttc'=>Facture::sum("prix_ttc"),
          'clients'=>Client::all()
          ]
        );
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  \App\Models\Facture  $facture
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request, Facture $facture)
      {
       $facture->update([
        "client_id"=>$request->client_id,
        "num_facture"=>$request->num_facture,
        "statut"=>$request->statut ?? "desactiver",
       ]);
        Session()->flash('update','La notification du facture effectuée');
        return back();

      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del_facture = Facture::find($id);
        $del_facture->delete();
        Session()->flash('delete','La suppression du facture effectuté');
        return redirect()->route('facture.index');
    }

    public static function asLetters($number) {
$convert = explode('.', $number);
$num[17] = array('zero', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit',
'neuf', 'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize');

$num[100] = array(20 => 'vingt', 30 => 'trente', 40 => 'quarante', 50 => 'cinquante',
60 => 'soixante', 70 => 'soixante-dix', 80 => 'quatre-vingt', 90 => 'quatre-vingt-dix');

if (isset($convert[1]) && $convert[1] != '') {
return self::asLetters($convert[0]).' et '.self::asLetters($convert[1]);
}
if ($number < 0) return 'moins '.self::asLetters(-$number);
if ($number < 17) {
return $num[17][$number];
}
elseif ($number < 20) {
return 'dix-'.self::asLetters($number-10);
}
elseif ($number < 100) {
if ($number%10 == 0) {
return $num[100][$number];
}
elseif (substr($number, -1) == 1) {
if( ((int)($number/10)*10)<70 ){
return self::asLetters((int)($number/10)*10).'-et-un';
}
elseif ($number == 71) {
return 'soixante-et-onze';
}
elseif ($number == 81) {
return 'quatre-vingt-un';
}
elseif ($number == 91) {
return 'quatre-vingt-onze';
}
}
elseif ($number < 70) {
return self::asLetters($number-$number%10).'-'.self::asLetters($number%10);
}
elseif ($number < 80) {
return self::asLetters(60).'-'.self::asLetters($number%20);
}
else {
return self::asLetters(80).'-'.self::asLetters($number%20);
}
}
elseif ($number == 100) {
return 'cent';
}
elseif ($number < 200) {
return self::asLetters(100).' '.self::asLetters($number%100);
}
elseif ($number < 1000) {
return self::asLetters((int)($number/100)).' '.self::asLetters(100).($number%100 > 0 ? ' '.self::asLetters($number%100): '');
}
elseif ($number == 1000){
return 'mille';
}
elseif ($number < 2000) {
return self::asLetters(1000).' '.self::asLetters($number%1000).' ';
}
elseif ($number < 1000000) {
return self::asLetters((int)($number/1000)).' '.self::asLetters(1000).($number%1000 > 0 ? ' '.self::asLetters($number%1000): '');
}
elseif ($number == 1000000) {
return 'millions';
}
elseif ($number < 2000000) {
return self::asLetters(1000000).' '.self::asLetters($number%1000000);
}
elseif ($number < 1000000000) {
return self::asLetters((int)($number/1000000)).' '.self::asLetters(1000000).($number%1000000 > 0 ? ' '.self::asLetters($number%1000000): '');
}
}

    public function showPdf(Facture $facture){

      $entreprise = Entreprise::all();
      $letter_chiffre = $this->asLetters(($facture->prix_ttc));
      $pdf = PDF::loadView('factures.showPdf',compact('facture','entreprise','letter_chiffre'));



      return $pdf->stream();
      // return $pdf->download('facture.pdf');
    }

}
