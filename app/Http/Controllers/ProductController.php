<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductValidation\ShowProductRequest;
use App\Http\Requests\ProductValidation\UpdateProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller{
    public function add(){
        $categories= Category::all();
        return view('product.add', compact('categories'));
    }
    public function addpost(ShowProductRequest $request){
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
    public function listProduct()
    {
        $product = Product::all();
        $categories = Category::all();
        return view('product.list', compact('product', 'categories'));
    }
    public function deleteProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('list');
    }
    public function editProduct($id){
        $product = \App\Models\Product::findOrFail($id);
        return view('product.editProduct', compact('product'));
    }
    public function updateProduct(UpdateProductRequest $request, $id)
    {
        $product =Product::findOrFail($id);
        $product->update([
            'productTitle' => $request->productTitle,
            'productCategoryId' => $request->productCategoryId,
            'productBarcode' => $request->productBarcode,
            'productStatus' => $request->productStatus,
        ]);
        return view('product.editProduct', [
            'product' => $product,
            'success' => 'Ürün başarıyla güncellendi.'
        ]);
    }
    public function productListDeleted()
    {
        $categories = Category::all();
        $product= \App\Models\Product::onlyTrashed()->get();
        return view('product.productListDeleted', compact('product','categories'));
    }
}