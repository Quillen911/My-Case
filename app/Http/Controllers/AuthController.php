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
        // Hatalı girişte error mesajı ile view'a dön
        return view('auth.login', ['error' => 'Email veya şifre yanlış']);
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
        $messages = [
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'username.alpha_num' => 'Kullanıcı adı sadece harf ve rakam içermelidir.',
            'username.regex' => 'Kullanıcı adı boşluk içeremez.',
            'email.unique' => 'Bu e-posta zaten kayıtlı.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'username.required' => 'Kullanıcı adı zorunludur.',
            'email.required' => 'E-posta zorunludur.',
            'password.required' => 'Şifre zorunludur.',
            'password.regex' => 'Şifre en az 6 karakter olmalı, bir büyük harf, bir küçük harf ve bir sayı içermelidir.'
        ];

        $validator = \Validator::make($request->all(), [
            'username' => [
                'required',
                'unique:users,username',
                'alpha_num',
                'regex:/^\S+$/'
            ],
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/'
            ]
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $firstError = null;
            if ($errors->has('username')) {
                $firstError = $errors->first('username');
            } elseif ($errors->has('email')) {
                $firstError = $errors->first('email');
            } elseif ($errors->has('password')) {
                $firstError = $errors->first('password');
            }
            return view('user.addUser', [
                'error' => $firstError,
                'success' => null,
                'old' => $request->all()
            ]);
        }

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return view('user.addUser', ['success' => 'Kullanıcı başarıyla eklendi.']);
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

        $messages = [
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'username.alpha_num' => 'Kullanıcı adı sadece harf ve rakam içermelidir.',
            'username.regex' => 'Kullanıcı adı boşluk içeremez.',
            'email.unique' => 'Bu e-posta zaten kayıtlı.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'username.required' => 'Kullanıcı adı zorunludur.',
            'email.required' => 'E-posta zorunludur.',
        ];

        $validator = \Validator::make($request->all(), [
            'username' => [
                'required',
                'unique:users,username,' . $user->id,
                'alpha_num',
                'regex:/^\S+$/'
            ],
            'email' => 'required|email|unique:users,email,' . $user->id,
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $firstError = null;
            if ($errors->has('username')) {
                $firstError = $errors->first('username');
            } elseif ($errors->has('email')) {
                $firstError = $errors->first('email');
            }
            return view('user.editUser', [
                'user' => $user,
                'error' => $firstError,
                'success' => null,
            ]);
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return view('user.editUser', [
            'user' => $user,
            'success' => 'Kullanıcı başarıyla güncellendi.',
        ]);
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
        $messages = [
            'categoryTitle.required' => 'Kategori adı zorunludur.',
            'categoryTitle.unique' => 'Bu kategori adı zaten kullanılıyor.',
            'categoryDesc.required' => 'Kategori açıklaması zorunludur.',
            'categoryStatus.required' => 'Kategori durumu zorunludur.'
        ];
        $validator = \Validator::make($request->all(), [
            'categoryTitle' => 'required|unique:category,categoryTitle',
            'categoryDesc' => 'required',
            'categoryStatus' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return view('category.addCategory', [
                'error' => $validator->errors()->first(),
                'success' => null,
                'old' => $request->all()
            ]);
        }
        Category::create([
            'categoryTitle' => $request->categoryTitle,
            'categoryDesc' => $request->categoryDesc,
            'categoryStatus' =>$request->categoryStatus,
        ]);
        return view('category.addCategory', [
            'success' => 'Kategori başarıyla eklendi.',
            'old' => []
        ]);
    }
    public function editCategory($id){
        $category = \App\Models\Category::findOrFail($id);
        return view('category.editCategory', compact('category'));
    }
    public function updateCategory(Request $request, $id){
        $category = \App\Models\Category::findOrFail($id);
        $messages = [
            'categoryTitle.required' => 'Kategori adı zorunludur.',
            'categoryTitle.unique' => 'Bu kategori adı zaten kullanılıyor.',
            'categoryDesc.required' => 'Kategori açıklaması zorunludur.',
            'categoryStatus.required' => 'Kategori durumu zorunludur.'
        ];
        $validator = \Validator::make($request->all(), [
            'categoryTitle' => 'required|unique:category,categoryTitle,' .$category->id,
            'categoryDesc' => 'required',
            'categoryStatus' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $category->categoryTitle = $request->categoryTitle;
        $category->categoryDesc = $request->categoryDesc;
        $category->categoryStatus = $request->categoryStatus;
        $category->save();
        return view('category.editCategory', [
            'category' => $category,
            'success' => 'Kategori başarıyla güncellendi.'
        ]);
    }
    public function deleteCategory($id){
        $category = \App\Models\Category::findOrFail($id);
        Product::where('productCategoryId', $id)->update(['productCategoryId' => null]);
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
        $messages = [
            'productTitle.required' => 'Ürün adı zorunludur.',
            'productBarcode.required' => 'Ürün barkodu zorunludur.',
            'productBarcode.unique' => 'Bu barkod zaten kullanılıyor.',
            'productStatus.required' => 'Ürün durumu zorunludur.'
        ];
        $validator = \Validator::make($request->all(), [
            'productTitle' => 'required',
            'productCategoryId' => 'nullable',
            'productBarcode' => 'required|unique:product,productBarcode',
            'productStatus' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        Product::create([
            'productTitle' => $request->productTitle,
            'productCategoryId' => $request->productCategoryId,
            'productBarcode' => $request->productBarcode, 
            'productStatus' => $request->productStatus, 
        ]);
        $categories = Category::all();
        return view('product.add', [
            'categories' => $categories,
            'success' => 'Ürün başarıyla eklendi.'
        ]);
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
        $messages = [
            'productTitle.required' => 'Ürün adı zorunludur.',
            'productBarcode.required' => 'Ürün barkodu zorunludur.',
            'productBarcode.unique' => 'Bu barkod zaten kullanılıyor.',
            'productStatus.required' => 'Ürün durumu zorunludur.'
        ];
        $validator = \Validator::make($request->all(), [
            'productTitle' => 'required',
            'productCategoryId' => 'nullable',
            'productBarcode' => 'required|unique:product,productBarcode,' .$product->id,
            'productStatus' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $product->productTitle = $request->productTitle;
        $product->productCategoryId = $request->productCategoryId;
        $product->productBarcode = $request->productBarcode;
        $product->productStatus = $request->productStatus;
        $product->save();
        return view('product.editProduct', [
            'product' => $product,
            'success' => 'Ürün başarıyla güncellendi.'
        ]);
    }
    public function productListDeleted(){
        $categories = Category::all();
        $product= \App\Models\Product::onlyTrashed()->get();
        return view('product.productListDeleted', compact('product','categories'));
    }

}


