@extends('layouts.master')
@section('title')
    Liste des types client
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Liste des types du client
        </li>
    </ol>
</nav>
<div class="card">
    <div class="card-body p-2">
        @can('typeClient-create')
            <button type="button" class="btn btn-primary px-5 text-uppercase mb-2" data-bs-toggle="modal" data-bs-target="#add">
                <span class="mdi mdi-plus-circle-outline align-middle"></span>
                <span>Nouveau</span>
            </button>
        @endcan
        <div class="table-responsive">
            <table id="" class="table table-bordered table-sm m-0 datatable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($type_clients as $type_client)
                        <tr>
                            <td class="align-middle">{{ $type_client->nom }}</td>
                            <td class="align-middle">
                                @can('typeClient-edit')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $type_client->id }}">
                                        <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                                @can('typeClient-destroy')
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#destroy{{ $type_client->id }}">
                                        <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Ajouter un employé -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Nouveau type du client</h6>
                <button type="button" class="btn bg-transparent p-0 border-0" data-bs-dismiss="modal" aria-label="Close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('typeClient.store') }}" method="post">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="nom" id="" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                        @error('nom')
                            <strong class="invalid-feedback">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-sm">
                            <span class="mdi mdi-checkbox-marked-circle-outline align-middle"></span>
                            <span>Enregistrer</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@foreach ($type_clients as $type_client)
<div class="modal fade" id="edit{{ $type_client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Modifier le type  : {{ $type_client->nom }}</h6>
                <button type="button" class=" btn bg-transparent p-0 border-0" data-bs-dismiss="modal" aria-label="Close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('typeClient.update',$type_client) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="form-group mb-2">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="nom_u" id="" class="form-control @error('nom_u') is-invalid @enderror" value="{{ $type_client->nom }}">
                        @error('nom_u')
                            <strong class="invalid-feedback">{{ $message }}</strong>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success btn-sm">
                            <span class="mdi mdi-checkbox-marked-circle-outline align-middle"></span>
                            <span>Modifier</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

   <!-- Supprimer un type_client -->


<div class="modal fade" id="destroy{{ $type_client->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h6 class="modal-title m-0" id="exampleModalCenterTitle">Confirmer la suppression</h6>
                <button type="button" class="btn bg-transparent p-0 border-0 border-0" data-bs-dismiss="modal" aria-label="Close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('typeClient.destroy',$type_client) }}" method="post">
                    @csrf
                    @method("DELETE")
                    <h6 class="mb-2 text-center text-muted">
                        Voulez-vous vraiment déplacer du type client vers la corbeille
                    </h6>
                    <h6 class="mb-2 fw-bolder text-center text-uppercase text-danger fs-12">
                        {{ $type_client->nom ?? '' }}
                    </h6>
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <button type="submit" class="btn btn-success btn-sm w-100">OUI</button>
                        </div>
                        <div class="col-lg-5">
                            <button type="button" class="btn btn-danger btn-sm w-100" data-bs-dismiss="modal" aria-label="Close">
                                NON
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach
@endsection
