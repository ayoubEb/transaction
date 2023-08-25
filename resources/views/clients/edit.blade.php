@extends('layouts.master')
@section('title')
    Modifier le client : {{ $client->raison_sociale ?? '' }}
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">
            <a href="{{ route('client.index') }}">
                Liste des clients
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Modifier le client : {{ $client->raison_sociale ?? '' }}
        </li>
    </ol>
</nav>

@include('sweetalert::alert')
<form action="{{ route('client.update',$client) }}" method="post">
    @csrf
    @method("PUT")


    <div class="card">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-lg-7 col-sm-6">
                    <h6 class="text-uppercase mb-3 text-primary">
                        <span class="border border-end-0 border-start-0 border-top-0 border-solid border-primary border-2 pb-1">information général</span>
                    </h6>
                    <div class="row row-cols-2">

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Raison sociale <span class="text-danger"> * </span></label>
                                <input type="text" name="raison_sociale" class="form-control @error('raison_sociale') is-invalid @enderror" value="{{ $client->raison_sociale }}">
                                @error('raison_sociale')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Responsable <span class="text-danger"> * </span></label>
                                <input type="text" name="responsable" class="form-control @error('responsable') is-invalid @enderror" value="{{ $client->responsable }}">
                                @error('responsable')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Téléphone  <span class="text-danger"> * </span></label>
                                <input type="text" name="phone" id="" class="form-control @error('phone') is-invalid @enderror" value="{{ $client->phone }}">
                                @error('phone')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Activité</label>
                                <input type="text" name="activite" id="" class="form-control" value="{{ $client->activite }}">
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">ICE</label>
                                <input type="text"  name="ice" class="form-control @error('ice') is-invalid @enderror" min="1" value="{{ $client->ice }}">
                                @error('ice')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">IF</label>
                                <input type="text" name="if" class="form-control @error('if') is-invalid @enderror" min="1" value="{{ $client->if }}">
                                @error('if')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">RC</label>
                                <input type="text" name="rc" class="form-control @error('rc') is-invalid @enderror" value="{{ $client->rc }}">
                                @error('rc')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">E-mail</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $client->email }}">
                                @error('email')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>


                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Adresse <span class="text-danger"> * </span></label>
                                <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{ $client->adresse }}">
                                @error('adresse')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Ville <span class="text-danger"> * </span></label>
                                <input type="text" name="ville" class="form-control @error('ville') is-invalid @enderror" value="{{ $client->ville }}">
                                @error('ville')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Code postal</label>
                                <input type="text" name="code_postal" class="form-control @error('code_postal') is-invalid @enderror" value="{{ $client->code_postal }}">
                                @error('text')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>




                    </div>
                </div>
                <div class="col">
                    <h6 class="text-uppercase mb-4 text-primary">
                        <span class="border border-end-0 border-start-0 border-top-0 border-solid border-primary border-2 pb-1">groupe & type</span>
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mb-2">
                            <thead>
                                <tr>
                                    <th># <span class="text-danger"> * </span></th>
                                    <th>nom</th>
                                    <th>remise</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($groupes as $group)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="form-check">
                                                <label for="{{"a".$group->id}}" class="form-check-label">{{$group->nom}}</label>
                                                <input type="radio" name="group_id" id="{{"a".$group->id}}" class="form-check-input" {{ $group->id == $client->group_id ? 'checked' :'' }} value="{{$group->id}}">
                                            </div>
                                        </td>
                                        <td class="align-middle"> {{ $group->nom }} </td>
                                        <td class="align-middle"> {{ $group->remise }} %</td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                        {{$groupes->links()}}
                    </div>


                    <div class="form-group my-2">
                        <label for="" class="form-label">Type <span class="text-danger"> * </span></label>
                        <select name="type" id="" class="form-select">
                            <option value="">Choisir le type du client</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ $type->id == $client->type_client_id ? 'selected':'' }}>{{ $type->nom }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">
                    Enregistrer
                </button>
            </div>
        </div>
    </div>



</form>
@endsection