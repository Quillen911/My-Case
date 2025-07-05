<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Category;
use App\Models\Admin;
use App\Models\Product;

Route::get('/register', [AuthController::class,'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::get('/login', [AuthController::class,'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class,'login'])->name('login');

Route::get('/main', function () {
    return view('auth.main');
})->middleware('auth')->name('main');

Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/admin-list', function(){
    $admins = Admin::all();
    return view('admin.list', compact('admins'));
})->middleware('auth')->name('admin.list');

Route::get('/admin/{id}/edit', [AuthController::class, 'edit'])->name('editAdmin')->middleware('auth');
Route::post('/admin/{id}/edit', [AuthController::class, 'update'])->name('updateAdmin')->middleware('auth');
Route::delete('/admin/{id}', [AuthController::class, 'delete'])->name('deleteAdmin')->middleware('auth');
Route::get('/admin/deletedAdmin', [AuthController::class, 'deletedAdmin'])->name('deletedAdmin')->middleware('auth');

//CATEGORY

Route::get('/add', [AuthController::class, 'addCategory'])->name('add');
Route::post('/add', [AuthController::class, 'showCategory'])->name('add.show');

Route::get('/category-list',function (){
    $category = Category::all();
    return view('category.listCategory', compact('category'));
})->middleware('auth')->name('category.list');

Route::get('/category/{id}/edit', [AuthController::class, 'editCategory'])->name('editCategory')->middleware('auth');
Route::post('/category/{id}/edit', [AuthController::class, 'updateCategory'])->name('updateCategory')->middleware('auth');
Route::delete('/category/{id}', [AuthController::class, 'deleteCategory'])->name('deleteCategory')->middleware('auth');
Route::get('/category/listDeleted',[AuthController::class,'listDeleted'])->name('listDeleted')->middleware('auth');

//PRODUCT

Route::get('/product/add',[AuthController::class,'add'])->name('product.add')->middleware('auth');
Route::post('/product/addpost',[AuthController::class,'addpost'])->name('product.addpost')->middleware('auth');


Route::get('/product/list',function (){
    $product = Product::all();
    $categories = Category::all();
    return view('product.list', compact('product', 'categories'));
})->middleware('auth')->name('list');

Route::delete('/product/{id}', [AuthController::class, 'deleteProduct'])->name('deleteProduct')->middleware('auth');
Route::get('/product/{id}/edit', [AuthController::class, 'editProduct'])->name('editProduct')->middleware('auth');
Route::post('/product/{id}/edit', [AuthController::class, 'updateProduct'])->name('updateProduct')->middleware('auth');
Route::get('/product/productListDeleted', [AuthController::class, 'productListDeleted'])->name('productListDeleted')->middleware('auth');