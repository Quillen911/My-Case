<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller{
    
    public function showLogin(){
        return view('auth.login'); 
    }

    public function login(Request $request){
        $info = $request->only('email','password'); //veri aldı

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Sadece belirli email ile girişe izin ver
        if($info['email'] !== 'hecksoft0@gmail.com'){
            return back()->withErrors([
                'email' => 'Sadece admin kullanıcı giriş yapabilir.',
            ]);
        }

        if(Auth::attempt($info)){
            return redirect()->route('main'); //doğruysa giriş
        }
        return back()->withErrors([
            'email' => 'Email veya şifre yanlış', //yanlış
        ]);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login.form');
    }

    //USER

    public function addUser(){
        return view('user.addUser');
    }
    public function postUser(Request $request){
        $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ], [
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'email.unique' => 'Bu e-posta zaten kayıtlı.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
        ]);

        $user = User::Create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('addUser');
        
    }

    public function editUser($id){
        $user = \App\Models\User::findOrFail($id);
        return view('user.editUser',compact('user'));
    }
    

    //Category

    public function addCategory(){
        return view('category.addCategory');
    }
    public function showCategory(Request $request){
        
        $request->validate([
            'categoryTitle' => 'required|unique:category,categoryTitle',
            'categoryDesc' => 'required',
            'categoryStatus' => 'required',
        ],[
            'categoryTitle.unique' => 'Bu kategori adı zaten kullanılıyor.'
        ]);

        $category = Category::create([
            'categoryTitle' => $request->categoryTitle,
            'categoryDesc' => $request->categoryDesc,
            'categoryStatus' =>$request->categoryStatus,
        ]);
        return redirect()->route('add');
    }
    public function editCategory($id){
        $category = \App\Models\Category::findOrFail($id);
        return view('category.editCategory', compact('category'));
    }
    public function updateCategory(Request $request, $id){
        $category = \App\Models\Category::findOrFail($id);

        $request->validate([
            'categoryTitle' => 'required|unique:category,categoryTitle,' .$category->id,
            'categoryDesc' => 'required',
            'categoryStatus' => 'required',
        ],[
            'categoryTitle.unique' => 'Bu kategori adı zaten kullanılıyor.'
        ]);

        $category ->categoryTitle = $request->categoryTitle;
        $category ->categoryDesc = $request->categoryDesc;
        $category ->categoryStatus = $request->categoryStatus;
        $category ->save();

        return redirect()->route('category.list');
    }
    public function deleteCategory($id){
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.list');
    }
    public function listDeleted(){
        $categories= \App\Models\Category::onlyTrashed()->get();
        return view('category.listDeleted', compact('categories'));
    }
    
    //PRODUCT

    public function add(){
        $categories= Category::all();
        return view('product.add', compact('categories'));
    }
    public function addpost(Request $request){

        $request->validate([
            'productTitle' => 'required',
            'productCategoryId' => 'nullable',
            'productBarcode' => 'required|unique:product,productBarcode',
            'productStatus' => 'required',
        ],[
            'productBarcode.unique' => 'Bu barkod zaten kullanılıyor.'

        ]);

        $product = Product::create([
            'productTitle' => $request->productTitle,
            'productCategoryId' => $request->productCategoryId,
            'productBarcode' => $request->productBarcode, 
            'productStatus' => $request->productStatus, 
        ]);
        return redirect()->route('product.add');

    }
    public function deleteProduct($id){
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('list');
    }
    public function editProduct($id){
        $product = \App\Models\Product::findOrFail($id);
        return view('product.editProduct', compact('product'));
    }
    public function updateProduct(Request $request, $id){
        $product = \App\Models\Product::findOrFail($id);

        $request->validate([
            'productTitle' => 'required' ,
            'productCategoryId' => 'nullable' ,
            'productBarcode' => 'required|unique:product,productBarcode,' .$product->id,
            'productStatus' => 'required'
        ],[
            'productBarcode.unique' => 'Bu barkod zaten kullanılıyor.'
        ]);

        $product ->productTitle = $request->productTitle;
        $product ->productCategoryId = $request->productCategoryId;
        $product ->productBarcode = $request->productBarcode;
        $product ->productStatus = $request->productStatus;
        $product ->save();

        return redirect()->route('list');
    }
    public function productListDeleted(){
        $categories = Category::all();
        $product= \App\Models\Product::onlyTrashed()->get();
        return view('product.productListDeleted', compact('product','categories'));
    }

}


