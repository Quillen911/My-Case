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
    public function editVerify(){
        return view('user.editVerify');
    }

    public function postEditVerify(Request $request){
        $info = $request->only('password');
        $request->validate([
            'password' => 'required',
        ]);
        $user = Auth::user();
        if(Auth::attempt(['email' => $user->email, 'password' => $request->password])){
            return redirect()->route('editUser', ['id' => $user->id]);
        }

        return back()->withErrors(['password' => 'Şifre yanlış!']);
    }

    public function editUser($id){
        $user = \App\Models\User::findOrFail($id);
        return view('user.editUser',compact('user'));
    }
    public function updateUser(Request $request, $id){
        $user = \App\Models\User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username'. $user->id , 
            'email' => 'required|email|unique:users,email'. $user->id ,
        ], [
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'email.unique' => 'Bu e-posta zaten kayıtlı.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
        ]);

        $user -> username = $request->username;
        $user -> email = $request->email;
        $user -> save();
        
        return redirect()->route('listUser');
    }
    public function deleteUser(Request $request, $id){
        
        $user=\App\Models\User::findOrFail($id);
        $choices = $request->input('userID',[]);
        $user = array_diff($user,$choices); 
        if(!empty($choices)){
            User::whereIn('id', $choices)->delete();
        }
        return redirect()->route('listUser');
    }
    public function deleteListUser(){
        $user = \App\Models\User::onlyTrashed()->get();
        return view('user.deleteListUser', compact('user'));
    }
    
    public function bulkDeleteUser(Request $request)
    {
        $ids = $request->input('user_ids', []);
        $user = User::all();
        $error = null;
        $success = null;
        if (empty($ids)) {
            $error = 'Lütfen silmek için en az bir kullanıcı seçin.';
            return view('user.listUser', compact('user', 'error', 'success'));
        }
        // Admin (id=1) silinmesin
        $ids = array_filter($ids, function($id) { return $id != 1; });
        if (!empty($ids)) {
            User::whereIn('id', $ids)->delete(); // Soft delete
            $success = 'Seçilen kullanıcılar silindi.';
        } else {
            $error = 'Admin silinemez.';
        }
        $user = User::all(); // Silme sonrası güncel liste
        return view('user.listUser', compact('user', 'error', 'success'));
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


