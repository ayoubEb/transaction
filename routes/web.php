<?php


use Illuminate\Support\Facades\Route;
// use Spatie\Permission\Models\Permission;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FactureProduitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AmountPurchaseController;
use App\Http\Controllers\AmountSaleController;
use App\Http\Controllers\AttributController;
use App\Http\Controllers\BonCommandeController;
use App\Http\Controllers\CaracteristiqueController;
use App\Http\Controllers\CustomizeController;
use App\Http\Controllers\CustomizeFactureController;
use App\Http\Controllers\CustomizeStockController;
use App\Http\Controllers\FacturePaiementController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LigneAchatController;
use App\Http\Controllers\LigneBonCommandeController;
use App\Http\Controllers\ProduitCaracteristiqueController;
use App\Http\Controllers\ProduitCategorieController;
use App\Http\Controllers\ProduitSousCategorieController;
use App\Http\Controllers\SousCategorieController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockHistoriqueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeekAmountController;
use App\Http\Controllers\TypeClientController;
use App\Http\Controllers\TransactionController;



Route::group(['middleware' => ['auth']], function() {

    Route::resources([
        "amount-sale"=>AmountSaleController::class,
        "amount-purchase"=>AmountPurchaseController::class,
        "week-amount"=>WeekAmountController::class,
        "group"=>GroupController::class,
        "facture-paiement"=>FacturePaiementController::class,
        "categorie"=>CategorieController::class,
        "produit"=>ProduitController::class,
        "facture"=>FactureController::class,
        "factureProduit"=>FactureProduitController::class,
        "client"=>ClientController::class,
        "entreprise"=>EntrepriseController::class,
        "profil"=>ProfilController::class,
        "user"=>UserController::class,
        "role"=>RoleController::class,
        "type-client"=>TypeClientController::class,
        "transaction"=>TransactionController::class,
        "sousCategorie"=>SousCategorieController::class,
        "caracteristique"=>CaracteristiqueController::class,
        "produitCaracteristique"=>ProduitCaracteristiqueController::class,
        "produitCategorie"=>ProduitCategorieController::class,
        "produitSousCategorie"=>ProduitSousCategorieController::class,
        "stock"=>StockController::class,
        "fournisseur"=>FournisseurController::class,
        "customize"=>CustomizeController::class,
        "customize-facture"=>CustomizeFactureController::class,
        "customize-stock"=>CustomizeStockController::class,
        "stockHistorique"=>StockHistoriqueController::class,

    ]);

Route::resource("facture-paiement",FacturePaiementController::class);

Route::get('/getGroup',[ClientController::class,'getGroup'])->name("getGroup");

Route::controller(GetDataController::class)->group(function(){
    Route::get('/get-group-client','GroupClient')->name("clientGroup");
    Route::get('/getProduit','getProduit')->name("getProduit");
    Route::get('/client-year','ClientYear')->name("clientYear");

});




// Route::controller(CategorieController::class)->group(function(){
//     Route::post('/restore/{id}','restore')->name("categorie.restore");
//     Route::delete('/destroyDefinitivement/{id}','destroyDefinitivement')->name("categorie.destrotDefini");
// });
Route::controller(WeekAmountController::class)->group(function(){
    Route::post('/generer-weekend','generer')->name("generer");
});

Route::controller(FactureController::class)->group(function(){
    Route::put('/facture-valider/{facture}','valider')->name("facture.valider");
    Route::get('/facture-produits/{facture}','produits')->name("facture.produit");
    Route::get("/search-produits",'search_produitAdd')->name('searchProduit');
});

Route::controller(FactureController::class)->group(function(){
    Route::put('/validation/{facture}','statut_valider')->name("facture.statut");
});

Route::controller(FacturePaiementController::class)->group(function(){
    Route::get('/paiement-clients','facture_paiement')->name("paiement.facture");
    Route::get('/paiement-fiches','client_paiement')->name("paiement.client");
    Route::get('/information-paiement-client/{client}','cp_details')->name("paycli.details");
});



Route::post("/categorie-product",[CategorieController::class,"add_product"])->name("add.product");

Route::get('/',[HomeController::class,'index'])->name('home');

});











Route::get('/facture/pdf/{facture}',[FactureController::class,'showPdf'])->name('facture-pdf.show');
Route::get('/facture-pro/{id}/pdf/download',[FactureController::class,'downloadPdf'])->name('facture-pdf.down');






// Route::delete('/client/delete-all',[ClientController::class,'destroyAll'])->name('client.destroy-all');









Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

