@extends('layouts.master')
@section('title')
    Liste des groupes
@endsection
@section("content")
@include('sweetalert::alert')


<div class="card">
    <div class="card-body p-2">
        <div class="d-flex justify-content-center mb-3">
            @can("groupe-create")
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add">
                    <span class="mdi mdi-plus-circle-outline align-middle"></span>
                    <span>Nouveau</span>
                </button>
            @endcan
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-sm m-0 datatable">
                <thead class="table-success">
                    <tr>
                        <th>Nom</th>
                        <th>Remise</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($groupes as $groupe)
                        <tr>
                            <td class="align-middle">{{ $groupe->nom }}</td>
                            <td class="align-middle">{{ $groupe->remise." %" }}</td>
                            <td class="align-middle">
                                <i @class([
                                    "mdi",
                                    "mdi-check-bold"=>$groupe->statut == "activer",
                                    "text-success"=>$groupe->statut == "activer",
                                    "mdi-close-thick"=>$groupe->statut == "desactiver",
                                    "text-danger"=>$groupe->statut == "desactiver",
                                ])>
                                </i>
                            </td>
                            <td class="align-middle">
                                @can("produit-edit")
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $groupe->id }}">
                                        <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                                @can("produit-destroy")
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $groupe->id }}">
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
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header py-2 bg-primary">
                <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter un groupe</h6>
                <button type="button" class="btn btn-transparent p-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                    <i class="mdi mdi-close-thick"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('group.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="" class="form-label fw-normal">Nom</label><span class="text-danger">&nbsp;*</span>
                        <input type="text" name="nom" id="" class="form-control form-control-sm @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                        @error('nom')
                            <span class="badge bg-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="form-label fw-normal">Remise</label></span>
                        <input type="text" name="remise" id="" class="form-control form-control-sm"  value="{{ old('remise') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="form-label fw-normal">Statut</label>
                        <div class="form-check form-switch" dir="ltr">
                            <input class="form-check-input py-2 px-3" type="checkbox" name="statut" id="SwitchCheckSizelg" value="activer">
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary w-100 shadow-none">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@foreach ($groupes as $groupe)
    <div class="modal fade" id="edit{{ $groupe->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header py-2 bg-primary">
                    <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Modifier le groupe : {{ $groupe->nom }}</h6>
                    <button type="button" class="btn btn-transparent p-0 text-white" data-bs-dismiss="modal" aria-label="btn-close">
                        <i class="mdi mdi-close-thick"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('group.update',$groupe) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-4">
                          <label for="" class="form-label fw-normal">Nom du group : </label>
                          <input type="text" name="nom_u" id="" class="form-control  @error('nom_u')
                            is-invalid
                          @enderror" value={{$groupe->nom ?? ""}}>
                          @error('nom_u')
                            <span class="badge bg-danger mt-1">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group mb-4">
                          <label for="" class="form-label fw-normal">Remise du group : </label>
                          <input type="text" name="remise_u" id="" class="form-control" value={{$groupe->remise ?? ""}}>
                        </div>
                        <div class="form-group mb-4">
                          <label for="" class="form-label fw-normal d-block">Statut du group : </label>

                          <div class="form-check form-switch form-switch-lg" dir="ltr">
                            <input class="form-check-input" type="checkbox" name="statut_u" id="SwitchCheckSizelg" value="activer"  {{$groupe->statut == 'activer' ? "checked":''}} value="activer">
                            <label class="form-check-label" for="SwitchCheckSizelg">
                              <i class="{{ $groupe->statut=='activer' ? 'badge bg-success':'badge bg-danger' }}"> {{ $groupe->statut ?? '' }} </i>
                            </label>
                          </div>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                          <button type="submit" class="btn btn-primary w-100">Modifier</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete{{ $groupe->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title m-0" id="exampleModalCenterTitle">Confirmer la suppression</h6>
                    <button type="button" class="btn bg-transparent p-0 border-0" data-bs-dismiss="modal" aria-label="Close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('group.destroy',$groupe) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <h6 class="mb-2 text-center text-muted">
                            Voulez-vous vraiment déplacer du groupe vers la corbeille
                        </h6>
                        <div class="d-flex justify-content-center mb-2" >
                            <div class="form-check">
                                <input type="checkbox" name="force" id="del{{$groupe->id}}" class="form-check-input">
                                <label for="del{{$groupe->id}}" class="form-check-label fw-bolder">Ignorer la corbeille et supprimer définitivement du groupe</label>
                            </div>

                        </div>
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