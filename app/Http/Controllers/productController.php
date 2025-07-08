<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class productController extends Controller{
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