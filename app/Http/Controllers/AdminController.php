<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Facture;
use App\Models\Group;
use App\Models\FactureProduit;
use App\Models\Client;
use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{

    public function index()
    {






        // $sum_prix_vente = DB::table('produits')->sum('prix_vente');
        // $sum_prix_achat = DB::table('produits')->sum('prix_achat');
        // $sum_prix_revient = DB::table('produits')->sum('prix_revient');
        // $sum_montant = DB::table('factures')->sum('prix_ttc');
        // $sum_prix_ttc = DB::table('factures')->sum('prix_ttc');
        // $sum_prix_ht = DB::table('factures')->sum('prix_ht');


        // $clients = Client::select(DB::raw("COUNT(*) as count"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck("count");
        // $months = Client::select(DB::raw("Month(created_at) as month"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('month');
        // $data_client = array(0,0,0,0,0,0,0,0,0,0,0,0);
        // foreach($months as $index => $month){
        //     $data_client[$month-1] = $clients[$index];
        // }

        // $prix_vente = Produit::select(DB::raw("SUM(prix_vente) as sum_pv"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck("sum_pv");
        // $months_pv = Produit::select(DB::raw("Month(created_at) as month"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('month');
        // $data_produit_pv = array(0,0,0,0,0,0,0,0,0,0,0,0);
        // foreach($months_pv as $index => $month){
        //     $data_produit_pv[$month-1] = $prix_vente[$index];
        // }

        // $prix_achat = Produit::select(DB::raw("SUM(prix_achat) as sum_pa"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck("sum_pa");
        // $months_pa = Produit::select(DB::raw("Month(created_at) as month"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('month');
        // $data_produit_pa = array(0,0,0,0,0,0,0,0,0,0,0,0);
        // foreach($months_pa as $index => $month){
        //     $data_produit_pa[$month-1] = $prix_achat[$index];
        // }

        // $prix_revient = Produit::select(DB::raw("SUM(prix_revient) as sum_pu"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck("sum_pu");
        // $months_pu = Produit::select(DB::raw("Month(created_at) as month"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck('month');
        // $data_produit_pu = array(0,0,0,0,0,0,0,0,0,0,0,0);
        // foreach($months_pu as $index => $month){
        //     $data_produit_pu[$month-1] = $prix_revient[$index];
        // }



        // $ttc = Facture::select(DB::raw("SUM(prix_ttc) as sum_ttc"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck("sum_ttc");
        // $months_ttc = Facture::select(DB::raw("Month(created_at) as month"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck("month");
        // $data_facture_ttc = array(0,0,0,0,0,0,0,0,0,0,0,0);
        // foreach($months_ttc as $index => $month){
        //     $data_facture_ttc[$month-1] = $ttc[$index];
        // }

        // $prix_ht = Facture::select(DB::raw("SUM(prix_ht) as sum_ht"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck("sum_ht");
        // $months_ht = Facture::select(DB::raw("Month(created_at) as month"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("Month(created_at)"))->pluck("month");
        // $data_facture_ht = array(0,0,0,0,0,0,0,0,0,0,0,0);
        // foreach($months_ht as $index => $month){
        //     $data_facture_ht[$month-1] = $prix_ht[$index];
        // }


        $count_client = Client::count();
        $count_client_today = Client::where("created_at",Carbon::today())->count();

        $count_facture = Facture::count();
        $count_facture_today = Facture::where("created_at",Carbon::today())->count();

        $count_produit = Produit::count();
        $count_produit_today = Produit::where("created_at",Carbon::today())->count();

        $count_stock = Stock::count();
        $count_stock_today = Stock::where("created_at",Carbon::today())->count();

        // liste
        $transactions = Transaction::select("client_id","remarque","montant")->get();
        $transactions_today = Transaction::select("client_id","remarque","montant","created_at")->whereDate("created_at","=",Carbon::today())->get();
        $stocks = Stock::select("produit_id","entre","sortie","reste","date_stock")->get();


        return view('home',
        [
            "count_client"=>$count_client,
            "count_client_today"=>$count_client_today,

            "count_facture"=>$count_facture,
            "count_facture_today"=>$count_facture_today,

            "count_produit"=>$count_produit,
            "count_produit_today"=>$count_produit_today,

            "count_stock"=>$count_stock,
            "count_stock_today"=>$count_stock_today,

            "transactions"=>$transactions,
            "transactions_today"=>$transactions_today,

            "stocks"=>$stocks
            // 'count_produit'=>Produit::count(),
            // 'count_client'=>Client::count(),
            // 'count_facture'=>Facture::count(),

            // "produits"=>Produit::all(),
            // "clients"=>Client::all(),
            // "groupes"=>Group::all(),
            // "factures"=>Facture::all(),



            // "ch_client"=>$clients,
            // "ch_ttc"=>$ttc,


            // "year_client"=>Client::select(DB::raw('YEAR(created_at) year'))->groupBy('year')->get(),



        // 'sum_pv'=>$sum_prix_vente,
        // 'sum_pa'=>$sum_prix_achat,
        // 'sum_pu'=>$sum_prix_revient,

        // // 'data_facture'=>$data_facture,

        // 'montant'=>$sum_montant,
        // 'prix_ttc'=>$sum_prix_ttc,
        // 'prix_ht'=>$sum_prix_ht,


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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
