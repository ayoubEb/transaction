@extends('layouts.master')
@section('content')

@include('sweetalert::alert')

<div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
    <h5 class="m-0">Liste des catégories</h5>
    <ol class="breadcrumb m-0 py-2">
        <li class="text-white fw-bolder">
            <a href="{{ route('home') }}" class="text-white">
                Acceuil
            </a>
        </li>
        @can('categorie-list')
            <li class="text-white mx-2 fw-bolder">
                <span class="ti ti-angle-right" style="font-size:0.60rem"></span>
            </li>
            <li class="text-white fw-bolder">
                <a href="{{ route('categorie.index') }}" class="text-white">
                    Liste des catégories
                </a>
            </li>
        @endcan
    </ol>
</div>



<div class="card">
    <div class="card-body p-2">
        @can("categorie-create")
            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#add-categorie">
                <span class="mdi mdi-plus-circle-outline align-middle"></span>
                <span>Ajouter catégorie par sous catégorie</span>
            </button>
        @endcan
        <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#add-sous">
            <span class="mdi mdi-plus-circle-outline align-middle"></span>
            <span>Ajouter sous catégorie</span>
        </button>
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered mb-0 table-sm">
                <thead>
                    <tr class="table-success">
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $categorie)
                        <tr>
                            <td class="align-middle">{{ $categorie->nom }}</td>
                            <td class="align-middle">{{ Str::limit($categorie->description, 30) }}</td>
                            <td class="align-middle">
                                @can('categorie-edit')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $categorie->id }}">
                                        <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                                @can('categorie-show')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-warning" data-bs-toggle="modal" data-bs-target="#show{{ $categorie->id }}">
                                        <i class="ti-info" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                                @can('categorie-delete')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $categorie->id }}">
                                        <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <h6 class="text-center m-0">
                                    Aucun catégorie saisir
                                </h6>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>
</div>

@foreach ($categories as $categorie)
    <div class="modal fade" id="edit{{ $categorie->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-primary py-2">
                    <h6 class="modal-title text-white m-0" id="varyingModalLabel">Modifier la catégorie : {{ $categorie->nom }}</h6>
                    <button type="button" class="btn btn-transparent p-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categorie.update',$categorie) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Nom</label>
                            <input type="text" name="nom_u" id="" class="form-control form-control-sm" value="{{ $categorie->nom ?? '' }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Description</label>
                            <input type="text" name="description_u" id="" class="form-control form-control-sm" value="{{ $categorie->description ?? '' }}">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                <span>Modifier</span>
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="show{{ $categorie->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-primary py-2">
                    <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Catégorie : {{ $categorie->nom }}</h6>
                    <button type="button" class="btn btn-transparent p-0 border-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-sm m-0">
                        <tbody>
                            <tr>
                                <th class="text-center">nom</th>
                            </tr>
                            <tr>
                                <td class="align-middle text-center">{{ $categorie->nom }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">description</th>
                            </tr>
                            <tr>
                                <td class="align-middle text-center">{{ $categorie->description }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete{{ $categorie->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <form action="{{ route('categorie.destroy',$categorie) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <div class="p-3 mb-3">
                            <h5 class="mb-2 fw-bolder text-center">Voulez-vous supprimer défenitivement du catégorie</h5>
                            <h6 class="text-danger text-center fw-bolder w-100">{{ $categorie->nom }}</h6>
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
@endforeach


<div class="modal fade" id="add-categorie" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter des catégories</h6>
                <button type="button" class="btn btn-transparent p-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categorie.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-success py-2px">
                            <h6 class="m-0 title text-uppercase">Catégorie</h6>
                        </div>
                        <div class="card-body p-2">
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Nom</label>
                                <input type="text" name="nom" id="" class="form-control form-control-sm @error('nom') is-invalid @enderror" placeholder="Nom du catégorie" value="{{ old('nom') }}" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label">Description</label>
                                <input type="text" name="description" id="" class="form-control form-control-sm" placeholder="Description" value="{{ old('description') }}">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-success py-2px">
                            <h6 class="m-0 title text-uppercase">sous catégories</h6>
                        </div>
                        <div class="card-body p-2">
                            <div class="row row-cols-2" id="autre">

                            </div>

                        </div>
                    </div>


                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-sm btn-dark" id="nouveau">Ajouter autre sous catégorie</button>

                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                            <span>Enregistrer</span>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-sous" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter des catégories</h6>
                <button type="button" class="btn btn-transparent p-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sous-categorie.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header bg-success py-2px">
                            <h6 class="m-0 title text-uppercase">Sous catégorie</h6>
                        </div>
                        <div class="card-body p-2">
                            <div class="row justify-content-center mb-2">
                                <div class="col-lg-5">
                                    <div class="form-group mb-2">
                                        <label for="" class="form-labe">Nom du catégorie</label>
                                        <select name="categorie_id" id="" class="form-select">
                                            <option value="">Choisir le catégorie</option>
                                            @foreach ($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->nom }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-dark w-100" id="add">Autre</button>
                                </div>
                            </div>

                            <div class="row row-cols-2" id="autreSous">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-body p-2">
                                            <div class="form-group">
                                                <label for="" class="form-label">Nom</label>
                                                <input type="text" name="" id="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="d-flex justify-content-center">

                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                            <span>Enregistrer</span>
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

$(document).ready(function(){
  $('#nouveau').on('click',function(){
    var html="";
    html+='<div class="col">';
        html+='<div class="card poisition-relative">';
            html+='<button type="button" class="position-absolute top-0 btn btn-outline-danger btn-sm rounded-circle" id="remove_btn"style="left:92%"><span class="mdi mdi-close-thick fw-bolder"></span></button>';
            html+='<div class="card-body p-2">';
                html += '<div class="form-group mb-2">';
                    html+='<label for="">Nom</label>';
                    html+='<input type="text" name="nom_sous[]" id="" class="form-control form-control-sm" required>';
                html += '</div>';
            html += '</div>';
        html += '</div>';
    html += '</div>';
    $('#autre').append(html);
  });

  $('#add').on('click',function(){
    var out="";
    out+='<div class="col">';
        out+='<div class="card poisition-relative">';
            out+='<button type="button" class="position-absolute top-0 btn btn-outline-danger btn-sm rounded-circle" id="remove_sous"style="left:92%"><span class="mdi mdi-close-thick fw-bolder"></span></button>';
            out+='<div class="card-body p-2">';
                out += '<div class="form-group mb-2">';
                    out+='<label for="">Nom</label>';
                    out+='<input type="text" name="nom_sous[]" id="" class="form-control" required>';
                out += '</div>';
            out += '</div>';
        out += '</div>';
    out += '</div>';
    $('#autreSous').append(out);
  });
});
$(document).on('click','#remove_btn',function() {
$(this).closest('.col').remove();
})
$(document).on('click','#remove_sous',function() {
$(this).closest('.col').remove();
})
</script>
@endsection