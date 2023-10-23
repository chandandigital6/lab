<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoxesRequest;
use App\Models\Boxes;
use App\Models\Slots;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Number;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;

class BoxesController extends Controller
{

    public function showBoxesWithslot(Boxes $box)
    {
        $slots = $box->slots;

        return view('boxes.show', compact('slots'));
    }


//    public function showBoxesWithslot($boxes)
//    {
//        $data=Boxes::find($boxes);
////        $boxesTable = SpladeTable::for( Slots::all()->where('box_id',$boxes))
////            ->column('box_id')
////            ->column('occupied') // Access the related boxes' columns using dot notation
////            ->column('item');
//////            ->column('number_of_boxes');
//
//        return view('boxes.show', compact('data'));
//    }
    public function index(){
//        $boxesWithSlots = Boxes::has('slots')->get();
        $boxesTable=SpladeTable::for(Boxes::class)

            ->column('storage_id')
            ->column('boxes_name')
            ->column('boxes_categories')
            ->column('number_of_boxes')
            ->column('number_of_slot')
            ->column('action');
//        $boxes=Boxes::all();
        return view('boxes.index',compact('boxesTable'));
    }
    public function create(){
        $boxesTable=SpladeForm::make()->action(route('boxes.store'))->method('post')->fields([
              Input::make('storage_id')->label('storage id')->placeholder('enter storage id')->required(),
            Input::make('boxes_name')->label('boxes_name')->placeholder('boxes_name')->required(),
            Input::make('boxes_categories')->label('boxes_categories')->placeholder('boxes_categories')->required(),
            Number::make('number_of_boxes')->label('number_of_boxes')->required('number_of_boxes'),
            Input::make('number_of_slot')->label('number_of_slot')->placeholder('number_of_slot')->required(),

            Submit::make('boxes')->label('Add Boxes')
        ]);
        return view('boxes.create',compact('boxesTable'));
    }
    public function store(BoxesRequest $request){
        $boxes=Boxes::create($request->all());
        return redirect()->route('boxes.index');
    }

    public function edit( $box){
        $data=Boxes::find($box);
        $boxesTable=SpladeForm::make()->fill($data)->action(route('boxes.update',['box'=>$box]))->method('put')->fields([
            Input::make('storage_id')->label('storage id')->placeholder('enter storage id')->required(),
            Input::make('boxes_name')->label('boxes_name')->placeholder('boxes_name')->required(),
            Input::make('boxes_categories')->label('boxes_categories')->placeholder('boxes_categories')->required(),
            Number::make('number_of_boxes')->label('number_of_boxes')->required('number_of_boxes'),
            Submit::make('boxes')->label('update Boxes')
        ]);
        return view('boxes.edit',compact('boxesTable'));
    }
    public function update(Boxes $box, BoxesRequest $request){
           $box->update($request->all());

           return redirect()->route('boxes.index');
    }

    public function delete(Boxes $box){
        $box->delete();
        return redirect()->route('boxes.index');
    }
}
