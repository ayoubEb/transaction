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
use App\Http\Controllers\FacturePaiementController;
use App\Http\Controllers\GetDataController;
use App\Http\Controllers\SousCategorieController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeekAmountController;
use App\Http\Controllers\WeekAmountPurchaseController;
use App\Http\Controllers\WeekAmountSaleController;
use App\Http\Controllers\TypeClientController;
use App\Http\Controllers\TransactionController;



Route::group(['middleware' => ['auth']], function() {

    Route::resources([
        "amount-sale"=>WeekAmountSaleController::class,
        "amount-purchase"=>WeekAmountPurchaseController::class,
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
        "sous-categorie"=>SousCategorieController::class,
    ]);

Route::resource("facture-paiement",FacturePaiementController::class);
Route::resource("facture-reglement",FactureReglementController::class);
Route::get('/getGroup',[ClientController::class,'getGroup'])->name("getGroup");

Route::controller(GetDataController::class)->group(function(){
    Route::get('/get-group-client','GroupClient')->name("clientGroup");
    Route::get('/getProduit','getProduit')->name("getProduit");
    Route::get('/client-year','ClientYear')->name("clientYear");
});

Route::controller(FacturePaiementController::class)->group(function(){
    Route::get('/paiement-clients','facture_paiement')->name("paiement.facture");
    Route::get('/paiement-fiches','client_paiement')->name("paiement.client");
    Route::get('/information-paiement-client/{client}','cp_details')->name("paycli.details");
});

Route::post("/categorie-product",[CategorieController::class,"add_product"])->name("add.product");

Route::get('/',[AdminController::class,'index'])->name('admin');

});











Route::get('/facture/pdf/{facture}',[FactureController::class,'showPdf'])->name('facture-pdf.show');
Route::get('/facture-pro/{id}/pdf/download',[FactureController::class,'downloadPdf'])->name('facture-pdf.down');






// Route::delete('/client/delete-all',[ClientController::class,'destroyAll'])->name('client.destroy-all');









Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

