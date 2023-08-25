@extends('layouts.master')
@section('title')
    Information facture : {{ $facture->num_facture }}
    @endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">
            <a href="{{route('facture.index')}}">
                Liste des factures
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Information facture : {{ $facture->num_facture }}
        </li>
    </ol>
</nav>
    <div class="row row-cols-4">
        <div class="col mb-2">
            <div class="card m-0 bg-primary">
                <div class="card-body py-3 px-0">
                    <h6 class="m-0 text-uppercase text-center text-white fs-10">
                        ht : {{ $facture->prix_ht }} dh
                    </h6>
                </div>
            </div>
        </div>
        <div class="col mb-2">
            <div class="card m-0 bg-primary">
                <div class="card-body py-3 px-0">
                    <h6 class="m-0 text-uppercase text-center text-white fs-10">
                        ttc : {{ $facture->prix_ttc }} dh
                    </h6>
                </div>
            </div>
        </div>
        <div class="col mb-2">
            <div class="card m-0 bg-success">
                <div class="card-body py-3 px-0">
                    <h6 class="m-0 text-uppercase text-center text-white fs-10">
                        payer : {{ $facture->payer }} dh
                    </h6>
                </div>
            </div>
        </div>
        <div class="col mb-2">
            <div class="card m-0 bg-danger">
                <div class="card-body py-3 px-0">
                    <h6 class="m-0 text-uppercase text-center text-white fs-10">
                        reste : {{ $facture->reste }} dh
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-2">
            <h6 class="mb-3 text-uppercase text-center">
                <span class="border border-top-0 border-start-0 border-end-0 border-solid border-primary border-2">information général</span>
            </h6>
            <div class="row justify-content-center mb-3">
                <div class="col-lg-4">
                    <div class="card m-0 border border-1 border-solid border-success">
                        <div class="card-body py-2 px-0">
                            <h6 class="m-0 text-center fs-10 text-uppercase">
                                référence : {{ $facture->num_facture ?? '' }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-2">
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item py-2">
                            <h6 class="text-uppercase m-0 fs-10">
                                <span class="float-start">client : </span>
                                <span class="float-end fw-normal"> {{ $client->raison_sociale ?? '' }} </span>
                            </h6>
                        </li>
                        <li class="list-group-item py-2">
                            <h6 class="text-uppercase m-0 fs-10">
                                <span class="float-start">tva</span>
                                <span class="float-end fw-normal"> {{ $facture->taux_tva }} %</span>
                            </h6>
                        </li>
                        <li class="list-group-item py-2">
                            <h6 class="text-uppercase m-0 fs-10">
                                <span class="float-start">date</span>
                                <span class="float-end fw-normal"> {{ $facture->date }} </span>
                            </h6>
                        </li>
                        <li class="list-group-item py-2">
                            <h6 class="text-uppercase m-0 fs-10">
                                <span class="float-start">statut</span>
                                <span class="float-end fw-normal {{ $facture->statut == 'en cours' ? 'badge bg-warning':'badge bg-success' }}"> {{ $facture->statut ?? '' }} </span>
                            </h6>
                        </li>
                        <li class="list-group-item py-2">
                            <h6 class="text-uppercase m-0 fs-10">
                                <span class="float-start">état paiement</span>
                                <span class="float-end fw-normal {{ $facture->etat_paiement == 'attente' ? 'badge bg-warning':'badge bg-success' }}"> {{ $facture->etat_paiement }} </span>
                            </h6>
                        </li>
                    </ul>
                </div>
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item py-2">
                            <h6 class="text-uppercase m-0 fs-10">
                                <span class="float-start">prix ht</span>
                                <span class="float-end"> {{ $facture->prix_ht }} dh</span>
                            </h6>
                        </li>
                        <li class="list-group-item py-2">
                            <h6 class="text-uppercase m-0 fs-10">
                                <span class="float-start">prix ttc</span>
                                <span class="float-end"> {{ $facture->prix_ttc }} dh</span>
                            </h6>
                        </li>
                        <li class="list-group-item py-2">
                            <h6 class="text-uppercase m-0 fs-10">
                                <span class="float-start">remise</span>
                                <span class="float-end fw-normal"> {{ $facture->remise }} %</span>
                            </h6>
                        </li>
                        <li class="list-group-item py-2">
                            <h6 class="text-uppercase m-0 fs-10 text-success">
                                <span class="float-start">payer</span>
                                <span class="float-end"> {{ $facture->payer }} dh</span>
                            </h6>
                        </li>
                        <li class="list-group-item py-2">
                            <h6 class="text-uppercase m-0 fs-10 text-danger">
                                <span class="float-start">reste</span>
                                <span class="float-end"> {{ $facture->reste }} dh</span>
                            </h6>
                        </li>
                    </ul>
                </div>
            </div>

            <h6 class="my-3 text-uppercase text-center">
                <span class="border border-top-0 border-start-0 border-end-0 border-solid border-primary border-2">les produits</span>
            </h6>

            <div class="table-responsive">
                <table class="table table-striped table-sm m-0">
                    <thead class="table-success">
                        <tr>
                            <th>référence</th>
                            <th>désignation</th>
                            <th>prix vente</th>
                            <th>quantité</th>
                            <th>montant</th>
                            <th>remise</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($facture->produits as $facture_produit)
                            <tr>
                                <td class="align-middle">{{ $facture_produit->produit->reference ?? '' }} </td>
                                <td class="align-middle">{{ $facture_produit->produit->designation ?? '' }} </td>
                                <td class="align-middle">{{ $facture_produit->produit->prix_vente ?? '' }} DH</td>
                                <td class="align-middle">{{ $facture_produit->quantite ?? '' }}</td>
                                <td class="align-middle">{{ $facture_produit->montant ?? '' }} DH</td>
                                <td class="align-middle">{{ $facture_produit->remise ?? '' }} %</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <h6 class="my-3 text-uppercase text-center">
                <span class="border border-top-0 border-start-0 border-end-0 border-solid border-primary border-2">réglements</span>
            </h6>


            <div class="table-repsonsive">
                <table class="table table-striped table-sm m-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Type</th>
                            <th>payer</th>
                            <th>reste</th>
                            <th>date</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($facture->paiement as $facture_paiement)
                            <tr>
                                <td class="align-middle text-capitalize">
                                    @if ($facture_paiement->type_paiement == "chèque")
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#paiementCheque{{ $facture_paiement->id }}">
                                            chèque
                                        </button>
                                    @else
                                        {{ $facture_paiement->type_paiement }}

                                    @endif
                                </td>
                                <td class="align-middle">
                                    {{ $facture_paiement->payer }} DH
                                </td>
                                <td class="align-middle">
                                    {{ $facture_paiement->reste }} DH
                                </td>
                                <td class="align-middle">
                                    {{ $facture_paiement->date_paiement }} DH
                                </td>
                                <td class="align-middle">
                                    @can('facturePaiement-destroy')
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $facture_paiement->id }}">
                                            <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                        </button>
                                    @endcan
                                </td>
                            </tr>

                            <div class="modal fade" id="paiementCheque{{ $facture_paiement->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header py-2 bg-primary">
                                            <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Chèque : {{ $facture_paiement->cheque->numero ?? '' }}</h6>
                                            <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                                                <span class="mdi mdi-close-thick"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-2">
                                            <ul class="list-group">
                                                <li class="list-group-item py-2">
                                                    <h6 class="m-0 fs-12 text-uppercase">
                                                        <span class="float-start">numéro</span>
                                                        <span class="float-end"> {{ $facture_paiement->cheque->numero ?? '' }} </span>
                                                    </h6>
                                                </li>
                                                <li class="list-group-item py-2">
                                                    <h6 class="m-0 fs-12 text-uppercase">
                                                        <span class="float-start">nom bancaire</span>
                                                        <span class="float-end"> {{ $facture_paiement->cheque->bancaire->nom_bank ?? '' }} </span>
                                                    </h6>
                                                </li>
                                                <li class="list-group-item py-2">
                                                    <h6 class="m-0 fs-12 text-uppercase">
                                                        <span class="float-start">date chèque</span>
                                                        <span class="float-end"> {{ $facture_paiement->cheque->date_cheque ?? '' }} </span>
                                                    </h6>
                                                </li>
                                                <li class="list-group-item py-2">
                                                    <h6 class="m-0 fs-12 text-uppercase">
                                                        <span class="float-start">date enquisement</span>
                                                        <span class="float-end"> {{ $facture_paiement->cheque->date_enquisement ?? '' }} </span>
                                                    </h6>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="delete{{ $facture_paiement->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{ route('facture-paiement.destroy',$facture_paiement) }}" method="POST">
                                                @csrf
                                                @method("DELETE")
                                                <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>
                                                <h6 class="mb-2 fw-bolder text-center text-muted">Voulez-vous supprimer défenitivement du paiement</h6>
                                                {{-- <h6 class="text-danger mb-2 text-center">{{ $facture_paiement->nu }}</h6> --}}
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary px-5 fw-bolder py-2 me-2">
                                                        Je confirme
                                                    </button>

                                                    <button  type="button" class="btn btn-light px-5 py-2 fw-bolder" data-bs-dismiss="modal" aria-label="btn-close" style="background:#CEAD6D" data-bs-toggle="modal" data-bs-target="#historyPaiement{{ $facture_paiement->facture->id }}">
                                                        Retour
                                                    </button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @empty
                            <tr>
                                <td class="align-middle" colspan="5">
                                    <h6 class="text-center m-0 text-uppercase text-danger py-1 fs-12">
                                        Aucun paiement enregistrer
                                    </h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>




    @foreach ($facture->produits as $facture_produit)
        <div class="modal fade" id="edit{{ $facture_produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
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
                            <div class="row row-cols-2">
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Produits</label>
                                        <select name="produit_u" id="" class="form-select fw-bolder">
                                            <option value="">Choisir le produit</option>
                                            @foreach ($produits as $produit)
                                                <option value="{{ $produit->id }}" class="fw-bolder" {{ $facture_produit->produit_id == $produit->id ? "selected":"" }}> {{ $produit->reference }} => {{ $produit->prix_vente }} DH</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">prix vente</label>
                                        <input type="number" id="" name="prix_vente" class="form-control pv" step="any" min="0" value="{{ $facture_produit->produit->prix_vente ?? '' }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-3">
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Quantite</label>
                                        <input type="number" id="" name="quantite_u" class="form-control quantite" step="any" min="0" value="{{ $facture_produit->quantite ?? '' }}" >
                                    </div>
                                </div>

                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Remise</label>
                                        <input type="number" id="" name="remise_u" class="form-control remise" step="any" min="0" value="{{ $facture_produit->remise ?? '' }}" >
                                    </div>
                                </div>

                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Montant</label>
                                        <input type="number" id="" name="montant_u" class="form-control montant" step="any" min="0" value="{{ $facture_produit->montant }}" readonly>
                                    </div>
                                </div>
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

    })
</script>
@endsection