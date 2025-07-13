<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;


//LOGIN

Route::get('/', [AuthController::class,'showLogin'])->name('login.form'); 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');                                       //Giriş                      
Route::post('/login', [AuthController::class,'login'])->name('login');                                          //Giriş Onayı

Route::middleware(['auth:sanctum'])->group(function(){
    //LOG OUT
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');                                   //Çıkış
    //MAIN
    Route::prefix('/main')->group(function(){
        Route::get('', [AuthController::class, 'main'])->name('main');                                          //Ana Sayfa
        Route::get('/settings', [AuthController::class, 'getSettings'])->name('getSettings');                   //Ayarlar
        Route::post('/settings', [AuthController::class, 'postSettings'])->name('postSettings');                //Ayarlar Verisi
    });

    // USER
    Route::prefix('user')->group(function() {
        Route::get('/add',[UserController::class, 'addUser'])->name('addUser');                                 //Ekle
        Route::post('/postUser',[UserController::class, 'postUser'])->name('user.postUser');                    //EKLE için veri gönder
        Route::get('/list',[UserController::class,'listUser'])->name('listUser');                               //Liste
        Route::get('/{id}/edit',[UserController::class, 'editUser'])->name('editUser');                         //Düzenle
        Route::post('/{id}/edit',[UserController::class, 'updateUser'])->name('updateUser');                    //Yeni Düzen Verisi Gönderildi
        Route::get('/editVerify/{id}', [UserController::class, 'editVerify'])->name('editVerify');              //Admin Onayı
        Route::post('/postEditVerify/{id}', [UserController::class, 'postEditVerify'])->name('postEditVerify'); //Admin Onaylandı Verisi
        Route::get('/deleteListUser', [UserController::class, 'deleteListUser'])->name('deleteListUser');       //Silinenler
        Route::post('/bulk-delete', [UserController::class, 'bulkDeleteUser'])->name('bulkDeleteUser');         //Silmek
    });

    //CATEGORY 
    Route::prefix('category')->group(function () {
        Route::get('/add', [CategoryController::class, 'addCategory'])->name('add');                            //Ekle
        Route::post('/add', [CategoryController::class, 'showCategory'])->name('add.show');                     //EKLE için veri gönder
        Route::get('/list', [CategoryController::class, 'listCategory'] )->name('category.list');               //Liste                                                               //Liste
        Route::get('/{id}/edit', [CategoryController::class, 'editCategory'])->name('editCategory');            //Düzenle
        Route::post('/{id}/edit', [CategoryController::class, 'updateCategory'])->name('updateCategory');       //Yeni Düzen Verisi
        Route::delete('/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');          //Silmek
        Route::get('/listDeleted', [CategoryController::class, 'listDeleted'])->name('listDeleted');            //Silinenler
    });

    //PRODUCT
    Route::prefix('product')->group(function () {
        Route::get('/add',[ProductController::class,'add'])->name('product.add');                               //Ekle
        Route::post('/addpost',[ProductController::class,'addpost'])->name('product.addpost');                  //EKLE için veri gönder
        Route::get('/list', [ProductController::class, 'listProduct'])->name('list');                           //Liste                                                     //LİSTE
        Route::delete('/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');             //Sil
        Route::get('/{id}/edit', [ProductController::class, 'editProduct'])->name('editProduct');               //Düzenle
        Route::post('/{id}/edit', [ProductController::class, 'updateProduct'])->name('updateProduct');          //Yeni Düzen Verisi    
        Route::get('/productListDeleted', [ProductController::class, 'productListDeleted'])->name('productListDeleted');//SİLİNENLER
    });
}); 