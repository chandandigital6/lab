<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Textarea;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;

class ProductCategoryController extends Controller
{
    public function index(){
        $productCategoryTable=SpladeTable::for(ProductCategory::all())
            ->column('category_name')
            ->column('purpose')
            ->column('action');

   return view('productCategory.index',compact('productCategoryTable'));
    }
    public function create(){
        $productCategory=SpladeForm::make()->action(route('product-category.store'))->method('post')->fields([
            Input::make('category_name')->label('Product Category')->placeholder('enter product category name')->required(),
            Textarea::make('purpose')->label('Purpose')->placeholder('place your purpose '),
            Submit::make('Create')->label('Create '),
        ]);
        return view('productCategory.create',compact('productCategory'));
    }
    public function store(ProductCategoryRequest $request){
            $productCategory=ProductCategory::create($request->all());
            return redirect()->route('product-category.index');
    }
    public function edit($productCategory){
         $productCategory=ProductCategory::find($productCategory);
        $productCategory=SpladeForm::make()->fill($productCategory)->action(route('product-category.update',['productCategory'=>$productCategory->id]))->method('put')->fields([
            Input::make('category_name')->label('Product Category')->placeholder('enter product category name')->required(),
            Textarea::make('purpose')->label('Purpose')->placeholder('place your purpose '),
            Submit::make('Update')->label('Update '),
        ]);
        return view('productCategory.edit',compact('productCategory'));
    }
    public function update(ProductCategory $productCategory,ProductCategoryRequest $request){
           $productCategory->update($request->all());
        return redirect()->route('product-category.index');
        Toast::success('Product Category Updated');
    }
    public function delete(ProductCategory $productCategory){
             $productCategory->delete();
        return redirect()->route('product-category.index');
        Toast::success('Product Category delete');
    }
}
