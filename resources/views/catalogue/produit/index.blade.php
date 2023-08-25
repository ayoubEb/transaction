@extends('layouts.master')
@section('title')
    Liste des produits
@endsection
@section('content')
@include('sweetalert::alert')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
      <li class="breadcrumb-item active" aria-current="page">Liste des produits</li>
    </ol>
</nav>

<div class="card">
    <div class="card-body p-2">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-3">
                        @can("produit-create")
                            <a href="{{ route('produit.create') }}" class="btn btn-primary w-100">
                                <span class="mdi mdi-plus-circle-outline align-middle"></span>
                                Ajouter
                            </a>
                        @endcan

                    </div>
                    <div class="col-lg-5">
                        <button type="button" class="btn btn-primary w-100"  data-bs-toggle="modal" data-bs-target="#addRapide">
                            <span class="mdi mdi-plus-circle-outline align-middle"></span>
                            <span class="text-uppercase fs-12"> Ajouter une produit rapidement</span>

                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mb-3">
            @can("produit-create")
            @endcan

        </div>
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered mb-0 table-sm datatable">
                    <thead class="table-success">
                        <tr>
                            <th>Référrence</th>
                            <th>code</th>
                            <th>Désignation</th>
                            <th>P.d'achat</th>
                            <th>P.vente</th>
                            <th>P.revients</th>
                            <th>Quantite</th>
                            <th>statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produits as $produit)
                            <tr>
                                <td class="align-middle">
                                    {{ $produit->reference ?? '' }}
                                </td>
                                <td class="align-middle">{{ $produit->code }}</td>
                                <td class="align-middle">{{ $produit->designation }}</td>
                                <td class="align-middle fw-bolder">{{ $produit->prix_achat ?? 0 }} DH</td>
                                <td class="align-middle fw-bolder">{{ $produit->prix_vente ?? 0 }} DH</td>
                                <td class="align-middle fw-bolder">{{ $produit->prix_revient ?? 0 }} DH</td>
                                <td class="align-middle">
                                   <span @class([
                                            'badge',
                                            'bg-danger' => $produit->quantite == 0,
                                            'bg-success' => $produit->quantite != 0,
                                        ])>
                                       {{ $produit->quantite ?? 'aucun' }}
                                   </span>
                                </td>
                                <td class="align-middle">
                                   <span
                                   @class([
                                            'badge',
                                            'bg-success' => date("Y-m-d",strtotime($produit->created_at)) ==  Carbon\Carbon::now()->format('Y-m-d'),
                                            'bg-danger' => date("Y-m-d",strtotime($produit->created_at)) <  Carbon\Carbon::now()->format('Y-m-d'),
                                            // 'bg-success' => $produit->quantite != 0,
                                        ])>

                                       {{ date("Y-m-d",strtotime($produit->created_at)) ==  Carbon\Carbon::now()->format('Y-m-d') ? "nouveau":"déja" }}
                                   </span>

                                </td>
                                <td class="align-middle">
                                    @can("produit-edit")
                                        <a href="{{ route('produit.edit',$produit) }}" class="btn p-0 bg-transparent border-0 text-primary">
                                            <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                        </a>
                                    @endcan
                                    @can("produit-destroy")
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $produit->id }}">
                                            <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                        </button>
                                    @endcan
                                    @can("produit-show")
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-warning" data-bs-toggle="modal" data-bs-target="#montant{{ $produit->id }}">
                                            <i class="ti-menu" style="font-size: 0.90rem;"></i>
                                        </button>
                                    @endcan
                                    @can("produit-show")
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-primary fw-bolder" data-bs-toggle="modal" data-bs-target="#show{{ $produit->id }}">
                                            <i class="ti ti-info"></i>
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

    </div>
</div>

<div class="modal fade" id="addRapide" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter une produit rapidement</h6>
                <button type="button" class="btn btn-transparent p-0 border-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('produit.rapidement')}}" method="post">
                    @csrf
                    <div class="row row-cols-2">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Code</label>
                                <input type="text" name="code" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Référence</label>
                                <input type="text" name="reference" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Désignation</label>
                                <input type="text" name="designation" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Prix vente</label>
                                <input type="text" name="prix_vente" id="" step="any" min="0"  class="form-control">
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Prix achat</label>
                                <input type="text" name="prix_achat" step="any" min="0"  id="" class="form-control">
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Prix revient</label>
                                <input type="number" name="prix_revient" step="any" min="0" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Quantite</label>
                                <input type="number" name="quantite" id="" min="1" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Description</label>
                                <textarea name="description" id=""  rows="10" class="form-control"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                       <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    @foreach ($produits as $produit)

        <div class="modal fade" id="delete{{ $produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('produit.destroy',$produit) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <h3 class="text-primary mb-3 textx-center">Confirmer la suppression</h3>
                            <h6 class="mb-2 fw-bolder text-center text-muted">
                                Voulez-vous vraiment déplacer du produit vers la corbeille
                            </h6>
                            <h6 class="text-danger mb-2 text-center">{{ $produit->designation }}</h6>
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

        <div class="modal fade" id="show{{ $produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-primary py-2">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Produit : {{ $produit->reference }}</h6>
                        <button type="button" class="btn btn-transparent p-0 border-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item py-2px bg-secondary">
                                <h6 class="m-0 text-uppercase fs-12 text-white text-center">
                                    code : {{ $produit->code ?? '' }}
                                </h6>
                            </li>
                            <li class="list-group-item py-2px">
                                <h6 class="m-0 text-uppercase fs-12">
                                    <span class="float-start">référence : </span>
                                    <span class="float-end fw-normal"> {{ $produit->reference ?? '' }} </span>
                                </h6>
                            </li>
                            <li class="list-group-item py-2px">
                                <h6 class="m-0 text-uppercase fs-12">
                                    <span class="float-start">désignation : </span>
                                    <span class="float-end fw-normal"> {{ $produit->designation ?? '' }} </span>
                                </h6>
                            </li>
                            <li class="list-group-item py-2px">
                                <h6 class="m-0 text-uppercase fs-12">
                                    <span class="float-start">désignation : </span>
                                    <span class="float-end fw-normal"> {{ $produit->designation ?? '' }} </span>
                                </h6>
                            </li>
                            <li class="list-group-item py-2px">
                                <h6 class="m-0 text-uppercase fs-12">
                                    <span class="float-start">quantité : </span>
                                    <span class="float-end fw-normal"> {{ $produit->quantite ?? '' }} </span>
                                </h6>
                            </li>
                            <li class="list-group-item py-2px">
                                <h6 class="m-0 text-uppercase fs-12">
                                    <span class="float-start">prix vente : </span>
                                    <span class="float-end fw-normal"> {{ $produit->prix_vente ?? 0 }} DH</span>
                                </h6>
                            </li>
                            <li class="list-group-item py-2px">
                                <h6 class="m-0 text-uppercase fs-12">
                                    <span class="float-start">prix achat : </span>
                                    <span class="float-end fw-normal"> {{ $produit->prix_axhat ?? 0 }} DH</span>
                                </h6>
                            </li>
                            <li class="list-group-item py-2px">
                                <h6 class="m-0 text-uppercase fs-12">
                                    <span class="float-start">prix revient : </span>
                                    <span class="float-end fw-normal"> {{ $produit->prix_revient ?? 0 }} DH</span>
                                </h6>
                            </li>
                            <li class="list-group-item py-2px">
                                <h6 class="m-0 text-uppercase fs-12 fst-italic text-center text-muted">
                                    {{ $produit->description }}
                                </h6>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center mt-2">
                            <a href="{{ route('produit.show',$produit) }}" class="btn btn-sm btn-dark"> Plus détails </a>
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
                                    $quantite_today= \App\Models\FactureProduit::where("produit_id",$produit->id)->whereDate('created_at', '=', date('Y-m-d'))->sum("quantite");
                                    $sum_pu_today= \App\Models\FactureProduit::where("produit_id",$produit->id)->whereDate('created_at', '=', date('Y-m-d'))->sum("montant");

                                    $count_produit = \App\Models\FactureProduit::where("produit_id",$produit->id)->count();
                                    $quantite_produit = \App\Models\FactureProduit::where("produit_id",$produit->id)->sum("quantite");
                                    $sum_pu = \App\Models\FactureProduit::where("produit_id",$produit->id)->sum("montant");

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

        {{-- <div class="modal fade" id="a{{ $produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
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
        </div> --}}



@section('script')
<script>
    if ($(".selecttwo").length) {
    $(".selecttwo").select2({
        dropdownParent: $(".fade")
      });
  }
</script>
@endsection