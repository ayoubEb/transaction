@extends('layouts.master')
@section('content')

@include('sweetalert::alert')
    <div class="row row-cols-3">
        <div class="col">
            <div class="card">
                <div class="card-header bg-success py-2px">
                    <h6 class="m-0 title text-uppercase">
                        facture
                    </h6>
                </div>
                <div class="card-body p-2">
                    <form action="{{ route('customize-facture.update',$facture) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Référence</label>
                            <input type="text" name="reference_facture" id="" class="form-control" value="{{ $facture->reference ?? '' }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Numéro</label>
                            <input type="number" name="numero_facture" id="" class="form-control" value="{{ $facture->numero ?? '' }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">tva</label>
                            <input type="number" name="tva" id="" class="form-control" min=0 max="100" step="any" value="{{ $facture->tva ?? '' }}">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success btn-sm px-3">
                                <span class="mdi mdi-checkbox-marked-circle-outline align-middle"></span>
                                <span>Modifier</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header bg-success py-2px">
                    <h6 class="m-0 title text-uppercase">
                        stock
                    </h6>
                </div>
                <div class="card-body p-2">
                    <form action="{{ route('customize-stock.update',$stock) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Référence</label>
                            <input type="text" name="reference_stock" id="" class="form-control" value="{{ $stock->reference ?? '' }}">
                        </div>
                        <div class="form-group mb-2">
                            <label for="" class="form-label">Numéro</label>
                            <input type="number" name="numero_stock" id="" class="form-control" value="{{ $stock->numero ?? '' }}">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success btn-sm px-3">
                                <span class="mdi mdi-checkbox-marked-circle-outline align-middle"></span>
                                <span>Modifier</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection