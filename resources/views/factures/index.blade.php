@extends('layouts.master')
@section('content')
@include('sweetalert::alert')
<div class="d-flex justify-content-between mb-2">
    <h5 class="m-0">Liste des clients</h5>
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
    </ol>
</div>





<div class="card">
    <div class="card-body p-2">
            @can('facture-create')
                <a href="{{ route('facture.create') }}" class="btn btn-primary btn-sm mb-2">
                    <span class="mdi mdi-plus-circle-outline align-middle"></span>
                    Ajouter
                </a>
            @endcan
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered mb-0 table-sm" id="dataTableExample">
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
                                        "bg-success"=>$facture->statut == "valider",
                                    ])>
                                        {{ $facture->statut }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    @can("facture-edit")
                                        <a href="{{ route('facture.edit',$facture) }}"
                                        @class([
                                            "btn","bg-trasparent","p-0","border-0","text-primary",
                                            "d-none"=>$facture->statut == "valider",

                                        ])>
                                            <i class="mdi mdi-pencil" style="font-size: 0.90rem;"></i>
                                        </a>
                                    @endcan
                                    @can("facture-edit")
                                        <a href="{{ route('facture-pdf.show',$facture) }}" class="btn bg-trasparent p-0 border-0 text-primary">
                                            <i class="mdi mdi-file" style="font-size: 0.90rem;"></i>
                                        </a>
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

