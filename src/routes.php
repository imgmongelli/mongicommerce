<?php
use Mongi\Mongicommerce\Http\Controllers\admin\AdminCategoryController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminConfigurationFieldController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminDetailController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminNewProductController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminNewProductVariationController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminOrdersController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminProductsListController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminSettingsController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminUpdatePackageController;
use Mongi\Mongicommerce\Http\Controllers\admin\DashboardController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopShowVariationProductController;
use Mongi\Mongicommerce\Http\Controllers\shop\ShopSingleProductController;

Route::group(['middleware' => ['web']], function () {
    /*****************
     *-----SHOP------*
     *****************/

    Route::get('/shop/{id?}',[ShopController::class,'page'])->name('shop');
    Route::get('/prodotto/{id}/{item_id?}',[ShopSingleProductController::class,'page'])->name('shop.single.product');

    Route::post('/shop/get/product-information',[ShopShowVariationProductController::class,'getData'])->name('shop.get.product.information');


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


    //refresh
    Route::get('/admin/update',[AdminUpdatePackageController::class,'update'])->name('admin.updatepackage');

});
