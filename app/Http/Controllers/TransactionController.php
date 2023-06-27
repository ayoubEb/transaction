<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        $clients = Client::all();
        return view("transaction",compact("transactions","clients"));
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
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        toast("La suppression du transaction effectuée","success");
        return back();
    }
}
