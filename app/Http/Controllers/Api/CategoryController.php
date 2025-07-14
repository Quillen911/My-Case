<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryValidation\ShowCategoryRequest;
use App\Http\Requests\CategoryValidation\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller{
    public function index()
    {
        return response()->json(Category::all());
    }

    public function show($id)
    {
        $category = Category::find($id);
        if(! $category){
            return response()->json(['message' => 'Kategori bulunamadı'],404);
        }
        return response()->json($category);
    }

    public function store(ShowCategoryRequest $request)
    {
        $category = Category::create([
            'categoryTitle' => $request->categoryTitle,
            'categoryDesc' => $request->categoryDesc,
            'categoryStatus' =>$request->categoryStatus,
        ]);
        return response()->json($category,201);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json(['message' => 'Kategori bulunamadı'],404);
        }
        $category->update($request->only(['categoryTitle', 'categoryDesc', 'categoryStatus']));
        return response()->json(['message' => 'Kategori başarıyla güncellendi', 'category' => $category]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json(['message' => 'Kategori bulunamadı'],404);
        }
        $category->delete();
        return response()->json(['message' => 'Kategori Silindi']);
    }

}