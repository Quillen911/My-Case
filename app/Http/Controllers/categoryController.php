<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class categoryController extends Controller{
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
    public function listCategory(){
        $category = Category::all();
        return view('category.listCategory', compact('category'));
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
}