<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

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
        $stocks = Stock::select("produit_id","entre","sortie","reste","date_stock","min","initial","reserverValider","reserverAttente","num")->latest()->take(8)->get();

        $reservation = Stock::select('produit_id',"num","reserverAttente","reserverValider")->get();
        return view('home',[
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

            "stocks"=>$stocks,
            "reservation"=>$reservation
        ]);
    }
}
