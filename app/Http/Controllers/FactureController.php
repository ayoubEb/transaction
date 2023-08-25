<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Facture;
use App\Models\FactureProduit;
use App\Models\Client;
use App\Models\CustomizeFacture;

use App\Models\Entreprise;
use App\Models\Group;
use App\Models\Produit;

use App\Models\StockHistorique;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $tva = CustomizeFacture::select("tva")->first();

        $factures = Facture::withTrashed()
        ->join("clients","clients.id","factures.client_id")
        ->select('factures.*',"clients.raison_sociale","clients.deleted_at as cli_del" )
        ->get();

        // dd($factures);
        $clients = Client::all();
        $banks = Bank::select('id',"nom_bank")->get();
        return view('ventes.factures.index',
            [
            'factures'=>$factures,
            "clients"=>$clients,
            "banks"=>$banks,
            "tva"=>$tva
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $produits = Produit::select("id","reference","prix_vente","designation")->get();
        $clients = Client::get(["id","raison_sociale"]);

        $groupes = Group::get(["id","nom"]);
        $entreprises = Entreprise::get(["id","raison_sociale"]);
        $banks = Bank::select("id","nom_bank")->get();
        $tva = CustomizeFacture::select("tva")->first()->tva;
        return  view('ventes.factures.create',[
            'clients'=>$clients,
            "entreprises"=>$entreprises,
            "groupes"=>$groupes,
            "banks"=>$banks,
            "produits"=>$produits,
            "tva"=>$tva
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
        $customize_facture = CustomizeFacture::select("reference","numero","tva")->first();
        $count_facture = Facture::withTrashed()->count();
        $reference = strval($count_facture + $customize_facture->numero);

        $facture = Facture::create([
            "client_id"=>$request->client_id,
            "remise"=>$request->remise_facture,
            "num_facture"=>$customize_facture->reference.$reference,
            "statut"=>$request->statut,
            "date"=>$request->date ?? Carbon::today(),
            "prix_ht"=>$request->total,
            "taux_tva"=>$request->tva,
            "prix_ttc" => $request->ttc,
            "remise" => $request->remise_facture ?? 0,
            "entreprise_id" => $request->entreprise_id,
            "payer"=>0,
            "reste"=>$request->ttc,
           "etat_paiement"=>"attente",
        ]);

        foreach($request->pro as $k =>  $value){

            FactureProduit::create([
                "facture_id"=>$facture->id,
                "produit_id"=>$request->pro[$k] ,
                "quantite" => $request->quantite[$k],
                "remise" => $request->remise[$k],
                "montant" => $request->montant[$k],
            ]);



            $stock = Produit::join("stocks","produits.id","=","stocks.produit_id")
            ->select('stocks.produit_id',"stocks.entre","stocks.sortie","stocks.reste","stocks.id","stocks.date_stock")
            ->where("stocks.produit_id",$value)
            ->first();
            if(isset($stock)){
                Produit::join("stocks","produits.id","=","stocks.produit_id")
                ->select('stocks.produit_id',"stocks.reste","stocks.sortie","produits.quantite","stocks.reserverAttente")
                ->where("stocks.produit_id",$value)
                ->update([
                    "reserverAttente"=>$request->quantite[$k],
                ]);

            }
        }



        toast("L'enregistrement du facture effectuée","success");
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
        $client = Client::withTrashed()->join("factures","clients.id","=","factures.client_id")
                ->select("factures.id","clients.raison_sociale")
                ->where("factures.id",$facture->id)
                ->first();
            // dd($client);

        $produits = Produit::select("id","reference","designation","prix_vente")->get();
        return view("ventes.factures.show",[
            "facture"=>$facture,
            "client"=>$client,
            "produits"=>$produits
        ]);
    }
      /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function produits(Facture $facture)
    {
        $produits = Produit::select("id","reference")->get();
        return view("factures.produits",
            [
                "facture"=>$facture,
                "produits"=>$produits
            ]
            );

    }
      /**
     * Valider the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function valider(Facture $facture)
    {
        $facture->update([
            "statut"=>"validé",
        ]);

        $produits = FactureProduit::where("facture_id",$facture->id)->get();

        foreach($produits as $k =>  $value){



            $stock = Produit::join("stocks","produits.id","=","stocks.produit_id")
            ->select('stocks.produit_id',"stocks.entre","stocks.sortie","stocks.reste","stocks.id","stocks.date_stock","stocks.reserverAttente")
            ->where("stocks.produit_id",$produits[$k]->produit_id)
            ->first();
            if(isset($stock)){
                Produit::join("stocks","produits.id","=","stocks.produit_id")
                ->select('stocks.produit_id',"stocks.reste","stocks.sortie","produits.quantite","stocks.reserverAttente","stocks.reserverValider")
                ->where("stocks.produit_id",$produits[$k]->produit_id)
                ->update([
                    "sortie"=>$produits[$k]->quantite + $stock->sortie,
                    "reste"=>$stock->entre - ($produits[$k]->quantite + $stock->sortie),
                    "quantite"=>$stock->entre - ($produits[$k]->quantite + $stock->sortie),
                    "reserverAttente"=>0,
                    "reserverValider"=>$stock->reserverAttente,
                ]);
                $st_h = StockHistorique::where("stock_id",$stock->id)->where("fonction","qte_entre")->exists();

                if($st_h == false){
                    StockHistorique::create([
                        "stock_id"=>$stock->id,
                        "fonction"=>"qte_entre",
                        "quantite"=>$stock->entre,
                        "date_mouvement"=>$stock->date_stock,
                    ]);
                }
                StockHistorique::create([
                    "stock_id"=>$stock->id,
                    "fonction"=>"qte_sortie",
                    "quantite"=>$produits[$k]->quantite,
                    "date_mouvement"=>Carbon::now(),
                ]);
            }
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture,Request $request)
    {

            $produits = Produit::select("id","reference","designation","prix_vente")->get();
        return view('ventes.factures.edit',
        [
          'facture'=>$facture,
          'produits'=>$produits,
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
                "statut"=>$request->statut ?? "en cours",
                "taux_tva"=>$request->tva,
            ]);
            toast("La modification du facture effectuée","success");
            if($facture->statut == "valider")
            {
                    return redirect()->route('facture.index');
            }
            else
            {
                return back();
            }

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {

        $facture->delete();

        $produits = $facture->produits()->get();
        foreach($produits as $row => $val){
            $stock = Produit::join("stocks","produits.id","=","stocks.produit_id")
            ->select('stocks.produit_id',"stocks.entre","stocks.sortie","stocks.reste","produits.quantite")
            ->where("stocks.produit_id",$produits[$row]->produit_id)
            ->first();
            if(isset($stock)){

                Produit::join("stocks","produits.id","=","stocks.produit_id")
                ->select('stocks.produit_id',"stocks.reste","stocks.sortie","produits.quantite")
                ->where("stocks.produit_id",$produits[$row]->produit_id)
                ->update([
                    "sortie"=>$stock->sortie - $produits[$row]->quantite,
                    "reste"=>$stock->reste + $produits[$row]->quantite,
                    "quantite"=> $stock->quantite + $produits[$row]->quantite,
                ]);
            }



        }



        toast("La déplacement du corbeille du facture effectuée","success");
        return back();
    }
    /**
     * update the specified resource from storage.
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function statut_valider(Request $request, Facture $facture)
    {
        $facture->update([
            "statut"=>$request->statut,
        ]);

        return back();
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
      $pdf = PDF::loadview('ventes.factures.showPdf',compact('facture','entreprise','letter_chiffre'));
      return $pdf->stream();
      // return $pdf->download('facture.pdf');
    }



}
