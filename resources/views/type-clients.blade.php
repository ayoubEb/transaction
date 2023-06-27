@extends('layouts.master')
@section('content')
    <div class="d-flex my-3 justify-content-between">
        <h5 class="m-0">Liste des type clients</h5>
        @can('type-client-create')
            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#add">
                <span>Nouveau</span>
            </button>
        @endcan
    </div>

<div class="card">
    <div class="card-body p-2">
        <div class="table-responsive">
            <table id="datatable" class="table table-bordered table-sm m-0">
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
                                @can('type-client-edit')
                                    <button type="button" class="btn text-primary btn-transparent p-0" data-toggle="modal" data-target="#edit{{ $type_client->id }}">
                                        <span class="mdi mdi-pencil-outline"></span>
                                    </button>
                                @endcan
                                @can('type-client-destroy')
                                    <button type="button" class="btn text-danger btn-transparent p-0" data-toggle="modal" data-target="#destroy{{ $type_client->id }}">
                                        <span class="mdi mdi-trash-can"></span>
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
                <button type="button" class="btn bg-transparent p-0" data-bs-dismiss="modal" aria-label="Close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('type-client.store') }}" method="post">
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
                <button type="button" class=" btn bg-transparent p-0" data-bs-dismiss="modal" aria-label="Close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('type-client.update',$type_client) }}" method="post">
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
            <div class="modal-header bg-danger py-3">
                <h6 class="m-0 text-white">Confirmer la suppression</h6>
            </div>
            <div class="modal-body p-3">
                <p class="mb-2 ms-1">Vous êtes sur le point de supprimer le type</p>
                <p class="mb-2 text-primary ms-1 text-uppercase">
                    <span class="mdi mdi-check-bold align-middle"></span>
                    <span>{{ $type_client->nom ?? '' }}</span>
                </p>
                <p class="mb-2">Toutes les données associées seront également supprimées</p>
                <p class="fw-bolder mb-2 ms-1">
                    <span>Êtes-vous sûre ? </span>
                    <span class="text-danger">Il n'y a pas d'annulation</span>
                </p>
                <form action="{{ route('type-client.destroy',$type_client) }}" method="post">
                    @csrf
                    @method("DELETE")
                    <div class="row justify-content-evenly m-0">
                        <div class="col-lg-5 p-0">
                            <button type="submit" class="btn btn-success btn-sm w-100">
                                Oui, supprimez le type
                            </button>
                        </div>
                        <div class="col-lg-5 p-0">
                            <button type="button" class="btn btn-danger btn-sm w-100" data-bs-dismiss="modal" aria-label="Close">
                                Non, gardez le type
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
