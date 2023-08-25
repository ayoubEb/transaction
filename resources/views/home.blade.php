@extends('layouts.master')
@section('content')
<div class="row row-cols-lg-4 row-cols-md-2 row-cols-1" id="widget">
    <div class="col">
        <div class="card m-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="text-uppercase fs-12 m-0">clients</h6>
                    <a href="{{ route('client.index') }}" class="text-decoration-none text-uppercase fs-12 fw-bolder">voir plus</a>
                </div>
                <h1 class="text-center my-2 text-primary">
                    {{ $count_client ?? 0 }}
                </h1>
                <div class="d-flex justify-content-between">
                    <h6 class="m-0 fs-12 text-capitalize text-muted">total : {{ $count_client ?? 0 }}</h6>
                    <h6 class="m-0 fs-12 text-capitalize">aujourd'hui : {{ $count_client_today ?? 0 }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card m-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="text-uppercase fs-12 m-0">factures</h6>
                    <a href="{{ route('facture.index') }}" class="text-decoration-none text-uppercase fs-12 fw-bolder">voir plus</a>
                </div>
                <h1 class="text-center my-2 text-primary">
                    {{ $count_facture ?? 0 }}
                </h1>
                <div class="d-flex justify-content-between">
                    <h6 class="m-0 fs-12 text-capitalize text-muted">total : {{ $count_facture ?? 0 }}</h6>
                    <h6 class="m-0 fs-12 text-capitalize">aujourd'hui : {{ $count_facture_today ?? 0 }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card m-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="text-uppercase fs-12 m-0">produits</h6>
                    <a href="{{ route('produit.index') }}" class="text-decoration-none text-uppercase fs-12 fw-bolder">voir plus</a>
                </div>
                <h1 class="text-center my-2 text-primary">
                    {{ $count_produit ?? 0 }}
                </h1>
                <div class="d-flex justify-content-between">
                    <h6 class="m-0 fs-12 text-capitalize text-muted">total : {{ $count_produit ?? 0 }}</h6>
                    <h6 class="m-0 fs-12 text-capitalize">aujourd'hui : {{ $count_produit_today ?? 0 }}</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card m-0">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="text-uppercase fs-12 m-0">stocks</h6>
                    <a href="{{ route('stock.index') }}" class="text-decoration-none text-uppercase fs-12 fw-bolder">voir plus</a>
                </div>
                <h1 class="text-center my-2 text-primary">
                    {{ $count_stock ?? 0 }}
                </h1>
                <div class="d-flex justify-content-between">
                    <h6 class="m-0 fs-12 text-capitalize text-muted">total : {{ $count_stock ?? 0 }}</h6>
                    <h6 class="m-0 fs-12 text-capitalize">aujourd'hui : {{ $count_stock_today ?? 0 }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary py-2px">
                <h6 class="m-0 text-uppercase title text-white">
                    liste des transactions
                </h6>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table table-striped table-sm m-0">
                        <thead>
                            <tr>
                                <th>client</th>
                                <th>montant</th>
                                <th>date</th>
                                <th>remarque</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td class="align-middle"> {{ $transaction->client->raison_sociale ?? '' }} </td>
                                    <td class="align-middle"> {{ $transaction->montant ?? '' }} DH </td>
                                    <td class="align-middle"> {{ $transaction->date_transaction ?? '' }} </td>
                                    <td class="align-middle"> {{ $transaction->remarque ?? '' }} </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="align-middle" colspan="4">aucun transaction</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary py-2px">
                <h6 class="m-0 text-uppercase title text-white">transaction aujourd'hui</h6>
            </div>
            <div class="card-body p-2">
                <ul class="list-group">
                    @forelse ($transactions_today as $transaction_today)
                        <li class="list-group-item px-2 py-1">
                            <div class="row align-items-center">
                                <div class="col-lg-9">
                                    <h6 class="mb-2 text-primary">  {{ $transaction_today->client->raison_sociale ?? '' }} </h6>
                                    <p class="text-muted fs-12 fw-bolder mb-1">
                                        <span class="">Montant : </span>
                                        <span class="text-success fw-bolder"> {{ $transaction_today->montant }} DH</span>
                                    </p>
                                    <p class="text-muted fs-12 fw-bolder m-0">
                                        <span class="">Remarque : </span>
                                        <span class="fw-bolder"> {{ $transaction_today->remarque ?? '' }}</span>
                                    </p>

                                </div>
                                <div class="col">
                                    <p class="text-muted fs-12 m-0 text-center"> {{date("d/m/Y",strtotime($transaction_today->created_at))}} </p>
                                </div>
                            </div>
                        </li>
                    @empty

                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-success py-2px">
                <h6 class="m-0 text-uppercase title">
                    liste des stocks
                </h6>
            </div>
            <div class="card-body p-2">
                <div class="d-flex justify-content-center">
                    <ul class="list-group list-group-horizontal">

                        <li class="list-group-item text-success">
                            <span class="mdi mdi-arrow-left-thick text-center"></span>
                            <h6 class="m-0 d-inline"> {{$stocks->sum("entre")}} </h6>
                        </li>
                        <li class="list-group-item text-success">
                            <span class="mdi mdi-arrow-up-thick text-center"></span>
                            <h6 class="m-0 d-inline"> {{$stocks->sum("sortie")}} </h6>
                        </li>
                        <li class="list-group-item text-success">
                            <span class="mdi mdi-arrow-right-thick text-center"></span>
                            <h6 class="m-0 d-inline"> {{$stocks->sum("reste")}} </h6>
                        </li>



                    </ul>
                </div>


                <div class="table-responsive">
                    <table class="table table-striped table-sm m-0">
                        <thead>
                            <tr>
                                <th>référence</th>
                                <th>entre</th>
                                <th>reste</th>
                                <th>sortie</th>
                                <th>min</th>
                                <th>initial</th>
                                <th>r.v</th>
                                <th>r.a</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($stocks as $stock)
                                <tr>
                                    <td class="align-middle fs-12"> {{ $stock->produit->reference ?? '' }} </td>
                                    <td class="align-middle fs-12"> {{ $stock->entre ?? '' }} </td>
                                    <td class="align-middle fs-12"> {{ $stock->reste ?? '' }} </td>
                                    <td class="align-middle fs-12"> {{ $stock->sortie ?? '' }} </td>
                                    <td class="align-middle fs-12"> {{ $stock->min ?? '' }} </td>
                                    <td class="align-middle fs-12"> {{ $stock->initial ?? '' }} </td>
                                    <td class="align-middle fs-12"> {{ $stock->reserverValider ?? '' }} </td>
                                    <td class="align-middle fs-12"> {{ $stock->reserverAttente ?? '' }} </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header bg-success py-2px">
                <h6 class="m-0 title text-uppercase">
                    reservation du stock aujourd'hui
                </h6>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <div class="table table-sm m-0 table-striped table-sm">
                        <table class="table table-striped table-sm m-0">
                            <thead>
                                <tr>
                                    <th>num stock</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="card">
    <div class="card-header py-2px bg-success">
        <h6 class="m-0 title text-uppercase">liste des factures</h6>
    </div>
    <div class="card-body p-2">
        <div class="table-responsive">
            <table class="table table-bordered table-sm m-0">
                <thead>
                    <tr>
                        <th>client</th>
                        <th>numéro</th>
                        <th>ht</th>
                        <th>ttc</th>
                        <th>tva</th>
                        <th>remise</th>
                        <th>paiement</th>
                        <th>statut</th>
                        <th>payer</th>
                        <th>reste</th>
                        <th>date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($factures as $facture)
                        <tr>
                            <td class="align-middle">{{ $facture->client->raison_sociale ?? '' }} </td>
                            <td class="align-middle">{{ $facture->num_facture ?? '' }} </td>
                            <td class="align-middle">{{ $facture->prix_ht ?? '' }} </td>
                            <td class="align-middle">{{ $facture->prix_ttc ?? '' }} </td>
                            <td class="align-middle">{{ $facture->taux_tva ?? '' }} </td>
                            <td class="align-middle">{{ $facture->remise ?? '' }} </td>
                            <td class="align-middle">{{ $facture->etat_paiement ?? '' }} </td>
                            <td class="align-middle">{{ $facture->statut ?? '' }} </td>
                            <td class="align-middle">{{ $facture->payer ?? '' }} </td>
                            <td class="align-middle">{{ $facture->reste ?? '' }} </td>
                            <td class="align-middle">
                                @if (date("Y-m-d") == date("Y-m-d",strtotime($facture->date)))
                                     <span class="badge bg-danger fs-10 fw-bolder text-uppercase">aujourd'hui</span>
                                @else
                                    {{$facture->date}}
                                @endif
                            </td>
                        </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
