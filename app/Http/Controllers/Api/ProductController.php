<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductValidation\UpdateProductRequest;
use App\Http\Requests\ProductValidation\ShowProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Ürün bulunamadı'], 404);
        }
        return response()->json($product);
    }

    public function store(ShowProductRequest $request)
    {
        $product = Product::create([
            'productTitle'=> $request->productTitle, 
            'productCategoryId'=> $request->productCategoryId, 
            'productBarcode'=> $request->productBarcode,
            'productStatus'=> $request->productStatus
        ]);

        return response()->json($product, 201);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Ürün bulunamadı'], 404);
        }
        $product->update($request->only(['productTitle', 'productCategoryId', 'productDesc', 'productStatus']));
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Ürün bulunamadı'], 404);
        }
        Product::where('productCategoryId', $id)->update(['productCategoryId' => null]);
        $product->delete();
        return response()->json(['message' => 'Ürün silindi']);
    }
}
