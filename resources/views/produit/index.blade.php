@extends('layouts.master')
@section('content')
@include('sweetalert::alert')
<div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
    <h5 class="m-0">Liste des produits</h5>
    <ol class="breadcrumb m-0 py-2">
        <li class="text-white fw-bolder">
            <a href="{{ route('home') }}" class="text-white">
                Acceuil
            </a>
        </li>
        @can('produit-list')
            <li class="text-white mx-2 fw-bolder">
                <span class="ti ti-angle-right" style="font-size:0.60rem"></span>
            </li>
            <li class="text-white fw-bolder">
                <a href="{{ route('produit.index') }}" class="text-white">
                    Liste des produits
                </a>
            </li>
        @endcan
    </ol>
</div>
<div class="card">
    <div class="card-body p-2">
        <div class="d-flex justify-content-between mb-3">
            @can("produit-create")
                <a href="{{ route('produit.create') }}" class="btn btn-primary btn-sm">
                    <span class="mdi mdi-plus-circle-outline align-middle"></span>
                    Ajouter
                </a>
            @endcan
            <ul class="nav nav-pills">
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-1 px-2 active" id="liste-tab" data-bs-toggle="tab" data-bs-target="#liste" type="button" role="tab" aria-controls="liste" aria-selected="true">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link py-1 px-2" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid" type="button" role="tab" aria-controls="grid" aria-selected="false">
                        <span class="mdi mdi-dots-grid"></span>
                    </button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="liste" role="tabpanel" aria-labelledby="liste-tab">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered mb-0 table-sm">
                        <thead class="table-success">
                            <tr>
                                <th>Image</th>
                                <th>Référrence</th>
                                <th>Désignation</th>
                                <th>Prix d'achat</th>
                                <th>Prix de vente</th>
                                <th>Prix Unitaire</th>
                                <th>Categorie</th>
                                <th>Quantite</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produits as $produit)
                                <tr>
                                    <td class="align-middle">
                                        @if($produit->image != null)
                                            <img src="{{ asset('storage/img/produits/'.$produit->image ?? '') }}" alt="">
                                        @else
                                            <img src="{{ asset('images/produit_default.png') }}" alt="" class="avatar-sm">
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @can("produit-show")
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-primary fw-bolder" data-bs-toggle="modal" data-bs-target="#show{{ $produit->id }}">
                                                {{ $produit->reference ?? '' }}
                                            </button>
                                        @else
                                            <h6 class="m-0 text-center text-primary">

                                                {{ $produit->reference ?? '' }}
                                            </h6>
                                        @endcan
                                    </td>
                                    <td class="align-middle">{{ $produit->designation }}</td>
                                    <td class="align-middle fw-bolder">{{ $produit->prix_achat." DH" }}</td>
                                    <td class="align-middle fw-bolder">{{ $produit->prix_vente." DH" }}</td>
                                    <td class="align-middle fw-bolder">{{ $produit->prix_unitaire." DH" }}</td>
                                    <td class="align-middle">{{ $produit->categorie->nom }}</td>
                                    <td class="align-middle">{{ $produit->quantite }}</td>
                                    <td class="align-middle">
                                        @can("produit-edit")
                                            <a href="{{ route('produit.edit',$produit) }}" class="btn p-0 bg-transparent border-0 text-primary">
                                                <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                            </a>
                                        @endcan
                                        @can("produit-delete")
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $produit->id }}">
                                                <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                            </button>
                                        @endcan
                                        @can("produit-show")
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-warning" data-bs-toggle="modal" data-bs-target="#montant{{ $produit->id }}">
                                                <i class="ti-menu" style="font-size: 0.90rem;"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="9">
                                    <h6 class="text-center m-0">
                                        Aucun produit saisir
                                    </h6>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                <div class="row row-cols-4">
                    @forelse ($produits as $produit)
                        <div class="col  mb-3">
                            <div class="card h-100">
                                <div class="card-body p-2">
                                    <div class="row justify-content-center mb-2">
                                        <div class="col-lg-8">
                                            @if($produit->image != null)
                                                <img src="{{ asset('storage/img/produits/'.$produit->image ?? '') }}" alt="" class="img-fluid">
                                            @else
                                                <img src="{{ asset('images/produit_default.png') }}" alt="" class="img-fluid">
                                            @endif
                                        </div>
                                    </div>
                                    <h6 class="text-center mb-2 text-primary">
                                        @can("produit-show")
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-primary fw-bolder" data-bs-toggle="modal" data-bs-target="#show{{ $produit->id }}">
                                                {{ $produit->reference ?? '' }}
                                            </button>
                                        @else
                                            <h6 class="m-0 text-center text-primary">

                                                {{ $produit->reference ?? '' }}
                                            </h6>
                                        @endcan
                                    </h6>
                                    <h6 class="text-center mb-2 text-uppercase">
                                        {{ Str::limit($produit->designation,'25') }}
                                        <!-- {{ $produit->designation ?? '' }} -->
                                    </h6>
                                    <p class="mb-2">
                                        {{ Str::limit($produit->designation,'50') }}
                                    </p>
                                    <div class="">
                                            <h5 class="m-0 text-center text-primary">{{ $produit->prix_vente }} DH</h5>
                                    </div>

                                </div>
                                <div class="card-footer bg-warning">
                                    <div class="d-flex justify-content-between">
                                        @can("produit-edit")
                                            <a href="{{ route('produit.edit',$produit) }}" class="btn p-0 bg-transparent border-0 text-dark">
                                                <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                            </a>
                                        @endcan
                                        @can("produit-delete")
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-dark" data-bs-toggle="modal" data-bs-target="#delete{{ $produit->id }}">
                                                <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                            </button>
                                        @endcan
                                        @can("produit-show")
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-dark" data-bs-toggle="modal" data-bs-target="#montant{{ $produit->id }}">
                                                <i class="ti ti-menu" style="font-size: 0.90rem;"></i>
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>


    @foreach ($produits as $produit)
        <div class="modal fade" id="delete{{ $produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <form action="{{ route('produit.destroy',$produit) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <div class="p-3 mb-3">
                                <h5 class="mb-2 fw-bolder text-center">Voulez-vous supprimer défenitivement du produit</h5>
                                <h6 class="text-danger text-center fw-bolder w-100">{{ $produit->reference }} => {{ $produit->designation }}</h6>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-success p-3 w-100" style="border-radius:0;border-bottom-left-radius: 0.375rem;" data-bs-dismiss="modal" aria-label="btn-close">
                                    Fermer
                                </button>
                                <button type="submit" class="btn btn-danger p-3 w-100 fw-bolder fs-6" style="border-radius:0;border-bottom-right-radius: 0.375rem;" >
                                    Supprimer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="show{{ $produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary py-2">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Produit : {{ $produit->reference }}</h6>
                        <button type="button" class="btn btn-transparent p-0 border-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5">
                                @if($produit->image != null)
                                    <img src="{{ asset('storage/img/produits/'.$produit->image ?? '') }}" alt="" class="w-100">
                                @else
                                    <img src="{{ asset('images/produit_default.png') }}" alt="" class="w-100">
                                @endif
                            </div>
                            <div class="col">
                                <h5 class="text-uppercase mb-2">
                                    {{ $produit->designation ?? '' }}
                                </h5>
                                <div class="table-reponsive">
                                    <table class="table table-bordered table-sm m-0">
                                        <tbody>
                                            <tr>
                                                <th class="bg-light col-3">Référence</th>
                                                <td>
                                                    <span class=" badge bg-warning text-dark fs-6"> {{ $produit->categorie->nom ?? '' }} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-3">Catégorie</th>
                                                <td> {{ $produit->categorie->nom ?? '' }} </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-3">quantite</th>
                                                <td> {{ $produit->quantite ?? ""}} </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-3">prix vente</th>
                                                <td> {{ $produit->prix_vente." DH"}} </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-3">prix d'achat</th>
                                                <td> {{ $produit->prix_achat." DH"}} </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-3">prix unitaire</th>
                                                <td> {{ $produit->prix_unitaire." DH"}} </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-3 align-middle">description</th>
                                                <td> {{ $produit->description ?? ""}} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="montant{{ $produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary py-2">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Produit : {{ $produit->reference }}</h6>
                        <button type="button" class="btn btn-transparent p-0 border-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5">
                                @if($produit->image != null)
                                    <img src="{{ asset('storage/img/produits/'.$produit->image ?? '') }}" alt="" class="w-100">
                                @else
                                    <img src="{{ asset('images/produit_default.png') }}" alt="" class="w-100">
                                @endif
                            </div>
                            <div class="col">
                                <h5 class="text-uppercase mb-2">
                                    {{ $produit->designation ?? '' }}
                                </h5>

                                <h6 class="text-center text-primary text-uppercase mb-2 pb-1 border border-solid border-primary border-2 border-top-0 border-end-0 border-start-0">
                                    commandes
                                </h6>
                                @php
                                    $produit_today = \App\Models\FactureProduit::whereDate('created_at', '=', date('Y-m-d'))->count();
                                    $quantite_today= \App\Models\FactureProduit::where("reference",$produit->reference)->whereDate('created_at', '=', date('Y-m-d'))->sum("quantite");
                                    $sum_pu_today= \App\Models\FactureProduit::where("reference",$produit->reference)->whereDate('created_at', '=', date('Y-m-d'))->sum("prix_unitaire");

                                    $count_produit = \App\Models\FactureProduit::where("reference",$produit->reference)->count();
                                    $quantite_produit = \App\Models\FactureProduit::where("reference",$produit->reference)->sum("quantite");
                                    $sum_pu = \App\Models\FactureProduit::where("reference",$produit->reference)->sum("prix_unitaire");

                                @endphp
                                <div class="table-reponsive">
                                    <table class="table table-borderedless table-sm m-0">
                                        <tbody>
                                            <tr>
                                                <th class="table-primary text-center" colspan="2">aujourd'hui</th>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-8">produits</th>
                                                <td>{{ $produit_today ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-8">quantités de produit</th>
                                                <td>{{ $quantite_today ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-8">total prix unitaire de produit</th>
                                                <td>{{ $sum_pu_today ?? 0 }} DH</td>
                                            </tr>
                                            <tr>
                                                <th class="table-primary text-center" colspan="2">tout les jours</th>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">produits</th>
                                                <td>{{ $count_produit ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">quantités de produit</th>
                                                <td>{{ $quantite_produit ?? "" }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light">total prix unitaire de produit</th>
                                                <td>{{ $sum_pu_today ?? 0 }} DH</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach



@endsection



@section('script')
<script>
    if ($(".selecttwo").length) {
    $(".selecttwo").select2({
        dropdownParent: $(".fade")
      });
  }
</script>
@endsection