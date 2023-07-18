@extends('layouts.master')
@section('title')
Modifier le produit : {{ $produit->reference ?? "" }}
@endsection
@section('content')
@include('sweetalert::alert')

<div class="card">
    <div class="card-body p-2">
        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#general"
                    role="tab">
                    information général
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#attribut" role="tab">
                    caractéristique
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#categorie" role="tab">
                    catégorie
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#sous" role="tab">
                    Sous-catégorie
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active py-3 px-2" id="general" role="tabpanel">
                <div class="row">
                    <div class="col-lg-8">
                        <form action="{{route('produit.update',$produit)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="row row-cols-md-2 row-cols-1">
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Référence <span class="text-danger"> * </span></label>
                                        <input type="text" name="reference" id="" class="form-control @error('reference') is-invalid @enderror" value="{{ $produit->reference }}">
                                        @error("reference")
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Designation du produit <span class="text-danger"> * </span></label>
                                        <input type="text" name="designation" id="" class="form-control @error('designation') is-invalid @enderror" value="{{ $produit->designation }}">
                                        @error('designation')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Prix d'achat <span class="text-danger"> * </span></label>
                                        <input type="text" name="prix_achat" id="" class="form-control  @error('prix_achat') is-invalid @enderror" value="{{ $produit->prix_achat }}">
                                        @error('prix_achat')
                                            <span class="invalid-feedback">
                                                {{ $message }} ex : 0/0.00
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Prix de vente <span class="text-danger"> * </span></label>
                                        <input type="text" name="prix_vente" id="" class="form-control  @error('prix_vente') is-invalid @enderror" value="{{ $produit->prix_vente }}">
                                        @error('prix_vente')
                                        <span class="invalid-feedback">
                                            {{ $message }} ex : 0/0.00
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Prix Revient <span class="text-danger"> * </span></label>
                                        <input type="text" name="prix_revient" id="" class="form-control  @error('prix_revient') is-invalid @enderror" value="{{ $produit->prix_revient }}">
                                        @error('prix_revient')
                                            <span class="invalid-feedback">
                                                {{ $message }} ex : 0/0.00
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Image</label>
                                        <input type="file" name="img" id="img_file" onChange="img_pathUrl(this);" class="form-control mb-2">
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Code</label>
                                        <input type="text" name="code" id="" class="form-control  @error('code') is-invalid @enderror" value="{{ $produit->code }}">
                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Description</label>
                                        <textarea name="description" id=""  rows="3" class="form-control" value="{{ $produit->description }}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <a href="{{route('produit.index')}}" class="btn btn-sm btn-primary">Retour</a>
                                <button type="submit" class="btn btn-sm btn-success">
                                    <span class="align-middle mdi mdi-check-bold"></span>
                                    <span>Modifier</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        @if($produit->image != null)
                            <img src="{{ asset('storage/images/produits/'.$produit->image ?? '') }}" alt="" class="img-fluid" id="img_url">
                        @else
                            <img src="{{ asset('images/produit_default.png') }}" alt="" class="w-100 " id="img_url">
                        @endif

                    </div>
                </div>
            </div>
            <div class="tab-pane p-2" id="attribut" role="tabpanel">
                <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#add">
                    <span class="mdi mdi-plus-circle-outline align-middle"></span>
                    <span>Ajouter autre caractéristique</span>
                </button>
                <div class="table-responsive">
                    <table class="table table-striped m-0 table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>nom</th>
                                <th>valeur</th>
                                <th>prix ( DH )</th>
                                <th>quantité</th>
                                <th>montant</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produit->caracteristiques as $pro_caracteristique)
                                <tr>
                                    <td class="align-middle fw-bolder"> {{ $pro_caracteristique->caracteristique->nom ?? '' }} </td>
                                    <td class="align-middle"> {{ $pro_caracteristique->valeur ?? '' }} </td>
                                    <td class="align-middle"> {{ $pro_caracteristique->prix ?? '' }} DH</td>
                                    <td class="align-middle"> {{ $pro_caracteristique->quantite ?? '' }} </td>
                                    <td class="align-middle"> {{ $pro_caracteristique->quantite * $pro_caracteristique->prix }} DH</td>
                                    <td class="align-middle">
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $pro_caracteristique->id }}">
                                            <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                        </button>
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $pro_caracteristique->id }}">
                                            <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="edit{{ $pro_caracteristique->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary py-2">
                                                <h6 class="modal-title text-white m-0" id="varyingModalLabel">Modifier la caractéristique : {{ $pro_caracteristique->caracteristique->nom ?? '' }}</h6>
                                                <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                                                    <span class="mdi mdi-close-thick"></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('produitCaracteristique.update',$pro_caracteristique) }}" method="post">
                                                    @csrf
                                                    @method("PUT")
                                                    <input type="hidden" name="produit" value="{{ $produit->id }}">
                                                    <div class="form-group mb-2">
                                                        <label for="" class="form-label">Nom</label>
                                                        <select name="caracteristique_u" id="" class="form-select">
                                                            <option value="">Choisir le caractéristique</option>
                                                            @foreach ($caracteristiques as $caracteristique)
                                                                <option value="{{ $caracteristique->id }}" {{ $caracteristique->id == $pro_caracteristique->caracteristique_id ? 'selected':'' }}>
                                                                    {{ $caracteristique->nom }}
                                                                </option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="" class="form-label">Valeur</label>
                                                        <input type="text" name="valeur_u" id="" class="form-control" value="{{ $pro_caracteristique->valeur ?? '' }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="" class="form-label">Prix</label>
                                                        <input type="number" name="prix_u" id="" step="any" min="0" class="form-control" value="{{ $pro_caracteristique->prix ?? '' }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label for="" class="form-label">Quantité</label>
                                                        <input type="number" name="quantite_u" id="" min="0" class="form-control" value="{{ $pro_caracteristique->quantite ?? '' }}">
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-primary btn-sm px-4">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                                            <span>Modifier</span>
                                                        </button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete{{ $pro_caracteristique->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form action="{{ route('produitCaracteristique.destroy',$pro_caracteristique) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input type="hidden" name="produit" value="{{ $produit->id }}">
                                                    <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>

                                                    <h6 class="mb-2 fw-bolder text-center text-muted">
                                                        Voulez-vous vraiment déplacer du caractéristique vers la corbeille
                                                    </h6>

                                                    <div class="d-flex justify-content-center mb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="force" id="del{{$pro_caracteristique->id}}" class="form-check-input">
                                                            <label for="del{{$pro_caracteristique->id}}" class="form-check-label fw-bolder">Ignorer la corbeille et supprimer définitivement du caractéristique</label>
                                                        </div>

                                                    </div>

                                                    <h6 class="text-danger mb-2 text-center">{{ $pro_caracteristique->caracteristique->nom ?? '' }}</h6>
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
                        </tbody>
                        {{-- <tfoot>
                            <tr>
                                <td class="align-middle bg-light"></td>
                                <td class="align-middle bg-light"></td>
                                <td class="text-uppercase fw-bolder">
                                    {{ $produit->caracteristiques()->sum('prix') }} DH
                                </td>
                                <td class="text-uppercase fw-bolder">
                                    {{ $produit->caracteristiques()->sum('quantite') }}
                                </td>
                                <td class="align-middle bg-light"></td>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
            <div class="tab-pane p-2" id="categorie" role="tabpanel">
                <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#add-category">
                    <span class="mdi mdi-plus-circle-outline align-middle"></span>
                    <span>Ajouter autre catégorie</span>
                </button>
                <div class="table-responsive">
                    <table class="table table-sm m-0 table-striped">
                        <thead>
                            <tr>
                                <th>catégorie parent</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produit->categories as $produit_cat)
                                <tr>
                                    <td class="align-middle">{{ $produit_cat->categorie->nom ?? '' }}</td>
                                    <td class="align-middle">
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit-cat{{ $produit_cat->id }}">
                                            <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                        </button>
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete-cat{{ $produit_cat->id }}">
                                            <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit-cat{{ $produit_cat->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary py-2">
                                                <h6 class="modal-title text-white m-0" id="varyingModalLabel">Modifier le catégorie : {{ $produit_cat->categorie->nom ?? '' }}</h6>
                                                <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                                                    <span class="mdi mdi-close-thick"></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('produitCategorie.update',$produit_cat) }}" method="post">
                                                    @csrf
                                                    @method("PUT")
                                                    <div class="list-group mb-2">
                                                        @forelse ($categories as $categorie)
                                                            <label class="list-group-item m-0 py-2">
                                                            <input class="form-check-input" name="categorie_u" type="radio" {{ $produit_cat->categorie_id == $categorie->id ? 'checked':'' }} value="{{ $categorie->id }}">
                                                                {{ $categorie->nom }}
                                                            </label>

                                                        @empty

                                                        @endforelse

                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-primary btn-sm px-4">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                                            <span>Modifier</span>
                                                        </button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="modal fade" id="delete-cat{{ $produit_cat->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <form action="{{ route('produitCategorie.destroy',$produit_cat) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")

                                                    <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>


                                                    <h6 class="mb-2 fw-bolder text-center text-muted">
                                                        Voulez-vous vraiment déplacer du catégorie vers la corbeille
                                                    </h6>

                                                    <div class="d-flex justify-content-center mb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="force" id="delCat{{$produit_cat->categorie->id}}" class="form-check-input">
                                                            <label for="delCat{{$produit_cat->categorie->id}}" class="form-check-label fw-bolder">Ignorer la corbeille et supprimer définitivement du catégorie</label>
                                                        </div>

                                                    </div>

                                                    <h6 class="text-danger mb-2 text-center">{{ $produit_cat->categorie->nom ?? '' }}</h6>
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


                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane p-2" id="sous" role="tabpanel">
                <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#add-sous-category">
                    <span class="mdi mdi-plus-circle-outline align-middle"></span>
                    <span>Ajouter sous-catégorie</span>
                </button>
                <div class="table-responsive">
                    <table class="table table-sm m-0 table-striped">
                        <thead>
                            <tr>
                                <th>catégorie parent</th>
                                <th>sous-catégorie</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produit->sous_categories as $sous_produit)
                                <tr>
                                    <td class="align-middle">{{ $sous_produit->sous->categorie->nom ?? '' }}</td>
                                    <td class="align-middle">{{ $sous_produit->sous->nom ?? '' }}</td>
                                    <td class="align-middle">
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit-sous{{ $sous_produit->id }}">
                                            <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                        </button>
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete-sous{{ $sous_produit->id }}">
                                            <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="edit-sous{{ $sous_produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary py-2">
                                                <h6 class="modal-title text-white m-0" id="varyingModalLabel">Modifier le catégorie : {{ $sous_produit->nom ?? '' }}</h6>
                                                <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                                                    <span class="mdi mdi-close-thick"></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('produitSousCategorie.update',$sous_produit) }}" method="post">
                                                    @csrf
                                                    @method("PUT")

                                                    <div class="accordion accordion-flush" id="accordingEdit">
                                                        @foreach ($categories as $categorie)
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header" id="flush-heading{{$categorie->id}}">
                                                                    <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$categorie->id}}" aria-expanded="false" aria-controls="flush-collapse{{$categorie->id}}">
                                                                        <span class="me-2">
                                                                            {{ $categorie->nom ?? '' }}
                                                                        </span>
                                                                        <span class="float-end badge bg-warning">
                                                                            {{ count($categorie->sous) }}
                                                                        </span>

                                                                    </button>
                                                                </h2>

                                                                @if (count($categorie->sous) > 0)
                                                                    <div id="flush-collapse{{$categorie->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$categorie->id}}" data-bs-parent="#accordingEdit">
                                                                        <div class="accordion-body text-body py-2">
                                                                            <div class="row row-cols-2">
                                                                                @foreach ($categorie->sous as $sous)
                                                                                    <div class="col mb-2">
                                                                                        <div class="form-check">
                                                                                            <input type="radio" name="sous_u" id="su{{ $sous->id }}" class="form-check-input" {{ $sous_produit->sous_categorie_id == $sous->id ? 'checked':'' }} value="{{ $sous->id }}">
                                                                                            <label for="su{{ $sous->id }}" class="form-check-label">{{ $sous->nom ?? '' }}</label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                @endif
                                                            </div>

                                                        @endforeach
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-primary btn-sm px-4">
                                                            <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                                            <span>Modifier</span>
                                                        </button>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="delete-sous{{ $sous_produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">

                                                <form action="{{ route('produitSousCategorie.destroy',$sous_produit) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")

                                                    <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>


                                                    <h6 class="mb-2 fw-bolder text-center text-muted">
                                                        Voulez-vous vraiment déplacer du catégorie vers la corbeille
                                                    </h6>

                                                    <div class="d-flex justify-content-center mb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="force" id="delSous{{$sous_produit->id}}" class="form-check-input">
                                                            <label for="delSous{{$sous_produit->id}}" class="form-check-label fw-bolder">Ignorer la corbeille et supprimer définitivement du sous-catégorie</label>
                                                        </div>

                                                    </div>
                                                    {{-- <h6 class="text-danger mb-2 text-center">{{ $sous_produit-> ?? '' }}</h6> --}}
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


                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h6 class="modal-title text-white m-0" id="varyingModalLabel">Ajouter autre caractéristique du produit</h6>
                <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produitCaracteristique.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="produit" value="{{ $produit->id }}">
                    <div class="form-group mb-2">
                        <label for="" class="form-label">Nom</label>
                        <select name="caracteristique" id="" class="form-select">
                            <option value="">Choisir le caractéristique</option>
                            @foreach ($caracteristiques as $caracteristique)
                                <option value="{{ $caracteristique->id }}">
                                    {{ $caracteristique->nom }}
                                </option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="form-label">Valeur</label>
                        <input type="text" name="valeur" id="" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="form-label">Prix</label>
                        <input type="number" name="prix" id="" step="any" min="0" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="form-label">Quantité</label>
                        <input type="number" name="quantite" id="" min="0" class="form-control">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-sm px-4">
                            <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                            <span>Enregistrer</span>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-category" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h6 class="modal-title text-white m-0" id="varyingModalLabel">Ajouter autre catégorie du produit</h6>
                <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produitCategorie.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="produit" value="{{ $produit->id }}">
                    <div class="list-group mb-2">
                        @forelse ($categories as $categorie)
                            <label class="list-group-item m-0 py-2">
                            <input class="form-check-input" name="categorie[]" type="checkbox" value="{{ $categorie->id }}">
                                {{ $categorie->nom }}
                            </label>

                        @empty

                        @endforelse

                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-sm px-4">
                            <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                            <span>Enregistrer</span>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-sous-category" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h6 class="modal-title text-white m-0" id="varyingModalLabel">Ajouter sous-catégorie</h6>
                <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produitSousCategorie.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                    <div class="accordion accordion-flush" id="accordingSave">
                        @foreach ($categories as $categorie)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading{{$categorie->id}}">
                                    <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$categorie->id}}" aria-expanded="false" aria-controls="flush-collapse{{$categorie->id}}">
                                        <span class="me-2">
                                            {{ $categorie->nom ?? '' }}
                                        </span>
                                        <span class="float-end badge bg-warning">
                                            {{ count($categorie->sous) }}
                                        </span>

                                    </button>
                                </h2>

                                @if (count($categorie->sous) > 0)
                                    <div id="flush-collapse{{$categorie->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$categorie->id}}" data-bs-parent="#accordingSave">
                                        <div class="accordion-body text-body py-2">
                                            <div class="row row-cols-2">
                                                @foreach ($categorie->sous as $sous)
                                                    <div class="col mb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="sous[]" id="s{{ $sous->id }}" class="form-check-input" value="{{ $sous->id }}">
                                                            <label for="s{{ $sous->id }}" class="form-check-label">{{ $sous->nom ?? '' }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            </div>

                        @endforeach
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




    @endsection
    @section('script')
        <script>
               function img_pathUrl(input){
                    $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
                }


            // $(document).ready(function(){
            //     $("#qteNew").on("keyup",function(){
            //         let qteNew = parseInt($(this).val());
            //         let qte = parseInt($("#qte").val());

            //         let fonction = $("#fonction").val();
            //         let entre = parseInt($("#entre").val());
            //         let reste = parseInt($("#reste").val());
            //         let qte_fin = qteNew - qte;
            //         $("#qteFin").val(qte_fin);
            //         let qt = parseInt($("#qteFin").val());
            //         if(fonction == "augmentation"){
            //             console.log(qte_fin);
            //             $("#entre").val(entre + qt);
            //             $("#reste").val(reste + qt);
            //         }
            //     })
            // })
        </script>
    @endsection