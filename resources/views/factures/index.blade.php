@extends('layouts.master')
@section('title')
Liste des factures
@endsection
@section('content')
@include('sweetalert::alert')
<div class="card">
    <div class="card-body p-2">
        <div class="d-flex justify-content-center">
            @can('facture-create')
                <a href="{{ route('facture.create') }}" class="btn btn-primary btn-sm mb-2">
                    <span class="mdi mdi-plus-circle-outline align-middle"></span>
                    Ajouter
                </a>
            @endcan
        </div>
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
                        <tr>
                            <td class="align-middle">
                                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#client{{ $facture->client_id }}">
                                    <h6 class="m-0">{{  $facture->client->raison_sociale ?? "" }}</h6>
                                </button>
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
                                    "bg-danger"=>$facture->statut == "en cours",
                                    "bg-success"=>$facture->statut == "validé",
                                ])>
                                    {{ $facture->statut }}
                                </span>
                            </td>
                            {{-- <td class="align-middle">
                                @can('categorie-edit')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#add-produit{{ $facture->id }}">

                                        <i class="mdi mdi-plus-circle-outline" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                                @can('categorie-edit')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary {{ count($facture->produits) == 0 ? 'd-none':'' }}" data-bs-toggle="modal" data-bs-target="#listePro{{ $facture->id }}">
                                        <i class="mdi mdi-cube-outline" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                            </td> --}}



                            <td class="align-middle">
                                @if ($facture->statut == "validé")
                                    @can('facture-paiement-list')
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-success" data-bs-toggle="modal" data-bs-target="#historyPaiement{{ $facture->id }}">
                                            <i class="mdi mdi-history" style="font-size: 0.90rem;"></i>
                                            </button>
                                    @endcan
                                    @can('facture-paiement-create')
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-success {{ $facture->reste == 0 ? 'disabled':'' }}" data-bs-toggle="modal" data-bs-target="#addPaiement{{ $facture->id }}">
                                            <i class="mdi mdi-plus-circle-outline" style="font-size: 0.90rem;"></i>
                                        </button>
                                    @endcan
                                    <a href="{{ route('facture-pdf.show',$facture) }}" class="btn bg-trasparent p-0 border-0 text-primary">
                                        <i class="mdi mdi-file" style="font-size: 0.90rem;"></i>
                                    </a>

                                @else
                                    @can("facture-edit")
                                        <a href="{{ route('facture.edit',$facture) }}" class="{{ $facture->statut == "validé" ? 'd-none':'' }}">
                                            <i class="mdi mdi-pencil" style="font-size: 0.90rem;"></i>
                                        </a>
                                    @endcan
                                    @can("facture-destroy")
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $facture->id }}">
                                            <i class="mdi mdi-trash-can" style="font-size: 0.90rem;"></i>
                                        </button>
                                    @endcan
                                    @can('facture-edit')
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-success" {{ $facture->statut == 'validé' ? 'disabled':'' }} data-bs-toggle="modal" data-bs-target="#validation{{ $facture->id }}">
                                            <i class="mdi mdi-check-bold" style="font-size: 0.90rem;"></i>
                                        </button>
                                    @endcan

                                @endif


                                @can('facture-show')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-warning" data-bs-toggle="modal" data-bs-target="#show{{ $facture->id }}">
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

        <div class="modal fade" id="listePro{{ $facture->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel"></h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body p-2">

                        <a href="{{route('facture.produit',$facture)}}" class="btn btn-sm btn-primary px-3">
                            <span class="mdi mdi-cog-outline align-middle"></span>
                            <span>Management les produits du catégories</span>
                        </a>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm m-0">
                                <thead>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="historyPaiement{{ $facture->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Hitorique du paiement</h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body p-2">
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
                                                {{ $facture_paiement->type_paiement }}
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
                                                @can('categorie-destroy')
                                                    <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $facture_paiement->id }}">
                                                        <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                                    </button>
                                                @endcan
                                            </td>
                                        </tr>



                                    @empty
                                        <tr>
                                            <td class="align-middle" colspan="4">
                                                <h6 class="text-center m-0 text-uppercase text-danger py-1">
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
            </div>
        </div>

        <div class="modal fade" id="addPaiement{{ $facture->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
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
                            <input type="hidden" name="client_id" value="{{$facture->client->id}}">
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Type du paiement</label>
                                <select name="type" id="" class="form-select type">
                                    <option value="">Choisir le type du paiement</option>
                                    <option value="espèce">Espèce</option>
                                    <option value="chèque">Chèque</option>
                                </select>
                            </div>
                            <div id="cheque" class="bg-light p-2 my-2">

                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Numéro</label>
                                    <input type="text" name="numero" id="" class="form-control">
                                </div>

                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Nom bank</label>
                                    <select name="nom_bank" id="" class="form-select">
                                        <option value="">Choisir le nom du bank</option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id ?? '' }}">{{ $bank->nom_bank ?? '' }}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Date chèque</label>
                                    <input type="date" name="date_cheque" id="" class="form-control">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Date enquisement</label>
                                    <input type="date" name="date_enquisement" id="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Montant TTC</label>
                                <input type="number" name="" id="" class="form-control" value="{{$facture->prix_ttc ?? ''}}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Montant payer</label>
                                <input type="number" name="payer" id="" class="form-control payer" step="any" min="0" value="" max="{{ $facture->reste ?? ''}}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Montant reste Actuel</label>
                                <input type="number" id="" step="any" class="form-control resteActuel" value="{{ $facture->reste ?? ''}}" disabled>
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Montant reste nouveau</label>
                                <input type="number" name="reste" id="" step="any" class="form-control reste" value="" readonly>
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
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Information du facture</h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body p-2">

                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#facture{{ $facture->id }}" role="tab">
                                    Facture
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#produits{{ $facture->id }}" role="tab">Produits</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#paiement{{ $facture->id }}" role="tab">Paiements</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-1" id="facture{{ $facture->id }}" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered m-0 table-sm mb-2">
                                        <thead class="table-success">
                                            <tr>
                                                <th class="col-4">client</th>
                                                <th class="col-4">référence</th>
                                                <th class="col-4">statut</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle"> {{ $facture->client->raison_sociale ?? '' }} </td>
                                                <td class="align-middle"> {{ $facture->num_facture ?? '' }} </td>
                                                <td class="align-middle"> {{ $facture->statut ?? '' }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered m-0 table-sm mb-2">
                                        <thead class="table-success">
                                            <tr>
                                                <th class="col-4">ht</th>
                                                <th class="col-4">ttc</th>
                                                <th class="col-4">tva</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle"> {{ $facture->prix_ht ?? '' }} DH</td>
                                                <td class="align-middle"> {{ $facture->prix_ttc ?? '' }} DH </td>
                                                <td class="align-middle"> {{ $facture->taux_tva ?? '' }} %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered m-0 table-sm mb-2">
                                        <thead class="table-success">
                                            <tr>
                                                <th class="col-4">remise</th>
                                                <th class="col-4">etat paiement</th>
                                                <th class="col-4">date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle"> {{ $facture->remise ?? '' }} %</td>
                                                <td class="align-middle"> {{ $facture->etat_paiement ?? '' }} </td>
                                                <td class="align-middle"> {{ $facture->date ?? '' }} %</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered m-0 table-sm mb-2">
                                        <thead class="table-success">
                                            <tr>
                                                <th class="col-4">payer</th>
                                                <th class="col-4">reste</th>
                                                <th class="col-4">entreprise</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="align-middle"> {{ $facture->payer ?? '' }} DH</td>
                                                <td class="align-middle"> {{ $facture->reste ?? '' }} DH </td>
                                                <td class="align-middle"> {{ $facture->entreprise->raison_sociale ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane py-2 p-1" id="produits{{ $facture->id }}" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered m-0 table-sm m-0">
                                        <thead>
                                            <tr>
                                                <th>référence</th>
                                                <th>désignation</th>
                                                <th>prix</th>
                                                <th>quantite</th>
                                                <th>montant</th>
                                                <th>état</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($facture->produits as $facture_produit)
                                                <tr>
                                                    <td class="align-middle"> {{ $facture_produit->produit->reference ?? '' }} </td>
                                                    <td class="align-middle"> {{ $facture_produit->produit->designation ?? '' }} </td>
                                                    <td class="align-middle"> {{ $facture_produit->produit->prix_vente ?? '' }} DH</td>
                                                    <td class="align-middle"> {{ $facture_produit->quantite ?? '' }} </td>
                                                    <td class="align-middle"> {{ $facture_produit->montant ?? '' }} DH</td>
                                                    <td class="align-middle">
                                                        <span class="{{ $facture->statut == "validé" ? 'mdi mdi-arrow-right-thick text-success':'mdi mdi-pause text-warning' }}"></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane py-2 p-1" id="paiement{{ $facture->id }}" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered m-0 table-sm m-0">
                                        <thead>
                                            <tr>
                                                <th>type</th>
                                                <th>payer</th>
                                                <th>reste</th>
                                                <th>date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($facture->paiement as $paiement)
                                                <tr>
                                                    <td class="align-middle"> {{ $paiement->type_paiement ?? '' }} </td>
                                                    <td class="align-middle text-success fw-bolder"> {{ $paiement->payer  ?? '' }} DH</td>
                                                    <td class="align-middle text-danger fw-bolder"> {{ $paiement->reste  ?? '' }} DH</td>
                                                    <td class="align-middle"> {{ $paiement->date_paiement  ?? '' }} </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                            <div class="d-flex justify-content-center mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="force" id="del{{$facture->id}}" class="form-check-input">
                                    <label for="del{{$facture->id}}" class="form-check-label fw-bolder">Ignorer la corbeille et supprimer définitivement du facture</label>
                                </div>

                            </div>

                            <h6 class="text-danger mb-2 text-center">{{ $facture->num }}</h6>
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


        @foreach ($facture->paiement as $facture_paiement)


            <div class="modal fade" id="delete{{ $facture_paiement->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{ route('facture-paiement.destroy',$facture_paiement) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                {{-- <input type="hidden" name="facture_id" value="{{  }}"> --}}
                                <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>
                                <h6 class="mb-2 fw-bolder text-center text-muted">Voulez-vous supprimer défenitivement du paiement</h6>
                                <h6 class="text-danger mb-2 text-center">{{ $facture_paiement->num }}</h6>
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
        @endforeach



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
                    $(e.target).parent().parent().children("#cheque").show(450);
                }
                else{
                    $(e.target).parent().parent().children("#cheque").hide(450);
                }


                if(type == ""){

                    $(e.target).parent().parent().children("div").children(".payer").prop("disabled",true);
                }
                else{
                    $(e.target).parent().parent().children("div").children(".payer").prop("disabled",false);

                }
            })



            $(".payer").on("keyup",function(e){
                let payer = $(e.target).val();
                let reste = $(e.target).parent().parent().children("div").children(".resteActuel").val();
                $(e.target).parent().parent().children("div").children(".reste").val(reste - payer);

            })
        })
    </script>
@endsection
