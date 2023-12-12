@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="Card-body p-2">
            <div class="table-responsive">
                <table class="table table-bordered table-sm m-0 datatable">
                    <thead>
                        <tr>
                            <th>référence</th>
                            <th>fournisseur</th>
                            <th>prix ttc</th>
                            <th>prix ht</th>
                            <th>payer</th>
                            <th>reste</th>
                            <th>état livraison</th>
                            <th>état paiement</th>
                            <th>statut</th>
                            <th>doc</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ligneAchats as $ligne)
                            <tr>
                                <td class="align-middle"> {{ $ligne->num_achat ?? '' }} </td>
                                <td class="align-middle"> {{ $ligne->fournisseur->raison_sociale ?? '' }} </td>
                                <td class="align-middle"> {{ $ligne->prix_ht ?? 0 }} Dh</td>
                                <td class="align-middle"> {{ $ligne->prix_ttc ?? 0 }} Dh</td>
                                <td class="align-middle"> {{ $ligne->payer ?? 0 }} Dh</td>
                                <td class="align-middle"> {{ $ligne->reste ?? 0 }} Dh</td>
                                <td class="align-middle"> {{ $ligne->etat_livraison ?? 0 }} Dh</td>
                                <td class="align-middle"> {{ $ligne->etat_paiement ?? 0 }} Dh</td>
                                <td class="align-middle"> {{ $ligne->statut ?? 0 }} Dh</td>
                                <td class="align-middle">
                                    <a class="btn py-0 px-1 border-0 btn-info shadow-none" href="{{ route('ligneAchat.bon',$ligne->id) }}">pdf</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection