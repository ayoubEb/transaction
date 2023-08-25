@extends('layouts.master')
@section('title')
Liste des factures
@endsection
@section('content')
@include('sweetalert::alert')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Liste des clients
        </li>
    </ol>
</nav>
<div class="card">
    <div class="card-body p-2">
        @can('facture-create')
            <a href="{{ route('facture.create') }}" class="btn btn-primary px-5 mb-2">
                <span class="mdi mdi-plus-circle-outline align-middle"></span>
                Ajouter
            </a>
        @endcan
        <input type="hidden" id="tva" value="{{ $tva }}">
        <div class="table-responsive">
            <table class="table table-bordered mb-0 table-sm datatable">
                <thead class="table-success">
                    <tr>
                        <th>Raison sociale</th>
                        <th>Numero du facture</th>
                        <th>Date du facture</th>
                        <th>Prix HT</th>
                        <th>Prix TTC</th>
                        <th>Taux TVA</th>
                        <th>Remise</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($factures as $facture)
                        <tr class="{{ $facture->deleted_at != null ? 'table-danger':'' }}">
                            <td class="align-middle">
                                @if ($facture->cli_del != null)
                                    {{ $facture->raison_sociale ?? ''}}
                                @else

                                 <button type="button" class="btn btn-link p-0 border-0 shadow-none" data-bs-toggle="modal" data-bs-target="#client{{ $facture->client_id ?? ''}}">
                                    {{ $facture->raison_sociale }}
                                 </button>
                                @endif
                            </td>
                            <td class="align-middle">{{ $facture->num_facture ?? '' }}</td>
                            <td class="align-middle">{{ date('d-m-Y',strtotime($facture->created_at)) ?? '' }}</td>
                            <td class="align-middle">{{ $facture->prix_ht ?? '0' }} DHS</td>
                            <td class="align-middle">{{ $facture->prix_ttc ?? '0' }} DHS</td>
                            <td class="align-middle">{{ $facture->taux_tva ?? '0' }} %</td>
                            <td class="align-middle">{{ $facture->remise }} %</td>

                                <td class="align-middle">
                                    <span @class([
                                        "badge",
                                        "bg-warning"=>$facture->statut == "en cours",
                                        "bg-success"=>$facture->statut == "validé",
                                        "bg-danger"=>$facture->statut == "annuler",
                                    ])>

                                    {{ $facture->statut }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    @if ($facture->statut == "validé")

                                        @can('facturePaiement-create')
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-success {{ $facture->reste == 0 ? 'disabled':'' }}" data-bs-toggle="modal" data-bs-target="#addPaiement{{ $facture->id }}">
                                                <i class="mdi mdi-plus-circle-outline" style="font-size: 0.90rem;"></i>
                                            </button>
                                        @endcan
                                        <a href="{{ route('facture-pdf.show',$facture->id) }}" class="btn bg-trasparent p-0 border-0 text-primary">
                                            <i class="mdi mdi-file" style="font-size: 0.90rem;"></i>
                                        </a>
                                        @can('avoire-create')
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-secondary" data-bs-toggle="modal" data-bs-target="#retour{{ $facture->id   }}">
                                            <i class="mdi mdi-restore" style="font-size: 0.90rem;"></i>
                                        </button>
                                        @endcan
                                        @can('facture-show')
                                            @if (count($facture->ligne_retours) > 0)
                                                <button type="button" class="btn p-0 bg-transparent border-0 text-secondary" data-bs-toggle="modal" data-bs-target="#listeRetour{{ $facture->id   }}">
                                                    <i class="mdi mdi-clipboard-list-outline" style="font-size: 0.90rem;"></i>
                                                </button>

                                            @endif
                                        @endcan

                                    @else
                                        @can("facture-edit")
                                            <a href="{{ route('facture.edit',$facture->id) }}" class="{{ $facture->statut == "validé" ? 'd-none':'' }}">
                                                <i class="mdi mdi-pencil" style="font-size: 0.90rem;"></i>
                                            </a>
                                        @endcan
                                        @can('facture-edit')
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-success" {{ $facture->statut == 'validé' ? 'disabled':'' }} data-bs-toggle="modal" data-bs-target="#validation{{ $facture->id }}">
                                                <i class="mdi mdi-check-bold" style="font-size: 0.90rem;"></i>
                                            </button>
                                        @endcan

                                    @endif
                                    @can('facture-show')
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-warning" data-bs-toggle="modal" data-bs-target="#show{{ $facture->id   }}">
                                            <i class="mdi mdi-information-outline" style="font-size: 0.90rem;"></i>
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


    @foreach ($factures as $facture)

        <div class="modal fade" id="validation{{ $facture->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-2">
                        <form action="{{ route('facture.valider',$facture) }}" method="post">
                            @csrf
                            @method("PUT")
                            <h3 class="text-primary mb-3 text-center">Valider la facture</h3>
                            <h6 class="mb-2 fw-bolder text-center text-muted">Voulez-vous validé la facture</h6>
                            <h6 class="text-danger mb-2 text-center">{{ $facture->num_facture ?? '' }}</h6>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary px-5 fw-bolder py-2 me-2">
                                    Validé
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


        <div class="modal fade" id="addPaiement{{ $facture->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter paiement du cette facture</h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body p-2">
                        <form action="{{route('facture-paiement.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="facture_id" value="{{$facture->id}}">
                            <input type="hidden" name="client_id" value="{{$facture->client_id ?? ''}}">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Type du paiement</label>
                                        <select name="type" id="" class="form-select type">
                                            <option value="">Choisir le type du paiement</option>
                                            <option value="espèce">Espèce</option>
                                            <option value="chèque">Chèque</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="cheque" class="bg-light p-2 my-2">
                                <div class="row row-cols-2">
                                    <div class="col mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label">Numéro</label>
                                            <input type="text" name="numero" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label">Nom bank</label>
                                            <select name="nom_bank" id="" class="form-select">
                                                <option value="">Choisir le nom du bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id ?? '' }}">{{ $bank->nom_bank ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col mb-md-0 mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label">Date chèque</label>
                                            <input type="date" name="date_cheque" id="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col mb-md-0 mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label">Date enquisement</label>
                                            <input type="date" name="date_enquisement" id="" class="form-control">
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="row row-cols-2">
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Montant TTC</label>
                                        <input type="number" name="" id="" class="form-control" value="{{$facture->prix_ttc ?? ''}}" disabled>
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Montant reste Actuel</label>
                                        <input type="number" id="" step="any" class="form-control resteActuel" value="{{ $facture->reste ?? ''}}" disabled>
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Montant payer</label>
                                        <input type="number" name="payer" id="" class="form-control payer" step="any" min="0" value="" max="{{ $facture->reste ?? ''}}" disabled>
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Montant reste nouveau</label>
                                        <input type="number" name="reste" id="" step="any" class="form-control reste" value="" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success btn-sm">
                                    <span class="mdi mdi-check-bold align-middle"></span>
                                    <span>Enregistrer</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="show{{ $facture->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Information du facture : {{ $facture->num_facture ?? '' }} </h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body p-2">
                        <div class="row justify-content-center mb-2">
                            <div class="col-lg-4">
                                <div class="card m-0 border border-1 border-solid border-success">
                                    <div class="card-body py-3 px-0">
                                        <h6 class="m-0 text-center text-uppercase fs-12">
                                            référence : {{ $facture->num_facture }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-2">
                            <div class="col mb-2">
                                <ul class="list-group">
                                    <li class="list-group-item py-2">
                                        <h6 class="m-0 fs-12 text-uppercase">
                                            <span class="float-start">prix ht</span>
                                            <span class="float-end fw-normal"> {{ $facture->prix_ht ?? '' }} dh</span>
                                        </h6>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <h6 class="m-0 fs-12 text-uppercase">
                                            <span class="float-start">prix ttc</span>
                                            <span class="float-end fw-normal"> {{ $facture->prix_ttc ?? '' }} dh</span>
                                        </h6>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <h6 class="m-0 fs-12 text-uppercase">
                                            <span class="float-start">remise</span>
                                            <span class="float-end fw-normal"> {{ $facture->remise ?? '' }} %</span>
                                        </h6>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <h6 class="m-0 fs-12 text-uppercase text-success">
                                            <span class="float-start">payer</span>
                                            <span class="float-end fw-normal"> {{ $facture->payer ?? '' }} dh</span>
                                        </h6>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <h6 class="m-0 fs-12 text-uppercase text-danger">
                                            <span class="float-start">prix ttc</span>
                                            <span class="float-end fw-normal"> {{ $facture->reste ?? '' }} dh</span>
                                        </h6>
                                    </li>
                                </ul>
                            </div>
                            <div class="col mb-2">
                                <ul class="list-group">
                                    <li class="list-group-item py-2">
                                        <h6 class="m-0 fs-12 text-uppercase">
                                            <span class="float-start">statut</span>
                                            <span class="float-end fw-normal {{ $facture->statut == 'en cours' ? 'badge bg-warning':'badge bg-success' }}"> {{ $facture->statut ?? '' }}</span>
                                        </h6>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <h6 class="m-0 fs-12 text-uppercase">
                                            <span class="float-start">client</span>
                                            <span class="float-end fw-normal"> {{ $facture->raison_sociale ?? '' }}</span>
                                        </h6>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <h6 class="m-0 fs-12 text-uppercase">
                                            <span class="float-start">tva</span>
                                            <span class="float-end fw-normal"> {{ $facture->taux_tva ?? '' }} %</span>
                                        </h6>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <h6 class="m-0 fs-12 text-uppercase">
                                            <span class="float-start">état paiement</span>
                                            <span class="float-end fw-normal {{ $facture->etat_paiement == 'attente' ? 'badge bg-warning':'badge bg-success' }}"> {{ $facture->etat_paiement ?? '' }} </span>
                                        </h6>
                                    </li>
                                    <li class="list-group-item py-2">
                                        <h6 class="m-0 fs-12 text-uppercase">
                                            <span class="float-start">date</span>
                                            <span class="float-end fw-normal"> {{ $facture->date ?? '' }}</span>
                                        </h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @if (count($facture->ligne_retours) > 0)
                            <div class="row justify-content-center mb-2">
                                <div class="col-lg-4">
                                    <div class="card m-0 border border-1 border-solid border-success">
                                        <div class="card-body py-3 px-0">
                                            <h6 class="m-0 text-center text-uppercase text-primary fs-12">
                                                les retours
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row row-cols-2">
                                <div class="col">
                                    <ul class="list-group">
                                        <li class="list-group-item py-2">
                                            <h6 class="m-0 fs-12 text-uppercase">
                                                <span class="float-start">retour</span>
                                                <span class="float-end mdi mdi-check-bold text-success"></span>
                                            </h6>
                                        </li>
                                        <li class="list-group-item py-2">
                                            <h6 class="m-0 fs-12 text-uppercase">
                                                <span class="float-start">quantité retour</span>
                                                <span class="float-end fw-normal"> {{ $facture->ligne_retours()->sum("total_qte") ?? '' }}</span>
                                            </h6>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col">

                                    <ul class="list-group">
                                        <li class="list-group-item py-2">
                                            <h6 class="m-0 fs-12 text-uppercase">
                                                <span class="float-start">montant ht</span>
                                                <span class="float-end fw-normal"> {{ $facture->ligne_retours()->sum("montant_ht") ?? 0 }} dh</span>
                                            </h6>
                                        </li>
                                        <li class="list-group-item py-2">
                                            <h6 class="m-0 fs-12 text-uppercase">
                                                <span class="float-start">montant ttc</span>
                                                <span class="float-end fw-normal"> {{ $facture->ligne_retours()->sum("montant_ttc") ?? 0 }} dh</span>
                                            </h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        @endif
                        <div class="d-flex justify-content-center mt-2">
                            <a href="{{ route('facture.show',$facture->id) }}" class="btn btn-sm btn-primary">
                                Plus détails
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="retour{{ $facture->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter du produit retour de facture</h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body p-2">
                        <div class="row justify-content-center mb-2">
                            <div class="col-lg-4">
                                <div class="card m-0 border border-1 border-solid border-success">
                                    <div class="card-body py-3 px-0">
                                        <h6 class="m-0 text-center text-uppercase fs-12">
                                            référence : {{ $facture->num_facture }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card m-0 border border-1 border-solid border-success">
                                    <div class="card-body py-3 px-0">
                                        <h6 class="m-0 text-center text-uppercase fs-12">
                                            tva : {{ $facture->taux_tva }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-2">
                            <div class="col mb-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm m-0">
                                        <thead>
                                            <tr class="bg-secondary">
                                                <th class="text-white text-center" colspan="2">produits actuel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="table-secondary">nombre des produits</th>
                                                <td class="align-middle fs-12">{{ count($facture->produits) }}</td>
                                            </tr>

                                            <tr>
                                                <th class="table-secondary">quantité des produits</th>
                                                <td class="align-middle text-uppercase fs-12"> {{ $facture->produits()->sum("quantite")}}</td>
                                            </tr>

                                            <tr>
                                                <th class="table-secondary">montant ht</th>
                                                <td class="align-middle text-uppercase fs-12"> {{ $facture->prix_ht}} dh</td>
                                            </tr>

                                            <tr>
                                                <th class="table-secondary">montant ttc</th>
                                                <td class="align-middle text-uppercase fs-12">
                                                    {{ $facture->prix_ttc}} dh
                                                    <input type="hidden" class="remise">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm m-0">
                                        <thead>
                                            <tr class="bg-secondary">
                                                <th colspan="2" class="text-white text-center">produits actuel</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="table-secondary">nombre des produits</th>
                                                <td class="align-middle">0</td>
                                            </tr>
                                            <tr>
                                                <th class="table-secondary">quantité des produits</th>
                                                <td class="align-middle">0</td>
                                            </tr>
                                            <tr>
                                                <th class="table-secondary">montant ht</th>
                                                <td class="align-middle">0 dh</td>
                                            </tr>
                                            <tr>
                                                <th class="table-secondary">montant ttc</th>
                                                <td class="align-middle">0 dh</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('ligneFactureRetour.store') }}" method="post">
                            @csrf

                            <input type="hidden" class="tva" value="{{ $facture->taux_tva }}">
                            <input type="hidden" name="facture_id" value="{{ $facture->id }}">
                            <input type="hidden" name="total_reste" class="totalReste">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm m-0">
                                    <thead class="table-success">
                                        <tr>
                                            <th class="col-3">produit</th>
                                            <th class="col-1">prix.pro</th>
                                            <th class="col-1">quantite</th>
                                            <th class="col-2">montant</th>
                                            <th class="col-1">nbr.retour</th>
                                            <th class="col-1">nbr.reste</th>
                                            <th class="col-1">montant.pa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($facture->produits as $facture_produit)
                                            <tr>
                                                <td class="align-middle fs-12">
                                                    <div class="form-check m-0">
                                                        <input type="checkbox" name="pro[]" id="p{{$facture_produit->id.$facture_produit->produit_id }}" class="form-check-input pro" style="cursor: pointer" value="{{ $facture_produit->produit_id }}">
                                                        <label for="p{{ $facture_produit->id.$facture_produit->produit_id }}" class="form-check-label" style="cursor: pointer"> {{ $facture_produit->produit->designation ?? '' }} </label>
                                                    </div>
                                                    <input type="hidden" class="price" value="{{ $facture_produit->produit->prix_vente ?? '' }}">
                                                </td>

                                                <td class="align-middle fs-12">
                                                    {{ $facture_produit->produit->prix_vente ?? '' }} DH
                                                </td>
                                                <td class="align-middle fs-12">
                                                    <input type="number" name="qte[]" id="" class="form-control form-control-sm qte" value="{{ $facture_produit->quantite - $facture_produit->total_retour }}" min="0" max="{{ $facture_produit->quantite }}" readonly disabled>
                                                </td>
                                                <td class="align-middle fs-12">
                                                    <input type="number" name="montant[]" id="" class="form-control form-control-sm montant" min="0" disabled>
                                                </td>
                                                <td class="align-middle fs-12">
                                                    <input type="number" name="retour[]" id="" class="form-control form-control-sm retour" min="0" max="{{ $facture_produit->quantite - $facture_produit->total_retour ?? '' }}" disabled>
                                                </td>
                                                <td class="align-middle fs-12">
                                                    <input type="number" name="reste[]" id="" class="form-control form-control-sm reste" min="0" readonly disabled>
                                                </td>
                                                <td class="align-middle fs-12">
                                                    <input type="number" name="mt_retour[]" id="" class="form-control form-control-sm mtRetour" min="0" readonly disabled>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-sm btn-success">
                                    Enregistrer
                                </button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="listeRetour{{ $facture->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Liste des produits des retours</h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body p-2">
                        <div class="row row-cols-lg-3 row-cols-1">
                            <div class="col mb-2">
                                <div class="card m-0 border border-1 border-solid border-primary rounded">
                                    <div class="card-body py-3 px-0">
                                        <h6 class="m-0 text-uppercase text-center fs-12">quantité actuel : {{ $facture->ligne_retours()->sum("total_qteActuel") ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="card m-0 border border-1 border-solid border-primary rounded">
                                    <div class="card-body py-3 px-0">
                                        <h6 class="m-0 text-uppercase text-center fs-12">quantité retours : {{ $facture->ligne_retours()->sum("total_qte") ?? 0 }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="card m-0 border border-1 border-solid border-primary rounded">
                                    <div class="card-body py-3 px-0">
                                        <h6 class="m-0 text-uppercase text-center fs-12">quantité restes : {{ $facture->ligne_retours()->sum("total_qteActuel") - $facture->ligne_retours()->sum("total_qte") }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="card m-0 border border-1 border-solid border-primary rounded">
                                    <div class="card-body py-3 px-0">
                                        <h6 class="m-0 text-uppercase text-center fs-12">montant actuel : {{  $facture->ligne_retours()->sum("montant_actuel") ?? 0  }} DH</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="card m-0 bg-light">
                                    <div class="card-body py-3 px-0">
                                        <h6 class="m-0 text-uppercase text-center fs-12">montant ht : {{  $facture->ligne_retours()->sum("montant_ht") ?? 0  }} DH</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="card m-0 bg-light">
                                    <div class="card-body py-3 px-0">
                                        <h6 class="m-0 text-uppercase text-center fs-12">montant ttc : {{  $facture->ligne_retours()->sum("montant_ttc") ?? 0  }} DH</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-sm m-0">
                                <thead class="table-success">
                                    <tr>
                                        <th class="">référence</th>
                                        <th class="">qte actuel</th>
                                        <th class="">qte retour</th>
                                        <th class="">qte reste</th>
                                        <th class="">montant actuel</th>
                                        <th class="">montant ht</th>
                                        <th class="">montant ttc</th>
                                        <th class="">montant reste</th>
                                        <th class="">date retour</th>
                                        <th class="">actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facture->ligne_retours as $ligne_retour)
                                        <tr>
                                            <td class="align-middle"> {{ $ligne_retour->reference }} </td>
                                            <td class="align-middle"> {{ $ligne_retour->total_QteActuel }} </td>
                                            <td class="align-middle"> {{ $ligne_retour->total_qte }} </td>
                                            <td class="align-middle"> {{ $ligne_retour->total_QteActuel - $ligne_retour->total_qte }} </td>
                                            <td class="align-middle"> {{ $ligne_retour->montant_actuel }} </td>
                                            <td class="align-middle"> {{ $ligne_retour->montant_ht ?? 0 }}  DH</td>
                                            <td class="align-middle"> {{ $ligne_retour->montant_ttc ?? 0 }} DH</td>
                                            <td class="align-middle"> {{ ($ligne_retour->montant_actuel ?? 0) - ($ligne_retour->montant_ttc ?? 0) }} DH</td>
                                            <td class="align-middle"> {{ date("d / m / Y",strtotime($ligne_retour->date_retour)) }}</td>
                                            <td class="align-middle">
                                                <a href="{{ route('ligneFacture.pdf',$ligne_retour->id) }}" class="btn btn-transparent p-0 text-primary border-0">
                                                    <span class="mdi mdi-file-outline"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete{{ $facture->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('facture.destroy',$facture) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>

                            <h6 class="mb-2 fw-bolder text-center text-muted">
                                Voulez-vous vraiment déplacer du facture vers la corbeille
                            </h6>

                            <h6 class="text-danger mb-2 text-center">{{ $facture->num_facture }}</h6>
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

    @foreach ($clients as $client)
        <div class="modal fade" id="client{{ $client->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header py-2">
                        <h5 class="modal-title m-0" id="varyingModalLabel">Information du client : {{ $client->raison_sociale }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered table-sm">
                            <tbody>
                                <tr>
                                    <th colspan="2" class="bg-warning text-center">Groupes</th>
                                </tr>
                                @if (isset($client->group->nom))
                                    <tr>
                                        <th class="bg-light">Nom</th>
                                        <td class="">
                                            {{$client->group->nom ?? ''}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Remise</th>
                                        <td class="">
                                            {{ $client->group->remise." %" }}
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2" class="text-uppercase">aucun group</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th colspan="2" class="bg-warning text-center">Information général</th>
                                </tr>
                                <tr>
                                    <th class="bg-light">Raison social</th>
                                    <td class="">{{ $client->raison_sociale ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Adresse</th>
                                    <td class="">{{ $client->adresse ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">E-mail</th>
                                    <td class="">{{ $client->email ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Ville</th>
                                    <td class="">{{ $client->ville ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">ICE</th>
                                    <td class="">{{ $client->ice ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Téléphone</th>
                                    <td class="">{{ $client->telephone ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Code de postal</th>
                                    <td class="">{{ $client->code_postal ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Activité</th>
                                    <td class="">{{ $client->activite ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Type</th>
                                    <td class="">{{ $client->type->nom ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-light">Statut</th>
                                    <td class="">{{ $client->statut  }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(".type").on("change",function(e){
                let type = $(e.target).val();

                if(type == "chèque"){
                    $(e.target).parent().parent().parent().parent().children("#cheque").show(450);
                }
                else{
                    $(e.target).parent().parent().parent().parent().children("#cheque").hide(450);
                }


                if(type == ""){

                    $(e.target).parent().parent().parent().parent().children("div").children("div").children("div").children(".payer").prop("disabled",true);
                }
                else{
                    $(e.target).parent().parent().parent().parent().children("div").children("div").children("div").children(".payer").prop("disabled",false);

                }
            })

            $(".pro").on("change",function(e){
                if($(this).is(":checked")){
                    let sum = 0;
                    let total_reste = 0;
                    let count_check = $(".pro:checked").length;
                    $(e.target).parent().parent().parent().children("td").children(".qte").prop("disabled",false);
                    $(e.target).parent().parent().parent().children("td").children(".retour").prop("disabled",false);
                    $(e.target).parent().parent().parent().children("td").children(".reste").prop("disabled",false);
                    $(e.target).parent().parent().parent().children("td").children(".mtRetour").prop("disabled",false);
                    $(e.target).parent().parent().parent().children("td").children(".montant").prop("disabled",false);
                    $(e.target).parent().parent().parent().css("background","#57C5B6");
                    let qte = $(e.target).parent().parent().parent().children("td").children(".qte").val();
                    let price = $(e.target).parent().parent().children(".price").val();
                    let retour = $(e.target).parent().parent().parent().children("td").children(".retour").val();
                    let reste = qte - retour;
                    $(e.target).parent().parent().parent().children("td").children(".retour").val(0);
                    $(e.target).parent().parent().parent().children("td").children(".montant").val(price * qte);
                    $(e.target).parent().parent().parent().children("td").children(".reste").val(qte - retour);
                    $(e.target).parent().parent().parent().children("td").children(".mtRetour").val(price * reste);
                    $(e.target).parent().parent().parent().parent().parent().parent().parent().parent().children("div:nth-child(2)").children("div:nth-child(2)").children("div").children("table").children("tbody").children("tr:nth-child(1)").children("td").html(count_check);
                    $(".retour").each(function(){
                        sum += +$(this).val();
                    })
                    $(".mtRetour").each(function(){
                        total_reste += +$(this).val();
                    })

                    $(e.target).parent().parent().parent().parent().parent().parent().parent().parent().children("div:nth-child(2)").children("div:nth-child(2)").children("div").children("table").children("tbody").children("tr:nth-child(2)").children("td").html(sum);
                    $(e.target).parent().parent().parent().parent().parent().parent().parent().parent().children("div:nth-child(2)").children("div:nth-child(2)").children("div").children("table").children("tbody").children("tr:nth-child(3)").children("td").html(total_reste+" DH");
                    $(e.target).parent().parent().parent().children("td").children(".totalReste").val(total_reste);

                }
                else{
                    let count_check = $(".pro:checked").length;
                    $(e.target).parent().parent().parent().children("td").children(".qte").prop("disabled",true);
                    $(e.target).parent().parent().parent().children("td").children(".retour").prop("disabled",true);
                    $(e.target).parent().parent().parent().children("td").children(".reste").prop("disabled",true);
                    $(e.target).parent().parent().parent().children("td").children(".mtRetour").prop("disabled",true);
                    $(e.target).parent().parent().parent().css("background","transparent");
                    let qte_retour = $(e.target).parent().parent().parent().children("td").children(".retour").val();
                    let price = $(e.target).parent().parent().children(".price").val();
                    $(e.target).parent().parent().parent().children("td").children(".montant").val(price * qte_retour);
                    $(e.target).parent().parent().parent().children("td").children(".retour").val(0);
                    $(e.target).parent().parent().parent().children("td").children(".reste").val(0);
                    $(e.target).parent().parent().parent().children("td").children(".mtRetour").val(0);
                    $(e.target).parent().parent().parent().parent().parent().parent().parent().parent().children("div:nth-child(2)").children("div:nth-child(2)").children("div").children("table").children("tbody").children("tr:nth-child(1)").children("td").html(count_check);
                }
            })
            $(".retour").on("keyup",function(e){
                let nbr_retour = $(e.target).val()
                let qte = $(e.target).parent().parent().children("td").children(".qte").val();
                let price = $(e.target).parent().parent().children("td").children(".price").val();
                let retour = $(e.target).val();
                let resu_retour = qte - retour;
                let sum = 0;
                let total = 0;
                $(e.target).parent().parent().children("td").children(".reste").val(resu_retour);
                $(e.target).parent().parent().children("td").children(".mtRetour").val(price * nbr_retour);
                $(e.target).parent().parent().parent().parent().parent().parent().parent().children("form").children("div").children("table").children("tbody").children("tr").children("td").children(".retour").each(function(){
                    sum += +$(this).val();
                })
                $(e.target).parent().parent().parent().parent().parent().parent().parent().children("form").children("div").children("table").children("tbody").children("tr").children("td").children(".mtRetour").each(function(){
                    total += +$(this).val();
                })
                $(e.target).parent().parent().parent().parent().parent().parent().parent().children("div:nth-child(2)").children("div:nth-child(2)").children("div").children("table").children("tbody").children("tr:nth-child(2)").children("td").html(sum);
                $(e.target).parent().parent().parent().parent().parent().parent().parent().children("div:nth-child(2)").children("div:nth-child(2)").children("div").children("table").children("tbody").children("tr:nth-child(3)").children("td").html(total);
                // let qte = $(e.target).val();
                // let price = $(e.target).parent().parent().children("td").children(".price").val();
                // $(e.target).parent().parent().children("td").children(".montant").val(qte * price);
            })


            $(".payer").on("keyup",function(e){
                let payer = $(e.target).val();
                let reste = $(e.target).parent().parent().parent().children("div").children("div").children(".resteActuel").val();
                $(e.target).parent().parent().parent().children("div").children("div").children(".reste").val(reste - payer);

            })
        })
    </script>
@endsection
