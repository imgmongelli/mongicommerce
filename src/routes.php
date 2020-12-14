<?php


use Mongi\Mongicommerce\Http\Controllers\admin\DashboardController;

//BackEnd Pages
Route::get('/admin/dashboard',[DashboardController::class,'page'])->name('admin.dashboard');
