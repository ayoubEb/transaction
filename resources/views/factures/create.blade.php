@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between mb-2">
    <h5 class="m-0">Ajouter un facture</h5>
    <ol class="breadcrumb m-0 py-2">
        <li class="text-white fw-bolder">
            <a href="{{ route('home') }}" class="text-white">
                Acceuil
            </a>
        </li>
        @can('facture-list')
            <li class="text-white mx-2 fw-bolder">
                <span class="ti ti-angle-right" style="font-size:0.60rem"></span>
            </li>
            <li class="text-white fw-bolder">
                <a href="{{ route('facture.index') }}" class="text-white">
                    Liste des factures
                </a>
            </li>
        @endcan
        @can('facture-create')
            <li class="text-white mx-2 fw-bolder">
                <span class="ti ti-angle-right" style="font-size:0.60rem"></span>
            </li>
            <li class="text-white fw-bolder">
                <a href="{{ route('facture.create') }}" class="text-white">
                    Ajouter du facture
                </a>
            </li>
        @endcan
    </ol>
</div>

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

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">TVA</label>
                                <input type="number" name="tva" id="tva" min="0" max="100" class="form-control @error('tva') is-invalid @enderror">
                                @error('tva')
                                    <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col mb-2">
                            <div class="form-group">
                                <label for="" class="form-label">Type paiement</label>
                                <select name="type" id="" class="form-select">
                                    <option value="">Choisir le type du paiement</option>
                                    <option value="espèce">Espèce</option>
                                    <option value="chèque">Chèque</option>
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
                        <label for="" class="form-label">Montant HT</label>
                        <input type="number" name="total" id="total" class="form-control" readonly step="any" min="0">
                    </div>

                    <div class="form-group mb-2">
                        <label for="" class="form-label">Payer</label>
                        <input type="number" name="payer" id="payer" class="form-control" step="any" min="0">
                    </div>


                    <div class="form-group mb-2">
                        <label for="" class="form-label">Reste</label>
                        <input type="number" name="reste" id="reste" min="1" class="form-control" readonly>
                    </div>


                    <div class="form-group mb-2">
                        <label for="" class="form-label">Montant TTC</label>
                        <input type="number" name="ttc" id="ttc" class="form-control" readonly step="any" min="0">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success">
            <h6 class="m-0 text-uppercase title">Ajouter des produits</h6>
        </div>
        <div class="card-body p-2">
            <div class="row row-cols-4 mb-2" id="product">
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h6 class="m-0 text-center text-uppercase">Article : 1</h6>
                        </div>
                        <div class="card-body p-2">
                            <div class="form-group mb-2">
                                <input type="text" name="reference[]" id="" class="form-control form-control-sm reference" required placeholder="Référence">
                                <div class="filter"></div>
                            </div>
                            <div class="form-group mb-2">
                                <input type="text" name="designation[]" id="" class="form-control form-control-sm designation" required placeholder="Désignation">
                            </div>
                            <div class="form-group mb-2">
                                <input type="number" name="prix_unitaire[]" id="" min="1" class="form-control form-control-sm prix-unitaire" step="any" value="0" required placeholder="Prix vente">
                            </div>
                            <div class="form-group mb-2">
                                <input type="number" name="quantite[]" id="" min="1" class="form-control form-control-sm quantite" value="0" required min="1" placeholder="Quantite">
                            </div>
                            <div class="form-group mb-2">
                                <input type="number" name="montant[]" id="" min="1" class="form-control form-control-sm montant" step="any" value="0" required readonly  placeholder="Montant">
                            </div>
                            <div class="input-group input-group-sm mb-2">
                                <input type="text" name="remise[]" class="form-control remise" placeholder="Remise" value="0" aria-describedby="basic-addon1">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <button type="button" class="btn btn-dark btn-sm" id="add_btn">
                    {{-- <span class="mdi mdi-plus fw-bolder"></span> --}}
                    Ajouter autre produit
                </button>

            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-dark btn-sm">
        Enregistrer
    </button>
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



    let i = 1;

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

                }
            })
    })

    $(document).on("change",".select-produit",function(e){
        let reference = $(this).val();
        let quantite = $(e.target).parent().parent().parent().parent().parent().children("div").children(".quantite").val(1);
        let quantite_val = quantite.val();

        $.ajax({
            type:"GET",
            url:"{{ route('getProduit') }}",
            data:{"ref":reference},
            success:function(data){
                $(e.target).parent().parent().parent().parent().parent().children("div").children(".designation").val(data.designation);
                $(e.target).parent().parent().parent().parent().parent().children("div").children(".prix-unitaire").val(data.prix_vente);
                let montant = parseFloat(data.prix_vente * quantite_val).toFixed(2);
                $(e.target).parent().parent().parent().parent().parent().children("div").children(".montant").val(montant);
            }
        })
        $('.filter').addClass('d-none');

    })

    $(document).on("keyup",".quantite",function(e){
        let sum = 0;
        let quantite = $(e.target).val();
        let tva = $("#tva").val();
        let ht = parseFloat($("#total").val()).toFixed(2);
        let remise = $(e.target).parent().parent().children("div").children(".remise").val();
        let price = $(e.target).parent().parent().children("div").children(".prix-unitaire").val()
        let montant = parseFloat(quantite * price);
        let montantRemise = parseFloat((quantite * price) * ( 1 - (remise/100))).toFixed(2);


        let remise_facture = $("#RGroup").val();


        if(remise == 0 || remise == '')
        {
            $(e.target).parent().parent().children("div").children(".montant").val(montant)
            $(".montant").each(function(){
                sum += +$(this).val();
            });

            let ttc = parseFloat((sum * (1 - ( tva/100))) * (1 - (remise_facture/100))).toFixed(2);
            $("#ttc").val(ttc);
            $("#total").val(ttc);
            $("#payer").attr("max",ttc);
            $("#reste").val(ttc);


        }
        else
        {
            $(e.target).parent().parent().children("div").children(".montant").val(montantRemise)
            $(".montant").each(function(){
                sum += +$(this).val();
            });
            let ttc = parseFloat((sum * (1 - ( tva/100))) * (1 - (remise_facture/100))).toFixed(2);
            $("#ttc").val(ttc);
            $("#total").val(ttc);
            $("#payer").attr("max",ttc);
            $("#reste").val(ttc);
        }




    })


    $(document).on("keyup",".prix-unitaire",function(e){
        let sum = 0;
        let price = $(e.target).val();
        let remise = $(e.target).parent().parent().children("div").children(".remise").val();
        let quantite = $(e.target).parent().parent().children("div").children(".quantite").val()
        let montant = parseFloat(price * quantite);
        let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);


        let remise_facture = $("#RGroup").val();


        if(remise == 0 || remise == '')
        {
            $(e.target).parent().parent().children("div").children(".montant").val(montant)
            $(".montant").each(function(){
                sum += +$(this).val();
            });

            let ttc = parseFloat((sum * (1 - ( tva/100))) * (1 - (remise_facture/100))).toFixed(2);
            $("#ttc").val(ttc);
            $("#total").val(ttc);
            $("#payer").attr("max",ttc);
            $("#reste").val(ttc);


        }
        else
        {
            $(e.target).parent().parent().children("div").children(".montant").val(montantRemise)
            $(".montant").each(function(){
                sum += +$(this).val();
            });
            let ttc = parseFloat((sum * (1 - ( tva/100))) * (1 - (remise_facture/100))).toFixed(2);
            $("#ttc").val(ttc);
            $("#total").val(ttc);
            $("#payer").attr("max",ttc);
            $("#reste").val(ttc);
        }
    })



    $(document).on("keyup","#payer",function(){

        let payer = $(this).val();
        let ttc = $("#ttc").val();
        let resu = 0;
        resu = parseFloat(ttc - payer).toFixed(2);
        if(payer == "" || payer == 0){
            $("#reste").val(ttc);
        }
        else{
            $("#reste").val(resu);
        }


    })


    // remise des produits
    $(document).on("keyup",".remise",function(e){
        let sum = 0;
        let sum_remise = 0;
        let quantite = $(e.target).parent().parent().children("div").children(".quantite").val();
        let remise = $(e.target).val();
        let price = $(e.target).parent().parent().children("div").children(".prix-unitaire").val()
        let montant = parseFloat(quantite * price);
        let montantRemise = parseFloat(montant * ( 1 - (remise/100))).toFixed(2);
        $(e.target).parent().parent().children("div").children(".montant").val(montant)
        $(".montant").each(function(){
            sum += +$(this).val();
        });
        if(remise == 0){
            $("#total").val(sum);
            $("#ttc").val(montant);
        }
        else{
            $(e.target).parent().parent().children("div").children(".montant").val(montantRemise)
            $(".montant").each(function(){
                sum_remise += +$(this).val();
            });
            $("#total").val(sum);
            $("#ttc").val(sum_remise);
        }
    })

    $(document).on("keyup",".reference",function(e){
        let reference = $(this).val();
        if(reference != ''){
            $.ajax({
                type:"GET",
                url:"{{ route('facture.create') }}",
                data:{"ref":reference},
                success:function(data){
                    if(reference != ''){
                        $(e.target).parent().children(".filter").html(data);
                        console.log($(".refer").val());
                    }
                    else{
                        $(e.target).parent().children(".filter").html("aucun produit")
                    }
                }
            })
        }
        else{
            $(e.target).parent().parent().children("div").children(".designation").val("");
            $(e.target).parent().parent().children("div").children(".quantite").val("");
            $(e.target).parent().parent().children("div").children(".prix-unitaire").val("");
            $(e.target).parent().parent().children("div").children(".montant").val("");
            $(e.target).parent().parent().children("div").children(".remise").val("");
        }
    })


    $(document).on("keyup","#tva",function(){
        let ht = $("#total").val();
        let tva = $(this).val();
        let remise_facture = $("#RGroup").val();
        let ttc = parseFloat(ht * (1 - ( tva/100))).toFixed(2);
        let ttc_remise = parseFloat(ttc * (1 - (remise_facture/100))).toFixed(2);
        if(remise_facture != 0 || remise_facture != ''){
            $("#ttc").val(ttc_remise);
            $("#reste").val(ttc_remise);
        }
        else{
            $("#ttc").val(ttc);
            $("#reste").val(ttc);

        }
    })

    $('#add_btn').on('click',function(){
        i++;
        var html="";
        html+='<div class="col">';
                html+='<div class="card">';
                    html+='<div class="card-header bg-warning">';
                        html+='<h6 class="m-0 text-center text-uppercase">Article : '+i+'</h6>';
                    html+='</div>';
                    html+='<div class="card-body p-2">';
                        html+='<div class="form-group mb-2">';
                            html+='<input type="text" name="reference[]" id="" class="form-control form-control-sm reference" required placeholder="Référence">';
                            html+='<div class="filter"></div>';
                        html+='</div>';
                        html+='<div class="form-group mb-2">';
                            html+='<input type="text" name="designation[]" id="" class="form-control form-control-sm designation" required placeholder="Désignation">';
                        html+='</div>';
                        html+='<div class="form-group mb-2">';
                            html+='<input type="number" name="prix_unitaire[]" id="" min="1" class="form-control form-control-sm prix-unitaire" step="any" required placeholder="Prix vente">';
                        html+='</div>';
                        html+='<div class="form-group mb-2">';
                            html+='<input type="number" name="quantite[]" id="" min="1" class="form-control form-control-sm quantite" required min="1" placeholder="Quantite">';
                        html+='</div>';
                        html+='<div class="form-group mb-2">';
                            html+='<input type="number" name="montant[]" id="" min="1" class="form-control form-control-sm montant" step="any" required readonly placeholder="Montant">';
                        html+='</div>';
                        html+='<div class="input-group input-group-sm mb-2">';
                            html+='<input type="text" name="remise[]" class="form-control remise" placeholder="Remise" value="0" aria-describedby="basic-addon1">';
                            html+='<div class="input-group-prepend">';
                                html+='<span class="input-group-text" id="basic-addon1">%</span>';
                            html+='</div>';
                        html+='</div>';
                        html+='<div class="form-group mb-2">';
                            html+='<button type="button" class="btn btn-danger btn-sm w-100" id="remove_btn"><span class="mdi mdi-trash-can fw-bolder"></span></button>';
                        html+='</div>';
                    html+='</div>';
                html+='</div>';
            html+='</div>';
      $('#product').append(html);
    });

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


    $("#client").on("change",function(){
        let cli = $(this).val();
        if(cli == "autre" || cli == ""){
            $("#nouveau").show(450);
        }
        else{
            $("#nouveau").hide(450);

        }
    })
  });
  $(document).on('click','#remove_btn',function() {
  $(this).closest('.col').remove();
  })



  </script>
 @endsection