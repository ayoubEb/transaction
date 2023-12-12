@extends('layouts.master')
@section('title')
    Liste des achats
@endsection
@section('content')
@include('sweetalert::alert')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Liste des achats
        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-body p-2">
        <a href="{{ route('ligneAchat.create') }}" class="btn btn-primary px-5 fw-bolder mb-3">
            <span class="mdi mdi-plus-circle-outline align-middle"></span>
            <span>Nouveau</span>
        </a>
        <div class="table-responsive">
            <table class="table table-bordered table-sm m-0 datatable">
                <thead>
                    <tr>
                        <th>fournisseur</th>
                        <th>numero</th>
                        <th>date</th>
                        <th>nombre.pro</th>
                        <th>montant ht</th>
                        <th>montant ttc</th>
                        <th>payer</th>
                        <th>reste</th>
                        <th>statut</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ligneAchats as $ligne)
                        <tr>
                            <td class="align-middle">
                                <button type="button" class="btn btn-link fw-bolder p-0 border-0 shadow-none" data-bs-toggle="modal" data-bs-target="#fourni{{ $ligne->fournisseur->id }}">
                                    {{ $ligne->fournisseur->raison_sociale ?? '' }}
                                </button>
                            </td>
                            <td class="align-middle"> {{ $ligne->num_achat ?? '' }} </td>
                            <td class="align-middle"> {{ $ligne->date ?? '' }} </td>
                            <td class="align-middle"> {{ $ligne->nombre_produit ?? '' }} </td>
                            <td class="align-middle fw-bolder"> {{ $ligne->prix_ht ?? 0 }} DH </td>
                            <td class="align-middle fw-bolder"> {{ $ligne->prix_ttc ?? 0 }} DH </td>
                            <td class="align-middle fw-bolder text-success"> {{ $ligne->payer ?? 0 }} DH </td>
                            <td class="align-middle fw-bolder text-danger"> {{ $ligne->reste ?? 0 }} DH </td>
                            <td class="align-middle"> {{ $ligne->statut ?? '' }} </td>
                            <td class="align-middle fw-bolder">
                                <button type="button" class="btn btn-secondary py-0 px-1 shadow-none" data-bs-toggle="modal" data-bs-target="#achats{{ $ligne->id }}">
                                    <span class="mdi mdi-cube-outline "></span>
                                </button>
                                @if ($ligne->statut == "validé")
                                    <button type="button" class="btn btn-success py-0 px-1 shadow-none" data-bs-toggle="modal" data-bs-target="#addPaiement{{ $ligne->id }}">
                                        <span class="mdi mdi-currency-usd "></span>
                                    </button>

                                    <button type="button" class="btn btn-success py-0 px-1 shadow-none" {{ $ligne->etat_paiement == "en attente"  ? "disabled":""}} data-bs-toggle="modal" data-bs-target="#historiquePaiement{{ $ligne->id }}">
                                        <span class="mdi mdi-history "></span>
                                    </button>

                                @else
                                    <button type="button" class="btn btn-success py-0 px-1 shadow-none" data-bs-toggle="modal" data-bs-target="#valider{{ $ligne->id }}">
                                        <span class="mdi mdi-check-bold "></span>
                                    </button>

                                    <a href="{{ route('ligneAchat.edit',$ligne) }}" class="btn btn-primary py-0 px-1 shadow-none">
                                        <span class="mdi mdi-pencil-outline"></span>
                                    </a>

                                @endif
                                <button type="button" class="btn btn-warning py-0 px-1 shadow-none" data-bs-toggle="modal" data-bs-target="#show{{ $ligne->id }}">
                                    <span class="mdi mdi-information-outline "></span>
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



@forelse ($ligneAchats as $ligne)
    <div class="modal fade" id="valider{{ $ligne->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark py-3">
                    <h6 class="modal-title m-0 text-white fw-bolder text-uppercase" >Validation du ligne d'achat</h6>
                    <button  class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-uppercase text-center mb-2">
                        vous êtes valider votre achat  ?
                    </h6>
                    <form action="{{ route('ligneAchat.valider',$ligne) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success px-5">Valider</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addPaiement{{ $ligne->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark py-3">
                    <h6 class="modal-title m-0 text-white fw-bolder text-uppercase" >Paiement du ligne d'achat : {{ $ligne->num_achat ?? '' }} </h6>
                    <button  class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('achatPaiement.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="ligne_achat_id" value="{{$ligne->id}}">
                        <input type="hidden" name="fournisseur_id" value="{{$ligne->fournisseur_id ?? ''}}">
                        <div class="row justify-content-center mb-2">
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
                                    <input type="number" name="" id="" class="form-control" value="{{$ligne->prix_ttc ?? ''}}" disabled>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Montant reste Actuel</label>
                                    <input type="number" id="" step="any" class="form-control resteActuel" value="{{ $ligne->reste ?? ''}}" disabled>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Montant payer</label>
                                    <input type="number" name="payer" id="" class="form-control payer" step="any" min="0" value="" max="{{ $ligne->reste ?? ''}}" disabled>
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

    <div class="modal fade" id="historiquePaiement{{ $ligne->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark py-3">
                    <h6 class="modal-title m-0 text-white fw-bolder text-uppercase" >Paiement du ligne d'achat : {{ $ligne->num_achat ?? '' }} </h6>
                    <button  class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-3">
                        <div class="col mb-2">
                            <div class="card m-0 bg-light">
                                <div class="card-body py-3">
                                    <h6 class="text-center m-0 text-uppercase">
                                        montant ttc : {{ $ligne->prix_ttc ?? 0 }} DH
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="card m-0 bg-success">
                                <div class="card-body py-3">
                                    <h6 class="text-center text-white m-0 text-uppercase">
                                        montant payer : {{ $ligne->payer ?? 0 }} DH
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="card m-0 bg-danger">
                                <div class="card-body py-3">
                                    <h6 class="text-center m-0 text-uppercase text-white">
                                        montant reste : {{ $ligne->reste ?? 0 }} DH

                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm m-0">
                            <thead class="table-light">
                                <tr>
                                    <th>type</th>
                                    <th>payer</th>
                                    <th>reste</th>
                                    <th>date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ligne->paiements as $i =>  $paiement)
                                    <tr>
                                        <td class="align-middle">
                                            @if ($paiement->type_paiement == "espèce")

                                                <span class="fw-bolder">{{ $paiement->type_paiement ?? '' }} </span>
                                            @else
                                                <button class="accordion-button fw-bolder text-center collapsed w-100"  type="button"  data-bs-toggle="collapse"  data-bs-toggle="collapse" data-bs-target="#type{{$i}}" aria-expanded="false" aria-controls="type{{$i}}">
                                                    <span class="mdi mdi-plus-circle align-middle text-success me-1 mdi-18px"></span>
                                                    <span>{{ $paiement->type_paiement ?? '' }} </span>
                                                </button>

                                            @endif
                                        </td>
                                        <td class="align-middle fw-bold text-success"> {{ $paiement->payer ?? 0 }} DH </td>
                                        <td class="align-middle fw-bold text-danger"> {{ $paiement->reste ?? 0 }} DH </td>
                                        <td class="align-middle "> {{ $paiement->date_paiement ?? '' }} </td>
                                    </tr>
                                    <td colspan="4" class="p-0">
                                        <div id="type{{$i}}" class="accordion-collapse collapse" aria-labelledby="type{{$i}}" data-bs-parent="#type{{$i}}">
                                            <table class="table table-bordered table-sm m-0 ">
                                                <thead>
                                                    <tr class="fw-bolder table-primary">
                                                        <th class="text-dark">numero</th>
                                                        <th class="text-dark">bank</th>
                                                        <th class="text-dark">date</th>
                                                        <th class="text-dark">date enquisement</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($paiement->cheques as $cheque)
                                                        <tr>
                                                            <td class="align-middle">
                                                                {{ $cheque->numero ?? '' }}
                                                            </td>
                                                            <td class="align-middle">
                                                                {{ $cheque->bank->nom_bank ?? '' }}
                                                            </td>
                                                            <td class="align-middle">
                                                                {{ $cheque->date_cheque ?? '' }}
                                                            </td>
                                                            <td class="align-middle">
                                                                {{ $cheque->date_enquisement ?? '' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="show{{ $ligne->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark py-3">
                    <h6 class="modal-title m-0 text-white fw-bolder text-uppercase" >Informaiton du ligne d'achat : {{ $ligne->num_achat ?? '' }} </h6>
                    <button  class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-2">
                        <div class="col">
                            <ul class="list-group">
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">numero&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 fw-normal text-uppercase fs-12"> {{ $ligne->num_achat ?? '' }} </h6>
                                </li>
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">forunisseur&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 fw-normal text-uppercase fs-12"> {{ $ligne->num_achat ?? '' }} </h6>
                                </li>
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">statut&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 fw-normal text-uppercase fs-12">
                                        <span @class([
                                            "fw-bolder","px-2","py-1","rounded",
                                            "text-bg-success" => $ligne->statut == "valider",
                                            "text-bg-warning" => $ligne->statut == "en cours"
                                        ])>
                                            {{ $ligne->statut ?? '' }}
                                        </span>
                                    </h6>
                                </li>
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">montant ht&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 fw-normal text-uppercase fs-12"> {{ $ligne->prix_ht ?? 0 }} dh</h6>
                                </li>
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">montant ttc&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 fw-normal text-uppercase fs-12"> {{ $ligne->prix_ttc ?? 0 }} dh</h6>
                                </li>
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">taux tva&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 fw-normal text-uppercase fs-12"> {{ $ligne->taux_tva ?? 0 }} %</h6>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="list-group">
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">état paiement&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 fw-normal text-uppercase fs-12">
                                        <span @class([
                                            "fw-bolder","px-2","py-1","rounded",
                                            "text-bg-success" => $ligne->etat_paiement == "en complement",
                                            "text-bg-warning" => $ligne->etat_paiement == "avance",
                                            "text-bg-danger" => $ligne->etat_paiement == "en attente"
                                        ])>
                                            {{ $ligne->etat_paiement ?? '' }}
                                        </span>
                                    </h6>
                                </li>
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">état livraison&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 fw-normal text-uppercase fs-12">
                                        <span @class([
                                            "fw-bolder","px-2","py-1","rounded",
                                            "text-bg-danger" => $ligne->etat_livraison == "en attente",
                                            "text-bg-warning" => $ligne->etat_livraison == "en cours",
                                            "text-bg-success" => $ligne->etat_livraison == "en livrer"
                                        ])>
                                            {{ $ligne->etat_livraison ?? '' }}
                                        </span>
                                    </h6>
                                </li>
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">nombre des achats&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 fw-normal text-uppercase fs-12"> {{ $ligne->nombre_achat ?? '' }} </h6>
                                </li>
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">date&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 fw-normal text-uppercase fs-12"> {{ $ligne->date ?? '' }} </h6>
                                </li>
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">payer&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 text-uppercase fs-12 text-success"> {{ $ligne->payer ?? '' }} dh</h6>
                                </li>
                                <li class="list-group-item py-3 d-flex justify-content-between">
                                    <h6 class="m-0 text-uppercase fs-12">reste&nbsp;:&nbsp;</h6>
                                    <h6 class="m-0 text-uppercase fs-12 text-danger"> {{ $ligne->reste ?? '' }} dh</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="achats{{ $ligne->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark py-3">
                    <h6 class="modal-title m-0 text-white fw-bolder text-uppercase" >les achats du ligne : {{ $ligne->num_achat ?? '' }} </h6>
                    <button  class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm m-0">
                            <thead class="table-light">
                                <tr>
                                    <th>réf.produit</th>
                                    <th>dés.produit</th>
                                    <th>prix d'achat</th>
                                    <th>quantité</th>
                                    <th>remise (%]</th>
                                    <th>montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ligne->achats as $achat)
                                    <tr>
                                        <td class="align-middle"> {{ $achat->produit->reference ?? '' }} </td>
                                        <td class="align-middle"> {{ $achat->produit->designation ?? '' }} </td>
                                        <td class="align-middle"> {{ $achat->produit->prix_achat ?? 0 }} DH</td>
                                        <td class="align-middle"> {{ $achat->quantite ?? '' }} </td>
                                        <td class="align-middle"> {{ $achat->remise ?? 0 }} %</td>
                                        <td class="align-middle fw-bolder"> {{ $achat->montant ?? 0 }} DH</td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty

@endforelse



@foreach ($fournisseurs as $fournisseur)
    <div class="modal fade" id="fourni{{ $fournisseur->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark py-3">
                    <h6 class="modal-title m-0 text-white fw-bolder text-uppercase" >Information du fournisseur {{ $fournsseur->raison_sociale ?? '' }}</h6>
                    <button  class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item py-2 active">
                            <h6 class="m-0 text-center  text-uppercase fs-12">Raison sociale</h6>
                        </li>
                        <li class="list-group-item py-2 text-center">
                            {{ $fournisseur->raison_sociale ?? '' }}
                        </li>

                        <li class="list-group-item py-2 active">
                            <h6 class="m-0 text-center  text-uppercase fs-12">rc</h6>
                        </li>
                        <li class="list-group-item py-2 text-center">
                            {{ $fournisseur->rc ?? '' }}
                        </li>

                        <li class="list-group-item py-2 active">
                            <h6 class="m-0 text-center  text-uppercase fs-12">ice</h6>
                        </li>
                        <li class="list-group-item py-2 text-center">
                            {{ $fournisseur->ice ?? '' }}
                        </li>

                        <li class="list-group-item py-2 active">
                            <h6 class="m-0 text-center  text-uppercase fs-12">email</h6>
                        </li>
                        <li class="list-group-item py-2 text-center">
                            {{ $fournisseur->email ?? '' }}
                        </li>

                        <li class="list-group-item py-2 active">
                            <h6 class="m-0 text-center  text-uppercase fs-12">téléphone</h6>
                        </li>
                        <li class="list-group-item py-2 text-center">
                            {{ $fournisseur->phone ?? '' }}
                        </li>

                        <li class="list-group-item py-2 active">
                            <h6 class="m-0 text-center  text-uppercase fs-12">adresse</h6>
                        </li>
                        <li class="list-group-item py-2 text-center">
                            {{ $fournisseur->adresse ?? '' }} - {{ $fournisseur->ville ?? '' }} , {{ $fournisseur->code_postal ?? '' }}
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->


<!-- Optional: Place to the bottom of scripts -->
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

            $(".payer").on("keyup",function(e){
                let payer = $(e.target).val();
                let reste = $(e.target).parent().parent().parent().children("div").children("div").children(".resteActuel").val();
                $(e.target).parent().parent().parent().children("div").children("div").children(".reste").val(reste - payer);

            })
        })
    </script>
@endsection