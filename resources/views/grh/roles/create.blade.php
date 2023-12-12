@extends('layouts.master')
@section('title')
    Ajouter une autorisation
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">
            <a href="{{route('role.index')}}">
                Liste des autorisation
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Ajouter une autorisation
        </li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
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
        {!! Form::open(array('route' => 'role.store','method'=>'POST')) !!}

        <div class="table-responsive">
            <table class="table table-bordered table-sm m-0">
                <tbody>
                    <tr>
                        <th class="table-warning align-middle text-center">
                            permission
                        </th>
                        <td class="align-middle">
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" class="bg-warning py-3">
                            <h5 class="m-0 text-uppercase text-center text-white">catalogue</h5>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">catégorie</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($categories as $categorie)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $categorie->id }}">

                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $categorie->id }}" class="form-check-input" value="{{ $categorie->id }}">
                                                    {{ Str::after($categorie->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">sous catégorie</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($sous_categories as $sous)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $sous->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $sous->id }}" class="form-check-input" value="{{ $sous->id }}">
                                                    {{ Str::after($sous->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">caractéristique</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($caracteristiques as $caracteristique)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $caracteristique->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="permi{{ $caracteristique->id }}" class="form-check-input" value="{{ $caracteristique->id }}">
                                                    {{ Str::after($caracteristique->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">sous catégorie</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($sous_categories as $sous)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $sous->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="permi{{ $sous->id }}" class="form-check-input" value="{{ $sous->id }}">
                                                    {{ Str::after($sous->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">stock</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($stocks as $stock)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $stock->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $stock->id }}" class="form-check-input" value="{{ $stock->id }}">
                                                    {{ Str::after($stock->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">stock historique</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($stock_historiques as $stock_historique)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $stock_historique->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="permi{{ $stock_historique->id }}" class="form-check-input" value="{{ $stock_historique->id }}">
                                                    {{ Str::after($stock_historique->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">produit</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($produits as $produit)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $produit->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="permi{{ $produit->id }}" class="form-check-input" value="{{ $produit->id }}">
                                                    {{ Str::after($produit->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th colspan="2" class="bg-warning py-3">
                            <h5 class="m-0 text-uppercase text-center text-white">paramètre</h5>
                        </th>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">groupe</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($groupes as $groupe)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $groupe->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $groupe->id }}" class="form-check-input" value="{{ $groupe->id }}">
                                                    {{ Str::after($groupe->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">entreprise</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($entreprises as $entreprise)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $entreprise->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $entreprise->id }}" class="form-check-input" value="{{ $entreprise->id }}">
                                                    {{ Str::after($entreprise->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">type client</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($type_clients as $type_client)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $type_client->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="switche{{ $type_client->id }}" class="form-check-input" value="{{ $type_client->id }}">
                                                    {{ Str::after($type_client->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th colspan="2" class="bg-warning py-3">
                            <h5 class="m-0 text-uppercase text-center text-white">crm</h5>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">client</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($clients as $client)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $client->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $client->id }}" class="form-check-input" value="{{ $client->id }}">
                                                    {{ Str::after($client->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">fournisseur</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($fournisseurs as $fournisseur)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $fournisseur->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $fournisseur->id }}" class="form-check-input" value="{{ $fournisseur->id }}">
                                                    {{ Str::after($fournisseur->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th colspan="2" class="bg-warning py-3">
                            <h5 class="m-0 text-uppercase text-center text-white">grh</h5>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">utilisateurs</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($users as $user)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $user->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $user->id }}" class="form-check-input" value="{{ $user->id }}">
                                                    {{ Str::after($user->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">autorisation</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($roles as $role)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $role->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $role->id }}" class="form-check-input" value="{{ $role->id }}">
                                                    {{ Str::after($role->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th colspan="2" class="bg-warning py-3">
                            <h5 class="m-0 text-uppercase text-center text-white">ventes</h5>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">facture</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($factures as $facture)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $facture->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $facture->id }}" class="form-check-input" value="{{ $facture->id }}">
                                                    {{ Str::after($facture->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">avoire</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($avoires as $avoire)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $avoire->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $avoire->id }}" class="form-check-input" value="{{ $avoire->id }}">
                                                    {{ Str::after($avoire->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">facture paiement</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($facture_paiements as $facture_paiement)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $facture_paiement->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $facture_paiement->id }}" class="form-check-input" value="{{ $facture_paiement->id }}">
                                                    {{ Str::after($facture_paiement->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>

                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">vente semaines</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($vente_semaines as $vente_semaine)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $vente_semaine->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $vente_semaine->id }}" class="form-check-input" value="{{ $vente_semaine->id }}">
                                                    {{ Str::after($vente_semaine->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>




                    <tr>
                        <th colspan="2" class="bg-warning py-3">
                            <h5 class="m-0 text-uppercase text-center text-white">achats</h5>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">ligne achats</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($ligne_achats as $ligne_achat)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $ligne_achat->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $ligne_achat->id }}" class="form-check-input" value="{{ $ligne_achat->id }}">
                                                    {{ Str::after($ligne_achat->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">achat paiement</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($achat_paiements as $achat_paiement)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $achat_paiement->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $achat_paiement->id }}" class="form-check-input" value="{{ $achat_paiement->id }}">
                                                    {{ Str::after($achat_paiement->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" class="bg-warning py-3">
                            <h5 class="m-0 text-uppercase text-center text-white">autre</h5>
                        </th>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">customize</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($customizes as $customize)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $customize->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $customize->id }}" class="form-check-input" value="{{ $customize->id }}">
                                                    {{ Str::after($customize->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">transaction</th>
                        <td class="align-middle">
                            <ul class="list-group">
                                <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 m-0">
                                    @foreach ($transactions as $transaction)
                                        <div class="col mb-lg-0 mb-2">
                                            <label class="list-group-item py-1 d-flex justify-content-center m-0" style="cursor: pointer;" for="swithe{{ $transaction->id }}">
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permission[]" id="swithe{{ $transaction->id }}" class="form-check-input" value="{{ $transaction->id }}">
                                                    {{ Str::after($transaction->name,'-') }}
                                                </div>
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            </ul>

                        </td>
                    </tr>




                </tbody>
            </table>
        </div>
        <div class="row row-cols-2">
            <div class="col">
                <a href="{{ route('role.index') }}" class="btn btn-sm btn-info">Retour</a>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-sm btn-primary float-end">Enregistrer</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>






@endsection
