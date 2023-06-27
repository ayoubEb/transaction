@extends('layouts.master')
@section('content')
<h5 class="mb-2">Informations du client & paiement</h5>
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header py-2px bg-success">
                <h6 class="m-0 text-uppercase">information client</h6>
            </div>
            <div class="card-body p-2">
                <ul class="list-group">
                    <li class="list-group-item py-3">
                        <h6 class="m-0 float-start">Raison sociale</h6>
                        <h6 class="m-0 float-end">{{ $client->rs ?? "" }}</h6>
                    </li>
                    <li class="list-group-item py-3">
                        <h6 class="m-0 float-start">ICE</h6>
                        <h6 class="m-0 float-end">{{ $client->ice ?? "" }}</h6>
                    </li>
                    <li class="list-group-item py-3">
                        <h6 class="m-0 float-start">E-mail</h6>
                        <h6 class="m-0 float-end">{{ $client->email ?? "" }}</h6>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header py-2px bg-success">
                <h6 class="m-0 text-uppercase">information client</h6>
            </div>
            <div class="card-body p-2">
                <ul class="list-group">
                    <li class="list-group-item py-2">
                        <div class="row">
                            <div class="col-lg-2">
                                <p class="m-0 fw-bolder">
                                    Raison sociale :
                                </p>
                            </div>
                            <div class="col">
                                <p class="m-0">{{ $client->rs }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-2">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="m-0 fw-bolder">
                                    ICE :
                                </p>
                            </div>
                            <div class="col">
                                <p class="m-0">{{ $client->ice }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-2">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="m-0 fw-bolder">
                                    E-MAIL :
                                </p>
                            </div>
                            <div class="col">
                                <p class="m-0">{{ $client->email }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-2">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="m-0 fw-bolder">
                                    Téléphone :
                                </p>
                            </div>
                            <div class="col">
                                <p class="m-0">{{ $client->telephone }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-2">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="m-0 fw-bolder">
                                    Adresse :
                                </p>
                            </div>
                            <div class="col">
                                <p class="m-0">{{ $client->adresse }}</p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item py-2">
                        <div class="row">
                            <div class="col-lg-3">
                                <p class="m-0 fw-bolder">
                                    Ville :
                                </p>
                            </div>
                            <div class="col">
                                <p class="m-0">{{ $client->ville }}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection