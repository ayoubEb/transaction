@extends('layouts.master')
@section("content")
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

      <h5 class="mb-3 mb-md-0">Liste des entreprises</h5>
        @can("role-create")
            <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0 py-1 px-3" data-bs-toggle="modal" data-bs-target="#add">
                Ajouter
            </button>
        @endcan

</div>
<div class="card">
    <div class="card-body p-2">
        <div class="table-responsive">
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
        </div>
    </div>
</div>
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title m-0" id="varyingModalLabel">Ajouter d'entreprise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('entreprise.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-cols-lg-2 row-cols-1">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Raison social <span class="text-danger">*</span></label>
                                <input type="text" name="raison_social" id="" class="form-control form-control-sm  @error('raison_social') is-invalid @enderror" value="{{old('raison_social')}}">
                                @error('raison_social')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                            <label for="" class="form-label">ICE <span class="text-danger">*</span></label>
                            <input type="text" name="ice" id=""class="form-control form-control-sm  @error('ice')
                            is-invalid
                            @enderror" value="{{ old('ice') }}">
                            @error('ice')
                                <span class="invalid-feedback">{{ $message }}&nbsp;ex : 454535....</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">RC <span class="text-danger">*</span></label>
                                <input type="text" name="rc" id="" class="form-control form-control-sm  @error('rc') is-invalid @enderror" value="{{ old('rc') }}">
                                @error('rc')
                                    <span class="invalid-feedback">{{ $message }}&nbsp;ex : 454535.....</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group m-0">
                                <label for="" class="form-label">IF <span class="text-danger">*</span></label>
                                <input type="text" name="if" id="" class="form-control form-control-sm  @error('if') is-invalid @enderror" value="{{ old('if') }}">
                                @error('if')
                                    <span class="invalid-feedback">{{ $message }}&nbsp;ex : 454535.....</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Adresse <span class="text-danger">*</span></label>
                                <input type="text" name="adresse" id="" class="form-control form-control-sm  @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}">
                                @error('adresse')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Ville <span class="text-danger">*</span></label>
                                <input type="text" name="ville" id="" class="form-control form-control-sm  @error('ville') is-invalid @enderror" value="{{ old('ville') }}">
                                @error('ville')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                <input type="text" name="telephone" id="" class="form-control form-control-sm  @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}">
                                @error('telephone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Fix</label>
                                <input type="text" name="fix" id="" class="form-control form-control-sm " value="{{ old('fix') }}">
                                @error('fix')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Code postal <span class="text-danger">*</span></label>
                                <input type="text" name="code_postal" id="" class="form-control form-control-sm  @error('code_postal') is-invalid @enderror" value="{{ old('code_postal') }}">
                                @error('code_postal')
                                    <span class="invalid-feedback">{{ $message }}&nbsp;ex : 26000</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Patente <span class="text-danger">*</span></label>
                                <input type="text" name="patente" id="" class="form-control form-control-sm  @error('patente')
                                is-invalid
                                @enderror" value="{{ old('patente') }}">
                                @error('patente')
                                <span class="invalid-feedback">{{ $message }}&nbsp;ex : 454535.....</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Logo</label>
                                <input type="file" name="img" id="" class="form-control shadow-none form-control-sm @error('img') is-invalid @enderror">
                                @error('img')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="" class="form-control form-control-sm  @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('code_postal')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Site</label>
                                <input type="url" name="site" id="" class="form-control shadow-none form-control-file-sm @error('site') is-invalid @enderror" value="{{ old('site') }}">
                                @error('site')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">CNSS <span class="text-danger">*</span></label>
                                <input type="text" name="cnss" id="" class="form-control form-control-sm  @error('cnss') is-invalid @enderror" value="{{ old('cnss') }}">
                                @error('cnss')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-lg-3">
                        <button type="submit" class="btn w-100 shadow-none btn-success">Enregistrer</button>
                      </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>
</div>

@foreach ($entreprises as $entreprise)
<div class="modal fade" id="edit{{ $entreprise->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title m-0" id="varyingModalLabel">Modifier d'entreprise : {{ $entreprise->ice }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('entreprise.update',$entreprise) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <input type="file" name="img_u" id="" class="form-control form-control-sm">
                            @if(isset($entreprise->logo))
                                <img src="{{ asset('images/entreprise/'.$entreprise->logo) }}" class="img-fluid">
                            @else
                            <h6 class="text-center m-0">Aucun logo</h6>
                            @endif
                        </div>
                    </div>
                    <div class="row row-cols-lg-2 row-cols-1">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Raison social <span class="text-danger">*</span></label>
                                <input type="text" name="raison_social_u" id="" class="form-control @error('raison_social_u') is-invalid @enderror" value="{{ $entreprise->raison_social ?? '' }}">
                                  @error('raison_social_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                  @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">ICE <span class="text-danger">*</span></label>
                                <input type="text" name="ice_u" id=""class="form-control @error('ice_u') is-invalid @enderror" value="{{ $entreprise->ice ?? '' }}">
                                @error('ice_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">PATENTE <span class="text-danger">*</span></label>
                                <input type="text" name="patente_u" id=""class="form-control @error('patente_u') is-invalid @enderror" value="{{ $entreprise->patente ?? '' }}">
                                @error('patente_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">RC <span class="text-danger">*</span></label>
                                <input type="text" name="rc_u" id="" class="form-control @error('rc_u') is-invalid @enderror" value="{{ $entreprise->rc ?? '' }}">
                                @error('rc_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group m-0">
                                <label for="" class="form-label">IF <span class="text-danger">*</span></label>
                                <input type="text" name="if_u" id="" class="form-control @error('if_u') is-invalid @enderror" value="{{ $entreprise->if ?? '' }}">
                                @error('if_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Adresse <span class="text-danger">*</span></label>
                                <input type="text" name="adresse_u" id="" class="form-control @error('adresse_u') is-invalid @enderror" value="{{ $entreprise->adresse ?? '' }}">
                                @error('adresse_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Ville <span class="text-danger">*</span></label>
                                <input type="text" name="ville_u" id="" class="form-control @error('ville_u') is-invalid @enderror" value="{{ $entreprise->ville ?? '' }}">
                                @error('ville_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                <input type="text" name="telephone_u" id="" class="form-control @error('telephone_u') is-invalid @enderror" value="{{ $entreprise->telephone ?? '' }}">
                                @error('telephone_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Fix</label>
                                <input type="text" name="fix_u" id="" class="form-control" value="{{ $entreprise->fix ?? '' }}">

                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Code postal <span class="text-danger">*</span></label>
                                <input type="text" name="code_postal_u" id="" class="form-control @error('code_postal_u') is-invalid @enderror" value="{{ $entreprise->code_postal ?? '' }}">
                                @error('code_postal_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email_u" id="" class="form-control @error('email_u') is-invalid @enderror" value="{{ $entreprise->email ?? '' }}">
                                @error('email_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Site</label>
                                <input type="url" name="site_u" id="" class="form-control shadow-none form-control-file-sm @error('site_u') is-invalid @enderror"  value="{{ $entreprise->site ?? '' }}">
                                @error('site_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">CNSS <span class="text-danger">*</span></label>
                                <input type="text" name="cnss_u" id="" class="form-control  @error('cnss_u') is-invalid @enderror"  value="{{ $entreprise->cnss ?? '' }}">
                                @error('cnss_u')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
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
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete{{ $entreprise->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <form action="{{ route('entreprise.destroy',$entreprise) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <div class="p-3 mb-3">
                        <h5 class="mb-2 fw-bolder text-center">Voulez-vous supprimer défenitivement d'entreprise'</h5>
                        <h6 class="text-danger text-center fw-bolder w-100">{{ $entreprise->rc }}</h6>
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