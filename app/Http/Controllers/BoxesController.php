<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoxesRequest;
use App\Models\Boxes;
use App\Models\Slots;
use App\Models\Storage;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Number;
use ProtoneMedia\Splade\FormBuilder\Select;
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

            ->column('storage_id','Storage')
            ->column('boxes_name')
            ->column('boxes_categories')
            ->column('number_of_boxes')
            ->column('number_of_slot')
            ->column('action');
//        $boxes=Boxes::all();
        return view('boxes.index',compact('boxesTable'));
    }
    public function create(){
        $storages = Storage::all();
        $storageOptions = $storages->pluck('name', 'id')->toArray();
        $boxesTable = SpladeForm::make()->action(route('boxes.store'))->method('post')->fields([
            Select::make('storage_id')
                ->label('Storage name')
                ->options($storageOptions) // Use the $storageOptions array for select options
                ->required(),
            Input::make('boxes_name')->label('Boxes Name')->placeholder('Boxes Name')->required(),
            Input::make('boxes_categories')->label('Boxes Categories')->placeholder('Boxes Categories')->required(),
            Number::make('number_of_boxes')->label('Number of Boxes')->required(),
            Input::make('number_of_slot')->label('Number of Slots')->placeholder('Number of Slots')->required(),
            Submit::make('boxes')->label('Add Boxes')
        ]);
        return view('boxes.create', compact('boxesTable'));
    }


    public function store(BoxesRequest $request){
        $boxes=Boxes::create($request->all());
        return redirect()->route('boxes.index');
    }

    public function edit( $box){
        $storages = Storage::all();
        $storageOptions = $storages->pluck('name', 'id')->toArray(); // Convert the collection to an array
        $data=Boxes::find($box);
        $boxesTable=SpladeForm::make()->fill($data)->action(route('boxes.update',['box'=>$box]))->method('put')->fields([
            Select::make('storage_id')
                ->label('Storage name')
                ->options($storageOptions) // Use the $storageOptions array for select options
                ->required(),
            Input::make('boxes_name')->label('Boxes name')->placeholder('boxes name')->required(),
            Input::make('boxes_categories')->label('Boxes categories')->placeholder('Boxes categories')->required(),
            Number::make('number_of_boxes')->label('Number of boxes')->required('Number of boxes'),
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
