@extends('layouts.master')
@section('title')
    @if ($entreprise_existe == false)
        Ajouter information d'entreprise
    @else
        Information d'entreprise
    @endif

@endsection
@section("content")
@include('sweetalert::alert')
<div class="card">
    <div class="card-body p-2">
        @if ($entreprise_existe == false)
            @can('entreprise-create')
                <form action="{{ route('entreprise.store') }}" method="post">
                    @csrf

                    <div class="row row-cols-2">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Raison Sociale <span class="text-danger"> * </span></label>
                                <input type="text" name="raison_sociale" id="" class="form-control @error('raison_sociale') is-invalid @enderror" value="{{ old('raison_sociale') }}">
                                @error('raison_sociale')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">ICE <span class="text-danger"> * </span></label>
                                <input type="text" name="ice" id="" class="form-control @error('ice') is-invalid @enderror" value="{{ old('ice') }}">
                                @error('ice')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">RC <span class="text-danger"> * </span></label>
                                <input type="text" name="rc" id="" class="form-control @error('rc') is-invalid @enderror" value="{{ old('rc') }}">
                                @error('rc')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">IF <span class="text-danger"> * </span></label>
                                <input type="text" name="if" id="" class="form-control @error('if') is-invalid @enderror" value="{{ old('if') }}">
                                @error('if')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Téléphone <span class="text-danger"> * </span></label>
                                <input type="text" name="telephone" id="" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}">
                                @error('telephone')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">fix</label>
                                <input type="text" name="fix" id="" class="form-control" value="{{ old('fix') }}">
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Patente <span class="text-danger"> * </span></label>
                                <input type="text" name="patente" id="" class="form-control @error('patente') is-invalid @enderror" value="{{ old('patente') }}">
                                @error('patente')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">E-mail <span class="text-danger"> * </span></label>
                                <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Site <span class="text-danger"> * </span></label>
                                <input type="text" name="site" id="" class="form-control @error('site') is-invalid @enderror" value="{{ old('site') }}">
                                @error('site')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">CNSS <span class="text-danger"> * </span></label>
                                <input type="text" name="cnss" id="" class="form-control @error('cnss') is-invalid @enderror" value="{{ old('cnss') }}">
                                @error('cnss')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label for="" class="form-label">Adresse <span class="text-danger"> * </span></label>
                                        <input type="text" name="adresse" id="" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}">
                                        @error('adresse')
                                            <strong class="invalid-feedback">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="form-label">Ville <span class="text-danger"> * </span></label>
                                        <input type="text" name="ville" id="" class="form-control @error('ville') is-invalid @enderror" value="{{ old('ville') }}">
                                        @error('ville')
                                            <strong class="invalid-feedback">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" class="form-label">Code postal <span class="text-danger"> * </span></label>
                                        <input type="text" name="code_postal" id="" class="form-control @error('code_postal') is-invalid @enderror" value="{{ old('code_postal') }}">
                                        @error('code_postal')
                                            <strong class="invalid-feedback">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-sm btn-success">
                            <span class="mdi mdi-check-bold align-middle"></span>
                            <span>Enregistrer</span>
                        </button>
                    </div>
                </form>
            @endcan
        @else
            <form action="{{ route('entreprise.update',$entreprise) }}" method="post">
                @csrf
                @method('PUT')

                <div class="row row-cols-2">
                    <div class="col mb-2">
                        <div class="form-group">
                            <label for="" class="form-label">Raison Sociale <span class="text-danger"> * </span></label>
                            <input type="text" name="raison_sociale" id="" class="form-control @error('raison_sociale') is-invalid @enderror" value="{{ $entreprise->raison_sociale ?? '' }}">
                            @error('raison_sociale')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="form-group">
                            <label for="" class="form-label">ICE <span class="text-danger"> * </span></label>
                            <input type="text" name="ice" id="" class="form-control @error('ice') is-invalid @enderror" value="{{ $entreprise->ice ?? '' }}">
                            @error('ice')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="form-group">
                            <label for="" class="form-label">RC <span class="text-danger"> * </span></label>
                            <input type="text" name="rc" id="" class="form-control @error('rc') is-invalid @enderror" value="{{ $entreprise->rc ?? '' }}">
                            @error('rc')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="form-group">
                            <label for="" class="form-label">IF <span class="text-danger"> * </span></label>
                            <input type="text" name="if" id="" class="form-control @error('if') is-invalid @enderror" value="{{ $entreprise->if ?? '' }}">
                            @error('if')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="form-group">
                            <label for="" class="form-label">Téléphone <span class="text-danger"> * </span></label>
                            <input type="text" name="telephone" id="" class="form-control @error('telephone') is-invalid @enderror" value="{{ $entreprise->telephone ?? '' }}">
                            @error('telephone')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="form-group">
                            <label for="" class="form-label">fix</label>
                            <input type="text" name="fix" id="" class="form-control" value="{{ $entreprise->fix ?? '' }}">
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="form-group">
                            <label for="" class="form-label">Patente <span class="text-danger"> * </span></label>
                            <input type="text" name="patente" id="" class="form-control @error('patente') is-invalid @enderror" value="{{ $entreprise->patente ?? '' }}">
                            @error('patente')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="form-group">
                            <label for="" class="form-label">E-mail <span class="text-danger"> * </span></label>
                            <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" value="{{ $entreprise->email ?? '' }}">
                            @error('email')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="form-group">
                            <label for="" class="form-label">Site <span class="text-danger"> * </span></label>
                            <input type="text" name="site" id="" class="form-control @error('site') is-invalid @enderror" value="{{ $entreprise->site ?? '' }}">
                            @error('site')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col mb-2">
                        <div class="form-group">
                            <label for="" class="form-label">CNSS <span class="text-danger"> * </span></label>
                            <input type="text" name="cnss" id="" class="form-control @error('cnss') is-invalid @enderror" value="{{ $entreprise->cnss ?? '' }}">
                            @error('cnss')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="" class="form-label">Adresse <span class="text-danger"> * </span></label>
                                    <input type="text" name="adresse" id="" class="form-control @error('adresse') is-invalid @enderror" value="{{ $entreprise->adresse ?? '' }}">
                                    @error('adresse')
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="form-label">Ville <span class="text-danger"> * </span></label>
                                    <input type="text" name="ville" id="" class="form-control @error('ville') is-invalid @enderror" value="{{ $entreprise->ville ?? '' }}">
                                    @error('ville')
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="" class="form-label">Code postal <span class="text-danger"> * </span></label>
                                    <input type="text" name="code_postal" id="" class="form-control @error('code_postal') is-invalid @enderror" value="{{ $entreprise->code_postal ?? '' }}">
                                    @error('code_postal')
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-center mt-2">
                    <button type="submit" class="btn btn-success py-1 px-3">
                        <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                        <span>Modifier</span>
                    </button>
                </div>

            </form>

        @endif

        <div class="row">
            {{-- <div class="col-lg-4 col-6">
                <img src="{{ asset('images/logo.jpg') }}" alt="" class="img-fluid mt-2 mb-4">
                <ul class="list-group mt-3">
                    <li class="list-group-item py-2px d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fs-12 text-uppercase">raison sociale</h6>
                        <h6 class="m-0">&nbsp;:&nbsp;</h6>
                        <h6 class="m-0 fs-12 text-uppercase fw-normal">{{ $entreprise->raison_sociale ?? 'aucun'  }}</h6>
                    </li>
                    <li class="list-group-item py-2px d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fs-12 text-uppercase">ice</h6>
                        <h6 class="m-0">&nbsp;:&nbsp;</h6>
                        <h6 class="m-0 fs-12 text-uppercase fw-normal">{{ $entreprise->ice ?? 'aucun'  }}</h6>
                    </li>
                    <li class="list-group-item py-2px d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fs-12 text-uppercase">patente</h6>
                        <h6 class="m-0">&nbsp;:&nbsp;</h6>
                        <h6 class="m-0 fs-12 text-uppercase fw-normal">{{ $entreprise->patente ?? 'aucun'  }}</h6>
                    </li>
                </ul>
            </div> --}}
            <div class="col">
            </div>
        </div>
        {{-- <div class="table-responsive">
            <table id="dataTableExample" class="table table-bordered table-sm m-0">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Raison Social</th>
                        <th>ICE</th>
                        <th>E-mail</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entreprises as $entreprise)
                        <tr>
                            <td class="align-middle">
                                @if ($entreprise->logo != null)
                                    <img src="{{ asset('images/entreprise/'.$entreprise->logo) }}" alt="" class="avatar-md rounded-circle">
                                @else
                                    Aucun logo
                                @endif
                            </td>
                            <td class="align-middle">{{ $entreprise->raison_social }}</td>
                            <td class="align-middle">{{ $entreprise->ice }}</td>
                            <td class="align-middle">{{ $entreprise->email }}</td>
                            <td class="align-middle">{{ $entreprise->telephone }}</td>
                            <td class="align-middle">
                                @can("entreprise-edit")
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $entreprise->id }}">
                                        <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                                @can("entreprise-delete")
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#delete{{ $entreprise->id }}">
                                        <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div> --}}
    </div>
</div>


@endsection