@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between">
    <h5 class="m-0">Liste des paiements du facture</h5>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0 py-1 px-3" data-bs-toggle="modal" data-bs-target="#add">
        Ajouter
    </button>
</div>
<div class="card">
    <div class="card-body p-2">
        <div class="table-responsive">
            <table class="table table-bordered table-sm m-0">
                <thead class="bg-warning">
                    <tr>
                        <th>Facture</th>
                        <th>Montant total</th>
                        <th>Montant Payer</th>
                        <th>Montant Rester</th>
                        <th class="text-capitalize">état</th>
                        {{-- <th>Paiement</th> --}}
                        <th>Reglement</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @forelse ($facture_paiements as $facture_paiement)
                    <tr>
                        <td class="align-middle">{{ $facture_paiement->facture->num_facture }}</td>
                        <td class="align-middle fw-bolder">{{ $facture_paiement->total." DH" }}</td>
                        <td class="align-middle fw-bolder text-success">{{ $facture_paiement->payer." DH" }}</td>
                        <td class="align-middle fw-bolder text-danger">{{ $facture_paiement->reste." DH" }}</td>
                        <td class="align-middle">
                            <span @class([
                                "badge",
                                "bg-warning"=>$facture_paiement->facture->statut =="en cours",
                                "bg-success"=>$facture_paiement->facture->statut =="payer",
                            ])>
                            {{ $facture_paiement->facture->statut }}
                            </span>
                        </td>
                        {{-- <td class="align-middle">
                            @if ($facture_paiement->reste == 0)
                                <button type="button" class="btn btn-sm btn-success text-uppercase fw-bolder" style="font-size:x-small">payer</button>
                            @else
                                <form action="{{ route('facture.payer',$facture_paiement->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger text-uppercase fw-bolder" style="font-size:x-small">
                                        payer
                                    </button>
                                </form>
                            @endif
                        </td> --}}
                        <td class="align-middle">
                            @if (isset($facture_paiement->reglements) && $facture_paiement->reste == 0)
                                <button type="button" class="btn btn-success py-0 px-1" data-bs-toggle="modal" data-bs-target="#add-reglement{{ $facture_paiement->id }}">
                                    <span class="mdi mdi-plus-circle-outline"></span>
                                </button>
                            @elseif (isset($facture_paiement->reglements) && $facture_paiement->reste != 0)
                                <button type="button" class="btn btn-success py-0 px-1" data-bs-toggle="modal" data-bs-target="#add-reglement{{ $facture_paiement->id }}">
                                    <span class="mdi mdi-plus-circle-outline"></span>
                                </button>
                                <button type="button" class="btn btn-success py-0 px-1" data-bs-toggle="modal" data-bs-target="#history{{ $facture_paiement->id }}">
                                    <span class="mdi mdi-history"></span>
                                </button>
                            @else
                                <button type="button" class="btn btn-success py-0 px-1" data-bs-toggle="modal" data-bs-target="#history{{ $facture_paiement->id }}">
                                    <span class="mdi mdi-history"></span>
                                </button>
                            @endif
                        </td>
                        <td class="align-middle">
                            <button type="button" class="btn btn-danger py-0 px-1" data-bs-toggle="modal" data-bs-target="#delete{{ $facture_paiement->id }}">
                                <span class="mdi mdi-trash-can"></span>
                            </button>
                        </td>
                    </tr>
                @empty

                @endforelse
            </table>

        </div>
    </div>
</div>

@foreach ($facture_paiements as $facture_paiement)

    <div class="modal fade" id="add-reglement{{ $facture_paiement->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title m-0" id="varyingModalLabel">Ajouter une paiement</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('facture-reglement.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Montant Total</label>
                            <input type="number" name="" class="form-control form-control-sm" readonly step="any" value="{{ $facture_paiement->total }}">
                        </div>
                        <input type="hidden" name="facture_paiement" value="{{ $facture_paiement->id }}">
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Type du paiement</label>
                            <select name="type" id="type" class="form-select form-select-sm">
                                <option value="">Choisir le type du paiement</option>
                                <option value="espèce" {{ old('type') == 'espèce' ? "selected" : "" }}>Espèce</option>
                                <option value="chèque" {{ old('type') == 'chèque' ? "selected" : "" }}>Chèque</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Montant Reste</label>
                            <input type="number" name="" id="reste" class="form-control form-control-sm" readonly step="any" value="{{ $facture_paiement->reglements->min("montant_reste") }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Montant payer</label>
                            <input type="number" name="payer" id="payer" max="{{ $facture_paiement->total }}" disabled min="1" step="any" class="form-control form-control-sm">
                        </div>

                        <div class="form-group mb-2">
                            <label for="" class="form-label">Montant Reste Nouveau</label>
                            <input type="number" name="reste" id="resteN" class="form-control form-control-sm" readonly step="any" value="">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="mdi mdi-checkbox-marked-circle-outline align-middle"></i>
                                <span>Enregistrer</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="history{{ $facture_paiement->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title m-0" id="varyingModalLabel">Historique du paiement</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card m-0 bg-light mb-2">
                                <div class="card-body p-2">
                                    <h6 class="m-0 text-uppercase text-center">
                                        total : {{ $facture_paiement->total." dh" }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm m-0">
                            <thead class="bg-warning">
                                <tr>
                                    <th>Type du paiement</th>
                                    <th>Montant payer</th>
                                    <th>Montant reste</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facture_paiement->reglements as $reglement)
                                    <tr>
                                        <td class="align-middle">{{ $reglement->type_paiement }}</td>
                                        <td class="align-middle fw-bolder text-success">{{ $reglement->montant_payer." DH" }}</td>
                                        <td class="align-middle fw-bolder text-danger">{{ $reglement->montant_reste." DH" }}</td>
                                        <td class="align-middle fw-bolder">{{ date("d-m-Y",strtotime($reglement->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="delete{{ $facture_paiement->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <form action="{{ route('facture-paiement.destroy',$facture_paiement) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <div class="p-3 mb-3">
                            <h5 class="mb-2 fw-bolder text-center">Voulez-vous supprimer défenitivement la paiement</h5>
                            <h6 class="text-danger text-center fw-bolder w-100">{{ $facture_paiement->ice }}</h6>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-success p-3 w-100" style="border-radius:0;border-bottom-left-radius: 0.375rem;" data-bs-dismiss="modal" aria-label="btn-close">
                                Fermer
                            </button>
                            <button type="submit" class="btn btn-danger p-3 w-100 fw-bolder fs-6" style="border-radius:0;border-bottom-right-radius: 0.375rem;" >
                                Supprimer
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
            $(document).on("change","#type",function(){
                let type = $(this).val();
                if(type == ""){
                    $("#payer").attr("disabled",true);
                }
                else{
                    $("#payer").attr("disabled",false);

                }
            })
            $(document).on("keyup","#payer",function(){
                let reste = $("#reste").val();
                let payer = $("#payer").val();
                let resu = parseFloat(reste - payer);
                $("#resteN").val(resu);
            })
        })
    </script>
@endsection