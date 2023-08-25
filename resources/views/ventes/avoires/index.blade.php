@extends('layouts.master')
@section('title')
    Liste des avoires
    @endsection
    @section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-3">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Liste des avoires
        </li>
    </ol>
</nav>
    <div class="card">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-bordered table-sm m-0 datatable">
                    <thead class="table-success">
                        <tr>
                            <th>#id</th>
                            <th>référence</th>
                            <th>qte</th>
                            <th>qte actuel</th>
                            <th>qte reste</th>
                            <th>montant actuel</th>
                            <th>montant </th>
                            <th>montant ttc</th>
                            <th>montant reste</th>
                            <th>date</th>
                            <th>actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ligne_retours as $ligne_retour)
                        <tr>
                            <td class="align-middle"> {{ "#".$ligne_retour->id ?? '' }} </td>
                                <td class="align-middle"> {{ $ligne_retour->reference ?? 0 }} </td>
                                <td class="align-middle"> {{ $ligne_retour->total_qte ?? 0 }} </td>
                                <td class="align-middle"> {{ $ligne_retour->total_QteActuel ?? 0 }} </td>
                                <td class="align-middle"> {{ $ligne_retour->total_QteActuel - $ligne_retour->total_qte }} DH</td>
                                <td class="align-middle"> {{ $ligne_retour->montant_actuel ?? 0 }} DH </td>
                                <td class="align-middle"> {{ $ligne_retour->montant_ht ?? 0 }} DH </td>
                                <td class="align-middle"> {{ $ligne_retour->montant_ttc ?? 0 }} DH </td>
                                <td class="align-middle"> {{ $ligne_retour->montant_actuel - $ligne_retour->montant_ttc ?? 0 }} DH </td>
                                <td class="align-middle"> {{ ($ligne_retour->date_retour)  }} </td>
                                <td class="align-middle">
                                    <button type="button" class="btn p-0 bg-transparent border-0 text-warning" data-bs-toggle="modal" data-bs-target="#produitRetour{{ $ligne_retour->id }}">
                                        <i class="mdi mdi-information-outline" style="font-size: 0.90rem;"></i>
                                    </button>
                                    <a href="{{ route('ligneFacture.pdf',$ligne_retour) }}" class="btn p-0 bg-transparent border-0 text-warning">
                                        <i class="mdi mdi-file-outline" style="font-size: 0.90rem;"></i>
                                    </a>
                                    <a href="{{ route('ligneFactureRetour.show',$ligne_retour) }}" class="btn p-0 bg-transparent border-0 text-primary">
                                        <i class="mdi mdi-menu" style="font-size: 0.90rem;"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11">
                                    <h6 class="text-center text-danger m-0 fs-12 text-uppercase py-1">
                                        aucun liste des retour
                                    </h6>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @foreach ($ligne_retours as $ligne_retour)
        <div class="modal fade" id="produitRetour{{ $ligne_retour->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Les produits retour du ligne retour : {{ $ligne_retour->reference }}</h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm m-0">
                                <thead>
                                    <tr>
                                        <th>produit</th>
                                        <th>prix.pro</th>
                                        <th>qte actuel</th>
                                        <th>qte retour</th>
                                        <th>qte reste</th>
                                        <th>montant actuel</th>
                                        <th>montant retour</th>
                                        <th>montant reste</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ligne_retour->facture_retours as $retour)
                                        <tr>
                                            <td class="align-middle"> {{ $retour->facture_produit->produit->designation ?? '' }} </td>
                                            <td class="align-middle"> {{ $retour->facture_produit->produit->prix_vente ?? 0 }} DH</td>
                                            <td class="align-middle"> {{ $retour->qte_actuel ?? 0 }}</td>
                                            <td class="align-middle"> {{ $retour->qte_retour ?? 0 }}</td>
                                            <td class="align-middle"> {{ $retour->qte_actuel - $retour->qte_retour ?? 0 }}</td>
                                            <td class="align-middle"> {{ $retour->montant_actuel ?? 0 }} DH</td>
                                            <td class="align-middle"> {{ $retour->montant ?? 0 }} DH</td>
                                            <td class="align-middle"> {{ $retour->montant_actuel - $retour->montant ?? 0 }} DH</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @endsection