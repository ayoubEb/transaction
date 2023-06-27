@extends('layouts.master')
@section('content')
@include('sweetalert::alert')
<div class="d-flex justify-content-between mb-2">
    <h5 class="m-0">Liste des clients</h5>
    <ol class="breadcrumb m-0 py-2">
        <li class="text-white fw-bolder">
            <a href="{{ route('home') }}" class="text-white">
                Acceuil
            </a>
        </li>
        @can('client-list')
            <li class="text-white mx-2 fw-bolder">
                <span class="ti ti-angle-right" style="font-size:0.60rem"></span>
            </li>
            <li class="text-white fw-bolder">
                <a href="{{ route('client.index') }}" class="text-white">
                    Liste des clients
                </a>
            </li>
        @endcan
    </ol>
</div>
<div class="card">
    <div class="card-body p-2">
        <div class="d-flex justify-content-between mb-2">
            @can('client-create')
                <a href="{{ route('client.create') }}" class="btn btn-primary btn-sm">Nouveau</a>
            @endcan
            <ul class="nav nav-tabs">
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm" id="liste-tab" data-bs-toggle="tab" data-bs-target="#liste" type="button" role="tab" aria-controls="liste" aria-selected="true">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-sm active" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid" type="button" role="tab" aria-controls="grid" aria-selected="false">
                        <span class="mdi mdi-dots-grid"></span>
                    </button>
                </li>
            </ul>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="liste" role="tabpanel" aria-labelledby="liste-tab">
                <div class="table-responsive">
                    <table class="table table-bordered m-0 table-sm" id="basic-datatable">
                        <thead class="table-success">
                            <tr>
                                <th>raison sociale</th>
                                <th>adresse</th>
                                <th>Téléphone</th>
                                <th>type</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clients as $client)
                                <tr>
                                    <td class="align-middle">{{ $client->raison_sociale ?? "" }}</td>
                                    <td class="align-middle">{{ $client->adresse ?? "" }}</td>
                                    <td class="align-middle">{{ $client->telephone ?? "" }}</td>
                                    <td class="align-middle">
                                        {{ $client->type->nom ?? "" }}
                                    </td>
                                    <td class="align-middle">
                                        @can('client-edit')
                                            <a href="{{ route('client.edit',$client) }}" class="btn p-0 bg-transparent border-0 text-primary">
                                                <span class="ti-pencil"></span>
                                            </a>
                                        @endcan
                                        @can('client-delete')
                                            <button  class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{$client->id}}">
                                                <span class="ti-trash"></span>
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

            <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                <div class="row row-cols-4 mt-2">

                    @forelse ($clients as $client)
                        <div class="col">
                            <div class="card client">
                                <div class="card-body p-0">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-5">
                                            <img src="{{ asset('images/user.png') }}" alt="" class="img-fluid rounded">
                                        </div>
                                        <div class="col-1 action d-flex flex-column">
                                            @can('client-edit')
                                                <a href="{{ route('client.edit',$client) }}" class="btn p-0 bg-transparent border-0 text-primary d-block">
                                                    <span class="ti-pencil"></span>
                                                </a>
                                            @endcan
                                            @can('client-delete')
                                                <button  class="btn p-0 bg-transparent border-0 text-danger d-block" data-bs-toggle="modal" data-bs-target="#delete{{$client->id}}">
                                                    <span class="ti-trash"></span>
                                                </button>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <h6 class="card-text text-white text-center text-uppercase">
                                            {{ $client->raison_sociale ?? "" }}
                                        </h6>
                                        <table class="table table-borderless table-sm m-0">
                                            <tbody>
                                                <tr>
                                                    <th class="col-1">
                                                        <p class="btn btn-sm btn-light m-0 fw-bolder fs-13-5">téléphone</p>
                                                    </th>
                                                    <td class="text-white align-middle">
                                                        <p class="m-0 fs-12"{{ $client->phone ?? '' }}></p>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-1">
                                                        <p class="btn btn-sm btn-light m-0 fw-bolder fs-13-5 w-100">Adresse</p>
                                                    </th>
                                                    <td class="text-white align-middle">
                                                        <p class="m-0 fs-12">{{ $client->adresse ?? '' }} {{ $client->ville ?? '' }}</p>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-1">
                                                        <p class="btn btn-sm btn-light m-0 fw-bolder fs-13-5 w-100">Activité</p>
                                                    </th>
                                                    <td class="text-white align-middle">
                                                        <p class="m-0 fs-12">{{ $client->activite ?? '' }}</p>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="col-1">
                                                        <p class="btn btn-sm btn-light m-0 fw-bolder fs-13-5 w-100">type</p>
                                                    </th>
                                                    <td class="text-white align-middle">
                                                        <p class="m-0 fs-12">{{ $client->type->nom ?? '' }}</p>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>


                    @empty

                    @endforelse

                </div>
            </div>
        </div>

    </div>
</div>



@foreach ($clients as $client)
    <div class="modal fade" id="delete{{ $client->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <form action="{{ route('client.destroy',$client) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <div class="p-3 mb-3">
                            <h5 class="mb-2 fw-bolder text-center">Voulez-vous supprimer défenitivement du client</h5>
                            <h6 class="text-danger text-center fw-bolder w-100">{{ $client->raison_sociale }} => {{ $client->responsable }}</h6>
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


@endsection
