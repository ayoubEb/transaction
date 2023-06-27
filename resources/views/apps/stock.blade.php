@extends('layouts.master')
@section('content')
    <div class="d-flex justify-content-between">
        <h5 class="m-0">Liste des stocks</h5>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add">
            <span class="mdi mdi-plus-circle-outline align-middle"></span>
            <span>Ajouter</span>
        </button>
    </div>
    <div class="card">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-bordered table-sm m-0">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantite</th>
                            <th>Type</th>
                            <th>Entré</th>
                            <th>Reste</th>
                            <th>Montant</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stocks as $stock)
                            <tr>
                                <td class="alig-middle">{{ $stock->produit->designation }}</td>
                                <td class="alig-middle">{{ $stock->produit->quantite }}</td>
                                <td class="alig-middle">{{ $stock->type }}</td>
                                <td class="alig-middle">{{ $stock->entre }}</td>
                                <td class="alig-middle">{{ $stock->reste }}</td>
                                <td class="alig-middle">{{ $stock->montant." DH" }}</td>
                                <td class="alig-middle">{{ date('d/m/Y',strtotime($stock->date_stock)) }}</td>
                            </tr>
                        @empty

                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h6 class="modal-title m-0" id="varyingModalLabel">Ajouter une stock</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('stock.store') }}" method="POST">
                        @csrf
                        <div class="row row-cols-lg-2 row-cols-1">
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Produit</label>
                                    <select name="produit" id="" class="form-select form-select-sm">
                                        <option value="">Choisir le produit</option>
                                        @foreach ($produits as $produit)
                                            <option value="{{ $produit->id }}">{{ $produit->designation }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Type</label>
                                    <select name="type" id="" class="form-select form-select-sm">
                                        <option value="">Choisir le type</option>
                                        <option value="entrie" >Entrie</option>
                                        <option value="sortie">Sortie</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Date movement</label>
                                    <input type="date" name="date" id="" class="form-control form-control-sm" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <div class="col mb-2">
                                <div class="form-group">
                                    <label for="" class="form-label">Quantité</label>
                                    <input type="number" name="quantite" id="" class="form-control form-control-sm" min="1">
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
@endsection