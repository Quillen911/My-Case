<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryValidation\ShowCategoryRequest;
use App\Http\Requests\CategoryValidation\UpdateCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller{
    public function addCategory()
    {
        return view('category.addCategory');
    }
    public function showCategory(ShowCategoryRequest $request)
    {
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
    public function listCategory()
    {
        $category = Category::withCount('product')->get();
 
        return view('category.listCategory', compact('category'));
    }
    public function editCategory($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        return view('category.editCategory', compact('category'));
    }
    public function updateCategory(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'categoryTitle' => $request->categoryTitle,
            'categoryDesc' => $request->categoryDesc,
            'categoryStatus' => $request->categoryStatus,
        ]);
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
}