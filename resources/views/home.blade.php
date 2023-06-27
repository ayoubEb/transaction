@extends('layouts.master')
@section('content')
    <div class="row row-cols-lg-4 row-cols-md-2 row-cols-1 mb-3">
        <div class="col">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row align-items-center">
                        <div class="col-lg-9">
                            <p class="mb-2">Total Produit</p>
                            <h5 class="m-0">{{ $count_produit }}</h5>
                        </div>
                        <div class="col-lg-3 avatar-sm">

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row align-items-center">
                        <div class="col-lg-9">
                            <p class="mb-2">Total Clients</p>
                            <h5 class="m-0">{{ $count_client }}</h5>
                        </div>
                        <div class="col-lg-3 avatar-sm">

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row align-items-center">
                        <div class="col-lg-9">
                            <p class="mb-2">Total Factures</p>
                            <h5 class="m-0">{{ $count_facture }}</h5>
                        </div>
                        <div class="col-lg-3 avatar-sm">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body p-2">
                    <h5 class="mb-3">Liste du clients</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm m-0">
                            <thead>
                                <tr>
                                    <th>Raison social</th>
                                    <th>ICE</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Code postal</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($clients as $client)
                                    <tr>
                                        <td class="align-middle">{{ $client->rs }}</td>
                                        <td class="align-middle">{{ $client->ice }}</td>
                                        <td class="align-middle">{{ $client->email }}</td>

                                        <td class="align-middle">{{ $client->telephone }}</td>
                                        <td class="align-middle">{{ $client->code_postal }}</td>
                                        <td class="align-middle">
                                            <span @class(["badge","bg-success"=>$client->statut=="activer","bg-danger"=>$client->statut=="desactiver"])>{{ $client->statut }}</span>
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
        <div class="col">
            <div class="card">
                <div class="card-body p-2">
                    <h5 class="mb-3">Liste du groupes</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm m-0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Remise (%)</th>
                                    <th>Staut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($groupes as $groupe)
                                    <tr>
                                        <td class="align-middle">{{ $groupe->nom }}</td>
                                        <td class="align-middle">{{ $groupe->remise }}</td>
                                        <td class="align-middle">
                                            <span @class(["badge","bg-success"=>$groupe->statut=="activer","bg-danger"=>$groupe->statut=="desactiver"])>{{ $groupe->statut }}</span>
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

    <div class="row row-cols-2 mb-2">
        <div class="col">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row mb-2">
                        <div class="col-lg-9">
                            <h5 class="m-0">Statistique du client par année</h5>
                        </div>
                        <div class="col">
                            <select name="client_year" id="" class="form-select form-select-sm client-year">
                                <option value="">Année actuel : {{ date("Y") }}</option>
                                @foreach ($year_client as $item)
                                    <option value="{{ $item->year }}">Année {{ $item->year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <canvas id="barChartClient"></canvas>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body p-2">
                    <div class="row mb-2">
                        <div class="col-lg-9">
                            <h5 class="m-0">Prix TTC par année</h5>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <canvas id="barTTC"></canvas>
                </div>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body p-2">
                <div class="row mb-2">
                    <div class="col-lg-9">
                        <h5 class="m-0">Liste du factures</h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm m-0">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Numéro</th>
                                <th>HT</th>
                                <th>TTC</th>
                                <th>TVA</th>
                                <th>Paiement</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($factures as $facture)
                                <tr>
                                    <td class="align-middle">{{ $facture->client->rs }}</td>
                                    <td class="align-middle">{{ $facture->num_facture }}</td>
                                    <td class="align-middle">{{ $facture->prix_ht }} DH</td>
                                    <td class="align-middle">{{ $facture->prix_ttc }} DH</td>
                                    <td class="align-middle">{{ $facture->taux_tva }} %</td>
                                    <td class="align-middle">
                                        <span @class(["badge","bg-success"=>$facture->paiement == "payé","bg-danger"=>$facture->paiement == "impayé"])>{{ $facture->paiement }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span @class(["badge","bg-success"=>$facture->statut == "valider","bg-danger"=>$facture->statut == "en cours"])>{{ $facture->statut }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<script>


// $(document).ready(function(){
//     $(document).on("change",".client-year",function(){
//         let year = $(this).val();
//         $.ajax({
//             type:"GET",
//             url:"{{ route('clientYear')}}",
//             data:{"year":year},
//             success:function(data){
//                 if(year!=""){
//                     $(function(){

//                         var barClient = $("#barChartClient");
//                         var barChart = new Chart(barClient,{
//                         type:'bar',
//                         data:{
//                             labels:['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','October','Novembre','December'],
//                             datasets:[
//                             {
//                             label:'Nombre client',
//                             data:data,
//                             backgroundColor:['#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838'],

//                             }]
//                         },
//                         options:{
//                             scales:{
//                             yAxes:[{
//                                 ticks:{
//                                 beginAtZero:true
//                                 }
//                             }]
//                             }
//                         }
//                         });
//                         })
//                     }
//                 else{
//                     $(function(){

//                         var count_client = <?php echo json_encode($ch_client); ?>;

//                         var barClient = $("#barChartClient");
//                         var barChart = new Chart(barClient,{
//                         type:'bar',
//                         data:{
//                             labels:['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','October','Novembre','December'],
//                             datasets:[
//                             {
//                             label:'Nombre client',
//                             data:count_client,
//                             backgroundColor:['#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838'],

//                             }]
//                         },
//                         options:{
//                             scales:{
//                             yAxes:[{
//                                 ticks:{
//                                 beginAtZero:true
//                                 }
//                             }]
//                             }
//                         }
//                         });
//                         })
//                 }
//             }
//         })
//     })
// })

//     $(function(){

//       var count_client = <?php echo json_encode($ch_client); ?>;

//       var barClient = $("#barChartClient");
//       var barChart = new Chart(barClient,{
//         type:'bar',
//         data:{
//            labels:['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','October','Novembre','December'],
//           datasets:[
//             {
//             label:'Nombre client',
//             data:count_client,
//             backgroundColor:['#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838'],

//           }]
//         },
//         options:{
//           scales:{
//             yAxes:[{
//               ticks:{
//                 beginAtZero:true
//               }
//             }]
//           }
//         }
//       });
//     })
//     $(function(){

//       var prix_ttc = <?php echo json_encode($ch_ttc); ?>;

//       var barttc = $("#barTTC");
//       var barChart = new Chart(barttc,{
//         type:'bar',
//         data:{
//            labels:['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','October','Novembre','December'],
//           datasets:[
//             {
//             label:'Montant TTC',
//             data:prix_ttc,
//             backgroundColor:['#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838','#c76838'],

//           }]
//         },
//         options:{
//           scales:{
//             yAxes:[{
//               ticks:{
//                 beginAtZero:true
//               }
//             }]
//           }
//         }
//       });
//     })



</script>
@endsection