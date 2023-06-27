<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>facture</title>
</head>
<body>
  <style>


  </style>
<div class="top-content">
<style>
  *{
  font-family: "roboto","sans-serif";
padding: 0%;
  margin:0;
  box-sizing: border-box;

}

#header{

    margin:5% auto;
    width:92%;
    height:100px;

}

#header .logo{
    width:40%;
    float:left;
    margin-top:0%;
}
#header .logo img{
    width:12rem;
}


#header .moin-facture{
    float:right;
  width: 40%;
    margin-top:0%;
}
#header .moin-facture .table{

    border:1 black solid;
    width:100%;
}

#header .moin-facture .table thead tr th{
padding:10px 5px;
border:1px solid black;
font-size:12px;
letter-spacing:0.75px
}

#header .moin-facture .table tbody tr td{
border:1px solid black;
padding:10px 5px;
letter-spacing:0.75px;
font-size:12px;
text-align:center;
}
.info{
    width:92%;
    margin:auto;
  height:150px;
  padding:2% 0%;


}
.info .info-client{
    float:left;
    width:42%;
    border:1px black solid;
    height:max-content;
    text-align:center;
    border-radius:5%;


}
.info .info-enter{
    float:right;
    border-radius:5%;
    width:42%;
    border:1px black solid;
    height:max-content;
    text-align:center;
}
.info .info-client ul,
.info .info-enter ul{
    list-style:none;
    margin-top:5px;
}
.info .info-client ul li,
.info .info-enter ul li{
    padding:3px 0px;
    font-size:14px;
}
.info .info-client h3,
.info .info-enter h3{
    padding-bottom:5px;
    margin-top:20px;
}
.info-facture{
    clear:both;
    width:92%;
    margin:auto;
    margin-bottom:2%;
}
.info-facture .table{
    width:100%;
    height:500px;

    border-collapse:collapse;
}
.info-facture .table thead{
    background:#FF8D29;
}
.info-facture .table thead tr th{
    padding:7px 2px;
    letter-spacing:.5px;
    font-size:12px;
}
.info-facture .table tbody tr td{
    padding:7px 2px 7px 7px;
    letter-spacing:.5px;
    font-size:12px;
}
.info-facture .table tbody tr:nth-child(even){
    background:rgba(0,0,0,.1);
}
.info-final{
    width:80%;
  margin-left:auto;
  margin-right:4%;
  margin-bottom:2%;
}
.info-final .table{
    border-collapse:collapse;
    width:100%;
}
.info-final .table thead tr th{
    font-size:13px;
}
.info-final .table tbody tr td{
    font-size:14px;
    text-align:center;
}
.info-final .table thead tr th,
.info-final .table tbody tr td{
    padding:5px;
    border:1px solid black;
}

hr{
    width:92%;
    margin:auto;
    margin-bottom:2%;
    border:0.05 black solid;
}
.footer{
    width:92%;
    margin:auto;
}
.chiffre{
    margin-left:4%;
}
.chiffre p{
    font-size:11px;
}
.chiffre p:first-child(){
    font-weight:bolder;
    margin-bottom:5px;
}

.chiffre p:nth-child(2){
    margin-bottom:2%;
}
.detail-enter{
    width:100%;
    margin:auto;
    background:rgba(0,0,0,.1);
    padding:5px 0px;
}
.detail-enter h6:first-child(){
    width:90%;
    margin:auto;
    text-align:center;
    letter-spacing:.5px;
margin-bottom:10px
}
.detail-enter h6:first-child()>span{
    font-weight:normal;
}
.detail-enter h6:last-child(){
    width:90%;
    margin:auto;
    text-align:center;
    letter-spacing:.5px;
margin-bottom:10px
}
.detail-enter h6:last-child()>span{
    font-weight:normal;
}
.detail-enter h5{
text-align:center;
margin-bottom:10px
}
</style>
<div id="header">
    <div class="logo">
        @if (isset($facture->entreprise->logo))
        <img src="./images/entreprise/{{ $facture->entreprise->logo }}" alt="">

        @endif
    </div>
    <div class="moin-facture">
      <table class="table" cellspacing="0">
        <thead>
        <tr>
          <th>
            N° DE FACTURE
          </th>
          <th>
            DATE
          </th>
        </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $facture->num_facture ?? ''}}</td>
            <td>{{ $facture->date}}</td>
          </tr>
        </tbody>
      </table>
    </div>
</div>

<div class="info">
    <div class="info-enter">

        <h3>{{ $facture->entreprise->raison_sociale ?? '' }}</h3>
        <ul>
            <li>{{ $facture->entreprise->adresse ?? '' }}</li>
            <li>{{ $facture->entreprise->code_postal ?? '' }} , {{ $facture->entreprise->ville ?? '' }}</li>
            <li>{{ $facture->entreprise->email ?? '' }}</li>
            <li>{{ $facture->entreprise->telephone ?? '' }}</li>
        </ul>


    </div>
    <div class="info-client">
        <h3>{{ $facture->client->rs ?? '' }}</h3>
        <ul>
            <li style="word-break:all;">{{ $facture->client->adresse ?? '' }}</li>
            <li>{{ $facture->client->ville ?? '' }}</li>
            <li>{{ $facture->client->telephone ?? '' }}</li>
        </ul>
    </div>
</div>

<div class="info-facture">
  <table class="table">
    <thead>
      <tr>
        <th>Référence</th>
        <th>Déségnation</th>
        <th>Quantite</th>
        <th>Prix unitaire</th>
        <th>Montant</th>
        <th>Remise</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($facture->facture_produit as $fp)
      <tr>
        <td>
          {{ $fp->reference ?? '' }}
        </td>
        <td>
          {{ $fp->designation ?? '' }}
        </td>
        <td>
          {{ $fp->quantite ?? '' }}
        </td>
        <td>
          {{ $fp->prix_unitaire ?? '' }} DHS
        </td>
        <td>
          {{ $fp->montant ?? '' }} DHS
        </td>
        <td>
          {{ $fp->remise ?? '' }} %
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="info-final">
    <table class="table">
        <thead>
            <tr>
                <th>Remise</th>
                <th>Taux de TVA</th>
                <th>Total de TTC</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
              <td>{{ $facture->remise ?? '0' }}%</td>
              <td>{{ $facture->taux_tva ?? '' }}%</td>
              <td>{{ $facture->prix_ttc ?? '' }} DHS</td>
              <td>{{ $facture->prix_ttc ?? '' }} DHS</td>
            </tr>
        </tbody>

  </table>
</div>
<div class="chiffre">
    <p>Arrête la présente facture à la somme de : </p>
    <p>{{ $letter_chiffre }} DHS</p>
</div>
<hr>

<div class="footer">
    <div class="detail-enter">

        <h5>
            {{ $facture->entreprise->raison_sociale ?? '' }}
        </h5>
        <h6>
               Siège :
           <span>
           {{ $facture->entreprise->adresse ?? '' }}
           </span>
        </h6>

        <h6>
            IF : <span>{{ $facture->entreprise->if ?? '' }}</span>&nbsp;&nbsp;
            ICE : <span>{{ $facture->entreprise->ice ?? ''  }}</span>&nbsp;&nbsp;
            PATENTE : <span>{{ $facture->entreprise->patente ?? ''  }}</span>&nbsp;&nbsp;
            RC : <span>{{ $facture->entreprise->rc ?? ''  }}</span>&nbsp;&nbsp;
            CNSS : <span>{{ $facture->entreprise->cnss ?? ''  }}</span>&nbsp;&nbsp;
        </h6>

    </div>
</div>

</body>
</html>


