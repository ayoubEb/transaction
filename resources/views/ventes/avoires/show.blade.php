@extends('layouts.master')
@section('title')
informaiton d'avoire : {{ $ligne->reference ?? '' }}
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-1">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Acceuil</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">
            <a href="{{route('facture.index')}}">
                Liste des factures
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            informaiton d'avoire : {{ $ligne->reference ?? '' }}
        </li>
    </ol>
</nav>
@include('sweetalert::alert')
<div class="card">
    <div class="card-body p-2">
        <div class="row">
            <div class="col-lg-5">
                <ul class="list-group mb-2">
                    <li class="list-group-item py-2 active">
                        <h6 class="m-0 text-uppercase fs-12 text-center">
                            avoire
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">référence</span>
                            <span class="float-end fw-normal"> {{ $ligne->reference ?? '' }} </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">date</span>
                            <span class="float-end fw-normal"> {{  date("d / m / Y",strtotime($ligne->date_retour)) }} </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">montant actuel</span>
                            <span class="float-end fw-normal"> {{  $ligne->montant_actuel ?? 0 }} DH</span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">montant ht</span>
                            <span class="float-end fw-normal"> {{  $ligne->montant_ht ?? 0 }} DH</span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">montant ttc</span>
                            <span class="float-end fw-normal"> {{  $ligne->montant_ttc ?? 0 }} DH</span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">quantité retour</span>
                            <span class="float-end fw-normal"> {{  $ligne->total_qte ?? 0 }}</span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h4 class="m-0 text-uppercase text-danger text-center">
                            {{  $ligne->montant_ttc ?? 0 }} dh
                        </h4>
                    </li>
                </ul>
                <ul class="list-group mb-2">
                    <li class="list-group-item py-2 active">
                        <h6 class="m-0 text-uppercase fs-12 text-center">
                            facture
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">référence</span>
                            <span class="float-end fw-normal"> {{ $ligne->facture->num_facture ?? '' }} </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">montant ht</span>
                            <span class="float-end fw-normal"> {{ $ligne->facture->prix_ht ?? 0 }} dh </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">montant ttc</span>
                            <span class="float-end fw-normal"> {{ $ligne->facture->prix_ttc ?? 0 }} dh </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12 text-success">
                            <span class="float-start">montant payer</span>
                            <span class="float-end"> {{ $ligne->facture->payer ?? 0 }} dh </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12 text-danger">
                            <span class="float-start">montant reste</span>
                            <span class="float-end"> {{ $ligne->facture->reste ?? 0 }} dh </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">date</span>
                            <span class="float-end fw-normal"> {{  date("d / m / Y",strtotime($ligne->facture->date)) }} </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h4 class="m-0 text-uppercase text-secondary text-center">
                            {{  $ligne->facture->prix_ttc ?? 0 }} dh
                        </h4>

                    </li>
                </ul>
                <ul class="list-group mb-2">
                    <li class="list-group-item py-2 active">
                        <h6 class="m-0 text-uppercase fs-12 text-center">
                            client
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">raison sociale</span>
                            <span class="float-end fw-normal"> {{ $ligne->facture->client->raison_sociale ?? '' }} </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">ice</span>
                            <span class="float-end fw-normal"> {{ $ligne->facture->client->ice ?? '' }} </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">adresse</span>
                            <span class="float-end fw-normal"> {{ $ligne->facture->client->adresse ?? '' }} , {{ $ligne->facture->client->code_postal ?? '' }} </span>
                        </h6>
                    </li>
                    <li class="list-group-item py-2">
                        <h6 class="m-0 text-uppercase fs-12">
                            <span class="float-start">ville</span>
                            <span class="float-end fw-normal"> {{ $ligne->facture->client->ville ?? '' }} </span>
                        </h6>
                    </li>
                </ul>
            </div>
            <div class="col">
                <h6 class="text-center fs-12 text-uppercase border border-top-0 border-start-0 border-end-0 border-2 border-solid border-primary py-2">
                    les produits retours
                </h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm m-0">
                        <thead class="table-success">
                            <tr>
                                <th>produit</th>
                                <th>q.actuel</th>
                                <th>q.retour</th>
                                <th>q.reste</th>
                                <th>montant</th>
                                <th>m.actuel</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ligne->facture_retours as $retour)
                                <tr>
                                    <td class="align-middle"> {{ $retour->facture_produit->produit->designation ?? ''}} </td>
                                    <td class="align-middle"> {{ $retour->qte_actuel ?? 0}} </td>
                                    <td class="align-middle"> {{ $retour->qte_retour ?? 0}} </td>
                                    <td class="align-middle"> {{ $retour->qte_actuel - $retour->qte_retour }} </td>
                                    <td class="align-middle"> {{ $retour->montant ?? 0}} DH</td>
                                    <td class="align-middle"> {{ $retour->montant_actuel ?? 0}} DH</td>
                                    <td class="align-middle">
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $retour->id }}">
                                            <i class="mdi mdi-pencil-outline" style="font-size: 0.90rem;"></i>
                                        </button>
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-warning" data-bs-toggle="modal" data-bs-target="#delete{{ $retour->id }}">
                                            <i class="mdi mdi-trash-can" style="font-size: 0.90rem;"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    @foreach ($ligne->facture_retours as $facture_retour)
        <div class="modal fade" id="edit{{ $retour->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header py-2 bg-primary">
                        <h6 class="modal-title m-0 text-white" id="varyingModalLabel">Modifier le retour du produit {{ $facture_retour->facture_produit->produit->designation ?? '' }} </h6>
                        <button type="button" class="btn btn-transparent p-0 text-white border-0" data-bs-dismiss="modal" aria-label="btn-close">
                            <span class="mdi mdi-close-thick"></span>
                        </button>
                    </div>
                    <div class="modal-body p-2">
                        <form action="{{ route('factureRetour.update',$facture_retour) }}" method="post">
                            @csrf
                            @method("PUT")
                            <ul class="list-group">
                                <div class="row row-cols-2">
                                    <div class="col mb-2">
                                        <li class="list-group-item bg-light p-2px rounded d-flex justify-content-between text-uppercase">
                                            <h6 class="m-0 fs-12">produit :</h6>
                                            <h6 class="m-0 fs-12 fw-normal"> {{ $facture_retour->facture_produit->produit->designation ?? '' }} </h6>
                                        </li>
                                    </div>
                                    <div class="col mb-2">
                                        <li class="list-group-item bg-light p-2px rounded d-flex justify-content-between text-uppercase">
                                            <h6 class="m-0 fs-12">prix produit :</h6>
                                            <h6 class="m-0 fs-12 fw-normal"> {{ $facture_retour->facture_produit->produit->prix_vente ?? 0 }} dh</h6>
                                        </li>
                                    </div>
                                    <div class="col mb-2">
                                        <li class="list-group-item bg-light p-2px rounded d-flex justify-content-between text-uppercase">
                                            <h6 class="m-0 fs-12">quantité actuel :</h6>
                                            <h6 class="m-0 fs-12 fw-normal"> {{ $facture_retour->qte_actuel ?? '' }} </h6>
                                        </li>
                                    </div>
                                    <div class="col mb-2">
                                        <li class="list-group-item bg-light p-2px rounded d-flex justify-content-between text-uppercase">
                                            <input type="hidden" class="retour" value="{{ $facture_retour->qte_retour ?? '' }}">
                                            <h6 class="m-0 fs-12">quantité retour :</h6>
                                            <h6 class="m-0 fs-12 fw-normal">
                                                <span class="badge bg-primary">
                                                    {{ $facture_retour->qte_retour ?? '' }}
                                                </span>
                                                &nbsp;|&nbsp;
                                                <span class="badge bg-dark"></span>
                                            </h6>
                                        </li>
                                    </div>
                                    <div class="col mb-2">
                                        <li class="list-group-item bg-light p-2px rounded d-flex justify-content-between text-uppercase">
                                            <input type="hidden" class="reste" value="{{ $facture_retour->qte_actuel - $facture_retour->qte_retour }}">
                                            <h6 class="m-0 fs-12">quantité reste :</h6>
                                            <h6 class="m-0 fs-12 fw-normal">
                                                <span class="badge bg-primary">
                                                    {{ $facture_retour->qte_actuel - $facture_retour->qte_retour }}
                                                </span>
                                                &nbsp;|&nbsp;
                                                <span class="badge bg-dark"></span>
                                            </h6>
                                        </li>
                                    </div>
                                </div>

                            </ul>

                            <div class="row row-cols-2">
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">Nouveau quantité retour</label>
                                        <input type="hidden" name="qte_retour" class="qteRetour" value="{{ $facture_retour->qte_retour }}">
                                        <input type="hidden" class="price" value="{{ $facture_retour->facture_produit->produit->prix_vente ?? 0 }}">
                                        <input type="number" name="qte" id="" class="form-control qte" min="0" max="{{ $facture_retour->qte_retour }}">

                                    </div>
                                </div>
                                <div class="col mb-2">
                                    <div class="form-group">
                                        <label for="" class="form-label">montant</label>
                                        <input type="number" name="montant" id="" class="form-control montant" min="0" step="any">
                                    </div>
                                </div>
                            </div>
                            <button type="submit">save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete{{ $facture_retour->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('factureRetour.destroy',$facture_retour->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>

                            <h6 class="mb-2 fw-bolder text-center text-muted">
                                Voulez-vous vraiment déplacer du facture vers la corbeille
                            </h6>

                            <h6 class="text-danger mb-2 text-center">{{ $facture_retour->facture_produit->produit->reference }}</h6>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary px-5 fw-bolder py-2 me-2">
                                    Je confirme
                                </button>
                                <button type="button" class="btn btn-light px-5 py-2 fw-bolder" data-bs-dismiss="modal" aria-label="btn-close" style="background:#CEAD6D">
                                    Annuler
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(".qte").on("keyup",function(e){
                let nbr = parseInt($(e.target).val());
                let price = $(e.target).parent().parent().parent().children("div").children("div").children(".price").val();
                $(e.target).parent().parent().parent().children("div").children("div").children(".montant").val(nbr * price);
                let retour= $(e.target).parent().parent().parent().parent().children("ul").children("div").children("div:nth-child(4)").children("li").children(".retour").val();
                let reste = parseInt($(e.target).parent().parent().parent().parent().children("ul").children("div").children("div:nth-child(5)").children("li").children(".reste").val());
                $(e.target).parent().parent().parent().parent().children("ul").children("div").children("div:nth-child(4)").children("li").children("h6").children("span:nth-child(2)").html(retour - nbr);
                $(e.target).parent().parent().parent().parent().children("ul").children("div").children("div:nth-child(5)").children("li").children("h6").children("span:nth-child(2)").html(reste + nbr);
            })
        })
    </script>
@endsection