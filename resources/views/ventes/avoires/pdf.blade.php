<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
        *{
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        body{
            padding: 3%;
        }
        header{
        width: 95%;
        }
        header .text-left{
            width: 40%;
            float: left;
            margin: auto;
        }
        header .text-left p{
            border-bottom: 2px double black
        }
        header .text-left p span{

            text-transform: uppercase;
            font-weight: bolder;
        }
        header .text-left p span:first-child(){
        font-size: 25px;

        }
        header .text-left p span:last-child(){
        font-size: 14px;

        }
        header .text-left h2{

            text-transform: uppercase;
            display: inline;
        }
        header .text-left h6{

            display: inline;
            text-transform: uppercase
        }


        header .text-right{
            float: right;
            width: 40%;

        }


        article{

            width: 30%;
            margin: 5rem auto

        }
        article hr{
            margin: 5px 0px
        }
        article img{
            width: 8rem;
            margin-left: 15%;
            margin-bottom: 20px;
            text-align: center;
        }

        article h4{
            text-transform: uppercase;
            text-align: center;
            font-size: 14px
        }

        .client{
         margin: 10px
        }
        .client p{
            font-weight: bolder;
            font-size: 14px;
            margin-bottom: 5px
        }
        .client p:nth-child(2),
        .client p:nth-child(3),
        .client p:nth-child(4){
            font-weight: bolder;
            font-size: 14px;
            text-transform: uppercase
        }

        section{
            clear: both;
        }
        section .produits .table{
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }
        section .produits .table thead{
            background: transparent;

        }
        section .produits .table thead th{

            font-size: xx-small ;
            padding: 7px 0px;
            text-align: center;
            border: 1px solid black;

            text-transform: uppercase;
        }

        section .produits .table tbody td{
            /* font-variant-caps: all-small-caps; */
            font-size: xx-small ;
            /* font-size: 14px: */
            padding: 7px 0px;
            text-align: center;
            border: 1px solid black;
        }
        section .produits .table tfoot tr th{

            border: 1px solid black;
            /* font-size: xx-small ; */

        }

        section .produits .table tfoot tr:first-child() th{
            padding-left: 5px;
            text-align: left;
        }
        section .produits .table tfoot tr:first-child() th > *{
            letter-spacing: .3px
        }

        section .produits .table tfoot tr:first-child() th h5:nth-child(1){

            margin-bottom: 10px;
        }
        section .produits .table tfoot tr:first-child() th h5:nth-child(2){

            text-transform: uppercase
        }
        section .produits .table tfoot tr:nth-child(1) th:nth-child(2),
        section .produits .table tfoot tr:nth-child(1) th:nth-child(3),
        section .produits .table tfoot tr:nth-child(2) th,
        section .produits .table tfoot tr:nth-child(3) th,
        section .produits .table tfoot tr:nth-child(4) th{
            text-align: center;
            text-transform: uppercase;
            font-size: xx-small ;
            padding: 10px 0px;
            /* border: 1px solid black; */

            /* text-transform: uppercase; */
        }
        section .produits .table tfoot tr:nth-child(1) th:nth-child(2),
        section .produits .table tfoot tr:nth-child(2) th:nth-child(1),
        section .produits .table tfoot tr:nth-child(3) th:nth-child(1),
        section .produits .table tfoot tr:nth-child(4) th:nth-child(1){
            background: #8CC0DE
        }

        footer{
            clear: both;
            width: 30%;
            margin: auto
        }
        footer .table tbody td{
            font-size: x-small ;
            padding: 4px 0px;
            text-align: center;
            border: 0
        }
    </style>

    <header>
        <div class="text-left">
            <p>
                <span>belpre</span>
                <span>s.a.r.l</span>
            </p>

        </div>
        <div class="text-center">
        </div>
        <div class="text-right">
            xxx
        </div>
    </header>
    <article>
        <img src="./images/logo.jpg" alt="">
        <h4>ligne retour</h4>
        <hr>
        <h4>
            {{$ligne->reference }}/{{date("Y",strtotime($ligne->date_retour))}}
        </h4>
    </article>


    <div class="client">
        <p>{{ $ligne->facture->client->ville ?? '' }} , le : {{ date("d / m / Y",strtotime($ligne->date_retour)) }} </p>
        <p>client :   {{$ligne->facture->client->raison_sociale ?? ''}} </p>
        <p>adresse :   {{$ligne->facture->client->adresse ?? ''}}, {{ $ligne->facture->client->ville ?? '' }} </p>
        <p>ice :  {{ $facture->client->ice ?? '' }}</p>
    </div>

    <section>
        <div class="produits">
            <table class="table">
                <thead>
                    <tr>
                        <th>designation</th>
                        <th>qté</th>
                        <th>qté retour</th>
                        <th>code</th>
                        <th>p.u (h.t)</th>
                        <th>montant ht</th>
                        <th>montant ttc</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ligne->facture_retours as $ligne_retour)
                        <tr>
                            <td> {{ $ligne_retour->facture_produit->produit->designation ?? ''}} </td>
                            <td> {{ $ligne_retour->qte_actuel ?? 0}} DH</td>
                            <td> {{ $ligne_retour->qte_actuel - $ligne_retour->qte_retour}} DH</td>
                            <td> {{ $ligne_retour->facture_produit->produit->code ?? ''}} </td>
                            <td> {{ $ligne_retour->facture_produit->produit->prix_vente ?? 0}} DH</td>
                            <td> {{ $ligne_retour->montant_ht ?? 0}} DH</td>
                            <td> {{ $ligne_retour->montant_ttc ?? 0}} DH</td>
                        </tr>

                    @endforeach
                    @for ($i = 0; $i < 20 - count($ligne->facture_retours); $i++)
                        <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" rowspan="3">
                            <h5>Arrête la présente facture à la somme de :</h5>
                            <h5>{{ $letter_chiffre }} DHS</h5>
                        </th>
                        <th>total h.t</th>
                        <th> {{ $ligne->montant_ht }} DH</th>
                    </tr>
                    <tr>
                        <th>dont tva</th>
                        <th> {{ $ligne->facture->taux_tva }} %</th>
                    </tr>
                    <tr>
                        <th>total t.t.c</th>
                        <th> {{ $ligne->montant_ttc }} DH</th>
                    </tr>

                </tfoot>
            </table>

        </div>

    </section>
</body>
</html>