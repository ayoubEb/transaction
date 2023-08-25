<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:transaction-list|transaction-create|transaction-edit|transaction-destroy', ['only' => ['index']]);
         $this->middleware('permission:transaction-create', ['only' => ['store']]);
         $this->middleware('permission:transaction-edit', ['only' => ['update']]);
         $this->middleware('permission:transaction-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::select('id',"client_id","date_transaction","montant","remarque")->get();
        $clients = Client::select('id',"raison_sociale")->get();
        return view("transaction",[
            "transactions"=>$transactions,
            "clients"=>$clients
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
        $request->validate([
            "client"=>["required"],
            "date"=>["required"],
        ]);
        Transaction::create([
            "client_id"=>$request->client,
            "date_transaction"=>$request->date,
            "montant"=>$request->montant,
            "remarque"=>$request->remarque,
        ]);

        toast("L'enregistrement du transaction effectuée","success");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            "client_u"=>["required"],
            "date_u"=>["required"],
        ]);
        $transaction->update([
            "client_id"=>$request->client_u,
            "date_transaction"=>$request->date_u,
            "montant"=>$request->montant_u,
            "remarque"=>$request->remarque_u,
        ]);
        toast("La notitification du transaction effectuée","success");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction, Request $request)
    {
        if(isset($request->force))
        {
            $transaction->forceDelete();
            toast("La suppression du transaction effectuée","success");
        }
        else
        {
            $transaction->delete();
            toast("La déplacement du corbeille du transaction effectuée","success");
        }
        return back();

    }
}
