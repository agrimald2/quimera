<?php

use Illuminate\Support\Facades\Route;
use App\Category;
use App\Brand;
// use Illuminate\Http\Request;

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


// Auth::routes(['register' => false]);
Auth::routes();


/**
 * Frontend with Vue
 */
Route::get('/', 'Frontend\FrontendController@index');
Route::prefix('api/frontend')->group(function () {
    Route::get('/', 'Frontend\FrontendController@indexData');
});




Route::get('home/records', 'Ecommerce\HomeController@records');
Route::get('products/records', 'Ecommerce\ProductController@records');
Route::get('api/product/{id}', 'Ecommerce\ProductController@record');

Route::get('/api/{officeId}/setOffice', function($officeId) {
    session(['officeId' => $officeId]);
    return ['ok' => true];
});
Route::get('shop/boots', function(){
    return view('quimeraShopping');
});
Route::get('/api/dashboard', 'DashboardController@index');
Route::get('/api/products/withInventory', 'ProductController@withInventory');
Route::post('/api/products/image', 'ProductController@storeImage');
Route::get('/api/products/tables', 'ProductController@tables');
Route::get('/api/products/images/{id}', 'ProductController@getImage');
Route::get('/api/customers/byDni', 'CustomerController@byDni');
Route::get('/api/shoppings/removeAll', 'ShoppingController@removeAll');
Route::get('/api/products/{id}/inventoryAll', 'ProductController@inventoryAll');
Route::get('/generateQR/product', 'ProductController@GenerateQRProduct');
Route::post('/api/asign_descuento', 'ProductController@PostDescuento');

Route::post('/api/products/search', 'ProductController@search');
Route::get('/api/customers/{key}/search', 'CustomerController@search');
Route::post('/api/products/searchBy', 'ProductController@searchByCharacterisc');

Route::post('/api/categories/image', 'CategoryController@storeImage');

Route::post('/api/collections/image', 'CollectionController@storeImage');

Route::get('/api/sales/{id}/delivery', 'SaleController@delivery');
Route::get('/api/sales/all', 'SaleController@all');
Route::get('/api/sales/{id}/dispatched', 'SaleController@dispatched');
Route::post('/api/sales/deleteSale', 'SaleController@deleteSale');
Route::post('/api/sales/shop', 'SaleController@shop');
Route::post('/api/sales/shopPayment', 'SaleController@shopPayment');
Route::get('/api/sales/find', 'SaleController@find');
Route::put('/api/sales/{id}/withInventory', 'SaleController@updateWithInventory');
Route::put('/api/sales/pay', 'SaleController@pay');
Route::get('/api/sales/dispatchedSales', 'SaleController@dispatchedSales');
Route::get('/api/sales/deliverySales', 'SaleController@deliverySales');

Route::get('/api/salesdetails/find', 'SaleDetailController@findDetails');


Route::get('/api/products/all', 'ProductController@all');
Route::get('/api/deletedReasons/all', 'DeletedReasonController@all');
Route::get('/api/users/session', 'UserController@session');
Route::get('/api/customers/{dni}/dni', 'CustomerController@getDni');
Route::get('/api/users/dealers', 'UserController@dealers');

Route::get('/api/deliveries/all', 'DeliveryController@all');
Route::get('/api/disableds/shop', 'DisabledController@shop');

Route::get('/api/rawMaterial/{id}/inventory', 'RawMaterialController@inventory');
Route::post('/api/rawMaterial/terminar', 'RawMaterialController@finish');

Route::get('/generateQR', 'InventoryController@GenerateQR');
Route::get('/generateqr_pack_product/{id}', 'InventoryController@GenerateQR_PackProducts');
Route::get('/generateqr_product/{codigo}', 'InventoryController@GenerateQR_Products');
Route::get('/api/generateQR/inventories/{code_inventorie}', 'InventoryController@ScannerInventories');

Route::apiResources([
    'api/disableds' => 'DisabledController',
    'api/offices' => 'OfficeController',
    'api/deliveryman' => 'DeliverymanController',
    'api/credentials' => 'CredentialController',
    'api/users' => 'UserController',
    'api/paymentMethods' => 'PaymentMethodController',
    'api/emails' => 'EmailController',
    'api/rawMaterial' => 'RawMaterialController',
    'api/products' => 'ProductController',
    'api/colors' => 'ColorController',
    'api/sizes' => 'SizeController',
    'api/brands' => 'BrandController',
    'api/collections' => 'CollectionController',
    'api/categories' => 'CategoryController',
    'api/subCategories' => 'SubCategoryController',
    'api/shoppings' => 'ShoppingController',
    'api/inventories' => 'InventoryController',
    'api/customers' => 'CustomerController',
    'api/sales' => 'SaleController',
    'api/salesdetails' => 'SaleDetailController',
    'api/checkout' => 'CheckoutController',
    'api/deliveries' => 'DeliveryController',
    'api/deletedReasons' => 'DeletedReasonController',
]);

Route::post('/api/filters_products/', 'ProductController@FilterProduct');
Route::post('/api/filters_inventories/', 'InventoryController@FilterInventory');
Route::post('/api/categories/image', 'CategoryController@storeImage');
Route::get('/api/categories/images/{id}', 'CategoryController@getImage');

Route::post('/api/logout', 'Auth\LoginController@logout');

// Menu shop link
Route::get('/store', function () {
    return view('frontend.store.store');
})->name('store');

// Product detail route
Route::get('/item/{id}', function () {
    return view('frontend.store.store');
});

// Category detail
Route::get('/store/{id}', function () {
    return view('frontend.store.store');
});

// Cart checkout
Route::get('/cart', function () {
    return view('frontend.store.store');
});


Route::get('/payment', function () {
    return view('quimeraStore');
});

Route::get('/{saleId}/checkoutDetails', function () {
    return view('quimeraStore');
});

Route::get('/{saleId}/checkout', function () {
    return view('quimeraStore');
});

Route::get('/checkout', function () {
    return view('quimeraStore');
});

Route::get('/shopping', function () {
    return view('quimeraShopping');
});

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');
