@extends('layouts.master')
@section('content')

<div class="d-flex justify-content-between mb-2">
    <h5 class="m-0">Modifier la facture : {{ $facture->num_facture ?? '' }} </h5>
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


    <div class="row">
        <div class="col-lg-4">
            <form action="{{ route('facture.update',$facture) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header bg-success py-2px">
                        <h6 class="text-uppercase m-0 title">
                            information général
                        </h6>
                    </div>
                    <div class="card-body p-2">


                        <div class="form-group mb-2">
                            <label for="" class="form-label">Client</label>
                            <select name="client_id" id="client" class="form-select">
                                <option value="">Séléctionner le client</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ $client->id == $facture->client_id ? "selected":"" }}>{{ $client->raison_sociale }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="" class="form-label">Nom du group</label>
                            <input type="text" name="" id="NGroup" class="form-control" disabled value="{{ $facture->client->group->nom ?? '' }}">
                        </div>



                        <div class="form-group mb-2">
                            <label for="" class="form-label">Remise du group</label>
                            <input type="number" name="" id="RGroup" class="form-control" disabled value="{{ $facture->client->group->remise ?? '' }}">
                        </div>



                        <div class="form-group mb-2">
                            <label for="" class="form-label">Date du facture</label>
                            <input type="date" name="date" id="" class="form-control" value="{{ $facture->date }}">
                        </div>

                        <div class="form-group mb-2">
                            <label for="" class="form-label">TVA</label>
                            <input type="number" name="tva" id="tva" class="form-control " value="{{ $facture->taux_tva }}">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success px-5">Modifier</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-success py-2px">
                    <h6 class="m-0 text-uppercase title">les produits du facture</h6>
                </div>
                <div class="card-body p-2">
                    @can('facture-produit-create')
                        <button type="button" class="btn btn-sm py-2px btn-primary" data-bs-toggle="modal" data-bs-target="#ajouter">
                            <i class="mdi mdi-plus-circle-outline align-middle"></i>
                            <span>Ajouter autre produits</span>
                        </button>
                    @endcan
                    <div class="table-resposnive">
                        <table class="table table-bordered table-sm m-0">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Désignation</th>
                                    <th>Quantite</th>
                                    <th>Prix vente</th>
                                    <th>Remise</th>
                                    <th>Montant</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($facture->produits as $facture_produit)
                                    <tr>
                                        <td class="align-middle">{{ $facture_produit->produit->reference  }}</td>
                                        <td class="align-middle">{{ $facture_produit->produit->designation }}</td>
                                        <td class="align-middle">{{ $facture_produit->quantite }}</td>
                                        <td class="align-middle">{{ $facture_produit->produit->prix_vente }} DH</td>
                                        <td class="align-middle">{{ $facture_produit->remise }} %</td>
                                        <td class="align-middle">{{ $facture_produit->montant }} DH</td>
                                        <td class="align-middle">
                                  
                                                @can('facture-produit-edit')
                                                    <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#edit{{ $facture_produit->reference }}">
                                                        <i class="mdi mdi-pencil" style="font-size:0.90rem"></i>
                                                    </button>
                                                @endcan
                                                @can('facture-produit-destroy')
                                                    <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#delete{{ $facture_produit->reference }}">
                                                        <i class="mdi mdi-trash-can" style="font-size:0.90rem"></i>
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
        </div>
    </div>










    @foreach ($facture->produits as $facture_produit)
        <div class="modal fade" id="edit{{ $facture_produit->reference }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Modifier le produit du facture : {{ $facture_produit->facture->num_facture ?? '' }}</h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body p-2">
                        <form action="{{ route('factureProduit.update',$facture_produit) }}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Produits</label>
                                <select name="produit_u" id="" class="form-select">
                                    <option value="">Choisir le produit</option>
                                    @foreach ($produits as $produit)
                                        <option value="{{ $produit->id }}" {{ $facture_produit->produit_id == $produit->id ? "selected":"" }}> {{ $produit->reference }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Prix vente</label>
                                <input type="number" id="" name="pv" class="form-control pvEdit" step="any" min="0" value="{{ $facture_produit->produit->prix_vente }}" readonly>
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Montant</label>
                                <input type="number" id="" name="montant_u" class="form-control montantEdit" step="any" min="0" value="{{ $facture_produit->montant }}" readonly>
                            </div>


                            <div class="form-group mb-2">
                                <label for="" class="form-label">Quantite</label>
                                <input type="number" id="" name="quantite_u" class="form-control quantiteEdit" step="any" min="0" value="{{ $facture_produit->quantite ?? '' }}" >
                            </div>

                            <div class="form-group mb-2">
                                <label for="" class="form-label">Remise</label>
                                <input type="number" id="" name="remise_u" class="form-control remiseEdit" step="any" min="0" value="{{ $facture_produit->remise ?? '' }}" >
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-sm btn-success px-3">
                                    <span class="mdi mdi-check-bold align-middle"></span>
                                    <span>Enregistrer</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="delete{{ $facture_produit->reference }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('factureProduit.destroy',$facture_produit) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>
                            <h6 class="mb-2 fw-bolder text-center text-muted">Voulez-vous supprimer défenitivement du produit</h6>
                            <h6 class="text-danger mb-2 text-center">{{ $produit->reference }}</h6>

                            @foreach ($facture_produit->produit->stock->history as $i)
                                @if ( $i->fonction == "qte_sortie" && $i->created_at == $facture_produit->created_at)
                                {{ $i->quantite ?? ''}}
                                @endif
                            @endforeach
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary px-5 fw-bolder py-2 me-2">
                                    Je confirme
                                </button>
                                <button type="button" class="btn btn-light px-5 py-2 fw-bolder" data-bs-dismiss="modal" aria-label="btn-close" style="background:#CEAD6D">
                                    Annuler
                                </button>
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
                    <h6 class="modal-title m-0" id="varyingModalLabel">Ajouter des autres produit</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">

                            <div class="table-responsive mb-2">
                                <table class="table table-bordered table-sm m-0">
                                    <thead>
                                        <tr class="bg-secondary">
                                            <th colspan="5" class="text-center text-white">actuel</th>
                                        </tr>
                                        <tr>
                                            <th colspan="">ttc</th>
                                            <th colspan="">ht</th>
                                            <th colspan="">nombre produits</th>
                                            <th colspan="">remise</th>
                                            <th colspan="">tva</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle fs-12 fw-bolder"> {{ $facture->prix_ttc }} DH</td>
                                            <td class="align-middle fs-12 fw-bolder">
                                                {{ $facture->prix_ht }} DH
                                                <input type="hidden" name="" value="{{ $facture->prix_ht }}">

                                            </td>
                                            <td class="align-middle fs-12 fw-bolder"> {{ count($facture->produits) }}</td>
                                            <td class="align-middle fs-12 fw-bolder">
                                                {{ $facture->remise }} %

                                            </td>
                                            <td class="align-middle fs-12 fw-bolder">

                                                {{ $facture->taux_tva }} %
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>



                    <div class="row row-cols-2 justify-content-center">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm m-0" id="new">
                                    <thead>
                                        <tr class="bg-secondary">
                                            <th colspan="4" class="text-center text-white">nouveau</th>
                                        </tr>
                                        <tr>
                                            <th>ht</th>
                                            <th>nombre d'articles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-middle text-uppercase fs-12">
                                                <span>0 dh</span>
                                            </td>

                                            <td class="align-middle text-uppercase fs-12">
                                                <span>0</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>


                    <form action="{{ route('factureProduit.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="facture_id" value="{{ $facture->id }}">
                        <input type="hidden" name="ht_new" id="htNew">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered m-0 datatable">
                                <thead class="table-success">
                                    <tr>

                                        <th>référence</th>
                                        <th class="col-4">nom</th>
                                        <th class="col-1">prix</th>
                                        <th class="col-1">quantité</th>
                                        <th class="col-1">remise</th>
                                        <th class="col-2">montant</th>
                                        <th class="col-1">rs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produits as $produit)
                                        <tr>
                                            <td class="align-middle">
                                                <div class="form-check fs-12">
                                                    {{-- @if ($produit->stock)

                                                    @else

                                                    @endif --}}
                                                    <input type="checkbox" name="pro[]" id="" class="form-check-input pro" value="{{ $produit->id }}" {{  $produit->stock->reste ?? 'disabled' }}>
                                                    <label for="" class="form-check">{{ $produit->reference }}</label>
                                                </div>
                                            </td>
                                            <td class="align-middle fs-12">{{ $produit->designation }}</td>
                                            <td class="align-middle">
                                                {{ $produit->prix_vente}} DH
                                                <input type="hidden" name="prix[]" class="price" value="{{ $produit->prix_vente }}">
                                            </td>
                                            <td class="align-middle">
                                                <input type="number" name="quantite[]" step="any" min="1"  id="" max="{{ $produit->stock->reste ?? '' }}" class="form-control form-control-sm qte" disabled>
                                            </td>
                                            <td class="align-middle">
                                                <input type="number" name="remise[]" step="any"  id="" class="form-control form-control-sm remise" disabled>
                                            </td>
                                            <td class="align-middle">
                                                <input type="number" name="montant[]" step="any"  id="" class="form-control form-control-sm montant" readonly disabled>
                                            </td>
                                            <td class="align-middle">
                                                <h6 class="m-0 {{ $produit->stock->reste ?? 'text-danger' }}">{{ $produit->stock->reste ?? 'Aucun stock' }}</h6>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <button type="submit" class="btn btn-success btn-sm px-3">
                                <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
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

            $(".pro").on("change",function(e){
        if($(this).is(':checked')){
            let count_pro = $(".pro:checked").length;
            let sum = 0;
            $(e.target).parent().parent().parent().children('td').children(".qte").prop("disabled",false);
            $(e.target).parent().parent().parent().children('td').children(".montant").prop("disabled",false);
            $(e.target).parent().parent().parent().children('td').children(".remise").prop("disabled",false);
            $(e.target).parent().parent().parent().children('td').children(".qte").val(1);
            $(e.target).parent().parent().parent().children('td').children(".remise").val(0);
            let qte = $(e.target).parent().parent().parent().children('td').children(".qte").val();
            let price = $(e.target).parent().parent().parent().children('td').children(".price").val();
            let remise = $(e.target).parent().parent().parent().children('td').children(".remise").val();
            let montant = parseFloat(qte * price).toFixed(2);
            let tva = $("#tva").val();
            let remise_facture = $("#RGroup").val();
            let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);

            let ht_act = parseFloat($("#htAct").val()).toFixed(2);
            if(remise == 0)
            {
                $(e.target).parent().parent().parent().children('td').children(".montant").val(montant);
                $(".montant").each(function(){
                    sum += +$(this).val();
                });


                let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("#new td:nth-child(1) span").html(sum + " dh");
                $("#new td:nth-child(2) span").html(count_pro);
                $("#htNew").val(sum);

                // let m =parseFloat(sum + ht_act).toFixed(2);
                // $("#finResu td:nth-child(1) span").html(m + " dh");


            }
            else
            {
                $(e.target).parent().parent().parent().children('td').children(".montant").val(montantRemise);
                $(".montant").each(function(){
                    sum += +$(this).val();
                })
                let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("#new td:nth-child(1)").html(sum + " dh");
                $("#new td:nth-child(2)").html(ttc + " dh");
                $("#new td:nth-child(3)").html(count_pro);
                $("#htNew").val(sum);

            }

        }
        else
        {
            $(e.target).parent().parent().parent().children('td').children(".qte").prop("disabled",true);
            $(e.target).parent().parent().parent().children('td').children(".remise").prop("disabled",true);
            $(e.target).parent().parent().parent().children('td').children(".montant").prop("disabled",true);
            $(e.target).parent().parent().parent().children('td').children(".montant").val(0);
            $(e.target).parent().parent().parent().children('td').children(".qte").val(0);
            let count_pro = $(".pro:checked").length;
            let sum = 0;
            let qte = $(e.target).parent().parent().parent().children('td').children(".qte").val();
            let price = $(e.target).parent().parent().parent().children('td').children(".price").val();
            let remise = $(e.target).parent().parent().parent().children('td').children(".remise").val();
            let montant = parseFloat(qte * price).toFixed(2);
            let tva = $("#tva").val();
            let remise_facture = $("#RGroup").val();
            let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
            if(remise == 0)
            {
                $(e.target).parent().parent().parent().children('td').children(".montant").val(montant);
                $(".montant").each(function(){
                    sum += +$(this).val();
                })
                let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("#new td:nth-child(1)").html(sum + " dh");
                $("#new td:nth-child(2)").html(count_pro);
                $("#htNew").val(sum);
            }
            else
            {
                $(e.target).parent().parent().parent().children('td').children(".montant").val(montantRemise);
                $(".montant").each(function(){
                    sum += +$(this).val();
                })
                let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("#new td:nth-child(1)").html(sum + " dh");
                $("#new td:nth-child(2)").html(count_pro);
                $("#htNew").val(sum);
            }
        }
    })


    $(".qte").on("keyup",function(e){
        let qte = $(e.target).val();
        let count_pro = $(".pro:checked").length;
        let price = $(e.target).parent().parent().children("td").children(".price").val();
        let remise = $(e.target).parent().parent().children("td").children(".remise").val();
        let montant = parseFloat(qte * price).toFixed(2);
        let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
        let sum = 0;
        let remise_facture = $("#RGroup").val();
        let tva = $("#tva").val();
        if(remise == 0){
            $(e.target).parent().parent().children("td").children(".montant").val(montant);
            $(".montant").each(function(){
                sum += +$(this).val();
            });
            let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("#new td:nth-child(1)").html(sum + " dh");
                $("#new td:nth-child(2)").html(count_pro);
                $("#htNew").val(sum);
        }
        else{
            $(e.target).parent().parent().children("td").children(".montant").val(montantRemise);
            $(".montant").each(function(){
                sum += +$(this).val();
            });
            let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("#new td:nth-child(1)").html(sum + " dh");
                $("#new td:nth-child(2)").html(count_pro);
                $("#htNew").val(sum);
        }
    })



    $(".remise").on("keyup",function(e){
        let remise = $(e.target).val();
        let count_pro = $(".pro:checked").length;
        let price = $(e.target).parent().parent().children("td").children(".price").val();
        let qte = $(e.target).parent().parent().children("td").children(".qte").val();
        let montant = parseFloat(qte * price).toFixed(2);
        let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
        let sum = 0;
        let remise_facture = $("#RGroup").val();
        let tva = $("#tva").val();
        if(remise == 0){
            $(e.target).parent().parent().children("td").children(".montant").val(montant);
            $(".montant").each(function(){
                sum += +$(this).val();
            });
            let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("#new td:nth-child(1)").html(sum + " dh");
                $("#new td:nth-child(2)").html(count_pro);
                $("#htNew").val(sum);
        }
        else{
            $(e.target).parent().parent().children("td").children(".montant").val(montantRemise);
            $(".montant").each(function(){
                sum += +$(this).val();
            });
            let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("#new td:nth-child(1)").html(sum + " dh");
                $("#new td:nth-child(2)").html(count_pro);
                $("#htNew").val(sum);
        }
    })





            $(".quantiteEdit").on("keyup",function(e){
                let qte = $(e.target).val();
                let pv = $(e.target).parent().parent().children("div").children(".pvEdit").val();
                let remise = $(e.target).parent().parent().children("div").children(".remiseEdit").val();
                // $(e.target).parent().parent().children("div").children(".montantEdit").val(qte * pv);
                let montant = pv * qte;
                let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
                if(remise == 0 || remise == null){
                    $(e.target).parent().parent().children("div").children(".montantEdit").val(montant);
                }
                else{

                    $(e.target).parent().parent().children("div").children(".montantEdit").val(montantRemise);
                }

            })

            $(".remiseEdit").on("keyup",function(e){
                let remise = $(e.target).val();
                let pv = $(e.target).parent().parent().children("div").children(".pvEdit").val();
                let qte = $(e.target).parent().parent().children("div").children(".quantiteEdit").val();
                // $(e.target).parent().parent().children("div").children(".montantEdit").val(qte * pv);
                let montant = pv * qte;
                let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
                if(remise == 0 || remise == null){
                    $(e.target).parent().parent().children("div").children(".montantEdit").val(montant);
                }
                else{

                    $(e.target).parent().parent().children("div").children(".montantEdit").val(montantRemise);
                }



            })
        })

    </script>
@endsection