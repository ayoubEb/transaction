@extends('layouts.master')
@section("content")
@include('sweetalert::alert')
<div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="mb-3 mb-md-0">Liste du groupes</h5>
    @can("groupe-create")
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add">
            Nouveau
        </button>
    @endcan
</div>

<div class="card">
    <div class="card-body p-2">
        <div class="table-responsive">
            <table class="table table-bordered table-sm m-0">
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
                                @can("produit-delete")
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#delete{{ $groupe->id }}">
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

    <div class="modal fade" id="delete{{ $groupe->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <form action="{{ route('group.destroy',$groupe) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <div class="p-3 mb-3">
                            <h5 class="mb-2 fw-bolder text-center">Voulez-vous supprimer défenitivement du group</h5>
                            <h6 class="text-danger text-center fw-bolder w-100">{{ $groupe->nom }}</h6>
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