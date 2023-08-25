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
            <table class="table table-striped table-sm m-0">
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
                        <th class="table-success col-lg-2 col-4">catégorie</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($categories as $categorie)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $categorie->id }}" class="form-check-input" value="{{ $categorie->id }}">
                                    <label for="permi{{ $categorie->id }}" class="form-check-label">{{ Str::after($categorie->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">sous-catégorie</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($sous_categories as $sous)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $sous->id }}" class="form-check-input" value="{{ $sous->id }}">
                                    <label for="permi{{ $sous->id }}" class="form-check-label">{{ Str::after($sous->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">caractéristique</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($caracteristiques as $caracteristique)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $caracteristique->id }}" class="form-check-input" value="{{ $caracteristique->id }}">
                                    <label for="permi{{ $caracteristique->id }}" class="form-check-label">{{ Str::after($caracteristique->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">stock</th>
                        <td class="align-middle d-md-flex">

                            @foreach ($stocks as $stock)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $stock->id }}" class="form-check-input" value="{{ $stock->id }}">
                                    <label for="permi{{ $stock->id }}" class="form-check-label">{{ Str::after($stock->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach

                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4 align-middle">facture</th>
                        <td class="align-middle d-md-flex">
                                @foreach ($factures as $facture)

                                    <div class="form-check">
                                        <input type="checkbox" name="permission[]" id="permi{{ $facture->id }}" class="form-check-input" value="{{ $facture->id }}">
                                        <label for="permi{{ $facture->id }}" class="form-check-label">{{ Str::after($facture->name,'-') }}</label>
                                        <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                    </div>

                                @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">customize</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($customizes as $customize)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $customize->id }}" class="form-check-input" value="{{ $customize->id }}">
                                    <label for="permi{{ $customize->id }}" class="form-check-label">{{ Str::after($customize->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">groupe</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($groupes as $groupe)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $groupe->id }}" class="form-check-input" value="{{ $groupe->id }}">
                                    <label for="permi{{ $groupe->id }}" class="form-check-label">{{ Str::after($groupe->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">client</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($clients as $client)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $client->id }}" class="form-check-input" value="{{ $client->id }}">
                                    <label for="permi{{ $client->id }}" class="form-check-label">{{ Str::after($client->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">produit</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($produits as $produit)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $produit->id }}" class="form-check-input" value="{{ $produit->id }}">
                                    <label for="permi{{ $produit->id }}" class="form-check-label">{{ Str::after($produit->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">user</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($users as $user)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $user->id }}" class="form-check-input" value="{{ $user->id }}">
                                    <label for="permi{{ $user->id }}" class="form-check-label">{{ Str::after($user->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">role</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($roles as $role)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $role->id }}" class="form-check-input" value="{{ $role->id }}">
                                    <label for="permi{{ $role->id }}" class="form-check-label">{{ Str::after($role->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">entreprise</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($entreprises as $entreprise)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $entreprise->id }}" class="form-check-input" value="{{ $entreprise->id }}">
                                    <label for="permi{{ $entreprise->id }}" class="form-check-label">{{ Str::after($entreprise->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">transaction</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($transactions as $transaction)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $transaction->id }}" class="form-check-input" value="{{ $transaction->id }}">
                                    <label for="permi{{ $transaction->id }}" class="form-check-label">{{ Str::after($transaction->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">vente_semaine</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($vente_semaines as $vente_semaine)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $vente_semaine->id }}" class="form-check-input" value="{{ $vente_semaine->id }}">
                                    <label for="permi{{ $vente_semaine->id }}" class="form-check-label">{{ Str::after($vente_semaine->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">type_client</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($type_clients as $type_client)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $type_client->id }}" class="form-check-input" value="{{ $type_client->id }}">
                                    <label for="permi{{ $type_client->id }}" class="form-check-label">{{ Str::after($type_client->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">facture paiement</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($facture_paiements as $facture_paiement)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $facture_paiement->id }}" class="form-check-input" value="{{ $facture_paiement->id }}">
                                    <label for="permi{{ $facture_paiement->id }}" class="form-check-label">{{ Str::after($facture_paiement->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">stock historique</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($stock_historiques as $stock_historique)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $stock_historique->id }}" class="form-check-input" value="{{ $stock_historique->id }}">
                                    <label for="permi{{ $stock_historique->id }}" class="form-check-label">{{ Str::after($stock_historique->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th class="table-success col-lg-2 col-4">avoires</th>
                        <td class="align-middle d-md-flex">
                            @foreach ($avoires as $avoire)
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" id="permi{{ $avoire->id }}" class="form-check-input" value="{{ $avoire->id }}">
                                    <label for="permi{{ $avoire->id }}" class="form-check-label">{{ Str::after($avoire->name,'-') }}</label>
                                    <span class="fw-bolder text-primary">&nbsp;|&nbsp;&nbsp;</span>
                                </div>
                            @endforeach
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
