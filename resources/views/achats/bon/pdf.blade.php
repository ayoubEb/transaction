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

        header{
            line-height: 5rem;

        }
        header h3{
            float: left;
            text-transform: uppercase;
            color: red;
            margin-left: 3rem;

        }
        section{
            clear: both;
            /* height: 2rem; */
            /* background: red; */
            width: 95%;
            margin: 3rem auto;

        }
        section article:nth-child(1){
            width: 50%;
            float: left;
        }
        section article:nth-child(1) h3{
            margin-left: 1rem;
            margin-bottom: 0.75rem;
        }
        section article:nth-child(1) p{
            margin-left: 1rem;
            margin-bottom: .50rem;
        }
        section article:nth-child(2){
            width: 50%;
            float: right;
        }
        section article:nth-child(2) h3{
            margin-left: 1rem;
            margin-bottom: 0.75rem;
        }
        section article:nth-child(2) p{
            margin-left: 1rem;
            margin-bottom: .50rem;
        }
        section article:nth-child(3){
            clear: both;
            margin-bottom: 2rem;
        }
        section article:nth-child(3) .table,
        section article:nth-child(4) .table
        {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }
        section article:nth-child(3) .table thead,
        section article:nth-child(4) .table thead
        {
            background: #54b9ed;

        }

        section article:nth-child(3) .table thead tr th{
            font-size: 14px;
            font-weight:normal;
            padding: 4px 3px;
            text-transform: uppercase;
            border: 0;
        }

        section article:nth-child(4) .table thead tr th{
            font-size: 14px;
            font-weight:normal;
            padding: 8px 3px;
            border: 0;
        }
        section article:nth-child(4) .table tbody tr:nth-child(even){
            background: rgba(#000, #000, #000, .2);
        }


        section article:nth-child(3) .table tbody tr td,
        section article:nth-child(4) .table tbody tr td
        {
            font-size: 13px;
            text-align: center;
            padding: 4px 3px;
        }

        footer{
            width: 92%;
            margin:3rem auto
        }
        footer .table{
            width: 100%;
            margin: auto;
            border-collapse: collapse;
        }
        footer .table thead{
            background: #54b9ed;
        }
        footer .table thead tr th{
            font-size: 14px;
            font-weight:normal;
            padding: 8px 3px;
            border: 0;
        }
        footer .table tbody tr td,
        footer .table tbody tr td
        {
            font-size: 13px;
            text-align: center;
            padding: 12px 3px;
        }

    </style>

    <header>
        <h3>bon du commande : {{ $ligneAchat->num_achat ?? '' }} </h3>
    </header>
    <section>
        <article>
            <h3>{{ $ligneAchat->entreprise->raison_sociale ?? '' }}</h3>
            <p>{{ $ligneAchat->entreprise->ice ?? '' }}</p>
            <p>{{ $ligneAchat->entreprise->adresse ?? '' }} </p>
            <p>{{ $ligneAchat->entreprise->code_postal ?? '' }} - {{ $ligneAchat->entreprise->ville ?? '' }}</p>
            <p>{{ $ligneAchat->entreprise->telephone ?? '' }} / {{ $ligneAchat->entreprise->fix ?? '' }}</p>
        </article>
        <article>
            <h3>{{ $ligneAchat->fournisseur->raison_sociale ?? '' }}</h3>
            <p>{{ $ligneAchat->entreprise->ice ?? '' }}</p>
            <p>{{ $ligneAchat->entreprise->adresse ?? '' }} </p>
            <p>{{ $ligneAchat->entreprise->code_postal ?? '' }} - {{ $ligneAchat->entreprise->ville ?? '' }}</p>
            <p>{{ $ligneAchat->entreprise->telephone ?? '' }} / {{ $ligneAchat->entreprise->fix ?? '' }}</p>
        </article>
        <article>
            <table class="table">
                <thead>
                    <tr>
                        <th>date</th>
                        {{-- <th>paiement</th> --}}
                        <th>livraison</th>
                        <th>nombre produit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> {{ $ligneAchat->date ?? '' }} </td>
                        <td>
                            {{ $ligneAchat->etat_livraison ?? '' }}
                        </td>
                        <td>
                            {{ $ligneAchat->nombre_achats ?? '' }}
                        </td>
                    </tr>
                    {{-- @foreach ($ligneAchat->achats as $achat)
                        <tr>
                            <td class="align-middle"> {{ $achat->produit->reference ?? '' }} </td>
                            <td class="align-middle"> {{ $achat->produit->reference ?? '' }} </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </article>
        <article>
            <table class="table">
                <thead>
                    <tr>
                        <th>référence</th>
                        <th>désignation</th>
                        <th>prix</th>
                        <th>quantite</th>
                        <th>remise</th>
                        <th>montant</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ligneAchat->achats as $achat)
                        <tr>
                            <td> {{ $achat->produit->reference ?? '' }} </td>
                            <td> {{ $achat->produit->designation ?? '' }} </td>
                            <td> {{ $achat->produit->prix_achat ?? 0 }} DH</td>
                            <td> {{ $achat->produit->quantite ?? 0 }}</td>
                            <td> {{ $achat->produit->remise ?? 0.00 }} %</td>
                            <td> {{ $achat->produit->montant ?? 0 }} DH</td>
                        </tr>
                    @endforeach
                    @for ($i = 0; $i < 30 - count($ligneAchat->achats ); $i++)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </article>
    </section>


    <footer>
        <table class="table">
            <thead>
                <tr>
                    <th>prix ht</th>
                    <th>prix ttc</th>
                    <th>tva</th>
                    <th>payer</th>
                    <th>reste</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{ $ligneAchat->prix_ht ?? 0 }} DH</td>
                    <td> {{ $ligneAchat->prix_ttc ?? 0 }} DH</td>
                    <td> {{ $ligneAchat->taux_tva ?? 0 }} %</td>
                    <td> {{ $ligneAchat->payer ?? 0 }} DH</td>
                    <td> {{ $ligneAchat->reste ?? 0 }} DH</td>
                </tr>
            </tbody>
        </table>
    </footer>
</body>
</html>