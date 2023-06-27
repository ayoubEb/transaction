@extends('layouts.master')
@section('content')
@can('vente-semaine-create')
    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#add">
        <span>Nouveau</span>
    </button>

@endcan
    <div class="card">
        <div class="card body p-2">
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
                        @forelse ($week_amounts as $amount)
                        <tr>
                            <td class="align-middle">{{ $amount->date_debut }}</td>
                                <td class="align-middle">{{ $amount->date_fin }}</td>
                                <td class="align-middle">{{ $amount->total_vente }} DH</td>
                                <td class="align-middle">{{ $amount->total_achat }} DH</td>
                                <td class="align-middle">{{ $amount->montant_amana }} DH</td>
                                <td class="align-middle">{{ $amount->montant_ghazala }} DH</td>
                                <td class="align-middle">
                                    @can('vente-semaine-destroy')
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#show{{$amount->id}}">
                                        <span class="mdi mdi-eye-outline"></span>
                                    </button>
                                    @endcan
                                    @can('vente-semaine-show')
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#destroy{{$amount->id}}">
                                            <span class="mdi mdi-trash-can"></span>
                                        </button>
                                    @endcan
                                </td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    @foreach($week_amounts as $amount)
        <div class="modal fade" id="show{{ $amount->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h6 class="modal-title m-0" id="exampleModalCenterTitle">Information du semaine</h6>
                        <button type="button" class="btn bg-transparent p-0" data-dismiss="modal" aria-label="Close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h6 class="m-0 text-center text-uppercase">les achats</h6>
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="row">
                                            @foreach ($amount->sales as $sale)
                                                <div class="col-lg-4 mb-2">
                                                    <h6 class="m-0 font-weight-normal">{{ $sale->jour }}</h6>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <h6 class="m-0 font-weight-normal">{{ $sale->date_sale }}</h6>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <h6 class="m-0 font-weight-normal">{{ $sale->montant }} DH</h6>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h6 class="m-0 text-center text-uppercase">les ventes</h6>
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="row">
                                            @foreach ($amount->purchases as $purchase)
                                                <div class="col-lg-3 mb-2">
                                                    <h6 class="m-0 font-weight-normal">{{ $purchase->jour }}</h6>
                                                </div>
                                                <div class="col-lg-3 mb-2">
                                                    <h6 class="m-0 font-weight-normal">{{ $purchase->title }}</h6>
                                                </div>
                                                <div class="col-lg-3 mb-2">
                                                    <h6 class="m-0 font-weight-normal">{{ $purchase->date_purchase }}</h6>
                                                </div>
                                                <div class="col-lg-3 mb-2">
                                                    <h6 class="m-0 font-weight-normal">{{ $purchase->montant }} DH</h6>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="m-0 text-uppercase text-center">Montant</h6>
                                    </div>
                                    <div class="card-body p-2">
                                        <ul class="list-group mb-2">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <h6 class="m-0">Montant vente</h6>
                                                <h6 class="font-weight-normal m-0">{{ $amount->total_vente }} DH</h6>
                                            </li>
                                            <li class="list-group-item  d-flex justify-content-between">
                                                <h6 class="m-0">Montant achat</h6>
                                                <h6 class="font-weight-normal m-0">{{ $amount->total_achat }} DH</h6>
                                            </li>
                                            <li class="list-group-item  d-flex justify-content-between">
                                                <h6 class="m-0">Montant amana</h6>
                                                <h6 class="font-weight-normal m-0">{{ $amount->montant_amana }} DH</h6>
                                            </li>
                                            <li class="list-group-item  d-flex justify-content-between">
                                                <h6 class="m-0">Montant ghazala</h6>
                                                <h6 class="font-weight-normal m-0">{{ $amount->montant_ghazala }} DH</h6>
                                            </li>
                                            <li class="list-group-item  d-flex justify-content-between">
                                                <h6 class="m-0">Montant chèque</h6>
                                                <h6 class="font-weight-normal m-0">{{ $amount->montant_cheque }} DH</h6>
                                            </li>
                                            <li class="list-group-item  d-flex justify-content-between">
                                                <h6 class="m-0">Montant en ligne</h6>
                                                <h6 class="font-weight-normal m-0">{{ $amount->montant_online }} DH</h6>
                                            </li>
                                            <li class="list-group-item  d-flex justify-content-between">
                                                <h6 class="m-0">Montant reste à verser</h6>
                                                <h6 class="font-weight-normal m-0">{{ $amount->reste_verser }} DH</h6>
                                            </li>
                                            <li class="list-group-item  d-flex justify-content-between">
                                                <h6 class="m-0">Montant final</h6>
                                                <h6 class="font-weight-normal m-0">{{ $amount->reste_final }} DH</h6>
                                            </li>
                                        </ul>

                                        <div class="mb-2">
                                            <h6 class="mb-2 text-center text-uppercase">chèque</h6>
                                            <img src="{{asset('storage/images/cheque/'.$amount->file_cheque)}}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-header bg-success">
                                        <h6 class="m-0 text-uppercase text-center">File</h6>
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h6 class="mb-2 text-center text-uppercase">amana</h6>
                                                <img src="{{asset('storage/images/amana/'.$amount->file_amana)}}" alt="" class="img-fluid">
                                                {{-- <h5 class="m-0 text-center">{{}}</h5> --}}
                                            </div>
                                            <div class="col-lg-4">
                                                <h6 class="mb-2 text-center text-uppercase">ghazala</h6>
                                                <img src="{{asset('storage/images/ghazala/'.$amount->file_ghazala)}}" alt="" class="img-fluid">
                                            </div>
                                            <div class="col-lg-4">
                                                <h6 class="mb-2 text-center text-uppercase">reste à verse</h6>
                                                <img src="{{asset('storage/images/verse/'.$amount->file_verse)}}" alt="" class="img-fluid">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="destroy{{ $amount->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h6 class="modal-title m-0" id="exampleModalCenterTitle">Confirmer la suppression</h6>
                        <button type="button" class="btn bg-transparent p-0" data-dismiss="modal" aria-label="Close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('week-amount.destroy',$amount) }}" method="post">
                            @csrf
                            @method("DELETE")
                            <h6 class="mb-2 text-center">
                                Vous avez supprimer le semaine défenetivement

                            </h6>
                            <div class="row justify-content-center">
                                <div class="col-lg-5">
                                    <button type="submit" class="btn btn-success btn-sm w-100">OUI</button>

                                </div>
                                <div class="col-lg-5">
                                    <button type="button" class="btn btn-danger btn-sm w-100" data-dismiss="modal" aria-label="Close">
                                        NON
                                    </button>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endforeach


    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title m-0" id="exampleModalCenterTitle">Nouveau Vente semaine</h6>
                    <button type="button" class="btn bg-transparent p-0" data-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('week-amount.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h6 class="text-center mb-2">
                            Semaine :
                            <span class="font-weight-normal">
                                {{ date("d-m-Y",strtotime($start_date))}}
                                =>
                                {{ date("d-m-Y",strtotime($end_date))}}
                            </span>
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
                                            <input type="hidden" name="jour[]" value="{{ \App\Models\WeekAmount::day(date("D",strtotime($week))) }}">
                                                <div class="col-lg-4 mb-2">
                                                    {{ \App\Models\WeekAmount::day(date("D",strtotime($week))) }}
                                                </div>
                                                <div class="col-lg-4 mb-2 ">
                                                    {{ date("d-m-Y",strtotime($week)) }}
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
                                                <div class="col-lg-4 d-lg-none mb-2">
                                                    {{ \App\Models\WeekAmount::day(date("D",strtotime($week))) }}
                                                </div>
                                                <div class="col-lg-4 mb-2 ">
                                                    {{ date("d-m-Y",strtotime($week)) }}
                                                </div>
                                                <div class="col-lg-4 mb-2 ">
                                                    <input type="text" name="text_achat[]" id="" class="form-control mt-achat" placeholder="Text">
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <input type="number" name="montant_achat[]" id="" class="form-control mt-achat" step="any" value="0">
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