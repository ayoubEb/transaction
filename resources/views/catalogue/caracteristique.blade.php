@extends('layouts.master')
@section('title')
Liste des caractéristiques
@endsection
@section('content')
@include('sweetalert::alert')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Liste des caractéristiques

        </li>
    </ol>
</nav>


<div class="card">
    <div class="card-body p-2">
        @can("caracteristique-create")
            <button type="button" class="btn btn-primary text-uppercase mb-3 px-5" data-bs-toggle="modal" data-bs-target="#add">
                <span class="mdi mdi-plus-circle-outline align-middle"></span>
                <span>Ajouter</span>
            </button>
        @endcan
        <div class="table-responsive">
            <table class="table table-bordered table-sm m-0 datatable" >
                <thead class="table-primary">
                    <tr>
                        <th>#id</th>
                        <th>nom</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($caracteristiques as $caracteristique)
                        <tr>
                            <td class="align-middle"> {{ $caracteristique->id ?? '' }} </td>
                            <td class="align-middle"> {{ $caracteristique->nom ?? '' }} </td>
                            <td class="align-middle">
                                @can('caracteristique-edit')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $caracteristique->id }}">
                                        <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                                @can('caracteristique-destroy')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $caracteristique->id }}">
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

@forelse ($caracteristiques as $caracteristique)
    <div class="modal fade" id="edit{{ $caracteristique->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-primary py-2">
                    <h6 class="modal-title text-white m-0" id="varyingModalLabel">Modifier la caractéristique : {{ $caracteristique->nom }}</h6>
                    <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('caracteristique.update',$caracteristique) }}" method="post">
                        @csrf
                        @method("PUT")

                        <div class="form-group mb-2">
                            <label for="" class="form-label">Nom</label>
                            <input type="text" name="nom_u" id="" class="form-control" value="{{ $caracteristique->nom ?? '' }}">
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

    <div class="modal fade" id="delete{{ $caracteristique->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('caracteristique.destroy',$caracteristique) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>

                        <h6 class="mb-2 fw-bolder text-center text-muted">
                            Voulez-vous vraiment déplacer du caracteristique vers la corbeille
                        </h6>
                        <h6 class="text-danger mb-2 text-center">{{ $caracteristique->nom }}</h6>
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
                <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter des caractéristiques</h6>
                <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('caracteristique.store') }}" method="post">
                    @csrf
                    <div class="row row-cols-2" id="autre">
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



                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-sm btn-dark" id="nouveau">Ajouter autre caractéristique</button>

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
            html+='<button type="button" class="position-absolute top-0 btn btn-outline-danger btn-sm rounded-circle" id="remove"style="left:92%"><span class="mdi mdi-close-thick fw-bolder"></span></button>';
            html+='<div class="card-body p-2">';
                html += '<div class="form-group mb-2">';
                    html+='<label for="">Nom</label>';
                    html+='<input type="text" name="nom[]" id="" class="form-control" required>';
                html += '</div>';
            html += '</div>';
        html += '</div>';
    html += '</div>';
    $('#autre').append(html);
  });

});

$(document).on('click','#remove',function() {
    $(this).closest('.col').remove();
})

</script>
@endsection