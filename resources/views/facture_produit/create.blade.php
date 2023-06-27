@extends('layouts.master')
@section('content')
<!--<div class="layout-top-spacing">-->
<div class="card">
            <div class="card-header">
                <div class="card-title mb-2 fs-5">
                    Ajouter produits du facture : {{ $facture->num_facture }}
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
                            <a href="{{ route('facture-produit.index',$facture->id) }}" class="">Produit du facture : {{ $facture->num_facture }}</a>
                        </li>
                        <li class="mx-2">
                            <i class="mdi mdi-chevron-double-right"></i>
                        </li>
                        <li>
                            <a href="{{ route('facture-produit.create',$facture->id) }}" class="fw-bolder">Ajouter produits du facture : {{ $facture->num_facture }}</a>
                        </li>
                    </ul>
                </div> 
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                @endif
                <form action="{{ route('facture-produit.store',$facture) }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <button type="button" class="btn btn-primary btn-sm shadow-none mb-2" id="add_btn">
                            <span class="mdi mdi-plus fw-bolder"></span>
                        </button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Référence</th>
                                    <th>Désgnation</th>
                                    <th>Quantite</th>
                                    <th>Prix unitaire</th>
                                    <th>Remise</th>
                                    <th>Sup</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <button type="submit" class="btn btn-info btn-sm">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
@endsection

@section('add-produit')
<script>
  $(document).ready(function(){
  $('#add_btn').on('click',function(){
    var html="";
    html+='<tr>';
    html+='<td><input type="text" name="reference[]" id="" class="form-control form-control-sm"></td>';
    html+='<td><input type="text" name="designation[]" id="" class="form-control form-control-sm"></td>';
    html+='<td><input type="number" name="quantite[]" min="1" id="" class="form-control form-control-sm"></td>';
    html+='<td><input type="text" name="prix_unitaire[]" id="" class="form-control form-control-sm"></td>';
    html+='<td><input type="text" name="remise[]" id="" class="form-control form-control-sm"></td>';
    html+='<td><button type="button" class="btn btn-danger btn-sm " id="remove_btn"><span class="mdi mdi-trash-can fw-bolder"></span></button></td></td>';
    html+='</tr>';
    $('tbody').append(html);
  });
});
$(document).on('click','#remove_btn',function() {
$(this).closest('tr').remove();
})
</script>
@endsection
