<?php


use Mongi\Mongicommerce\Http\Controllers\admin\AdminCategoryController;
use Mongi\Mongicommerce\Http\Controllers\admin\DashboardController;

//BackEnd Pages
Route::get('/admin/dashboard',[DashboardController::class,'page'])->name('admin.dashboard');
Route::get('/admin/categoria/nuova-categoria',[AdminCategoryController::class,'page'])->name('admin.category.new');
