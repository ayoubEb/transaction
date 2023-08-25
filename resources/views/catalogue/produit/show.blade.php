@extends('layouts.master')
@section('title')
Modifier le produit : {{ $produit->reference ?? "" }}
@endsection
@section('content')
@include('sweetalert::alert')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item " aria-current="page">
            <a href="{{ route('produit.index') }}">Liste des produits</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <span>
                information du produit : {{ $produit->reference ?? '' }}
            </span>
        </li>
    </ol>
</nav>
<div class="card">
    <div class="card-body p-2">

        <h6 class="text-uppercase mt-4 mb-3 text-white">
            <span class="bg-info px-3 py-2 rounded text-white">inforamtion général</span>
        </h6>
        <div class="row">
            <div class="col-lg-9">
                <ul class="list-group mb-3">
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase">désignation : </h6>
                        <h6 class="m-0 text-lowercase fw-normal">{{ $produit->designation }}</h6>
                    </li>

                </ul>
                <div class="row row-cols-2">
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item py-3 d-flex jusfify-content-end">
                                <h6 class="m-0 text-uppercase">Référence : </h6>
                                <h6 class="fw-normal m-0">
                                    {{ $produit->reference ?? '' }}
                                </h6>
                            </li>
                            <li class="list-group-item py-3 d-flex jusfify-content-end">
                                <h6 class="m-0 text-uppercase">prix d'achat : </h6>
                                <h6 class="fw-normal m-0 ">
                                    {{ $produit->prix_achat ?? 0 }} DH
                                </h6>
                            </li>
                            <li class="list-group-item py-3 d-flex jusfify-content-end">
                                <h6 class="m-0 text-uppercase">prix de vente : </h6>
                                <h6 class="fw-normal m-0 ">
                                    {{ $produit->prix_vente ?? 0 }} DH
                                </h6>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="list-group">
                            <li class="list-group-item py-3 d-flex jusfify-content-end">
                                <h6 class="m-0 text-uppercase">code : </h6>
                                <h6 class="fw-normal m-0 ">
                                    {{ $produit->code ?? '' }}
                                </h6>
                            </li>
                            <li class="list-group-item py-3 d-flex jusfify-content-end">
                                <h6 class="m-0 text-uppercase">prix de revient : </h6>
                                <h6 class="fw-normal m-0 ">
                                    {{ $produit->prix_revient ?? 0 }} DH
                                </h6>
                            </li>
                            <li class="list-group-item py-3 d-flex jusfify-content-end">
                                <h6 class="m-0 text-uppercase">description : </h6>
                                <h6 class="fw-normal m-0 ">
                                    {{ $produit->description ?? ''}}
                                </h6>
                            </li>
                        </ul>
                    </div>


                </div>

            </div>
            <div class="col">
                @if($produit->image != null)
                    <img src="{{ asset('storage/images/produits/'.$produit->image ?? '') }}" alt="" class="img-fluid" id="img_url">
                @else
                    <img src="{{ asset('images/produit_default.png') }}" alt="" class="w-100 " id="img_url">
                @endif

            </div>
        </div>

        <h6 class="text-uppercase my-3 text-white">
            <span class="bg-info px-3 py-2 rounded">liste des caractéristiques</span>
        </h6>

        <div class="table-responsive">
            <table class="table table-striped m-0 table-sm">
                <thead class="table-primary">
                    <tr>
                        <th>nom</th>
                        <th>valeur</th>
                        <th>prix ( DH )</th>
                        <th>quantité</th>
                        <th>montant</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produit->caracteristiques as $pro_caracteristique)
                        <tr>
                            <td class="align-middle fw-bolder"> {{ $pro_caracteristique->caracteristique->nom ?? '' }} </td>
                            <td class="align-middle"> {{ $pro_caracteristique->valeur ?? '' }} </td>
                            <td class="align-middle"> {{ $pro_caracteristique->prix ?? '' }} DH</td>
                            <td class="align-middle"> {{ $pro_caracteristique->quantite ?? '' }} </td>
                            <td class="align-middle"> {{ $pro_caracteristique->quantite * $pro_caracteristique->prix }} DH</td>
                        </tr>


                    @empty
                        <tr>
                            <td colspan="6">
                                <h6 class="m-0 text-center fs-12 text-uppercase py-1 text-danger"> aucun caractéristique du produit </h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h6 class="text-uppercase my-3 text-white">
            <span class="bg-info px-3 py-2 rounded">liste des catégories</span>
        </h6>
        <div class="table-responsive">
            <table class="table table-sm m-0 table-striped">
                <thead>
                    <tr>
                        <th>catégorie parent</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produit->categories as $produit_cat)
                        <tr>
                            <td class="align-middle">{{ $produit_cat->categorie->nom ?? '' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="align-middle" colspan="2">
                                <h6 class="m-0 text-center text-uppercase text-danger fs-12">
                                    aucun catégorie du produit
                                </h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h6 class="text-uppercase my-3 text-white">
            <span class="bg-info px-3 py-2 rounded">liste des sous-catégorie</span>
        </h6>
        <div class="table-responsive">
            <table class="table table-sm m-0 table-striped">
                <thead>
                    <tr>
                        <th>catégorie parent</th>
                        <th>sous-catégorie</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produit->sous_categories as $sous_produit)
                        <tr>
                            <td class="align-middle">{{ $sous_produit->sous->categorie->nom ?? '' }}</td>
                            <td class="align-middle">{{ $sous_produit->sous->nom ?? '' }}</td>

                        </tr>


                    @empty
                        <tr>
                            <td class="align-middle" colspan="3">
                                <h6 class="m-0 text-center fs-12 text-danger text-uppercase">aucun sous catégorie du produit</h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>




    </div>
</div>









    @endsection
