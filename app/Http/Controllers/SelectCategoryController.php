<?php

namespace App\Http\Controllers;

use App\Models\SelectCategory;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;


class SelectCategoryController extends Controller
{
    public function index()
    {
         $selectCategoryTable=SpladeTable::for(SelectCategory::class)
             ->column('user_id')
             ->column('product_category_id')
             ->column('action');

         return view('selectCategory.index',compact('selectCategoryTable'));
    }

    public function create()
    {

        $categories = ProductCategory::all();
        $categoryName = $categories->pluck('category_name', 'id')->toArray();
        //        dd($c);
        $selectCategoryForm = SpladeForm::make()->action(route('selectCategory.store'))->method('post')->fields([
            Select::make('product_category_id')->options($categoryName)->multiple()->placeholder('select category name'),
            Submit::make('save')->label('save')
        ]);
        return view('selectCategory.create', compact('selectCategoryForm'));
    }


    public function store(Request $request)
    {
        $user = auth()->user();

//        dd($request->product_category_id);

        foreach ($request->product_category_id as $category) {
            $selectCategory = new SelectCategory();
            $selectCategory->user_id = $user->id;
            $selectCategory->product_category_id = $category;
            $selectCategory->save();
        }
        Toast::success('Categories created successfully');
        return redirect()->back();
    }

    public function delete(SelectCategory $selectCategory){
          $selectCategory->delete();
          return redirect()->route('selectCategory.index');
    }

}
