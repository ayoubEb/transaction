@extends('layouts.master')
@section('content')
<div class="card week">
    <div class="card-body p-2">
        {{-- @if (date("Y-m-d")<)

        @endif --}}
        @php

        @endphp
            <div class="row">
                <div class="col-lg-4">
                    @can('vente-semaine-create')
                        <form action="{{ route('generer') }}" method="post">
                            @csrf
                            <div class="form-group mb-2">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <select name="month" id="" class="form-control select2">
                                            <option value="1" {{\app\Models\WeekAmount::whereMonth("date_fin",'1')->first() ? 'disabled':''}}>Janvier</option>
                                            <option value="2" {{\app\Models\WeekAmount::whereMonth("date_fin",'2')->first() ? 'disabled':''}}>Février</option>
                                            <option value="3" {{\app\Models\WeekAmount::whereMonth("date_fin",'3')->first() ? 'disabled':''}}>mars</option>
                                            <option value="4" {{\app\Models\WeekAmount::whereMonth("date_fin",'4')->first() ? 'disabled':''}}>Avril</option>
                                            <option value="5" {{\app\Models\WeekAmount::whereMonth("date_fin",'5')->first() ? 'disabled':''}}>Mai</option>
                                            <option value="6" {{\app\Models\WeekAmount::whereMonth("date_fin",'6')->first() ? 'disabled':''}}>Juin</option>
                                            <option value="7" {{\app\Models\WeekAmount::whereMonth("date_fin",'7')->first() ? 'disabled':''}}>Juillet</option>
                                            <option value="8" {{\app\Models\WeekAmount::whereMonth("date_fin",'8')->first() ? 'disabled':''}}>Août</option>
                                            <option value="9" {{\app\Models\WeekAmount::whereMonth("date_fin",'9')->first() ? 'disabled':''}}>Septembre</option>
                                            <option value="10" {{\app\Models\WeekAmount::whereMonth("date_fin",'10')->first() ? 'disabled':''}}>October</option>
                                            <option value="11" {{\app\Models\WeekAmount::whereMonth("date_fin",'11')->first() ? 'disabled':''}}>November</option>
                                            <option value="12" {{\app\Models\WeekAmount::whereMonth("date_fin",'12')->first() ? 'disabled':''}}>December</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-info text-uppercase fs-12 h-100 w-100">
                                            <span>générer</span>
                                        </button>

                                    </div>
                                </div>

                            </div>

                        </form>
                    @endcan
                </div>
            </div>





            <div class="table-responsive">
                <table class="table table-bordered table-sm m-0">
                    <thead>
                        <tr>
                            <th>date début</th>
                            <th>date fin</th>
                            <th>total (vente)</th>
                            <th>total (achat)</th>
                            <th>montant amana</th>
                            <th>montant ghazala</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($weeks as $week)
                        <tr>
                            <td class="align-middle"> {{ $week->date_debut }} </td>
                            <td class="align-middle"> {{ $week->date_fin }} </td>
                            <td class="align-middle"> {{ $week->total_vente ?? 0 }} DH</td>
                            <td class="align-middle"> {{ $week->total_achat ?? 0 }} DH </td>
                            <td class="align-middle"> {{ $week->montant_amana ?? 0 }} DH </td>
                            <td class="align-middle"> {{ $week->montant_ghazala ?? 0 }} DH </td>
                            <td class="align-middle">
                                @if (count($week->sales) > 0 && count($week->purchases) > 0)
                                    @can('vente-semaine-create')
                                        <button type="button" class="btn btn-success p-0 px-1" data-bs-toggle="modal" data-bs-target="#show{{$week->id}}">
                                            <span class="mdi mdi-check-bold"></span>
                                        </button>
                                    @endcan

                                @else
                                    @can('vente-semaine-create')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#add{{$week->id}}">
                                            <span>Nouveau</span>
                                        </button>
                                    @endcan
                                @endif
                            </td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@foreach ($weeks as $week)
    <div class="modal fade" id="add{{ $week->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title m-0" id="exampleModalCenterTitle">Nouveau Vente semaine</h6>
                    <button type="button" class="btn bg-transparent p-0" data-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                        $begin = new DateTime($week->date_debut);
                        $end = new DateTime($week->date_fin);
                        $interval = DateInterval::createFromDateString('1 day');
                        $date_week = new DatePeriod($begin, $interval, $end);

                        // foreach ($period as $dt) {

                        //     echo $dt->format("l Y-m-d H:i:s\n");
                        // }
                    @endphp


                    <form action="{{route('week-amount.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="week" value="{{ $week->id }}">
                        <h6 class="text-center mb-2">
                            Semaine :

                        </h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h6 class="font-weight-normal m-0 text-white text-uppercase text-center">les ventes</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">

                                            @foreach ($date_week as $week)
                                                <input type="hidden" name="jour[]" value="{{ \App\Models\WeekAmount::day($week->format("D")) }}">
                                                <div class="col-lg-4 mb-2">
                                                    {{ \App\Models\WeekAmount::day($week->format("D")) }}
                                                </div>
                                                <div class="col-lg-4 mb-2 ">
                                                    {{ $week->format("d-m-Y") }}
                                                    <input type="hidden" name="date_week[]" value="{{ $week->format("d-m-Y") }}">
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <input type="number" name="montant_vente[]" id="" class="form-control mt-vente" min="0" step="any" value="0">
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <h6 class="m-0">En ligne</h6>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="number" name="online" id="mt-online" class="form-control" min="0" step="any" value="0">
                                            </div>
                                        </div>


                                        <div class="row mb-2">
                                            <div class="col-lg-3 d-flex align-items-center">
                                                <h6 class="m-0">Total Vente</h6>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="total_vente" id="total-vente" class="form-control" step="any" min="0" readonly value="0">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="total-online" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <h6 class="my-3 text-center">Amana</h6>
                                        <div class="row mb-2">
                                            <div class="col-lg-6">
                                                <input type="number" name="amana" class="form-control" step="any" min="0" id="mt-amana" value="0">

                                            </div>
                                            <div class="col-lg-6">
                                                <input type="file" name="file_amana" class="form-control">
                                            </div>
                                        </div>
                                        <h6 class="my-3 text-center">ghazala</h6>
                                        <div class="row mb-2">

                                            <div class="col-lg-6">
                                                <input type="number" name="ghazala" class="form-control" step="any" min="0" id="mt-ghazala" value="0" >

                                            </div>
                                            <div class="col-lg-6">
                                                    <input type="file" name="file_ghazala" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h6 class="font-weight-normal m-0 text-white text-uppercase text-center">les achats</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            @foreach ($date_week as $week)


                                                {{-- <div class="col-lg-4 mb-2">
                                                    {{ \App\Models\WeekAmount::day($week->format("D")) }}
                                                </div> --}}
                                                <div class="col-lg-4 mb-2 ">
                                                    {{ $week->format("d-m-Y") }}
                                                    <input type="hidden" name="date_week[]" value="{{ $week->format("d-m-Y") }}">
                                                </div>
                                                <div class="col-lg-4 mb-2 ">
                                                    <input type="text" name="text_achat[]" id="" class="form-control mt-achat" placeholder="Text">
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <input type="number" name="montant_achat[]" id="" class="form-control mt-achat" min="0" step="any" value="0">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3 d-flex align-items-center">
                                                <h6 class="m-0">Total Achat</h6>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="total_achat" id="total-achat" class="form-control" step="any"  readonly value="0">
                                            </div>
                                        </div>
                                        <h6 class="my-3 text-center">Reste à chèque</h6>
                                        <div class="row mb-2">
                                            <div class="col-lg-6">
                                                <input type="number" name="cheque" id="mt-cheque" class="form-control" step="any" value="0">
                                            </div>
                                            <div class="col-lg-6">

                                                <input type="file" name="file_cheque" class="form-control">
                                            </div>
                                        </div>
                                        <h6 class="my-3 text-center">Reste à verser</h6>
                                        <div class="row mb-2">

                                            <div class="col-lg-6">
                                                <input type="number" name="" class="form-control" step="any" id="reste" value="0" readonly>

                                            </div>
                                            <div class="col-lg-6">

                                                <input type="file" name="file_verse" class="form-control">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-4">
                                            <h5 class="m-2">Montant final</h5>
                                            <h5 class="m-0 text-success" id="result-final">0 DH</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">Save </button>
                    </form>
                </div>
            </div>
        </div>
    </div>





@endforeach
@foreach ($amounts as $amount)
<div class="modal fade" id="show{{ $amount->id ?? '' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">{{ $amount->id ?? '' }}</h6>
                <button type="button" class="btn bg-transparent p-0" data-dismiss="modal" aria-label="Close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#achats{{ $amount->id }}"
                            role="tab">achats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#ventes{{ $amount->id }}"" role="tab">vente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#autre{{ $amount->id }}""
                            role="tab">autre</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active p-1" id="achats{{ $amount->id }}" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm m-0">
                                <thead>
                                    <tr>
                                        <th>jour</th>
                                        <th>date</th>
                                        <th>montant</th>
                                        <th>title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amount->purchases as $purchase)
                                        <tr>
                                            <td class="align-middle"> {{ $purchase->jour ?? '' }} </td>
                                            <td class="align-middle"> {{ $purchase->date_purchase ?? '' }} </td>
                                            <td class="align-middle"> {{ $purchase->montant ?? '' }} DH</td>
                                            <td class="align-middle"> {{ $purchase->title ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="ventes{{ $amount->id }}" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm m-0">
                                <thead>
                                    <tr>
                                        <th>jour</th>
                                        <th>date</th>
                                        <th>montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($amount->sales as $sale)
                                        <tr>
                                            <td class="align-middle"> {{ $sale->jour ?? '' }} </td>
                                            <td class="align-middle"> {{ $sale->date_sale ?? '' }} </td>
                                            <td class="align-middle"> {{ $sale->montant ?? '' }} DH</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="autre{{ $amount->id }}"" role="tabpanel">
                        <div class="row row-cols-4">
                            <div class="col">
                                <div class="card m-0">
                                    <div class="card-body py-2 p-0">
                                        <h6 class="m-0 text-uppercase text-center fs-12">
                                            montant ghazala : {{ $amount->montant_ghazala }} dh
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card m-0">
                                    <div class="card-body py-2 p-0">
                                        <h6 class="m-0 text-uppercase text-center fs-12">
                                            montant amana : {{ $amount->montant_amana }} dh
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card m-0">
                                    <div class="card-body py-2 p-0">
                                        <h6 class="m-0 text-uppercase text-center fs-12">
                                            montant chèque : {{ $amount->montant_cheque }} dh
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card m-0">
                                    <div class="card-body py-2 p-0">
                                        <h6 class="m-0 text-uppercase text-center fs-12">
                                            montant online : {{ $amount->montant_online }} dh
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">

                        </div>
                    </div>

                </div>

                {{-- @foreach ($item->purchases as $im)
                    {{$im->jour ?? '' }}
                @endforeach --}}
            </div>
        </div>
    </div>
</div>

@endforeach
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(".mt-vente").on("keyup",function(e){
                let montant_online = parseFloat($("#mt-online").val());
                var sum_vente = 0;
                $('.mt-vente').each(function(){
                    sum_vente += +$(this).val();
                    $('#total-vente').val(sum_vente);
                })

                // let montant_online = $("#mt-online").val();

                let total_vente =parseFloat($("#total-vente").val());
                let total_achat =parseFloat($("#total-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                let reste = (total_vente +  montant_online)  - (total_achat + montant_amana + montant_ghazala);
                $("#reste").val(reste);
                $("#total-online").val(montant_online + reste);
                $("#result-final").html(reste - montant_cheque + " DH " );
            })

            $("#mt-online").on("keyup",function(){

                let total_vente =parseFloat($("#total-vente").val());
                let total_achat =parseFloat($("#total-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_online =parseFloat($("#mt-online").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                $("#total-online").val(montant_online + total_vente);
                let reste = (montant_online + total_vente)  - (total_achat + montant_amana + montant_ghazala);
                $("#reste").val(reste);
                $("#result-final").html(reste - montant_cheque + " DH " );


            })


            $("#mt-amana").on("keyup",function(){

                let total_vente =parseFloat($("#total-vente").val());
                let total_achat =parseFloat($("#total-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_online =parseFloat($("#mt-online").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                let reste = (montant_online + total_vente)  - (total_achat + montant_amana + montant_ghazala);
                $("#reste").val(reste);
                $("#result-final").html(reste - montant_cheque + " DH " );

            })
            $("#mt-ghazala").on("keyup",function(){

                let total_vente =parseFloat($("#total-vente").val());
                let total_achat =parseFloat($("#total-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_online =parseFloat($("#mt-online").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                let reste = (montant_online + total_vente)  - (total_achat + montant_amana + montant_ghazala);
                $("#reste").val(reste);
                $("#result-final").html(reste - montant_cheque + " DH " );

            })


            $(".mt-achat").on("keyup",function(e){

                var sum_achat = 0;

                $('.mt-achat').each(function(){
                    sum_achat += +$(this).val();
                    $('#total-achat').val(sum_achat);
                })
                let total_vente =parseFloat($("#total-vente").val());
                let total_achat =parseFloat($("#total-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_online =parseFloat($("#mt-online").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                let reste = (total_vente + montant_online) - (total_achat + montant_amana + montant_ghazala);
                $("#reste").val(reste);
                $("#result-final").html(reste - montant_cheque + " DH " );
            })

            $("#mt-cheque").on("keyup",function(){


                let total_vente =parseFloat($("#total-vente").val());
                let total_achat =parseFloat($("#total-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_online =parseFloat($("#mt-online").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                let reste =parseFloat($("#reste").val());

                $("#result-final").html(reste - montant_cheque + " DH " );
            })


        })
    </script>
@endsection