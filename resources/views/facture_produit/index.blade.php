@extends('layouts.master')
@section('content')
    @if (Session::has('success'))
      <div class="alert alert-success mb-2" role="alert">
        <strong>{{ Session::get('success') }}</strong>
      </div>

    @elseif (Session::has('delete'))
      <div class="alert alert-danger mb-2" role="alert">
        <strong>{{ Session::get('delete') }}</strong>
      </div>
    @endif

<div class="card">
    <div class="card-header">
        <div class="card-title mb-2 fs-5">
            Liste des produits du facture : {{ $facture->num_facture ?? '' }}
        </div>
        <div class="card-title-desc m-0">
            <ul class="list-unstyled d-flex m-0">
                <li>
                    <a href="{{ route('admin') }}">
                        <i class="mdi mdi-home"></i>
                        Acceuil
                    </a>
                </li>
                <li class="mx-2">
                    <i class="mdi mdi-chevron-double-right"></i>
                </li>
                <li>
                    <a href="{{ route('facture-produit.index',$facture->id ?? '') }}">
                        Liste des produits du facture : {{ $facture->num_facture ?? '' }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive ">
            <div class="row mb-2">
                <div class="col-lg-3">
                  <a href="{{ route('facture-produit.create',$facture->id) }}" class="btn btn-success text-center">
                    <span class="">Ajouter un produit</span>
                  </a>
                </div>
                <div class="col-lg-3">
                  <a href="{{ route('facture-pdf.show',$facture) }}" class="btn btn-info mb-2">
                    <span>View la facture du produits</span>
                  </a>
                </div>

            </div>
            <table class="table table-bordered table-sm mb-0" id="datatable">
                <thead class="table-success">
                    <tr>
                        <th>nom du client</th>
                        <th>num facture</th>
                        <th>reference</th>
                        <th>désignation</th>
                        <th>quantite</th>
                        <th>prix unitaire</th>
                        <th>Remise</th>
                        <th>Montant</th>
                        <th>date du commande</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($facture->facture_produit))
                        @foreach ($facture->facture_produit as $fp)
                            <tr>
                                <td>{{ $facture->client->rs ?? '' }}</td>
                                <td>{{ $facture->num_facture ?? '' }}</td>
                                <td>{{ $fp->reference ?? '' }}</td>
                                <td>{{ $fp->designation ?? '' }}</td>
                                <td>{{ $fp->quantite ?? '' }}</td>
                                <td>{{ $fp->prix_unitaire ?? '' }}</td>
                                <td>{{ $fp->remise ?? '' }}%</td>
                                <td class="align-middle">{{ $fp->montant ?? '0' }} DHS</td>
                                <td>{{  date('d-m-Y',strtotime($facture->created_at)) }}</td>
                                <td>
                                    <form action="{{ route('facture-produit.destroy',$fp->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="mdi mdi-trash-can"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('facture-produit.edit',$fp->id) }}" class="btn btn-info btn-sm">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection