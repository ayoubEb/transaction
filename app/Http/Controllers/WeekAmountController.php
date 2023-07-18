<?php

namespace App\Http\Controllers;

use App\Models\AmountPurchase;
use App\Models\AmountSale;
use App\Models\WeekAmount;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class WeekAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {



        $currentDate = Carbon::now();
        // $currentDate->startOfWeek();
        $currentDate->startOfWeek();
        $currentDate->endOfWeek();


        $startDate = $currentDate->copy()->startOfWeek();
        $endDate = $currentDate->copy()->endOfWeek();


        $start_date = $startDate->toDateString();
        $end_date = $endDate->toDateString();

        $date_week = array();
        // Loop through each day of the week
        $currentDate = $startDate;
        while ($currentDate->lt($endDate)) {
            // Perform your desired action for each day
            $date_week[]=$currentDate->format('D Y-m-d');

            // Move to the next day
            $currentDate->addDay();
        }

        $deja = WeekAmount::whereBetween("date_fin",[$start_date,$end_date])->count();


        $week_amounts = WeekAmount::all();
        return view("amounts",compact("date_week","start_date","end_date","week_amounts","deja"));

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


    // public function generer(Request $request){


    //     $currentDate = Carbon::today();
    //     $currentDate->startOfWeek();
    //     $currentDate->endOfWeek();


    //     $startDate = $currentDate->copy()->startOfWeek();
    //     $endDate = $currentDate->copy()->endOfWeek();


    //     $start_date = $startDate->toDateString();
    //     $end_date = $endDate->toDateString();

    //     $date_week = array();
    //     // Loop through each day of the week
    //     $currentDate = $startDate;
    //     while ($currentDate->lt($endDate)) {
    //         // Perform your desired action for each day
    //         $date_week[]=$currentDate->format('D Y-m-d');

    //         // Move to the next day
    //         $currentDate->addDay();
    //     }

    //     $file_ghazala = "";
    //     $file_amana = "";
    //     $file_cheque = "";
    //     $file_verse = "";
    //     if($request->hasFile("file_ghazala")){
    //         $destination_path = 'public/images/ghazala';
    //         $image_ghazala = $request->file("file_ghazala");
    //         $file_ghazala = $image_ghazala->getClientOriginalName();
    //         $request->file("file_ghazala")->storeAs($destination_path,$file_ghazala);
    //     }
    //     if($request->hasFile("file_amana")){
    //         $destination_path_amana = 'public/images/amana';
    //         $image_amana = $request->file("file_amana");
    //         $file_amana = $image_amana->getClientOriginalName();
    //         $request->file("file_amana")->storeAs($destination_path_amana,$file_amana);
    //     }
    //     if($request->hasFile("file_cheque")){
    //         $destination_path_cheque = 'public/images/cheque';
    //         $image_cheque = $request->file("file_cheque");
    //         $file_cheque = $image_cheque->getClientOriginalName();
    //         $request->file("file_cheque")->storeAs($destination_path_cheque,$file_cheque);
    //     }
    //     if($request->hasFile("file_verse")){
    //         $destination_path_verser = 'public/images/verse';
    //         $image_verser = $request->file("file_verse");
    //         $file_verse = $image_verser->getClientOriginalName();
    //         $request->file("file_verse")->storeAs($destination_path_verser,$file_verse);
    //     }

    //     $resu = $request->total_vente + $request->online - ($request->total_achat + $request->amana + $request->ghazala);
    //     $week =  WeekAmount::create([
    //         "date_debut"=>$start_date,
    //         "date_fin"=>$end_date,
    //         "file_ghazala"=>$file_ghazala,
    //         "file_amana"=>$file_amana,
    //         "file_cheque"=>$file_cheque,
    //         "file_verse"=>$file_verse,
    //         "montant_amana"=>$request->amana,
    //         "total_vente"=>$request->total_vente,
    //         "total_achat"=>$request->total_achat,
    //         "montant_ghazala"=>$request->ghazala,
    //         "montant_online"=>$request->online,
    //         "montant_cheque"=>$request->cheque,
    //         "reste_verser"=>$resu,
    //         "reste_final"=>$resu - $request->cheque,

    //     ]);

    //     foreach($date_week as $k => $row){
    //         if(!empty($row)){
    //            $week->sales()->create([
    //                 "week_amount_id"=> $week->id,
    //                 "jour"=>$request->jour[$k],
    //                 "date_sale"=>date("Y-m-d",strtotime($row)),
    //                 "montant"=>$request->montant_achat[$k],
    //             ]);
    //         }
    //     }
    //     foreach($date_week as $k => $row){
    //         if(!empty($row)){
    //            $week->purchases()->create([
    //                 "week_amount_id"=> $week->id,
    //                 "jour"=>$request->jour[$k],
    //                 "date_purchase"=>date("Y-m-d",strtotime($row)),
    //                 "title"=>$request->text[$k] ?? "",
    //                 "montant"=>$request->montant_achat[$k],
    //             ]);
    //         }
    //     }
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentDate = Carbon::today();
        $currentDate->startOfWeek();
        $currentDate->endOfWeek();


        $startDate = $currentDate->copy()->startOfWeek();
        $endDate = $currentDate->copy()->endOfWeek();


        $start_date = $startDate->toDateString();
        $end_date = $endDate->toDateString();

        $date_week = array();
        // Loop through each day of the week
        $currentDate = $startDate;
        while ($currentDate->lt($endDate)) {
            // Perform your desired action for each day
            $date_week[]=$currentDate->format('D Y-m-d');

            // Move to the next day
            $currentDate->addDay();
        }

        $file_ghazala = "";
        $file_amana = "";
        $file_cheque = "";
        $file_verse = "";
        $file_autre = "";
        if($request->hasFile("file_ghazala")){
            $destination_path = 'public/images/ghazala';
            $image_ghazala = $request->file("file_ghazala");
            $file_ghazala = $image_ghazala->getClientOriginalName();
            $request->file("file_ghazala")->storeAs($destination_path,$file_ghazala);
        }
        if($request->hasFile("file_amana")){
            $destination_path_amana = 'public/images/amana';
            $image_amana = $request->file("file_amana");
            $file_amana = $image_amana->getClientOriginalName();
            $request->file("file_amana")->storeAs($destination_path_amana,$file_amana);
        }
        if($request->hasFile("file_cheque")){
            $destination_path_cheque = 'public/images/cheque';
            $image_cheque = $request->file("file_cheque");
            $file_cheque = $image_cheque->getClientOriginalName();
            $request->file("file_cheque")->storeAs($destination_path_cheque,$file_cheque);
        }
        if($request->hasFile("file_verse")){
            $destination_path_verser = 'public/images/verse';
            $image_verser = $request->file("file_verse");
            $file_verse = $image_verser->getClientOriginalName();
            $request->file("file_verse")->storeAs($destination_path_verser,$file_verse);
        }
        if($request->hasFile("file_autre")){
            $destination_path_autre = 'public/images/autre';
            $image_autre = $request->file("file_autre");
            $file_autre = $image_autre->getClientOriginalName();
            $request->file("file_autre")->storeAs($destination_path_autre,$file_autre);
        }

        $resu = $request->total_vente + $request->online - ($request->total_achat + $request->amana + $request->ghazala);
       $week =  WeekAmount::create([
            "date_debut"=>$start_date,
            "date_fin"=>$end_date,
            "file_ghazala"=>$file_ghazala,
            "file_amana"=>$file_amana,
            "file_cheque"=>$file_cheque,
            "file_verse"=>$file_verse,
            "file_autre"=>$file_autre,
            "montant_amana"=>$request->amana,
            "total_vente"=>$request->total_vente,
            "total_achat"=>$request->total_achat,
            "montant_ghazala"=>$request->ghazala,
            "montant_online"=>$request->online,
            "montant_cheque"=>$request->cheque,
            "montant_autre"=>$request->autre,
            "reste_verser"=>$resu,
            "reste_final"=>$resu - $request->cheque,
            "remarque"=>$request->remarque,

        ]);

        foreach($date_week as $k => $row){
            if(!empty($row)){
               $week->sales()->create([
                    "week_amount_id"=> $week->id,
                    "jour"=>$request->jour[$k],
                    "date_sale"=>date("Y-m-d",strtotime($row)),
                    "montant"=>$request->montant_achat[$k],
                ]);
            }
        }
        foreach($date_week as $k => $row){
            if(!empty($row)){
               $week->purchases()->create([
                    "week_amount_id"=> $week->id,
                    "jour"=>$request->jour[$k],
                    "date_purchase"=>date("Y-m-d",strtotime($row)),
                    "title"=>$request->text[$k] ?? "",
                    "montant"=>$request->montant_achat[$k],
                ]);
            }
        }
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WeekAmount  $weekAmount
     * @return \Illuminate\Http\Response
     */
    public function show(WeekAmount $weekAmount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WeekAmount  $weekAmount
     * @return \Illuminate\Http\Response
     */
    public function edit(WeekAmount $weekAmount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WeekAmount  $weekAmount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WeekAmount $weekAmount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WeekAmount  $weekAmount
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeekAmount $weekAmount,Request $request)
    {
        if(isset($request->force)){
            $weekAmount->forceDelete();
            if (File::exists(storage_path().'/app/public/images/ghazala/'.$weekAmount->file_ghazala)) {
                File::delete(storage_path().'/app/public/images/ghazala/'.$weekAmount->file_ghazala);
            }

            if (File::exists(storage_path().'/app/public/images/amana/'.$weekAmount->file_amana)) {
                File::delete(storage_path().'/app/public/images/amana/'.$weekAmount->file_amana);
            }

            if (File::exists(storage_path().'/app/public/images/cheque/'.$weekAmount->file_cheque)) {
                File::delete(storage_path().'/app/public/images/cheque/'.$weekAmount->file_cheque);
            }

            if (File::exists(storage_path().'/app/public/images/verse/'.$weekAmount->file_verse)) {
                File::delete(storage_path().'/app/public/images/verse/'.$weekAmount->file_verse);
            }

            if (File::exists(storage_path().'/app/public/images/autre/'.$weekAmount->file_autre)) {
                File::delete(storage_path().'/app/public/images/autre/'.$weekAmount->file_autre);
            }
            toast("La suppression du week amount effectuée","success");
        }
        else{
            toast("La déplacement du corbeille du week amount effectuée","success");
            $weekAmount->delete();

        }


        return back();
    }
}
