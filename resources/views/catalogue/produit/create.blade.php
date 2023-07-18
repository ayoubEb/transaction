@extends('layouts.master')
@section('title')
    Ajouter une produit
@endsection
@section('content')

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
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Designation du produit <span class="text-danger"> * </span></label>
                                    <input type="text" name="designation" id="" class="form-control @error('designation') is-invalid @enderror" value="{{old('designation')}}">
                                    @error('designation')
                                    <strong class="invalid-feedback">
                                        {{ $message }}
                                    </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Prix d'achat <span class="text-danger"> * </span></label>
                                    <input type="text" name="prix_achat" id="" class="form-control  @error('prix_achat') is-invalid @enderror" value="{{ old('prix_achat') }}">
                                    @error('prix_achat')
                                        <strong class="invalid-feedback">
                                            {{ $message }} ex : 0/0.00
                                        </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Prix de vente <span class="text-danger"> * </span></label>
                                    <input type="text" name="prix_vente" id="" class="form-control  @error('prix_vente') is-invalid @enderror" value="{{ old('prix_vente') }}">
                                    @error('prix_vente')
                                    <strong class="invalid-feedback">
                                        {{ $message }} ex : 0/0.00
                                    </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Prix Revient <span class="text-danger"> * </span></label>
                                    <input type="text" name="prix_revient" id="" class="form-control  @error('prix_revient') is-invalid @enderror" value="{{ old('prix_revient') }}">
                                    @error('prix_revient')
                                        <strong class="invalid-feedback">
                                            {{ $message }} ex : 0/0.00
                                        </strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Code</label>
                                    <input type="text" name="code" class="form-control  @error('code') is-invalid @enderror" value="{{ old('code') }}">
                                    @error('code')
                                        <span class="invalid-feedback">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="" class="form-label">Description</label>
                                <textarea name="description" id=""  rows="5" class="form-control" value="{{ old('description') }}"></textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Image</label>
                            <input type="file" name="img" id="img_file" class="form-control mb-2">

                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <img src="" id="img_url" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Catégorie</label>
                            <select name="categorie[]" id="" class="form-control select2 select2-multiple" multiple="multiple">
                                <option value="">Choisir la catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom ?? '' }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Sous-catégorie</label>
                            <select name="sous[]" id="" class="form-control select2 select2-multiple" multiple="multiple">
                                <option value="">Choisir le sous-catégorie</option>
                                @foreach ($categories as $categorie)
                                    <optgroup label="{{ $categorie->nom }}">
                                        @if (count($categorie->sous) > 0)
                                            @foreach ($categorie->sous as $sous)
                                                <option value="{{ $sous->id }}">{{ $sous->nom }}</option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-success btn-sm px-3" name="save">
                            <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                            <span>Enregistrer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header py-2px bg-success">
                <h6 class="title m-0 text-uppercase">
                    Caractéristiques
                </h6>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped m-0">
                        <thead>
                            <tr>
                                <th>nom</th>
                                <th>valeur</th>
                                <th>prix</th>
                                <th>quantite</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($caracteristiques as $caracteristique)
                                <input type="hidden" name="caracteristique_id[]" value="{{ $caracteristique->id }}">
                                <tr>
                                    <td class="align-middle">{{ $caracteristique->nom ?? '' }} </td>
                                    <td class="align-middle">
                                        <input type="text" name="valeur[]" id="" class="form-control">
                                    </td>
                                    <td class="align-middle">
                                        <input type="number" name="prix_caracteristique[]" min="0" step="any" id="" class="form-control" value="0">
                                    </td>
                                    <td class="align-middle">
                                        <input type="number" name="quantite_caracteristique[]" min="0" id="" class="form-control" value="0">
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
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