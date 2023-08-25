@extends('layouts.master')
@section('title')
    Modifier l'authorisation : {{ $role->name }}
@endsection
@section('content')
<div class="card">
    <div class="card-body p-2">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
        @endif
        {!! Form::model($role, ['method' => 'PATCH','route' => ['role.update', $role->id]]) !!}
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="row align-items-center">
                    <label class="form-label col-md-2">Name : </label>
                    <div class="col">

                    </div>
                </div>
            </div>
        </div>



        <div class="table-responsive">
            <table class="table table-bordered table-sm m-0">
                {{-- <thead>

                </thead> --}}
                <tbody>
                    <tr>
                        <th class="bg-success col-lg-2 col-4 align-middle text-center text-white">name</th>
                        <td class="align-middle">
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">catégorie</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($categories as $categorie)
                                    <div class="col mb-lg-0 mb-2">
                                        <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $categorie->id }}">

                                            <div class="form-check form-switch">
                                                {{ Form::checkbox('permission_u[]', $categorie->id, in_array($categorie->id, $rolePermissions) ? true : false, array('class' => 'form-check-input',"style"=>"cursor:pointer",'id'=>'swithe'.$categorie->id)) }}
                                                {{Str::after($categorie->name,"-")}}
                                                {{-- <label class="form-check-label" for="swithe{{ $categorie->id }}"></label> --}}
                                                {{--
                                                Form::checkbox('permission[]', $categorie->id, in_array($categorie->id, $rolePermissions) ? true : false, array(['class' => 'name', "switch"=>"none"])) --}}

                                            </div>
                                        </label>
                                    </div>

                                    @endforeach

                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">sous-catégorie</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($sous_categories as $sous_categorie)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $sous_categorie->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $sous_categorie->id, in_array($sous_categorie->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$sous_categorie->id)) }}
                                                    {{Str::after($sous_categorie->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">caractéristique</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($caracteristiques as $caracteristique)
                                        <div class="col mb-lg-0 mb-2">
                                            <li class="list-group-item py-1 d-flex justify-content-center" style="cursor: pointer;" for="swithe{{ $caracteristique->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $caracteristique->id, in_array($caracteristique->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$caracteristique->id)) }}
                                                    <label class="form-check-label" for="swithe{{ $caracteristique->id }}">{{Str::after($caracteristique->name,"-")}}</label>
                                                </div>
                                            </li>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">stock</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($stocks as $stock)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $stock->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $stock->id, in_array($stock->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$stock->id)) }}
                                                    {{Str::after($stock->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">facture</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($factures as $facture)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $facture->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $facture->id, in_array($facture->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$facture->id)) }}
                                                    {{Str::after($facture->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">personalisation</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($customizes as $customize)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $customize->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $customize->id, in_array($customize->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$customize->id)) }}
                                                    {{Str::after($customize->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">groupe</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($groupes as $groupe)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $groupe->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $groupe->id, in_array($groupe->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$groupe->id)) }}
                                                    {{Str::after($groupe->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">client</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($clients as $client)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $client->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $client->id, in_array($client->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$client->id)) }}
                                                    {{Str::after($client->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">produit</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($produits as $produit)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $produit->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $produit->id, in_array($produit->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$produit->id)) }}
                                                    {{Str::after($produit->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">utilisateur</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($users as $user)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $user->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $user->id, in_array($user->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$user->id)) }}
                                                    {{Str::after($user->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">rôle</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($roles as $role)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $role->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $role->id, in_array($role->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$role->id)) }}
                                                    {{Str::after($role->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">Entreprise</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($entreprises as $entreprise)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $entreprise->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $entreprise->id, in_array($entreprise->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$entreprise->id)) }}
                                                    {{Str::after($entreprise->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">transaction</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($transactions as $transaction)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $transaction->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $transaction->id, in_array($transaction->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$transaction->id)) }}
                                                    {{Str::after($transaction->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">vente semaine</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($vente_semaines as $vente_semaine)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $vente_semaine->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $vente_semaine->id, in_array($vente_semaine->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$vente_semaine->id)) }}
                                                    {{Str::after($vente_semaine->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">type clients</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($type_clients as $type_client)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $type_client->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $type_client->id, in_array($type_client->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$type_client->id)) }}
                                                    {{Str::after($type_client->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">facture paiement</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($facture_paiements as $facture_paiement)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $facture_paiement->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $facture_paiement->id, in_array($facture_paiement->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$facture_paiement->id)) }}
                                                    {{Str::after($facture_paiement->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">stock historique</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($stock_historiques as $stock_historique)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $stock_historique->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $stock_historique->id, in_array($stock_historique->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$stock_historique->id)) }}
                                                    {{Str::after($stock_historique->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle text-center">avoires</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-2 row-cols-1 m-0">
                                    @foreach($avoires as $avoire)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $avoire->id }}">
                                                <div class="form-check form-switch">
                                                    {{ Form::checkbox('permission_u[]', $avoire->id, in_array($avoire->id, $rolePermissions) ? true : false, array('class' => 'form-check-input','id'=>'swithe'.$avoire->id)) }}
                                                    {{Str::after($avoire->name,"-")}}
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>







        <div class="row row-cols-5">


        </div>
        <div class="row row-cols-2 justify-content-between">
            <div class="col">
                <a href="{{ route('role.index') }}" class="btn btn-sm btn-info">Retour</a>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary btn-sm float-end">Modifier</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>


@endsection
