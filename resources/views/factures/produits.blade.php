@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between mb-2">
    <h5 class="m-0">Management les produits du facture : {{ $facture->num_facture }} </h5>
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
                <a href="{{ route('facture.produit',$facture) }}" class="text-white">
                    Les produits du facture : {{ $facture->num_facture ?? '' }}
                </a>
            </li>
        @endcan
    </ol>
</div>

<div class="card">
    <div class="card-body p-2">
        <div class="table-responsive">
            <table id="datatable" class="table table-striped table-sm m-0">
                <thead class="table-warning">
                    <tr>
                        <th>référence</th>
                        <th>désignation</th>
                        <th>prix vente</th>
                        <th>quantite</th>
                        <th>montant</th>
                        <th>remise</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facture->produits as $facture_produit)
                        <tr>
                            <td class="align-middle"> {{ $facture_produit->produit->reference ?? '' }} </td>
                            <td class="align-middle"> {{ $facture_produit->produit->designation ?? '' }} </td>
                            <td class="align-middle"> {{ $facture_produit->produit->prix_vente ?? '' }} DH</td>
                            <td class="align-middle"> {{ $facture_produit->quantite ?? '' }}</td>
                            <td class="align-middle"> {{ $facture_produit->montant ?? '' }} DH</td>
                            <td class="align-middle"> {{ $facture_produit->remise ?? '' }} %</td>
                            <td class="align-middle">
                                @can('categorie-edit')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $facture_produit->id }}">
                                        <i class="mdi mdi-pencil-outline" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@foreach ($facture->produits as $facture_produit)
<div class="modal fade" id="edit{{ $facture_produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2 bg-primary">
                <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Modifier le produit du facture : {{ $facture_produit->facture->num_facture ?? '' }}</h6>
                <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body p-2">
                <form action="{{ route('facture-produit.update',$facture_produit) }}" method="post">
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
                        <input type="number" id="" name="pv" class="form-control pv" step="any" min="0" value="{{ $facture_produit->produit->prix_vente }}" readonly>
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="form-label">Montant</label>
                        <input type="number" id="" name="montant_u" class="form-control montant" step="any" min="0" value="{{ $facture_produit->montant }}" readonly>
                    </div>


                    <div class="form-group mb-2">
                        <label for="" class="form-label">Quantite</label>
                        <input type="number" id="" name="quantite_u" class="form-control quantite" step="any" min="0" value="{{ $facture_produit->quantite ?? '' }}" >
                    </div>

                    <div class="form-group mb-2">
                        <label for="" class="form-label">Remise</label>
                        <input type="number" id="" name="remise_u" class="form-control remise" step="any" min="0" value="{{ $facture_produit->remise ?? '' }}" >
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
@endforeach
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(".quantite").on("keyup",function(e){
                let qte = $(e.target).val();
                let pv = $(e.target).parent().parent().children("div").children(".pv").val();
                let remise = $(e.target).parent().parent().children("div").children(".remise").val();
                let montant = qte * pv;
                let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
                console.log(pv);
                if(remise <= 0 ){
                    $(e.target).parent().parent().children("div").children(".montant").val(qte * pv);
                }
                else{
                    $(e.target).parent().parent().children("div").children(".montant").val(montantRemise);
                }

            })
            $(".remise").on("keyup",function(e){
                let remise = $(e.target).val();
                let qte = $(e.target).parent().parent().children("div").children(".quantite").val()
                let pv = $(e.target).parent().parent().children("div").children(".pv").val();
                let montant = qte * pv;
                let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
                console.log(pv);
                if(remise <= 0 ){
                    $(e.target).parent().parent().children("div").children(".montant").val(qte * pv);
                }
                else{
                    $(e.target).parent().parent().children("div").children(".montant").val(montantRemise);
                }
            })



        })
    </script>
@endsection