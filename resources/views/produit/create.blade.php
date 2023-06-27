@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between mb-2">
    <h5 class="m-0">Ajouter une produit</h5>
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
        @can('produit-create')
            <li class="text-white fw-bolder mx-2">
                <span class="ti ti-angle-right" style="font-size: 0.60rem"></span>
            </li>
            <li class="text-white fw-bolder">
                <a href="{{ route('produit.create') }}" class="text-white">
                    Ajouter du produit
                </a>
            </li>
        @endcan
    </ol>

</div>
<form action="{{ route('produit.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row row-cols-md-2 row-cols-1">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Référence <span class="text-danger"> * </span></label>
                                <input type="text" name="reference" id="" class="form-control @error('reference') is-invalid @enderror" value="{{ old('reference') }}">
                                @error("reference")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Designation du produit <span class="text-danger"> * </span></label>
                                <input type="text" name="designation" id="" class="form-control @error('designation') is-invalid @enderror" value="{{old('designation')}}">
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
                                <input type="text" name="prix_achat" id="" class="form-control  @error('prix_achat') is-invalid @enderror" value="{{ old('prix_achat') }}">
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
                                <input type="text" name="prix_vente" id="" class="form-control  @error('prix_vente') is-invalid @enderror" value="{{ old('prix_vente') }}">
                                @error('prix_vente')
                                <span class="invalid-feedback">
                                    {{ $message }} ex : 0/0.00
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Prix Unitaire <span class="text-danger"> * </span></label>
                                <input type="text" name="prix_unitaire" id="" class="form-control  @error('prix_unitaire') is-invalid @enderror" value="{{ old('prix_unitaire') }}">
                                @error('prix_unitaire')
                                    <span class="invalid-feedback">
                                        {{ $message }} ex : 0/0.00
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Quantite</label>
                                <input type="number" name="quantite" min="1"  id="" class="form-control  @error('quantite') is-invalid @enderror" value="{{ old('quantite') }}">
                                @error('quantite')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Description</label>
                        <textarea name="description" id=""  rows="5" class="form-control" value="{{ old('description') }}"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body p-2">
                    <div class="form-group mb-2">
                        <label for="" class="form-label">Nom du catégorie <span class="text-danger"> * </span></label>
                        <select name="categorie_id" class="form-select ">
                            <option value="">Choisir la catégorie</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <label for="" class="form-label">Image</label>
                        <input type="file" name="img" id="img_file" onChange="img_pathUrl(this);" class="form-control mb-2">
                        <img src="" id="img_url" alt="" class="img-fluid">
                    </div>


                    <button type="submit" class="btn btn-success btn-sm px-3" name="save">
                        <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                        <span>Enregistrer</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>


    @endsection
    @section('script')
        <script>
               function img_pathUrl(input){
                    $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
                }
        </script>
    @endsection