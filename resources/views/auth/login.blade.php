@extends('layouts.app')

@section('content')

        <div class="row justify-content-center w-100">
            <div class="col-lg-3">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            {{-- <div class="row justify-content-center mb-3">
                                <div class="col-lg-6">
                                    <img src="{{asset('images/logo-light.png')}}" class="img-fluid" alt="">
                                </div>
                            </div> --}}
                            <div class="form-group mb-2">
                                <label for="" class="form-label text-white">Username</label>
                                <input id="email" type="text" class="form-control shadow-none @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="form-label text-white">Mot de passe</label>
                                <input id="password" type="password" class="form-control shadow-none  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-light btn-sm">
                                    {{ __('Se connecter') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>




@endsection
