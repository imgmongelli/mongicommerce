<?php
use Mongi\Mongicommerce\Http\Controllers\admin\AdminCategoryController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminConfigurationFieldController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminDetailController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminNewProductController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminNewProductVariationController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminNewSingleProductController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminOrdersController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminProductsListController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminSettingsController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminUpdatePackageController;
use Mongi\Mongicommerce\Http\Controllers\admin\DashboardController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopCartController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopCheckoutController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopPaymentController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopShipmentController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopShowVariationProductController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopSingleProductController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopSummaryController;

Route::group(['middleware' => ['web']], function () {
    /*****************
     *-----SHOP------*
     *****************/

    Route::get('/shop/{id?}',[ShopController::class,'page'])->name('shop');
    Route::get('/prodotto/{id}/{item_id?}',[ShopSingleProductController::class,'page'])->name('shop.single.product');
    Route::get('page/shop/cart/',[ShopCartController::class,'page'])->name('shop.cart');
    Route::get('page/shop/summary/',[ShopSummaryController::class,'page'])->name('shop.summary');
    Route::get('page/shop/shipment/',[ShopShipmentController::class,'page'])->name('shop.shipment');
    Route::get('page/shop/payment/',[ShopPaymentController::class,'page'])->name('shop.payment');


    Route::post('/shop/get/product-information',[ShopShowVariationProductController::class,'getData'])->name('shop.get.product.information');
    Route::post('/shop/addtocart',[ShopCartController::class,'addToCart'])->name('shop.addtocart');
    Route::post('/shop/getcartelements',[ShopCartController::class,'getCartElements'])->name('shop.getcartelements');

    Route::post('/shop/getcartproducts/',[ShopCartController::class,'getCartProducts'])->name('getcartproducts');
    Route::post('shop/increment_number_product_in_cart/',[ShopCartController::class,'incrementOrDecrementElementInCart'])->name('increment_number_product_in_cart');
    Route::post('/shop/delete_from_cart',[ShopCartController::class,'deleteFromCart'])->name('delete_from_cart');
    Route::post('/shop/save_cache_details_order',[ShopCheckoutController::class,'saveDetailsInSession'])->name('save_cache_details_order');


    Route::get('page/shop/checkout/',[ShopCheckoutController::class,'page'])->name('shop.checkout');
    /*****************
     *------GET------*
     *****************/
    Route::get('/admin/dashboard',[DashboardController::class,'page'])->name('admin.dashboard');
    Route::get('/admin/categorie/',[AdminCategoryController::class,'page'])->name('admin.category.new');
    Route::get('/admin/dettagli',[AdminDetailController::class,'page'])->name('admin.details');
    Route::get('/admin/settings',[AdminSettingsController::class,'page'])->name('admin.settings');
    //products
    Route::get('/admin/prodotto/crea-prodotto',[AdminNewProductController::class,'page'])->name('admin.product.new');
    Route::get('/admin/prodotti',[AdminProductsListController::class,'page'])->name('admin.product.list');
    Route::get('/admin/prodotto/crea-singolo-prodotto',[AdminNewSingleProductController::class,'page'])->name('admin.new.single.product');
    Route::get('/admin/prodotto-variante/{id_product}',[AdminNewProductVariationController::class,'page'])->name('admin.product.new.variante');
    //orders
    Route::get('/admin/ordini',[AdminOrdersController::class,'page'])->name('admin.orders.list');



    /*****************
     *-----POST------*
     *****************/
    Route::post('/admin/post/get/categories/tree',[AdminCategoryController::class,'getStructureCategories'])->name('admin.post.get.categories.tree');
    Route::post('/admin/post/get/categories',[AdminCategoryController::class,'getCategories'])->name('admin.post.get.categories');
    Route::post('/admin/post/create-new-category',[AdminCategoryController::class,'setNewCategory'])->name('admin.post.create.new.category');

    //details
    Route::post('/admin/post/create/detail',[AdminDetailController::class,'setNewDetail'])->name('admin.post.create.detail');
    Route::post('/admin/post/get/details',[AdminDetailController::class,'getDetails'])->name('admin.post.get.details');

    //configuration
    Route::post('/admin/post/create/configuration',[AdminConfigurationFieldController::class,'setNewConfiguration'])->name('admin.post.create.configuration');
    Route::post('/admin/post/get/configuration',[AdminConfigurationFieldController::class,'getConfigurationFields'])->name('admin.post.get.configuration');

    //product
    Route::post('/admin/prodotto/crea-prodotto',[AdminNewProductController::class,'createNewProduct'])->name('admin.post.product.new');
    Route::post('/admin/prodotto/crea-variante-prodotto',[AdminNewProductVariationController::class,'createNewVariation'])->name('admin.post.product.variation.new');
    Route::post('/admin/prodotto/crea-singolo-prodotto',[AdminNewSingleProductController::class,'createNewSingleProduct'])->name('admin.post.new.single.product');


    //refresh
    Route::get('/admin/update',[AdminUpdatePackageController::class,'update'])->name('admin.updatepackage');

});
