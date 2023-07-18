@extends('layouts.master')
@section('title')
    Liste des produits
@endsection
@section('content')
@include('sweetalert::alert')

<div class="card">
    <div class="card-body p-2">
        <div class="d-flex justify-content-center mb-3">
            @can("produit-create")
                <a href="{{ route('produit.create') }}" class="btn btn-primary btn-sm">
                    <span class="mdi mdi-plus-circle-outline align-middle"></span>
                    Ajouter
                </a>
            @endcan
        </div>
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered mb-0 table-sm datatable">
                    <thead class="table-success">
                        <tr>
                            <th>Référrence</th>
                            <th>code</th>
                            <th>Désignation</th>
                            <th>Prix d'achat</th>
                            <th>Prix de vente</th>
                            <th>Prix revients</th>
                            <th>Quantite</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produits as $produit)
                            <tr>
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
                                <td class="align-middle">{{ $produit->code }}</td>
                                <td class="align-middle">{{ $produit->designation }}</td>
                                <td class="align-middle fw-bolder">{{ $produit->prix_achat." DH" }}</td>
                                <td class="align-middle fw-bolder">{{ $produit->prix_vente." DH" }}</td>
                                <td class="align-middle fw-bolder">{{ $produit->prix_revient." DH" }}</td>
                                <td class="align-middle">{{ $produit->quantite }}</td>
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


    @foreach ($produits as $produit)

        <div class="modal fade" id="delete{{ $produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('produit.destroy',$produit) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>
                            <h6 class="mb-2 fw-bolder text-center text-muted">
                                Voulez-vous vraiment déplacer du produit vers la corbeille
                            </h6>
                            <div class="d-flex justify-content-center mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="force" id="del{{$produit->id}}" class="form-check-input">
                                    <label for="del{{$produit->id}}" class="form-check-label fw-bolder">Ignorer la corbeille et supprimer définitivement du produit</label>
                                </div>
                            </div>
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary py-2">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Produit : {{ $produit->reference }}</h6>
                        <button type="button" class="btn btn-transparent p-0 border-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col">
                                <div class="table-reponsive">
                                    <table class="table table-borderedless table-sm m-0 ">
                                        <tbody>
                                            <tr class="bg-warning">

                                                <td colspan="2" class="text-center text-uppercase fw-bolder py-4"> {{ $produit->designation ?? ""}} </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-4">Référence</th>
                                                <td> {{ $produit->reference ?? ""}} </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-4">Code</th>
                                                <td> {{ $produit->code ?? ""}} </td>
                                            </tr>

                                            <tr>
                                                <th class="bg-light col-4">quantite</th>
                                                <td> {{ $produit->quantite ?? ""}} </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-4">prix vente</th>
                                                <td> {{ $produit->prix_vente." DH"}} </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-4">prix d'achat</th>
                                                <td> {{ $produit->prix_achat." DH"}} </td>
                                            </tr>
                                            <tr>
                                                <th class="bg-light col-4">prix revients</th>
                                                <td> {{ $produit->prix_revient." DH"}} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                @if($produit->image != null)
                                    <img src="{{ asset('/storage/images/produits/'.$produit->image) }}" alt="" class="img-fluid">
                                @else
                                    <img src="{{ asset('images/produit_default.png') }}" alt="" class="w-100">
                                @endif
                            </div>
                        </div>

                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-uppercase" style="font-variant-caps: all-petite-caps;letter-spacing:1px" data-bs-toggle="tab" href="#description{{$produit->id}}" role="tab">description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" style="font-variant-caps: all-petite-caps;letter-spacing:1px" data-bs-toggle="tab" href="#catacteristique{{$produit->id}}" role="tab">caractéristiques</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" style="font-variant-caps: all-petite-caps;letter-spacing:1px" data-bs-toggle="tab" href="#categorie{{$produit->id}}" role="tab">catégories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" style="font-variant-caps: all-petite-caps;letter-spacing:1px" data-bs-toggle="tab" href="#stock{{$produit->id}}" role="tab">stock</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active p-2" id="description{{$produit->id}}" role="tabpanel">
                                {{ $produit->description ?? '' }}
                            </div>

                            <div class="tab-pane p-2" id="catacteristique{{$produit->id}}" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm m-0">
                                        <thead class="table-success">
                                            <tr>
                                                <th>Nom</th>
                                                <th>valeur</th>
                                                <th>prix</th>
                                                <th>quanite</th>
                                                <th>montant</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($produit->caracteristiques as $caracteristique)
                                                <tr>
                                                    <td class="align-middle"> {{ $caracteristique->caracteristique->nom }} </td>
                                                    <td class="align-middle"> {{ $caracteristique->valeur }} </td>
                                                    <td class="align-middle"> {{ $caracteristique->prix ?? '0' }} DH</td>
                                                    <td class="align-middle"> {{ $caracteristique->quantite ?? '1' }}</td>
                                                    <td class="align-middle"> {{ $caracteristique->prix * $caracteristique->quantite }} DH</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <div class="tab-pane p-2" id="categorie{{$produit->id}}" role="tabpanel">
                                <div class="row row-cols-2">
                                    <div class="col">

                                        <div class="table-responsive">
                                            <table class="table table-bordered m-0">
                                                <thead>
                                                    <tr>
                                                        <th class="bg-light text-center">catégories parents</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($produit->categories as $pro_categorie)
                                                    <tr>
                                                        <td class="align-middle">
                                                            {{ $pro_categorie->categorie->nom }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered m-0">
                                                <thead>
                                                    <tr>
                                                        <th class="bg-light text-center">sous-catégories</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($produit->sous_categories as $pro_sous)
                                                    <tr>
                                                        <td class="align-middle">
                                                            {{ $pro_sous->sous->categorie->nom }}
                                                        </td>
                                                    </tr>

                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane p-2" id="stock{{$produit->id}}" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm m-0">
                                        <thead class="table-success">
                                            <tr>
                                                <th>num</th>
                                                <th>entre</th>
                                                <th>sortie</th>
                                                <th>reste</th>
                                                <th>min</th>
                                                <th>montant</th>
                                            </tr>

                                        </thead>
                                        <tbody>

                                                <tr>
                                                    <td class="align-middle"> {{ $produit->stock->num ?? '' }} </td>
                                                    <td class="align-middle"> {{ $produit->stock->entre ?? '' }} </td>
                                                    <td class="align-middle"> {{ $produit->stock->sortie ?? '' }} </td>
                                                    <td class="align-middle"> {{ $produit->stock->reste ?? '' }} </td>
                                                    <td class="align-middle"> {{ $produit->stock->min ?? '' }} </td>
                                                    <td class="align-middle"> {{ $produit->stock->montant ?? '' }} DH </td>
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