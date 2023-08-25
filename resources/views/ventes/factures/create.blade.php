@extends('layouts.master')
@section('title')
    Ajouter de facture
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
            ajouter une facture
        </li>
    </ol>
</nav>

<form action="{{ route('facture.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-success">
                    <h6 class="m-0 text-uppercase title">information général</h6>
                </div>
                <div class="card-body p-2">
                    <div class="row row-cols-2">

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Client</label>
                                <select name="client_id" id="client" class="form-select">
                                    <option value="">Choisir le client</option>
                                    @forelse ($clients as $client)
                                        <option value="{{$client->id}}">{{ $client->raison_sociale }}</option>
                                    @empty
                                        <option value="">Aucun client exsite</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Group</label>
                                <input type="text" id="NGroup" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Remise</label>
                                <input type="number" name="remise_facture" id="RGroup" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Statut</label>
                                <input type="text" name="statut" id="" class="form-control" readonly value="en cours">
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control @error('date') is-invalid @enderror">
                                @error('date')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Entreprise</label>
                                <select name="entreprise_id" id="" class="form-select @error('entreprise_id') is-invalid @enderror">
                                    <option value="">Séléctionner l'entreprise</option>
                                    @foreach ($entreprises as $entreprise)
                                        <option value="{{ $entreprise->id }}"  @if(count($entreprises)==1) selected @endif>{{ $entreprise->raison_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                    </div>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-success">
                    <h6 class="m-0 text-uppercase title">paiement</h6>
                </div>
                <div class="card-body p-2">

                    <div class="form-group mb-2">
                        <label for="" class="form-label">TVA</label>
                        <input type="number" name="tva" id="tva" min="0" max="100" class="form-control" readonly value="{{ $tva }}">
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item py-2px d-flex justify-content-between text-uppercase">
                            <h6 class="m-0 fs-12">total</h6>
                            <h6 class="m-0 fs-12">0 dh</h6>
                            <input type="hidden" name="total" id="total" value="">
                        </li>
                        <li class="list-group-item py-2px d-flex justify-content-between text-uppercase">
                            <h6 class="m-0 fs-12">ttc</h6>
                            <h6 class="m-0 fs-12 text-success">0 dh</h6>
                            <input type="hidden" name="ttc" id="ttc" value="">
                        </li>
                        <li class="list-group-item py-2px d-flex justify-content-between text-uppercase">
                            <h6 class="m-0 fs-12">reste</h6>
                            <h6 class="m-0 fs-12 text-danger">0 dh</h6>
                            <input type="hidden" name="reste" id="reste" value="">
                        </li>
                        <li class="list-group-item py-2px d-flex justify-content-between text-uppercase">
                            <h6 class="m-0 fs-12">nombre des produits</h6>
                            <h6 class="m-0 fs-12">0</h6>
                        </li>
                    </ul>


                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success">
            <h6 class="m-0 text-uppercase title">Ajouter des produits</h6>
        </div>
        <div class="card-body p-2" style="height: 30rem;  overflow-y: auto;">
            <div class="table-responsive">
                <table class="table table-sm table-bordered m-0">
                    <thead class="table-success">
                        <tr>

                            <th class="col-2">référence</th>
                            <th>nom</th>
                            <th class="col-1">prix</th>
                            <th class="col-1">quantité</th>
                            <th class="col-1">remise</th>
                            <th class="col-2">montant</th>
                            <th class="col-1">reste du stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                            <tr>
                                <td class="align-middle">
                                    <div class="form-check fs-12">
                                        <input type="checkbox" name="pro[]" id="p{{$produit->id}}" class="form-check-input pro" value="{{ $produit->id }}" {{  $produit->stock->reste ?? 'disabled' }}>
                                        <label for="p{{$produit->id}}" class="form-check-label">{{ $produit->reference }}</label>
                                    </div>
                                </td>
                                <td class="align-middle fs-12">{{ $produit->designation }}</td>
                                <td class="align-middle">
                                    {{ $produit->prix_vente}} DH
                                    <input type="hidden" name="prix[]" class="price" value="{{ $produit->prix_vente }}">
                                </td>
                                <td class="align-middle">
                                    <input type="number" name="quantite[]" step="any" min="1"  id="" max="{{ $produit->stock->reste ?? '' }}" class="form-control form-control-sm qte" disabled>
                                </td>
                                <td class="align-middle">
                                    <input type="number" name="remise[]" step="any"  id="" class="form-control form-control-sm remise" disabled>
                                </td>
                                <td class="align-middle">
                                    <input type="number" name="montant[]" step="any"  id="" class="form-control form-control-sm montant" readonly disabled>
                                </td>
                                <td class="align-middle">
                                    <h6 class="m-0 {{ $produit->stock->reste ?? 'text-danger' }}">{{ $produit->stock->reste ?? 'Aucun stock' }}</h6>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <button type="submit" class="btn btn-dark btn-sm" id="save">
            Enregistrer
        </button>
    </div>
</form>
<style>
    /* #nouveau{
        display: none;
    } */
</style>
@endsection
 @section('script')
 <script>

  $(document).ready(function(){


    $(document).on("change","#client",function(){


        let id = $(this).val();
        let out = "";
            $.ajax({
                type:"GET",
                url:"{{ route('clientGroup') }}",
                data:{"id":id},
                success:function(data){
                    $("#NGroup").val(data.nom);
                    $("#RGroup").val(data.remise);

                    let tva = $("#tva").val();

                    let count_pro = $(".pro:checked").length;
                    let sum = 0;

                    $(".montant").each(function(){
                        sum += +$(this).val();
                    });
                    let remise_facture = data.remise;
                    let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);

                    $("li:nth-child(1) h6:nth-child(2)").html(parseFloat(sum).toFixed(2) + " dh");
                    $("li:nth-child(2) h6:nth-child(2)").html(ttc + " dh");
                    $("li:nth-child(3) h6:nth-child(2)").html(ttc + " dh");
                    $("li:nth-child(4) h6:nth-child(2)").html(count_pro);
                    $("#total").val(sum);
                    $("#ttc").val(ttc);
                    $("#reste").val(ttc);

                }
            })
    })

    $("#type").on("change",function(){
        let type = $(this).val();
        if(type == "chèque"){
            $("#cheque").show(450);
        }
        else{
            $("#cheque").hide(450);

        }
    })


    $(document).on("change","#group",function(){
        let id = $(this).val();
        $.ajax({
            type:"GET",
            url:"{{ route('getGroup') }}",
            data:{"id":id},
            success:function(data){
                $("#remise").val(data.remise);
                let remise = $("#remise").val(data.remise);
                let remise_val = $("#remise").val();
                let ttc = $("#ttc").val();
                let resu = parseFloat(ttc * (1 - (remise_val / 100))).toFixed(2);
                console.log(resu);
                $("#ttc").val(resu);

            }
        })

    })


    $(document).on("change",".pro",function(e){
        if($(this).is(':checked')){
            let count_pro = $(".pro:checked").length;
            let sum = 0;
            $(e.target).parent().parent().parent().children('td').children(".qte").prop("disabled",false);
            $(e.target).parent().parent().parent().css("background-color","#57C5B6");
            $(e.target).parent().parent().parent().children('td').children(".montant").prop("disabled",false);
            $(e.target).parent().parent().parent().children('td').children(".remise").prop("disabled",false);
            $(e.target).parent().parent().parent().children('td').children(".qte").val(1);
            $(e.target).parent().parent().parent().children('td').children(".remise").val(0);
            let qte = $(e.target).parent().parent().parent().children('td').children(".qte").val();
            let price = $(e.target).parent().parent().parent().children('td').children(".price").val();
            let remise = $(e.target).parent().parent().parent().children('td').children(".remise").val();
            let montant = parseFloat(qte * price).toFixed(2);
            let tva = $("#tva").val();
            let remise_facture = $("#RGroup").val();
            let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);

            if(remise == 0)
            {
                $(e.target).parent().parent().parent().children('td').children(".montant").val(montant);
                $(".montant").each(function(){
                    sum += +$(this).val();
                })
                let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("li:nth-child(1) h6:nth-child(2)").html(parseFloat(sum).toFixed(2) + " dh");
                $("li:nth-child(2) h6:nth-child(2)").html(ttc + " dh");
                $("li:nth-child(3) h6:nth-child(2)").html(ttc + " dh");
                $("li:nth-child(4) h6:nth-child(2)").html(count_pro);
                $("#total").val(sum);
                $("#ttc").val(ttc);
                $("#reste").val(ttc);
            }
            else
            {
                $(e.target).parent().parent().parent().children('td').children(".montant").val(montantRemise);
                $(".montant").each(function(){
                    sum += +$(this).val();
                })
                let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("li:nth-child(1) h6:nth-child(2)").html(parseFloat(sum).toFixed(2) + " dh");
                $("li:nth-child(2) h6:nth-child(2)").html(ttc + " dh");
                $("li:nth-child(3) h6:nth-child(2)").html(ttc + " dh");
                $("li:nth-child(4) h6:nth-child(2)").html(count_pro);
                $("#total").val(sum);
                $("#ttc").val(ttc);
                $("#reste").val(ttc);
            }

        }
        else
        {
            $(e.target).parent().parent().parent().children('td').children(".qte").prop("disabled",true);
            $(e.target).parent().parent().parent().children('td').children(".remise").prop("disabled",true);
            $(e.target).parent().parent().parent().children('td').children(".montant").prop("disabled",true);
            $(e.target).parent().parent().parent().css("background-color","transparent");
            $(e.target).parent().parent().parent().children('td').children(".montant").val();
            $(e.target).parent().parent().parent().children('td').children(".qte").val(0);
            let count_pro = $(".pro:checked").length;
            let sum = 0;
            let qte = $(e.target).parent().parent().parent().children('td').children(".qte").val();
            let price = $(e.target).parent().parent().parent().children('td').children(".price").val();
            let remise = $(e.target).parent().parent().parent().children('td').children(".remise").val();
            let montant = parseFloat(qte * price).toFixed(2);
            let tva = $("#tva").val();
            let remise_facture = $("#RGroup").val();
            let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
            if(remise == 0)
            {
                $(e.target).parent().parent().parent().children('td').children(".montant").val(montant);
                $(".montant").each(function(){
                    sum += +$(this).val();
                })
                let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("li:nth-child(1) h6:nth-child(2)").html(parseFloat(sum).toFixed(2) + " dh");
                $("li:nth-child(2) h6:nth-child(2)").html(ttc + " dh");
                $("li:nth-child(3) h6:nth-child(2)").html(ttc + " dh");
                $("li:nth-child(4) h6:nth-child(2)").html(count_pro);
                $("#total").val(sum);
                $("#ttc").val(ttc);
                $("#reste").val(ttc);
            }
            else
            {
                $(e.target).parent().parent().parent().children('td').children(".montant").val(montantRemise);
                $(".montant").each(function(){
                    sum += +$(this).val();
                })
                let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
                $("li:nth-child(1) h6:nth-child(2)").html(parseFloat(sum).toFixed(2) + " dh");
                $("li:nth-child(2) h6:nth-child(2)").html(ttc + " dh");
                $("li:nth-child(3) h6:nth-child(2)").html(ttc + " dh");
                $("li:nth-child(4) h6:nth-child(2)").html(count_pro);
                $("#total").val(sum);
                $("#ttc").val(ttc);
                $("#reste").val(ttc);
            }
        }
    })


    $(".qte").on("keyup",function(e){
        let qte = $(e.target).val();
        let count_pro = $(".pro:checked").length;
        let price = $(e.target).parent().parent().children("td").children(".price").val();
        let remise = $(e.target).parent().parent().children("td").children(".remise").val();
        let montant = parseFloat(qte * price).toFixed(2);
        let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
        let sum = 0;
        let remise_facture = $("#RGroup").val();
        let tva = $("#tva").val();
        if(remise == 0){
            $(e.target).parent().parent().children("td").children(".montant").val(montant);
            $(".montant").each(function(){
                sum += +$(this).val();
            });
            let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
            $("li:nth-child(1) h6:nth-child(2)").html(parseFloat(sum).toFixed(2) + " dh");
            $("li:nth-child(2) h6:nth-child(2)").html(ttc + " dh");
            $("li:nth-child(3) h6:nth-child(2)").html(ttc + " dh");
            $("li:nth-child(4) h6:nth-child(2)").html(count_pro);
            $("#total").val(sum);
            $("#ttc").val(ttc);
            $("#reste").val(ttc);
        }
        else{
            $(e.target).parent().parent().children("td").children(".montant").val(montantRemise);
            $(".montant").each(function(){
                sum += +$(this).val();
            });
            let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
            $("li:nth-child(1) h6:nth-child(2)").html(parseFloat(sum).toFixed(2) + " dh");
            $("li:nth-child(2) h6:nth-child(2)").html(ttc + " dh");
            $("li:nth-child(3) h6:nth-child(2)").html(ttc + " dh");
            $("li:nth-child(4) h6:nth-child(2)").html(count_pro);
            $("#total").val(sum);
            $("#ttc").val(ttc);
            $("#reste").val(ttc);
        }
    })



    $(".remise").on("keyup",function(e){
        let remise = $(e.target).val();
        let count_pro = $(".pro:checked").length;
        let price = $(e.target).parent().parent().children("td").children(".price").val();
        let qte = $(e.target).parent().parent().children("td").children(".qte").val();
        let montant = parseFloat(qte * price).toFixed(2);
        let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
        let sum = 0;
        let remise_facture = $("#RGroup").val();
        let tva = $("#tva").val();
        if(remise == 0){
            $(e.target).parent().parent().children("td").children(".montant").val(montant);
            $(".montant").each(function(){
                sum += +$(this).val();
            });
            let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
            $("li:nth-child(1) h6:nth-child(2)").html(parseFloat(sum).toFixed(2) + " dh");
            $("li:nth-child(2) h6:nth-child(2)").html(ttc + " dh");
            $("li:nth-child(3) h6:nth-child(2)").html(ttc + " dh");
            $("li:nth-child(4) h6:nth-child(2)").html(count_pro);
            $("#total").val(sum);
            $("#ttc").val(ttc);
            $("#reste").val(ttc);
        }
        else{
            $(e.target).parent().parent().children("td").children(".montant").val(montantRemise);
            $(".montant").each(function(){
                sum += +$(this).val();
            });
            let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);
            $("li:nth-child(1) h6:nth-child(2)").html(parseFloat(sum).toFixed(2) + " dh");
            $("li:nth-child(2) h6:nth-child(2)").html(ttc + " dh");
            $("li:nth-child(3) h6:nth-child(2)").html(ttc + " dh");
            $("li:nth-child(4) h6:nth-child(2)").html(count_pro);
            $("#total").val(sum);
            $("#ttc").val(ttc);
            $("#reste").val(ttc);
        }
    })


    $("#tva").on("keyup",function(){
        let tva = $(this).val();

        let count_pro = $(".pro:checked").length;
        let sum = 0;

        $(".montant").each(function(){
            sum += +$(this).val();
        });
        let remise_facture = $("#RGroup").val();
        let ttc = parseFloat((sum  + (sum * (tva/100))) * (1 - (remise_facture/100))).toFixed(2);

        $("li:nth-child(1) h6:nth-child(2)").html(parseFloat(sum).toFixed(2) + " dh");
        $("li:nth-child(2) h6:nth-child(2)").html(ttc + " dh");
        $("li:nth-child(3) h6:nth-child(2)").html(ttc + " dh");
        $("li:nth-child(4) h6:nth-child(2)").html(count_pro);
        $("#total").val(sum);
        $("#ttc").val(ttc);
        $("#reste").val(ttc);

    })

  });




  </script>
 @endsection