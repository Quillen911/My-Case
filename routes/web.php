<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

Route::get('/login', [AuthController::class,'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class,'login'])->name('login');

Route::get('/main', function () {
    return view('auth.main');
})->middleware('auth')->name('main');

Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// USER
Route::get('/user/addUser',[AuthController::class, 'addUser'])->name('addUser')->middleware('auth');
Route::post('/user/postUser',[AuthController::class, 'postUser'])->name('user.postUser')->middleware('auth');
Route::get('/user/listUser',function(){
    $user=User::all();
    return view('user.listUser', compact('user'));
})->name('listUser')->middleware('auth');

Route::get('/user/{id}/edit',[AuthController::class, 'editUser'])->name('editUser')->middleware('auth');
Route::post('/user/{id}/edit',[AuthController::class, 'updateUser'])->name('updateUser')->middleware('auth');
Route::get('/user/editVerify', [AuthController::class, 'editVerify'])->name('editVerify')->middleware('auth');
Route::post('/user/postEditVerify', [AuthController::class, 'postEditVerify'])->name('postEditVerify')->middleware('auth');
Route::delete('/user/{id}', [AuthController::class, 'deleteUser'])->name('deleteUser')->middleware('auth');
Route::get('/user/deleteListUser', [AuthController::class, 'deleteListUser'])->name('deleteListUser')->middleware('auth');
Route::delete('/user/bulk-delete', [AuthController::class, 'bulkDeleteUser'])->name('bulkDeleteUser')->middleware('auth');

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
