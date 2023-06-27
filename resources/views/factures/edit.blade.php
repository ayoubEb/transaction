@extends('layouts.master')
@section('content')
{{-- <div class="d-flex justify-content-between align    -items-center mb-2">
    <h5 class="m-0">Edit la facture : {{ $facture->num_facture }}</h5>
    <div class="">
        <button type="button" class="btn btn-primary py-1 px-3" data-bs-toggle="modal" data-bs-target="#ajouter">
            Ajouter autre produit
        </button>
        <button type="button" class="btn btn-primary py-1 px-3" data-bs-toggle="modal" data-bs-target="#ajouter">
            Ajouter une reglement
        </button>

    </div>

</div> --}}
<div class="d-flex justify-content-between mb-2">
    <h5 class="m-0">Modifier la facture : {{ $facture->num_facture ?? '' }} </h5>
    {{-- <div class="">
        <button type="button" class="btn btn-primary py-1 px-3" data-bs-toggle="modal" data-bs-target="#ajouter">
            Ajouter autre produit
        </button>


    </div> --}}
    <ol class="breadcrumb m-0 py-2">
        <li class="text-white fw-bolder">
            <a href="{{ route('home') }}" class="text-white">
                Acceuil
            </a>
        </li>
        @can('facture-list')
            <li class="text-white mx-2 fw-bolder">
                <span class="ti ti-angle-right" style="font-size:0.60rem"></span>
            </li>
            <li class="text-white fw-bolder">
                <a href="{{ route('facture.index') }}" class="text-white">
                    Liste des factures
                </a>
            </li>
        @endcan
        @can('facture-edit')
            <li class="text-white mx-2 fw-bolder">
                <span class="ti ti-angle-right" style="font-size:0.60rem"></span>
            </li>
            <li class="text-white fw-bolder">
                <a href="{{ route('facture.edit',$facture) }}" class="text-white">
                    Modifier la facture : {{ $facture->num_facture ?? '' }}
                </a>
            </li>
        @endcan
    </ol>
</div>
<div class="row row-cols-4">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body py-3 p-0">
                <h6 class="m-0 text-center text-uppercase text-dark">
                    montant ht : {{ $facture->prix_ht ?? '' }} dh
                </h6>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body py-3 p-0">
                <h6 class="m-0 text-center text-uppercase text-dark">
                    montant ttc : {{ $facture->prix_ttc ?? '' }} dh
                </h6>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body py-3 p-0">
                <h6 class="m-0 text-center text-uppercase text-success payer">
                    montant payer : {{ $facture->payer ?? '' }} dh
                </h6>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body py-3 p-0">
                <h6 class="m-0 text-center text-uppercase text-danger">
                    montant reste : {{ $facture->reste ?? '' }} dh
                </h6>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('facture.update',$facture) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row justify-content-center mb-2">
        <div class="col-lg-4">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <label for="" class="form-label m-0">Statut : </label>
                </div>
                <div class="col">
                    <div class="btn-group w-100" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="statut" value="valider" id="btnradio1" autocomplete="off" {{ $facture->statut=='valider' ? 'checked':'' }}>
                        <label class="btn btn-outline-dark shadow-none mb-0" for="btnradio1">Valider</label>
                        <input type="radio" class="btn-check" name="statut" value="en cours" id="btnradio2" autocomplete="off" {{ $facture->statut=='en cours' ? 'checked':'' }}>
                        <label class="btn btn-outline-dark shadow-none mb-0" for="btnradio2">En cours</label>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">

            <div class="card">
                <div class="card-header bg-success py-2px">
                    <h6 class="text-uppercase m-0 title">
                        information général
                    </h6>
                </div>
                <div class="card-body p-2">
                    <div class="row row-cols-lg-2 row-cols-1">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Client</label>
                                <select name="client_id" id="client" class="form-select">
                                    <option value="">Séléctionner le client</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}" {{ $client->id == $facture->client_id ? "selected":"" }}>{{ $client->raison_sociale }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Nom du group</label>
                                <input type="text" name="" id="NGroup" class="form-control" disabled value="{{ $facture->client->group->nom ?? '' }}">
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Remise du group</label>
                                <input type="number" name="" id="RGroup" class="form-control" disabled value="{{ $facture->client->group->remise ?? '' }}">
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Date du facture</label>
                                <input type="date" name="date" id="" class="form-control" value="{{ $facture->date }}">
                            </div>
                        </div>







                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success px-5">Modifier</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-success py-2px">
                    <h6 class="m-0 text-uppercase title">paiement</h6>
                </div>
                <div class="card-body p-2">
                    <div class="row row-cols-2">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">TVA</label>
                                <input type="number" name="tva" id="" class="form-control tva" value="{{ $facture->taux_tva }}">
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Remise</label>
                                <input type="number" name="remise" id="" class="form-control remise" value="{{ $facture->remise ?? '0' }}">
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Montant HT</label>
                                <input type="number" name="total" id="" class="form-control ht" value="{{ $facture->prix_ht }}" readonly>
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Montant TTC</label>
                                <input type="number" name="ttc" id="" class="form-control ttc" value="{{ $facture->prix_ttc }}" readonly>
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Payer</label>
                                <input type="number" id="payerAct" class="form-control" value="{{ $facture->payer }}" readonly>
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Reste</label>
                                <input type="number" name="reste" id="" class="form-control" value="{{ $facture->reste }}" readonly>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</form>


<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header bg-success py-2px">
                <h6 class="m-0 text-uppercase title">les produits du facture</h6>
            </div>
            <div class="card-body p-2">
                <button type="button" class="btn btn-primary btn-sm px-3 mb-2" data-bs-toggle="modal" data-bs-target="#ajouter">
                    Ajouter autre produit
                </button>
                <div class="table-resposnive">
                    <table class="table table-bordered table-sm m-0">
                        <thead>
                            <tr>
                                <th>Référence</th>
                                <th>Désignation</th>
                                <th>Quantite</th>
                                <th>Prix unitaire</th>
                                <th>Remise</th>
                                <th>Montant</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($facture->facture_produit as $produit)
                                <tr>
                                    <td class="align-middle">{{ $produit->reference }}</td>
                                    <td class="align-middle">{{ $produit->designation }}</td>
                                    <td class="align-middle">{{ $produit->quantite }}</td>
                                    <td class="align-middle">{{ $produit->prix_unitaire }} DH</td>
                                    <td class="align-middle">{{ $produit->remise }} %</td>
                                    <td class="align-middle">{{ $produit->montant }} DH</td>
                                    <td class="align-middle">
                                        <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#edit{{ $produit->reference }}">
                                            <i class="mdi mdi-pencil" style="font-size:0.90rem"></i>
                                        </button>
                                        <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#delete{{ $produit->reference }}">
                                            <i class="mdi mdi-trash-can" style="font-size:0.90rem"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header bg-success py-2">
                <h6 class="m-0 title text-uppercase">Historique du paiement</h6>
            </div>
            <div class="card-body p-2">
                <button type="button" class="btn btn-primary btn-sm px-3 mb-2" data-bs-toggle="modal" data-bs-target="#add-reglement">
                    <span class="mdi mdi-plus-circle-outline align-middle">
                        Ajouter une réglement
                    </span>
                </button>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm m-0">
                        <thead class="table-warning">
                            <tr>
                                <th>type du paiement</th>
                                <th>payer</th>
                                <th>reste</th>
                                <th>date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($facture->paiement as $paiement)
                                <tr>
                                    <td class="align-middle">{{ $paiement->type_paiement ?? '' }} </td>
                                    <td class="align-middle">{{ $paiement->payer ?? '' }} DH</td>
                                    <td class="align-middle">{{ $paiement->reste ?? '' }} DH</td>
                                    <td class="align-middle">{{ date('d-m-Y',strtotime($paiement->created_at)) }} </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body p-1">
        @if (Session::has('update-produit'))
            <div class="alert alert-fill-success mb-2" role="alert">
                {{ Session::get('update-produit') }}
            </div>
        @endif



    </div>
</div>






    @foreach ($facture->facture_produit as $produit)
        <div class="modal fade" id="edit{{ $produit->reference }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Modifier de produit : {{ $produit->reference }}</h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('factureProduit.update',$produit) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Référence</label>
                                <input type="text" name="reference" id="" class="form-control" value="{{ $produit->reference }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Désignation</label>
                                <input type="text" name="designation" id="" class="form-control" value="{{ $produit->designation }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Prix unitaire</label>
                                <input type="text" name="prix_unitaire" id="" class="form-control" value="{{ $produit->prix_unitaire }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Quantite</label>
                                <input type="number" name="quantite" id="" min="1" class="form-control" value="{{ $produit->quantite }}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Remise</label>
                                <input type="text" name="remise" id="" class="form-control" value="{{ $produit->remise }}">
                            </div>

                            <div class="d-flex justify-content-center">
                                <div class="card border border-solid border-2 border-success">
                                    <div class="card-body py-2 px-4">
                                        <h6 class="mb-2 text-center text-uppercase">montant ht</h6>
                                        <h5 class="text-center m-0">{{ $facture->prix_ht }} DH</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <button type="submit" class="btn btn-success py-1 px-3">
                                    <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                    <span>Modifier</span>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete{{ $produit->reference }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('factureProduit.destroy',$produit) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <h5 class="mb-3 fw-bolder">Voulez-vous supprimer défenitivement du produit <span class="text-danger">{{ $produit->reference }}</span></h5>
                            <div class="row row-cols-2">
                                <div class="col">
                                    <button type="submit" class="btn btn-success p-3 w-100">
                                        Je confirmer
                                    </button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger p-3 w-100" data-bs-dismiss="modal" aria-label="btn-close">
                                        Annuler
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="ajouter" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title m-0" id="varyingModalLabel">Ajouter des autres produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" id="add" class="btn py-0 px-2 btn-primary mb-2">
                        <i class="mdi mdi-plus-thick"></i>
                    </button>
                    <form action="{{ route('factureProduit.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="facture_id" value="{{ $facture->id }}">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Référence</th>
                                        <th>Désigantion</th>
                                        <th>Prix unitaire</th>
                                        <th>Quantite</th>
                                        <th>Remise</th>
                                        <th>Del</th>
                                    </tr>
                                </thead>
                                <tbody id="product">

                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-success py-1 px-3">
                                <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                <span>Enregistrer</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-reglement" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2 bg-primary">
                    <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter autre réglement</h6>
                    <button type="button" class="btn btn-transparent border-0 text-white p-0" data-bs-dismiss="modal" aria-label="btn-close">
                        <i class="mdi mdi-close-thick"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('facture-paiement.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="facture_id" value="{{ $facture->id ?? '' }}">
                        <div class="row row-cols-3">
                            <div class="col mb-2">
                                <div class="card bg-light">
                                    <div class="card-body py-3 p-0">
                                        <h6 class="m-0 text-uppercase text-center ttc">
                                            montant ttc : {{ $facture->prix_ttc ?? '' }} dh
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="card bg-light">
                                    <div class="card-body py-3 p-0">
                                        <h6 class="m-0 text-uppercase text-success text-center payer">
                                            montant payer : {{ $facture->payer ?? '' }} dh
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="card bg-light">
                                    <div class="card-body py-3 p-0">
                                        <h6 class="m-0 text-uppercase text-danger text-center reste">
                                            montant reste : {{ $facture->reste ?? '' }} dh
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-2">
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Type du paiement</label>
                                    <select name="type" id="" class="form-select">
                                        <option value="">Choisir le type du paiement</option>
                                        <option value="espèce">Espèce</option>
                                        <option value="chèque">Chèque</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Montant TTC</label>
                                    <input type="number" name="" id="ttc" class="form-control" step="any" value="{{ $facture->prix_ttc }}" readonly>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Payer</label>
                                    <input type="number" name="payer" id="payer" class="form-control" step="any" value="{{ $facture->payer }}">
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Reste</label>
                                    <input type="number" name="reste" id="reste" class="form-control" step="any" value="{{ $facture->reste }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-sm btn-success">
                                <span class="mdi mdi-plus-circle-outline align-middle"></span>
                                <span>Enregistrer</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            $(document).on("change","#client",function(){
                let id = $(this).val();
                let out = "";
                $.ajax({
                    type:"GET",
                    url:"{{ route('clientGroup') }}",
                    data:{"id":id},
                    success:function(data){

                        $("#NGroup").val(data.nom);
                        $("#RGroup").val(data.remise);

                    }
                })
            })

            $(document).on("change",".select-produit",function(e){
                let reference = $(this).val();
                $.ajax({
                    type:"GET",
                    url:"{{ route('getProduit') }}",
                    data:{"ref":reference},
                    success:function(data){
                    $(e.target).parent().parent().parent().parent().parent().children('td').children(".reference").prop("disabled",true);
                    $(e.target).parent().parent().parent().parent().parent().children('td').children(".reference").val("");
                    $(e.target).parent().parent().parent().parent().parent().children('td').children(".designation").val(data.designation);
                    $(e.target).parent().parent().parent().parent().parent().children('td').children(".quantite").val(data.quantite);
                    $(e.target).parent().parent().parent().parent().parent().children('td').children(".pu").val(data.prix_unitaire);

                    }
                })
            })
            $(document).on("keyup",".reference",function(e){
                let reference = $(this).val();
                $.ajax({
                    type:"GET",
                    url:"{{ route('facture.create') }}",
                    data:{"ref":reference},
                    success:function(data){
                        if(reference != ''){
                            $(e.target).parent().children(".filter").html(data);
                        }
                        else{
                            $(e.target).parent().children(".filter").html("")
                        }
                        // $.each(data,function(k){

                        // })

                    }
                })
            })

            $(".tva").on("keyup",function(e){
                let tva = parseFloat($(e.target).val());
                let ht = parseFloat($(e.target).parent().parent().parent().children("div").children("div").children(".ht").val());
                let remise = parseFloat($(e.target).parent().parent().parent().children("div").children("div").children(".remise").val());
                let ttc = parseFloat(ht + (ht * (tva / 100))).toFixed(2);
                let montantRemise = parseFloat(ht * ( 1 - (remise/100))).toFixed(2);


                if(tva != 0 || tva != ''){
                    $(e.target).parent().parent().parent().children("div").children("div").children(".ttc").val(ttc);
                    if(remise != '' || remise != 0){
                        $(e.target).parent().parent().parent().children("div").children("div").children(".ttc").val(montantRemise);

                    }
                }
                else{
                    $(e.target).parent().parent().parent().children("div").children("div").children(".ttc").val(ht);

                }

            })

            $('#add').on('click',function(){
                var html="";
                html+='<tr>';
                html+='<td class="align-middle"><input type="text" name="reference[]" id="" class="form-control form-control-sm reference">'
                   html += '<div class="filter"></div>';
                html += '</td>';
                html+='<td class="align-middle"><input type="text" name="designation[]" id="" class="form-control form-control-sm designation"></td>';
                html+='<td class="align-middle"><input type="number" name="quantite[]" min=1 id="" class="form-control form-control-sm quantite"></td>';
                html+='<td class="align-middle"><input type="text" name="prix_unitaire[]" id="" class="form-control form-control-sm pu"></td>';
                html+='<td class="align-middle"><input type="text" name="remise[]" value="0" id="" class="form-control form-control-sm"></td>';
                html+='<td class="align-middle"><button type="button" class="btn text-danger p-0 border-0" id="remove_btn"><span class="mdi mdi-trash-can fw-bolder"></span></button></td></td>';
                html+='</tr>';
                $('#product').append(html);
            });


            $("#payer").on("keyup",function(){
                let payer = $(this).val();
                let ttc = $("#ttc").val();
                let payer_act = $("#payerAct").val();
                $("#reste").val(ttc - payer);
                $(".payer").html('montant payer : ' + (payer + payer_act) + ' dh');
                $(".reste").html('montant reste : ' + (ttc - (payer + payer_act)) + ' dh');

            })
        })
        $(document).on('click','#remove_btn',function() {
            $(this).closest('tr').remove();
        })
    </script>
@endsection