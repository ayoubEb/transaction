@extends('layouts.master')
@section('content')
@include('sweetalert::alert')

<div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
    <h5 class="m-0">Liste des sous-catégories</h5>
    <ol class="breadcrumb m-0 py-2">
        <li class="text-white fw-bolder">
            <a href="{{ route('home') }}" class="text-white">
                Acceuil
            </a>
        </li>
        @can('sous-categorie-list')
            <li class="text-white mx-2 fw-bolder">
                <span class="ti ti-angle-right" style="font-size:0.60rem"></span>
            </li>
            <li class="text-white fw-bolder">
                <a href="{{ route('sous-categorie.index') }}" class="text-white">
                    Liste des sous-catégories
                </a>
            </li>
        @endcan
    </ol>
</div>

<div class="card">
    <div class="card-body p-2">
        @can("sous-categorie-create")
            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#add">
                <span class="mdi mdi-plus-circle-outline align-middle"></span>
                <span>Ajouter</span>
            </button>
        @endcan
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-sm m-0">
                <thead class="table-primary">
                    <tr>
                        <th>#id</th>
                        <th>nom</th>
                        <th>catégorie parent</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ( $sous_categories as $sous )
                        <tr>
                            <td class="align-middle"> {{ $sous->id ?? '' }} </td>
                            <td class="align-middle text-uppercase"> {{ $sous->nom ?? '' }} </td>
                            <td class="align-middle text-uppercase fw-bolder">
                                <span class="badge bg-warning text-dark">{{ $sous->categorie->nom ?? '' }}</span>
                            </td>
                            <td class="align-middl">
                                @can('sous-categorie-edit')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $sous->id }}">
                                        <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                                @can('sous-categorie-destroy')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $sous->id }}">
                                        <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                    </button>
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

@forelse ($sous_categories as $sous)
    <div class="modal fade" id="edit{{ $sous->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-primary py-2">
                    <h6 class="modal-title text-white m-0" id="varyingModalLabel">Modifier le sous-catégorie : {{ $sous->nom }}</h6>
                    <button type="button" class="btn btn-transparent p-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sous-categorie.update',$sous) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Catégorie parent</label>
                            <select name="categorie_u" id="" class="form-select">
                                <option value="">Choisir la catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ $categorie->id == $sous->categorie_id ? "selected":"" }}> {{ $categorie->nom ?? '' }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Nom</label>
                            <input type="text" name="nom_u" id="" class="form-control" value="{{ $sous->nom ?? '' }}">
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

    <div class="modal fade" id="delete{{ $sous->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('sous-categorie.destroy',$sous) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>
                        <h6 class="mb-2 fw-bolder text-center text-muted">Voulez-vous supprimer défenitivement du sous-catégorie</h6>
                        <h6 class="text-danger mb-2 text-center">{{ $sous->nom }}</h6>
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


<div class="modal fade" id="add" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary py-2">
                <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter des sous-catégorie</h6>
                <button type="button" class="btn btn-transparent p-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sous-categorie.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="row justify-content-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label for="" class="form-label">Catégorie</label>
                                        <select name="categorie_id" id="" class="form-select">
                                            <option value="">Choisir la catégorie</option>
                                            @foreach ($categories as $categorie)
                                                <option value="{{ $categorie->id ?? '' }}">{{ $categorie->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-success py-2px">
                            <h6 class="m-0 title text-uppercase">sous catégories</h6>
                        </div>
                        <div class="card-body p-2">
                            <div class="row row-cols-2" id="autre-sous">
                               <div class="col">
                                   <div class="card poisition-relative">
                                       <div class="card-body p-2">
                                           <div class="form-group mb-2">
                                               <label for="">Nom</label>
                                               <input type="text" name="nom[]" id="" class="form-control" required>
                                           </div>
                                       </div>
                                    </div>
                               </div>
                            </div>

                        </div>
                    </div>


                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-sm btn-dark" id="nouveau-sous">Ajouter autre sous catégorie</button>

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
  $('#nouveau-sous').on('click',function(){
    var html="";
    html+='<div class="col">';
        html+='<div class="card poisition-relative">';
            html+='<button type="button" class="position-absolute top-0 btn btn-outline-danger btn-sm rounded-circle" id="remove_sous"style="left:92%"><span class="mdi mdi-close-thick fw-bolder"></span></button>';
            html+='<div class="card-body p-2">';
                html += '<div class="form-group mb-2">';
                    html+='<label for="">Nom</label>';
                    html+='<input type="text" name="nom[]" id="" class="form-control" required>';
                html += '</div>';
            html += '</div>';
        html += '</div>';
    html += '</div>';
    $('#autre-sous').append(html);
  });

});

$(document).on('click','#remove_sous',function() {
    $(this).closest('.col').remove();
})

</script>
@endsection