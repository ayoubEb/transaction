@extends('layouts.master')
@section('title')
    Liste des fournisseurs
@endsection
@section('content')
@include('sweetalert::alert')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Liste des fournisseur

        </li>
    </ol>
</nav>

<div class="card">
    <div class="card-body p-2">
        <button type="button" class="btn btn-primary text-uppercase mb-3" data-bs-toggle="modal" data-bs-target="#add">
            <span class="mdi mdi-plus-circle-outline align-middle"></span>
            <span>Ajouter</span>
        </button>

        <div class="table-responsive">
            <table class="table table-bordered m-0 table-sm datatable">
                <thead class="table-success">
                    <tr>
                        <th>raison sociale</th>
                        <th>rc</th>
                        <th>ice</th>
                        <th>téléphone</th>
                        <th>fix</th>
                        <th>email</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($fournisseurs as $fournisseur)
                        <tr>
                            <td class="align-middle">{{ $fournisseur->raison_sociale }}</td>
                            <td class="align-middle">{{ $fournisseur->rc ?? '' }}</td>
                            <td class="align-middle">{{ $fournisseur->ice ?? '' }}</td>
                            <td class="align-middle">{{ $fournisseur->phone ?? '' }}</td>
                            <td class="align-middle">{{ $fournisseur->fix ?? '' }}</td>
                            <td class="align-middle">{{ $fournisseur->email ?? '' }}</td>
                            <td class="align-middle">
                                <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $fournisseur->id }}">
                                    <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                </button>

                                <button type="button" class="btn p-0 bg-transparent border-0 text-warning" data-bs-toggle="modal" data-bs-target="#show{{ $fournisseur->id }}">
                                    <i class="ti-info" style="font-size: 0.90rem;"></i>
                                </button>

                                <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $fournisseur->id }}">
                                    <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                </button>
                            </td>
                        </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@forelse ($fournisseurs as $fournisseur)
    <div class="modal fade" id="edit{{ $fournisseur->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary py-2">
                    <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Modifier du fournisseur : {{ $fournisseur->raison_sociale }}</h6>
                    <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fournisseur.update',$fournisseur) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="row row-cols-2">
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Raison sociale</label>
                                    <input type="text" name="raison_sociale_u" id="" class="form-control @error('raison_sociale_u') is-invalid @enderror" value="{{ $fournisseur->raison_sociale }}">
                                    @error('raison_sociale_u')
                                        <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">ICE</label>
                                    <input type="text" name="ice_u" id="" class="form-control @error('ice') is-invalid @enderror" value="{{ $fournisseur->ice }}">
                                    @error('ice')
                                        <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">RC</label>
                                    <input type="text" name="rc_u" id="" class="form-control @error('rc') is-invalid @enderror" value="{{ $fournisseur->rc }}">
                                    @error('rc')
                                        <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">E-mail</label>
                                    <input type="email" name="email_u" id="" class="form-control @error('email') is-invalid @enderror" value="{{ $fournisseur->email }}">
                                    @error('email')
                                        <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Téléphone</label>
                                    <input type="text" name="phone_u" id="" class="form-control @error('phone') is-invalid @enderror" value="{{ $fournisseur->phone }}">
                                    @error('phone')
                                        <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Fix</label>
                                    <input type="text" name="fix_u" id="" class="form-control @error('fix') is-invalid @enderror" value="{{ $fournisseur->fix }}">
                                    @error('fix')
                                        <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Adresse</label>
                                    <input type="text" name="adresse_u" id="" class="form-control @error('adresse') is-invalid @enderror" value="{{ $fournisseur->adresse }}">
                                    @error('adresse')
                                        <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Ville</label>
                                    <input type="text" name="ville_u" id="" class="form-control @error('ville') is-invalid @enderror" value="{{ $fournisseur->ville }}">
                                    @error('ville')
                                        <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Pays</label>
                                    <input type="text" name="pays_u" id="" class="form-control @error('pays') is-invalid @enderror" value="{{ $fournisseur->pays }}">
                                    @error('pays')
                                        <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Code postal</label>
                                    <input type="number" name="code_postal_u" id="" class="form-control @error('code_postal') is-invalid @enderror" value="{{ $fournisseur->code_postal }}">
                                    @error('code_postal')
                                        <strong class="invalid-feedback"> {{ $message }} </strong>
                                    @enderror
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

    <div class="modal fade" id="show{{ $fournisseur->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary py-2">
                    <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Information du fournisseur : {{ $fournisseur->raison_sociale }}</h6>
                    <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                        <span class="mdi mdi-close-thick"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row row-cols-md-2 row-cols-1">
                        <div class="col">
                            <div class="card m-0">
                                <div class="card-body p-2">
                                    <table class="table table-striped m-0">
                                        <tbody>
                                            <tr>
                                                <th class="align-middle">raison sociale</th>
                                                <td class="align-middle">{{ $fournisseur->raison_sociale }}</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">rc</th>
                                                <td class="align-middle">{{ $fournisseur->rc ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">téléphone</th>
                                                <td class="align-middle">{{ $fournisseur->phone ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">adresse</th>
                                                <td class="align-middle">{{ $fournisseur->adresse ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">pays</th>
                                                <td class="align-middle">{{ $fournisseur->pays ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card m-0">
                                <div class="card-body p-2">
                                    <table class="table table-striped m-0">
                                        <tbody>
                                            <tr>
                                                <th class="align-middle">ice</th>
                                                <td class="align-middle">{{ $fournisseur->ice ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">e-mail</th>
                                                <td class="align-middle">{{ $fournisseur->email ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">fix</th>
                                                <td class="align-middle">{{ $fournisseur->fix ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">ville</th>
                                                <td class="align-middle">{{ $fournisseur->ville ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="align-middle">code postal</th>
                                                <td class="align-middle">{{ $fournisseur->code_postal ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="delete{{ $fournisseur->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('fournisseur.destroy',$fournisseur) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>
                        <h6 class="mb-2 fw-bolder text-center text-muted">
                            Voulez-vous vraiment déplacer du fournisseur vers la corbeille
                        </h6>
                        <h6 class="text-danger mb-2 text-center">{{ $fournisseur->raison_sociale ?? '' }}</h6>
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
                <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Ajouter de fournisseur</h6>
                <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                    <span class="mdi mdi-close-thick"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('fournisseur.store') }}" method="post">
                    @csrf
                    <div class="row row-cols-2">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Raison sociale</label>
                                <input type="text" name="raison_sociale" id="" class="form-control @error('raison_sociale') is-invalid @enderror" value="{{ old('raison_sociale') }}">
                                @error('raison_sociale')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">ICE</label>
                                <input type="text" name="ice" id="" class="form-control @error('ice') is-invalid @enderror" value="{{ old('ice') }}">
                                @error('ice')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">RC</label>
                                <input type="text" name="rc" id="" class="form-control @error('rc') is-invalid @enderror" value="{{ old('rc') }}">
                                @error('rc')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">E-mail</label>
                                <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Téléphone</label>
                                <input type="text" name="phone" id="" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                @error('phone')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Fix</label>
                                <input type="text" name="fix" id="" class="form-control @error('fix') is-invalid @enderror" value="{{ old('fix') }}">
                                @error('fix')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Adresse</label>
                                <input type="text" name="adresse" id="" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}">
                                @error('adresse')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Ville</label>
                                <input type="text" name="ville" id="" class="form-control @error('ville') is-invalid @enderror" value="{{ old('ville') }}">
                                @error('ville')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Pays</label>
                                <input type="text" name="pays" id="" class="form-control @error('pays') is-invalid @enderror"  value="{{ old('pays')}}">
                                @error('pays')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Code postal</label>
                                <input type="number" name="code_postal" id="" class="form-control @error('code_postal') is-invalid @enderror" value="{{ old('code_postal') }}">
                                @error('code_postal')
                                    <strong class="invalid-feedback"> {{ $message }} </strong>
                                @enderror
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