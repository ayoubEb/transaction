@extends('layouts.master')
@section('title')
    Liste des ventes du semaine
@endsection
@section('content')
@include('sweetalert::alert')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Liste des ventes du semaine
        </li>
    </ol>
</nav>
<div class="card">
    <div class="card-body p-2">
        @can('venteSemaine-create')
            @if($deja == 0)
                <button type="button" class="btn btn-primary px-3 mb-2 text-uppercase fw-bolder" data-bs-toggle="modal" data-bs-target="#add">
                    Nouveau
                </button>
            @endif
        @endcan
        <div class="table-responsive">
            <table class="table table-bordered table-sm m-0 datatable">
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
                                @can('venteSemaine-show')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#show{{ $amount->id }}">
                                        <i class="ti-eye" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                                @can('venteSemaine-destroy')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#destroy{{ $amount->id }}">
                                        <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <h6 class="m-0 text-center text-danger">Aucun vente du semaine</h6>
                        </td>
                    </tr>
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
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="exampleModalCenterTitle">Information du semaine</h6>
                        <button type="button" class="btn bg-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="Close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-uppercase mb-3 text-center w-100 text-primary">le {{ $amount->date_debut }} à {{ $amount->date_fin }} </h6>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm m-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center bg-success" colspan="3">les ventes</th>
                                            </tr>
                                            <tr class="table-success">
                                                <th>jours</th>
                                                <th>date</th>
                                                <th>montant</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($amount->sales as $sale)
                                                <tr>
                                                    <td class="align-middle"> {{ $sale->jour }} </td>
                                                    <td class="align-middle"> {{ $sale->date_sale }} </td>
                                                    <td class="align-middle"> {{ $sale->montant ?? 0 }} DH</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm m-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center bg-success" colspan="3">les achats</th>
                                            </tr>
                                            <tr class="table-success">
                                                <th>jours</th>
                                                <th>date</th>
                                                <th>montant</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($amount->purchases as $purchase)
                                                <tr>
                                                    <td class="align-middle"> {{ $purchase->jour }} </td>
                                                    <td class="align-middle"> {{ $purchase->date_purchase }} </td>
                                                    <td class="align-middle"> {{ $purchase->montant ?? 0 }} DH</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-md-2 row-cols-1">
                            <h6 class="text-uppercase my-3 text-center w-100 text-primary">montant</h6>
                            <div class="col mb-2">
                                <ul class="list-group">
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
                                </ul>
                            </div>

                            <div class="col mb-2">
                                <ul class="list-group">
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

                            </div>
                        </div>
                        <div class="row row-cols-4 row-cols-1">
                            <h6 class="text-uppercase my-3 text-center w-100 text-primary">les fiches</h6>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <h6 class="mb-2 text-center text-uppercase">amana</h6>
                                        <img src="{{asset('storage/images/amana/'.$amount->file_amana)}}" alt="" class="img-fluid">
                                    </div>
                                </div>

                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <h6 class="mb-2 text-center text-uppercase">ghazala</h6>
                                        <img src="{{asset('storage/images/ghazala/'.$amount->file_ghazala)}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <h6 class="mb-2 text-center text-uppercase">reste à verse</h6>
                                        <img src="{{asset('storage/images/verse/'.$amount->file_verse)}}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <h6 class="mb-2 text-center text-uppercase">chèque</h6>
                                        <img src="{{asset('storage/images/cheque/'.$amount->file_cheque)}}" alt="" class="img-fluid">
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
                        <button type="button" class="btn bg-transparent p-0 border-0" data-bs-dismiss="modal" aria-label="Close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('week-amount.destroy',$amount) }}" method="post">
                            @csrf
                            @method("DELETE")
                            <h6 class="mb-2 text-center text-muted">
                                Voulez-vous vraiment déplacer du vente de semaine vers la corbeille
                            </h6>
                            <div class="d-flex justify-content-center mb-2" >
                                <div class="form-check">
                                    <input type="checkbox" name="force" id="del{{$amount->id}}" class="form-check-input">
                                    <label for="del{{$amount->id}}" class="form-check-label fw-bolder">Ignorer la corbeille et supprimer définitivement du vente de semaine</label>
                                </div>

                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-5">
                                    <button type="submit" class="btn btn-success btn-sm w-100">OUI</button>
                                </div>
                                <div class="col-lg-5">
                                    <button type="button" class="btn btn-danger btn-sm w-100" data-bs-dismiss="modal" aria-label="Close">
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
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title m-0" id="exampleModalCenterTitle">Nouveau Vente semaine</h6>
                    <button type="button" class="btn bg-transparent p-0" data-bs-dismiss="modal" aria-label="Close">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-sm m-0">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="table-dark text-center border border-2 border-bottom-0 border-solid border-dark">jours / date</th>
                                        <th colspan="1" class="table-success text-center border border-2 border-bottom-0 border-start-0 border-solid border-success">vente</th>
                                        <th colspan="2" class="table-warning text-center border border-2 border-bottom-0 border-start-0 border-solid border-warning">achat</th>
                                    </tr>
                                    <tr>
                                        <th class="border border-2 border-top-0 border-end-0 border-solid border-dark">jours</th>
                                        <th class="border border-2 border-top-0 border-start-0 border-solid border-dark">date</th>
                                        <th class="border border-2 border-top-0 border-start-0 border-solid border-success">montant</th>
                                        <th class="border border-2 border-top-0 border-end-0 border-solid border-warning">montant</th>
                                        <th class="border border-2 border-top-0 border-start-0 border-solid border-warning">text</th>
                                    </tr>
                                </thead>
                                <tbody class="border border-2 border-start-0 border-top-0 border-end-0 border-solid border-primary">
                                    @foreach ($date_week as $week)
                                        <input type="hidden" name="jour[]" value="{{ \App\Models\WeekAmount::day(date("D",strtotime($week))) }}">
                                        <tr>
                                            <td class="align-middle border border-2 border-bottom-0 border-top-0 border-end-0 border-solid border-dark">
                                                {{ \App\Models\WeekAmount::day(date("D",strtotime($week))) }}
                                            </td>
                                            <td class="align-middle border border-2 border-bottom-0 border-top-0 border-start-0 border-solid border-dark"">
                                                {{ date("d-m-Y",strtotime($week)) }}
                                            </td>
                                            <td class="align-middle border border-2 border-bottom-0 border-top-0 border-start-0 border-solid border-success">
                                                <input type="number" name="montant_vente[]" id="" class="form-control form-control-sm mt-vente" min="0" step="any" value="0">
                                            </td>
                                            <td class="align-middle border-0">
                                                <input type="number" name="montant_achat[]" id="" class="form-control form-control-sm mt-achat" min="0" step="any" value="0">
                                            </td>
                                            <td class="align-middle border border-2 border-bottom-0 border-top-0 border-start-0 border-solid border-warning">
                                                <input type="text" name="text_achat[]" id="" class="form-control form-control-sm" placeholder="Text">
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card m-0">

                                    <div class="card-body p-2">


                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <h6 class="m-0">En ligne</h6>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="number" name="online" id="mt-online" class="form-control form-control-sm" min="0" step="any" value="0">
                                            </div>
                                        </div>


                                        <div class="row mb-2">
                                            <div class="col-lg-3 d-flex align-items-center">
                                                <h6 class="m-0">total Vente</h6>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="total_vente" id="tal-vente" class="form-control form-control-sm" step="any" min="0" readonly value="0">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="tal-online" class="form-control form-control-sm" disabled>
                                            </div>
                                        </div>
                                        <h6 class="my-3 text-center text-uppercase">Amana & ghazala & autre</h6>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm m-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="align-middle">amana</th>
                                                        <td class="align-middle">
                                                            <input type="number" name="amana" class="form-control form-control-sm" step="any" min="0" id="mt-amana" value="0">
                                                        </td>
                                                        <td class="align-middle">
                                                            <input type="file" name="file_amana" class="form-control form-control-sm">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle">ghazala</th>
                                                        <td class="align-middle">
                                                            <input type="number" name="ghazala" class="form-control form-control-sm" step="any" min="0" id="mt-ghazala" value="0">
                                                        </td>
                                                        <td class="align-middle">
                                                            <input type="file" name="file_ghazala" class="form-control form-control-sm">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle">autre</th>
                                                        <td class="align-middle">
                                                            <input type="number" name="autre" class="form-control form-control-sm" step="any" min="0" id="mt-autre" value="0" >
                                                        </td>
                                                        <td class="align-middle">
                                                            <input type="file" name="file_autre" class="form-control form-control-sm">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>




                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card m-0">

                                    <div class="card-body">

                                        <div class="row mb-3">
                                            <div class="col-lg-3 d-flex align-items-center">
                                                <h6 class="m-0">total Achat</h6>
                                            </div>
                                            <div class="col">
                                                <input type="number" name="total_achat" id="tal-achat" class="form-control form-control-sm" step="any"  readonly value="0">
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm m-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="align-middle">r.chèque</th>
                                                        <td class="align-middle">
                                                            <input type="number" name="cheque" id="mt-cheque" class="form-control form-control-sm" step="any" value="0">
                                                        </td>
                                                        <td class="align-middle">
                                                            <input type="file" name="file_cheque" class="form-control form-control-sm">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle">r.verser</th>
                                                        <td class="align-middle">
                                                            <input type="number" name="" class="form-control form-control-sm" step="any" id="reste" value="0" readonly>
                                                        </td>
                                                        <td class="align-middle">
                                                            <input type="file" name="file_verse" class="form-control form-control-sm">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">
                                            <h5 class="m-2">Montant final</h5>
                                            <h5 class="m-0 text-success" id="result-final">0 DH</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Remarque</label>
                            <textarea name="remarque" id="" rows="3" class="form-control form-control-sm" style="resize: none"></textarea>
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
                    $('#tal-vente').val(sum_vente);
                })

                // let montant_online = $("#mt-online").val();

                let tal_vente =parseFloat($("#tal-vente").val());
                let tal_achat =parseFloat($("#tal-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_autre =parseFloat($("#mt-autre").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                let reste = (tal_vente +  montant_online)  - (tal_achat + montant_amana + montant_ghazala + montant_autre);
                $("#reste").val(reste);
                $("#tal-online").val(montant_online + reste);
                $("#result-final").html(reste - montant_cheque + " DH " );
            })

            $("#mt-online").on("keyup",function(){

                let tal_vente =parseFloat($("#tal-vente").val());
                let tal_achat =parseFloat($("#tal-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_autre =parseFloat($("#mt-autre").val());
                let montant_online =parseFloat($("#mt-online").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                $("#tal-online").val(montant_online + tal_vente);
                let reste = (montant_online + tal_vente)  - (tal_achat + montant_amana + montant_ghazala + montant_autre);
                $("#reste").val(reste);
                $("#result-final").html(reste - montant_cheque + " DH " );


            })


            $("#mt-amana").on("keyup",function(){

                let tal_vente =parseFloat($("#tal-vente").val());
                let tal_achat =parseFloat($("#tal-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_autre =parseFloat($("#mt-autre").val());
                let montant_online =parseFloat($("#mt-online").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                let reste = (montant_online + tal_vente)  - (tal_achat + montant_amana + montant_ghazala + montant_autre);
                $("#reste").val(reste);
                $("#result-final").html(reste - montant_cheque + " DH " );

            })
            $("#mt-ghazala").on("keyup",function(){

                let tal_vente =parseFloat($("#tal-vente").val());
                let tal_achat =parseFloat($("#tal-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_autre =parseFloat($("#mt-autre").val());
                let montant_online =parseFloat($("#mt-online").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                let reste = (montant_online + tal_vente)  - (tal_achat + montant_amana + montant_ghazala + montant_autre);
                $("#reste").val(reste);
                $("#result-final").html(reste - montant_cheque + " DH " );

            })


            $(".mt-achat").on("keyup",function(e){

                var sum_achat = 0;

                $('.mt-achat').each(function(){
                    sum_achat += +$(this).val();
                    $('#tal-achat').val(sum_achat);
                })
                let tal_vente =parseFloat($("#tal-vente").val());
                let tal_achat =parseFloat($("#tal-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_autre =parseFloat($("#mt-autre").val());
                let montant_online =parseFloat($("#mt-online").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                let reste = (tal_vente + montant_online) - (tal_achat + montant_amana + montant_ghazala);
                $("#reste").val(reste);
                $("#result-final").html(reste - montant_cheque + " DH " );
            })

            $("#mt-cheque").on("keyup",function(){


                let tal_vente =parseFloat($("#tal-vente").val());
                let tal_achat =parseFloat($("#tal-achat").val());
                let montant_amana =parseFloat($("#mt-amana").val());
                let montant_ghazala =parseFloat($("#mt-ghazala").val());
                let montant_autre =parseFloat($("#mt-autre").val());
                let montant_online =parseFloat($("#mt-online").val());
                let montant_cheque =parseFloat($("#mt-cheque").val());
                let reste =parseFloat($("#reste").val());

                $("#result-final").html(reste - montant_cheque + " DH " );
            })


        })
    </script>
@endsection