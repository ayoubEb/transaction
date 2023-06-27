<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\reponse;

class GroupController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:groupe-list|groupe-create|groupe-edit|groupe-delete', ['only' => ['index','show']]);
         $this->middleware('permission:groupe-create', ['only' => ['index','store']]);
         $this->middleware('permission:groupe-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:groupe-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::get(["id","nom","remise","statut"]);
        return view(
            'groupes',
            [
                'groupes'=>$groups
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
        "nom"=>["required"],

      ]);
      Group::create([
        "nom"=>$request->nom,
        "remise"=>$request->remise ?? 0,
        "statut"=>$request->statut ?? "desactiver",
      ]);

        toast("La notification du group effectuée","success");
        return redirect()->route('group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
      $request->validate([
        "nom_u"=>["required"],
        "remise_u"=>["regex:/^([0-9](.[0-9])?)+$/"],
      ]);
      $group->update([
        "nom"=>$request->nom_u,
        "remise"=>$request->remise_u,
        "statut"=>$request->statut_u ?? $group->statut,
      ]);
      toast("La notification du group effectuée","success");
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del=Group::find($id);
        $del->delete();
        Session()->flash('delete','La suppression du group effectuté');
        return redirect()->route('group.index');
    }


    public function destroyAll(Request $request)
    {
      $idGroupes = $request->group_id;

      foreach($idGroupes as $idGroupe){
         $Groupe= Group::where('id' ,$idGroupe)->first();
        $Groupe->delete();

      }
      Session()->flash('delete','La suppression du group effectuée');
      return redirect()->back();
    }

}
