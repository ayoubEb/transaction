<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Group;
use App\Models\TypeClient;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:client-list|client-create|client-edit|client-destroy', ['only' => ['index','show']]);
         $this->middleware('permission:client-create', ['only' => ['create','store']]);
         $this->middleware('permission:client-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:client-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::get(
            [
                "id",
                "group_id",
                "raison_sociale",
                "responsable",
                "adresse",
                "telephone",
                "email",
                "ville",
                "ice",
                "if",
                "rc",
                "code_postal",
                "activite",
                "type_client_id",
                "created_at",
            ]
        );

        return view('clients.index',['clients'=>$client]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $liste_groupes = Group::select('id','nom','remise')->paginate(3);
        $type_client = TypeClient::select('id','nom')->get();
        return view('clients.create',[
          'groupes'=>$liste_groupes,
          "types"=>$type_client,
        ]);
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
        "raison_sociale"=>["required","not_regex:/^([a-z]+[0-9]+)|([A-Z]+[0-9]+)|([0-9]+)|([0-9]+[a-z]+)|([0-9]+[A-Z]+)$/"],
        "ville"=>["required","not_regex:/^([a-z]+[0-9]+)|([A-Z]+[0-9]+)|([0-9]+)|([0-9]+[a-z]+)|([0-9]+[A-Z]+)$/"],
        "adresse"=>["required"],
        "phone"=>["required","not_regex:/^([a-z]+)|([A-Z]+)|([A-Za-z]+)|([a-zA-Z]+)$/"],
        "ice"=>["nullable", "digits_between:1,16"],
        "if"=>["nullable", "digits_between:1,16"],
        "rc"=>["nullable", "digits_between:1,16"],


      ]);
      Client::create([
        "raison_sociale"=>$request->raison_sociale,
        "adresse"=>$request->adresse,
        "email"=>$request->email,
        "ville"=>$request->ville,
        "activite"=>$request->activite,
        "ice"=>$request->ice,
        "code_postal"=>$request->code_postal,
        "telephone"=>$request->phone,
        "group_id"=>$request->group_id,
        "responsable"=>$request->responsable,
        "ice"=>$request->ice,
        "if"=>$request->if,
        "rc"=>$request->rc,
        "type_client_id"=>$request->type,
      ]);

      toast("L'enregistrement du client effectuée","success");
       return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $groupes = Group::select('id','nom','remise')->paginate(8);
        $types = TypeClient::select('id','nom')->get();
        return view("clients.edit",[
            "client"=>$client,
            "groupes"=>$groupes ,
            "types"=>$types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
      $request->validate([
        "raison_sociale"=>["required","not_regex:/^([a-z]+[0-9]+)|([A-Z]+[0-9]+)|([0-9]+)|([0-9]+[a-z]+)|([0-9]+[A-Z]+)$/"],
        "ville"=>["required","not_regex:/^([a-z]+[0-9]+)|([A-Z]+[0-9]+)|([0-9]+)|([0-9]+[a-z]+)|([0-9]+[A-Z]+)$/"],
        "adresse"=>["required"],
        "phone"=>["required","not_regex:/^([a-z]+)|([A-Z]+)|([A-Za-z]+)|([a-zA-Z]+)$/"],
        "ice"=>["nullable", "digits_between:1,16"],
        "if"=>["nullable", "digits_between:1,16"],
        "rc"=>["nullable", "digits_between:1,16"],


      ]);
      $client->update([
        "raison_sociale"=>$request->raison_sociale,
        "adresse"=>$request->adresse,
        "email"=>$request->email,
        "ville"=>$request->ville,
        "activite"=>$request->activite,
        "ice"=>$request->ice,
        "code_postal"=>$request->code_postal,
        "telephone"=>$request->phone,
        "group_id"=>$request->group_id,
        "responsable"=>$request->nom_responsable,
        "ice"=>$request->ice,
        "if"=>$request->if,
        "rc"=>$request->rc,
        "type_client_id"=>$request->type,
      ]);
      toast("La notification du client effectuée","success");
      return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client,Request $request)
    {

        if(isset($request->force)){
            $client->forceDelete();
            toast("La suppression du client effectuée","success");
        }
        else{
            $client->delete();
            toast("La déplacement du corbeille du client effectuée","success");

        }

        return back();



    }


}
