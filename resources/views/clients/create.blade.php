@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between my-2">

    {{-- <div class="h6 m-0 d-flex"> --}}
        <a href="{{ route('client.index') }}">
            <h5 class="m-0">
                <span class="mdi mdi-arrow-left-bold btn btn-outline-info align-middle"></span>
                <span class="text-primary">Liste des clients</span>

            </h5>
        </a>
    {{-- </div> --}}
    <h5 class="m-0 fw-bolder">Ajouter une client</h5>
</div>
<form action="{{ route('client.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row row-cols-2">

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Raison sociale <span class="text-danger"> * </span></label>
                                <input type="text" name="raison_sociale" class="form-control @error('raison_sociale') is-invalid @enderror" value="{{ old('raison_sociale') }}">
                                @error('raison_sociale')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Responsable <span class="text-danger"> * </span></label>
                                <input type="text" name="responsable" class="form-control @error('responsable') is-invalid @enderror" value="{{ old('responsable') }}">
                                @error('responsable')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Téléphone  <span class="text-danger"> * </span></label>
                                <input type="text" name="phone" id="" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                @error('phone')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Activité</label>
                                <input type="text" name="activite" id="" class="form-control" value="{{ old('activite') }}">
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">ICE</label>
                                <input type="text"  name="ice" class="form-control @error('ice') is-invalid @enderror" min="1" value="{{ old('ice') }}">
                                @error('ice')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">IF</label>
                                <input type="text" name="if" class="form-control @error('if') is-invalid @enderror" min="1" value="{{ old('if') }}">
                                @error('if')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">RC</label>
                                <input type="text" name="rc" class="form-control @error('rc') is-invalid @enderror" value="{{ old('rc') }}">
                                @error('rc')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">E-mail</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                @error('email')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>


                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Adresse <span class="text-danger"> * </span></label>
                                <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}">
                                @error('adresse')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Ville <span class="text-danger"> * </span></label>
                                <input type="text" name="ville" class="form-control @error('ville') is-invalid @enderror" value="{{ old('ville') }}">
                                @error('ville')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Code postal</label>
                                <input type="text" name="code_postal" class="form-control @error('code_postal') is-invalid @enderror" value="{{ old('code_postal') }}">
                                @error('text')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>




                    </div>


                </div>
            </div>

        </div>
        <div class="col">
            <div class="card">
                <div class="card-body p-2">
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
                                                <input type="radio" name="group_id" id="{{"a".$group->id}}" class="form-check-input" value="{{$group->id}}">
                                            </div>
                                        </td>
                                        <td class="align-middle"> {{ $group->nom }} </td>
                                        <td class="align-middle"> {{ $group->remise }} </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                        {{$groupes->links()}}
                    </div>


                    <div class="form-group mb-2">
                        <label for="" class="form-label">Type <span class="text-danger"> * </span></label>
                        <select name="type" id="" class="form-select">
                            <option value="">Choisir le type du client</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->nom }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-centerr">
                        <button type="submit" class="btn btn-sm btn-success">Enregistrer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection