<?php


use Mongi\Mongicommerce\Http\Controllers\admin\AdminCategoryController;
use Mongi\Mongicommerce\Http\Controllers\admin\AdminDetailController;
use Mongi\Mongicommerce\Http\Controllers\admin\DashboardController;

//BackEnd Pages
Route::get('/admin/dashboard',[DashboardController::class,'page'])->name('admin.dashboard');
Route::get('/admin/categorie/',[AdminCategoryController::class,'page'])->name('admin.category.new');
Route::get('/admin/dettagli/',[AdminDetailController::class,'page'])->name('admin.details');




//Post
Route::post('/admin/post/get/categories/tree',[AdminCategoryController::class,'getStructureCategories'])->name('admin.post.get.categories.tree');
Route::post('/admin/post/get/categories',[AdminCategoryController::class,'getCategories'])->name('admin.post.get.categories');
Route::post('/admin/post/create-new-category',[AdminCategoryController::class,'setNewCategory'])->name('admin.post.create.new.category');
