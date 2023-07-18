@extends('layouts.master')
@section('title')
<div class="d-none d-sm-block ms-2">
    <h4 class="page-title font-size-18">Liste des stocks</h4>
</div>
@endsection
@section('content')
@include('sweetalert::alert')
    <div class="card">
        <div class="card-body p-2">

            <div class="table-responsive">
                <table class="table table-bordered table-sm m-0">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-white col-3">référence</th>
                            <th class="text-white">code</th>
                            <th class="text-white">désignation</th>
                            <th class="text-white">Entré</th>
                            <th class="text-white">sortie</th>
                            <th class="text-white">Reste</th>
                            <th class="text-white">initial</th>
                            <th class="text-white">r.v</th>
                            <th class="text-white">r.a</th>
                            <th class="text-white">Reste</th>
                            <th class="text-white">actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($produits as $produit)
                            <tr >
                                <td class="align-middle" style="{{ $produit->stock ? "background:#9DDAC6;" : "background:#FFEADD;" }}">
                                    {{ $produit->reference ?? '' }}
                                </td>
                                <td class="align-middle">
                                    {{ $produit->code ?? '' }}
                                </td>
                                <td class="align-middle fs-12">
                                    {{ $produit->designation ?? '' }}
                                </td>
                                <td class="align-middle">
                                    {{ $produit->stock->entre ?? '' }}
                                </td>
                                <td class="align-middle">
                                    {{ $produit->stock->sortie ?? '' }}
                                </td>
                                <td class="align-middle">
                                    {{ $produit->stock->reste ?? '' }}
                                </td>
                                <td class="align-middle">
                                    {{ $produit->stock->initial ?? '' }}
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-success">
                                        {{ $produit->stock->reserverValider ?? 0 }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-danger">
                                        {{ $produit->stock->reserverAttente ?? 0 }}
                                    </span>
                                </td>
                                <td class="align-middle">
                                    {{ $produit->stock->reste ?? '' }}
                                </td>
                                <td class="align-middle">
                                    @if (!isset($produit->stock))
                                        @can('stock-create')
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#add{{ $produit->id }}">
                                                <i class="mdi mdi-plus-circle-outline" style="font-size: 0.90rem;"></i>
                                            </button>
                                        @endcan
                                    @else
                                        @can('stock-history-list')
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-success" data-bs-toggle="modal" data-bs-target="#history{{ $produit->id }}">
                                                <i class="mdi mdi-history" style="font-size: 0.90rem;"></i>
                                            </button>
                                        @endcan
                                        @can('stock-history-create')
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-success" data-bs-toggle="modal" data-bs-target="#new{{ $produit->id }}">
                                                <i class="mdi mdi-plus-thick" style="font-size: 0.90rem;"></i>
                                            </button>
                                        @endcan

                                        @can('stock-history-destroy')
                                            <button type="button" class="btn p-0 bg-transparent border-0 text-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $produit->id }}">
                                                <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                            </button>
                                        @endcan

                                        {{-- {{ isset($produit->stock) ? c$produit->stock : 0 }} --}}
                                    @endif
                                </td>
                            </tr>
                            {{-- <tr>
                                <td class="align-middle">{{ $stock->num }}</td>
                                <td class="align-middle">{{ $stock->produit->designation }}</td>
                                <td class="align-middle">{{ $stock->produit->quantite }}</td>
                                <td class="align-middle">{{ $stock->entre }}</td>
                                <td class="align-middle">{{ $stock->reste }}</td>
                                <td class="align-middle">{{ $stock->montant." DH" }}</td>
                                <td class="align-middle">{{ date('d/m/Y',strtotime($stock->date_stock)) }}</td>
                                <td class="align-middle">
                                    @can('categorie-edit')
                                        <button type="button" class="btn p-0 bg-transparent border-0 text-primary" data-bs-toggle="modal" data-bs-target="#edit{{ $stock->id }}">
                                            <i class="ti-pencil" style="font-size: 0.90rem;"></i>
                                        </button>
                                    @endcan


                                </td>
                            </tr> --}}
                        @empty

                        @endforelse
                    </tbody>

                </table>
            </div>
            <div class="d-flex justify-content-center mt-2">
                {{ $produits->links() }}
            </div>
        </div>
    </div>




        @foreach ($produits as $produit)
            <div class="modal fade" id="add{{$produit->id}}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header py-2">
                            <h6 class="modal-title m-0" id="varyingModalLabel">Ajouter une stock du produit : {{ $produit->reference ?? '' }}</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('stock.store') }}" method="POST">
                                @csrf
                                <div class="row row-cols-lg-2 row-cols-1">
                                    <div class="col mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label">Produit</label>
                                            <input type="hidden" name="produit" value="{{ $produit->id ?? '' }}">
                                            <input type="hidden" name="prix_achat" value="{{ $produit->prix_achat ?? '' }}">
                                            <input type="text" id="" class="form-control" readonly value="{{ $produit->reference ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label">Date movement</label>
                                            <input type="date" name="date" id="" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label">Entré</label>
                                            <input type="number" name="entre" id="" class="form-control" min="1">
                                        </div>
                                    </div>
                                    <div class="col mb-2">
                                        <div class="form-group">
                                            <label for="" class="form-label">Min</label>
                                            <input type="number" name="min" id="" class="form-control" min="1">
                                        </div>
                                    </div>
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

            <div class="modal fade" id="new{{$produit->id}}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header py-2">
                            <h6 class="modal-title m-0" id="varyingModalLabel">Ajouter une augmentation du stock du produit : {{ $produit->reference ?? '' }}</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('stockHistorique.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="stock_id" value="{{ $produit->stock->id ?? ''  }}">
                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Fonction</label>
                                    <select name="fonction" id="" class="form-select" required>
                                        <option value="">Augmentation / Diminution</option>
                                        <option value="augmentation"> Augmentation </option>
                                        <option value="diminution"> Diminution </option>
                                    </select>
                                </div>

                                <div class="form-group mb-2">
                                    <label for="" class="form-label">Quantite</label>
                                    <input type="number" name="quantite" id="" class="form-control" min="1" required>
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

            <div class="modal fade" id="history{{$produit->id}}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header py-2">
                            <h6 class="modal-title m-0" id="varyingModalLabel">Historique du stock</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm m-0">
                                    <thead>
                                        <tr>
                                            {{-- <th>fonction</th> --}}
                                            <th>quantité</th>
                                            <th>fonction</th>
                                            <th>date</th>
                                            <th>actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($produit->stock->history))
                                            @foreach ($produit->stock->history as $history)
                                                <tr>
                                                    {{-- <td class="align-middle"> {{ $history->fonction }} </td> --}}
                                                    <td class="align-middle"> {{ $history->quantite }} </td>
                                                    <td class="align-middle">
                                                        @if ($history->fonction == "qte_entre")
                                                        <span class="mdi mdi-arrow-left-thick text-warning"></span>
                                                        @elseif($history->fonction == "qte_sortie")
                                                            <span class="mdi mdi-arrow-right-thick text-warning"></span>
                                                        @elseif($history->fonction == "augmentation")
                                                        <span class="mdi mdi-arrow-up-thick text-success"></span>
                                                        @else
                                                        <span class="mdi mdi-arrow-down-thick text-danger"></span>
                                                        @endif
                                                    </td>
                                                    <td class="align-middle"> {{ $history->date_mouvement }} </td>
                                                    <td class="align-middle">
                                                        @if ($history->fonction == "augmentation" || $history->fonction == "diminution")
                                                            @can('stock-history-destroy')
                                                                <button type="button" class="btn p-0 bg-transparent border-0 text-danger {{ $history->fonction == "ajouter" ? 'd-none':'' }}" data-bs-toggle="modal" data-bs-target="#deleteHis{{ $history->id }}">
                                                                    <i class="ti-trash" style="font-size: 0.90rem;"></i>
                                                                </button>

                                                            @endcan
                                                        @endif
                                                    </td>
                                                </tr>


                                            @endforeach

                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="delete{{ $produit->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{ route('stock.destroy',$produit->stock->id ?? '') }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>

                                <h6 class="mb-2 fw-bolder text-center text-muted">
                                    Voulez-vous vraiment déplacer du stock vers la corbeille
                                </h6>
                                <div class="form-check">
                                    <input type="checkbox" name="force" id="del{{$produit->stock->id}}" class="form-check-input">
                                    <label for="del{{$produit->stock->id}}" class="form-check-label fw-bolder">Ignorer la corbeille et supprimer définitivement du stock</label>
                                </div>

                                <h6 class="text-danger mb-2 text-center">{{ $produit->stock->num ?? '' }}</h6>
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

            @if (isset($produit->stock->history))
                @foreach ($produit->stock->history as $history)

                    <div class="modal fade" id="deleteHis{{ $history->id }}" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <form action="{{ route('stockHistorique.destroy',$history ?? '') }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <input type="hidden" name="stock_id" value="{{ $produit->stock->id ?? '' }}">
                                        <input type="hidden" name="quantite_n" value="{{ $history->quantite ?? '' }}">
                                        <h3 class="text-primary mb-3 text-center">Confirmer la suppression</h3>
                                        <h6 class="mb-2 fw-bolder text-center text-muted">Voulez-vous supprimer défenitivement du mouvement</h6>
                                        <h6 class="text-danger mb-2 text-center">{{ $produit->stock->num ?? '' }}</h6>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary px-5 fw-bolder py-2 me-2">
                                                Je confirme
                                            </button>
                                            <button type="button" class="btn btn-light px-5 py-2 fw-bolder" data-bs-toggle="modal" data-bs-target="#history{{ $produit->id }}" style="background:#CEAD6D">
                                                Retour
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach


@endsection