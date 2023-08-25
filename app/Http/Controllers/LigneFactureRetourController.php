<?php

namespace App\Http\Controllers;

use App\Models\LigneFactureRetour;
use App\Http\Controllers\Controller;
use App\Models\CustomizeFactureRetour;
use App\Models\Facture;
use App\Models\FactureProduit;
use App\Models\FactureRetour;
use App\Models\Stock;
use App\Models\StockHistorique;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
class LigneFactureRetourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ligne_retours = LigneFactureRetour::all();
        return view("ventes.avoires.index",[
            "ligne_retours"=>$ligne_retours,
        ]);
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
        $count_fr = LigneFactureRetour::count();
        $tva = Facture::where("id",$request->facture_id)->first()->taux_tva;
        $remise = Facture::where("id",$request->facture_id)->first()->remise;
        $ttc_actuel = Facture::where("id",$request->facture_id)->first()->prix_ttc;



        $sum_qte = 0;
        $l_rf = CustomizeFactureRetour::select("reference","numero")->first();

        $ligne = LigneFactureRetour::create([
            "reference"=>$l_rf->reference . ($count_fr + $l_rf->numero),
            "facture_id"=>$request->facture_id,
            "date_retour"=>Carbon::today(),

        ]);
        foreach($request->pro as $k => $val){
                FactureRetour::create([
                "ligne_facture_retour_id"=>$ligne->id,
                "facture_produit_id"=>$val,
                "qte_retour"=>$request->retour[$k],
                "qte_actuel"=>$request->qte[$k],
                // "nbr_reste"=>$request->reste[$k],
                "montant_actuel"=>$request->montant[$k],
                "montant"=>$request->mt_retour[$k],
            ]);

            $st = Stock::where("produit_id",$request->pro[$k])->first();
            $facture_pro = FactureProduit::where("produit_id",$request->pro[$k])->first();
            Stock::where("produit_id",$request->pro[$k])->update([
                "reserverRetour"=>$st->reserverRetour + $request->retour[$k],
            ]);
            FactureProduit::where("produit_id",$request->pro[$k])->update([
                "total_retour"=>$facture_pro->total_retour + $request->retour[$k] ,
            ]);
            StockHistorique::where("stock_id",$st->id)->create([
                "stock_id"=>$st->id,
                "fonction"=>"retour",
                "quantite"=>$request->retour[$k],
                "date_mouvement"=>Carbon::today(),
            ]);

            $sum_qte += $request->retour[$k];
        }
        $sum_retour = FactureRetour::where("ligne_facture_retour_id",$ligne->id)->sum("montant");
        $sum_qte_retour = FactureRetour::where("ligne_facture_retour_id",$ligne->id)->sum("qte_retour");
        $sum_qte_actuel = FactureRetour::where("ligne_facture_retour_id",$ligne->id)->sum("qte_actuel");

        $ligne = LigneFactureRetour::where("id",$ligne->id)->update([
            "total_qte"=>$sum_qte_retour,
            "total_QteActuel"=>$sum_qte_actuel,
            "montant_actuel"=>$ttc_actuel,
            "montant_ht"=>$sum_retour,
            "montant_ttc"=>($sum_retour + ($sum_retour * ($tva / 100))) * (1 - ($remise/100)),
        ]);
        Facture::where("id",$request->facture_id)->update([
            // "montant_retour"=>$sum_retour,
            // "qte_retour"=>$sum_qte,
            "retour"=>"oui",
            // "mt_retour_ttc"=>($sum_retour + ($sum_retour * ($tva / 100))) * (1 - ($remise/100)),

        ]);
        toast("L'enregistrement des produits retours effectuée","success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LigneFactureRetour  $ligneFactureRetour
     * @return \Illuminate\Http\Response
     */
    public function show(LigneFactureRetour $ligneFactureRetour)
    {
        $ligne = $ligneFactureRetour;
        return view("ventes.avoires.show",["ligne"=>$ligne]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LigneFactureRetour  $ligneFactureRetour
     * @return \Illuminate\Http\Response
     */
    public function edit(LigneFactureRetour $ligneFactureRetour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LigneFactureRetour  $ligneFactureRetour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LigneFactureRetour $ligneFactureRetour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LigneFactureRetour  $ligneFactureRetour
     * @return \Illuminate\Http\Response
     */
    public function destroy(LigneFactureRetour $ligneFactureRetour)
    {
        //
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

    public function pdf(LigneFactureRetour $ligneFactureRetour){
        $ligne = $ligneFactureRetour;
        $letter_chiffre = $this->asLetters(($ligne->montant_ttc));
        $pdf = PDF::loadview('ventes.avoires.pdf',compact('ligne','letter_chiffre'));
        return $pdf->stream();
    }
}
