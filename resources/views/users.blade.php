@extends('layouts.master')
@section('content')
@if (Session::has('delete'))
    <div class="alert alert-danger mb-2" role="alert">
        {{ Session::get('delete') }}
    </div>
@elseif (Session::has('update'))
    <div class="alert alert-fill-primary mb-2" role="alert">
        {{ Session::get('update') }}
    </div>
@elseif (Session::has('success'))
    <div class="alert alert-fill-success mb-2" role="alert">
        {{ Session::get('success') }}
    </div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
    <div>
      <h4 class="m-0">Liste d'utilisateurs</h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        @can("role-create")
            <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0 btn-sm px-4" data-bs-toggle="modal" data-bs-target="#add">
                Ajouter
            </button>
        @endcan
    </div>
</div>
    <div class="card">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-striped mb-0"  id="dataTableExample">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Statut</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="align-middle"><img src="{{ asset('images/users/'.$user->image) }}" class="avatar-sm"></td>
                                <td class="align-middle">{{ $user->name ?? '' }}</td>
                                <td class="align-middle">{{ $user->email ?? '' }}</td>
                                <td class="align-middle">{{ $user->statut ?? '' }}</td>
                                <td class="align-middle">
                                    {{ $user->role ?? '' }}
                                </td>
                                <td class="align-middle">
                                    @can('user-edit')
                                        <button type="button" class="btn bg-transparent border-0 text-primary p-0" data-bs-toggle="modal" data-bs-target="#edit{{ $user->id }}">
                                            <i class="ti-pencil" style="font-size: 0.80rem"></i>
                                        </button>
                                    @endcan
                                    @can('user-delete')
                                        <button type="button" class="btn bg-transparent border-0 text-primary p-0" data-bs-toggle="modal" data-bs-target="#delete{{ $user->id }}">
                                            <i class="ti-trash" style="font-size: 0.80rem"></i>
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


<div class="modal fade" id="add" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title m-0" id="varyingModalLabel">Ajouter un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="row row-cols-lg-2 row-cols-1">
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" id="" class="form-control form-control-sm @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error("name")
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" id="" class="form-control form-control-sm @error("email") is-invalid @enderror" value="{{ old('email') }}" >
                                @error("email")
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Mot de passe</label>
                                <input type="password" name="password" id="show_nouveau" class="form-control form-control-sm @error('password') is-invalid @enderror" value="{{ old('password') }}">
                                <div class="form-check">
                                    <input type="checkbox" name="" class="form-check-input" onclick="showNouveau()">
                                    <label for="" for="show_pwd" class="form-check-label">Afficher le mot de passe</label>
                                </div>
                                @error("password")
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" name="password_confirmation" id="show_confirmer" class="form-control form-control-sm">
                                <div class="form-check">
                                    <input type="checkbox" name="" class="form-check-input" onclick="showConfirmer()">
                                    <label for="" for="show_pwd" class="form-check-label">Afficher le mot de passe</label>
                                </div>
                            </div>
                        </div>
                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Statut</label>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="statut" id="btnradio1" autocomplete="off" value="activer">
                                <label class="btn btn-outline-success py-2" for="btnradio1">Activer</label>

                                <input type="radio" class="btn-check" name="statut" id="btnradio2" autocomplete="off" value="desactiver">
                                <label class="btn btn-outline-danger py-2" for="btnradio2">Desactiver</label>

                            </div>
                        </div>

                    </div>
                    <div class="form-group mb-2">
                        <label for="" class="form-label">Roles</label>
                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-success py-1 px-3">
                            <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                            <span>Enregistrer</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($users as $user)
    <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title m-0" id="varyingModalLabel">Modifier d'utilisateur : {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route("user.update",$user) }}" method="POST" >
                        @csrf
                        @method("PUT")
                        <div class="row row-cols-lg-2 row-cols-1">
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" name="name_u" id="" class="form-control form-control-sm @error("name_u") is-invalid @enderror" value="{{ $user->name ?? "" }}">
                                    @error("name_u")
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" name="email_u" id="" class="form-control form-control-sm @error("email_u") is-invalid @enderror" value="{{ $user->email ?? "" }}">
                                    @error("email_u")
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Nouveau mot de passe</label>
                                    <input type="password" name="password_u"  id="show_nouveau" class="form-control form-control-sm @error('password_u') is-invalid @enderror">
                                    <div class="form-check">
                                        <input type="checkbox" name="" class="form-check-input" onclick="showNouveau()">
                                        <label for="" for="show_pwd" class="form-check-label">Afficher le mot de passe</label>
                                    </div>
                                    @error("password_u")
                                        <strong class="invalid-feedback">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Confirmer le nouveau mot de passe</label>
                                    <input type="password" name="password_confirmation" id="show_confirmer" class="form-control form-control-sm">
                                    <div class="form-check">
                                        <input type="checkbox" name="" class="form-check-input" onclick="showConfirmer()">
                                        <label for="" for="show_pwd" class="form-check-label">Afficher le mot de passe</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Statut</label>
                                </div>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="statut_u" id="btnradio1" autocomplete="off" value="activer" {{ $user->statut == "activer" ? "checked":"" }}>
                                    <label class="btn btn-outline-success py-2" for="btnradio1">Activer</label>

                                    <input type="radio" class="btn-check" name="statut_u" id="btnradio2" autocomplete="off" value="desactiver" {{ $user->statut == "desactiver" ? "checked":"" }}>
                                    <label class="btn btn-outline-danger py-2" for="btnradio2">Desactiver</label>

                                </div>
                            </div>
                          
                        </div>
                        <div class="form-group mb-2 ">
                            <strong>Role:</strong>
                            {!! Form::select('roles_u[]', $roles,$user->roles->pluck('name','name')->all(), array('class' => 'form-control','multiple')) !!}
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success px-2 py-1">
                                <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                <span>Modifier</span>
                            </button>
                        </div>

                      </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <form action="{{ route('user.destroy',$user) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <div class="p-3 mb-3">
                            <h5 class="mb-2 fw-bolder text-center">Voulez-vous supprimer défenitivement d'utilisateur</h5>
                            <h6 class="text-danger text-center fw-bolder w-100">{{ $user->name }}</h6>
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