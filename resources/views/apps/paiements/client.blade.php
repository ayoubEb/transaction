@extends('layouts.master')
@section('content')
    <h5 class="mb-2">Liste des paiements du client</h5>
    <div class="card">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-bordered table-sm m-0">
                    <thead>
                        <tr>
                            <th>ICE.Cli</th>
                            <th>Name.Cli</th>
                            <th>e-mail.Cli</th>
                            <th>Montant HT</th>
                            <th>Montant TTC</th>
                            <th>Montant PAYER</th>
                            <th>Montant RESTE</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($client_paiements as $client_paiement)
                            <tr>
                                <td class="align-middle">{{ $client_paiement->ice }}</td>
                                <td class="align-middle">{{ $client_paiement->raison_sociale }}</td>
                                <td class="align-middle">{{ $client_paiement->email }}</td>
                                <td class="align-middle fw-bolder">{{ $client_paiement->sum_ht." DH" }}</td>
                                {{-- <td class="align-middle">{{ $client_paiement->sum_ttc }}</td> --}}
                                <td class="align-middle fw-bolder">
                                    {{$client_paiement->sum_ttc." DH" }}
                                </td>
                                <td class="align-middle fw-bolder text-success">
                                    {{$client_paiement->sum_payer." DH" }}
                                </td>
                                <td class="align-middle fw-bolder text-danger">
                                    {{$client_paiement->sum_reste." DH" }}
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('paycli.details', $client_paiement->cli) }}" class="btn btn-success py-0 px-1">
                                        <i class="mdi mdi-information-outline"></i>
                                    </a>
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