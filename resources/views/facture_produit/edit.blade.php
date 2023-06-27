@extends('layouts.master')
@section('content')
<div class="card">
   <div class="card-header">
        <div class="card-title mb-2 fs-5">
           Modifier produit du facture : {{ $edit_facture_pro->reference }}
        </div> 
        <div class="card-title-desc m-0">
            <ul class="list-unstyled m-0 d-flex">
                <li>
                   <a>
                        <i class="mdi mdi-home"></i>
                        Acceuil
                   </a>
                </li>
                <li class="mx-2">
                    <i class="mdi mdi-chevron-double-right"></i>
                </li>
                <li>
                    <a href="{{ route('facture.edit',$edit_facture_pro->facture->id) }}" >Modifier du facture : {{ $edit_facture_pro->facture->num_facture }}</a>
                </li>
                <li class="mx-2">
                    <i class="mdi mdi-chevron-double-right"></i>
                </li>
                <li>
                    <a href="{{ route('facture-produit.edit',$edit_facture_pro->id) }}" class="fw-bolder">Modifier produit du facture : {{ $edit_facture_pro->reference }}</a>
                </li>
            </ul>
        </div> 
    </div>
    <div class="card-body">
        <div class="row row-cols-4 mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label fw-normal">Nom du client</label>
                    <input type="text" name="" id="" value="{{ $edit_facture_pro->facture->client->rs ?? 'null' }}" class="form-control  text-black" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label fw-normal">Numero du facture</label>
                    <input type="text" name="" id="" value="{{ $edit_facture_pro->facture->num_facture ?? 'null' }}" class="form-control  text-black" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="" class="form-label fw-normal">Date du facture</label>
                    <input type="text" name="" id="" value="{{ $edit_facture_pro->facture->date_facture ?? 'null' }}" class="form-control  text-black" disabled>
                </div>
            </div>
            <div class="col">
               <div class="form-group">
                    <label for="" class="form-label fw-normal">Etat du facture</label>
                    <input type="text" name="" id="" value="{{ $edit_facture_pro->facture->statut ?? 'null' }}" class="form-control  text-black" disabled>
                </div>
            </div>
        </div>
        @if (Session::has('update'))
            <div class="alert alert-info mb-2" role="alert">
                </strong>{{ Session::get('update') }}<strong>
            </div>
        @endif
        <form action="{{ route('facture-produit.update',$edit_facture_pro->id) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row row-cols-2 row-cols-1 mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label fw-normal">Référence du produit</label>
                                <input type="text" name="reference" id="" class="form-control " value="{{ $edit_facture_pro->reference ?? 'null' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label fw-normal">Désignation du produit</label>
                                <input type="text" name="designation" id="" class="form-control " value="{{ $edit_facture_pro->designation ?? 'null' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-2 row-cols-1 mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label fw-normal">Quantite</label>
                                <input type="number" name="quantite" id="" class="form-control " value="{{ $edit_facture_pro->quantite }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label fw-normal">Prix unitaire</label>
                                <input type="text" name="prix_unitaire" id="" class="form-control " value="{{ $edit_facture_pro->prix_unitaire ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-2 row-cols-1 mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label fw-normal">remise</label>
                                <input type="text" name="remise" id="" class="form-control " value="{{ $edit_facture_pro->remise ?? '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="form-label fw-normal">Date du produit</label>
                                <input type="date" name="date" id="" class="form-control " value="<?php echo date_format($edit_facture_pro->created_at,"Y-m-d"); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm shadow-none btn-warning w-100 ">Modifier</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
   

@endsection