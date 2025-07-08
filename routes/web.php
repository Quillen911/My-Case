<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\userController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\productController;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

Route::get('/login', [AuthController::class,'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class,'login'])->name('login');

Route::get('/main', function () {
    return view('auth.main');
})->middleware('auth')->name('main');

Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/settings', [AuthController::class, 'getSettings'])->name('getSettings')->middleware('auth');
Route::post('/settings', [AuthController::class, 'postSettings'])->name('postSettings')->middleware('auth');

// USER
Route::get('/user/addUser',[userController::class, 'addUser'])->name('addUser')->middleware('auth');
Route::post('/user/postUser',[userController::class, 'postUser'])->name('user.postUser')->middleware('auth');
Route::get('/user/listUser',function(){
    $user=User::all();
    return view('user.listUser', compact('user'));
})->name('listUser')->middleware('auth');

Route::get('/user/{id}/edit',[userController::class, 'editUser'])->name('editUser')->middleware('auth');
Route::post('/user/{id}/edit',[userController::class, 'updateUser'])->name('updateUser')->middleware('auth');
Route::get('/user/editVerify/{id}', [userController::class, 'editVerify'])->name('editVerify')->middleware('auth');
Route::post('/user/postEditVerify/{id}', [userController::class, 'postEditVerify'])->name('postEditVerify')->middleware('auth');
Route::get('/user/deleteListUser', [userController::class, 'deleteListUser'])->name('deleteListUser')->middleware('auth');
Route::post('/user/bulk-delete', [userController::class, 'bulkDeleteUser'])->name('bulkDeleteUser')->middleware('auth');

//CATEGORY

Route::get('/add', [categoryController::class, 'addCategory'])->name('add');
Route::post('/add', [categoryController::class, 'showCategory'])->name('add.show');

Route::get('/category-list',function (){
    $category = Category::all();
    return view('category.listCategory', compact('category'));
})->middleware('auth')->name('category.list');

Route::get('/category/{id}/edit', [categoryController::class, 'editCategory'])->name('editCategory')->middleware('auth');
Route::post('/category/{id}/edit', [categoryController::class, 'updateCategory'])->name('updateCategory')->middleware('auth');
Route::delete('/category/{id}', [categoryController::class, 'deleteCategory'])->name('deleteCategory')->middleware('auth');
Route::get('/category/listDeleted',[categoryController::class,'listDeleted'])->name('listDeleted')->middleware('auth');

//PRODUCT

Route::get('/product/add',[productController::class,'add'])->name('product.add')->middleware('auth');
Route::post('/product/addpost',[productController::class,'addpost'])->name('product.addpost')->middleware('auth');


Route::get('/product/list',function (){
    $product = Product::all();
    $categories = Category::all();
    return view('product.list', compact('product', 'categories'));
})->middleware('auth')->name('list');

Route::delete('/product/{id}', [productController::class, 'deleteProduct'])->name('deleteProduct')->middleware('auth');
Route::get('/product/{id}/edit', [productController::class, 'editProduct'])->name('editProduct')->middleware('auth');
Route::post('/product/{id}/edit', [productController::class, 'updateProduct'])->name('updateProduct')->middleware('auth');
Route::get('/product/productListDeleted', [productController::class, 'productListDeleted'])->name('productListDeleted')->middleware('auth');
