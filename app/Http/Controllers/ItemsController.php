<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Items;
use App\Models\Slots;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\FormBuilder\File;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;

class ItemsController extends Controller
{


    public function index(){
        $itemTable=SpladeTable::for(Items::class)->
            column('name')
            ->column('item_photo')
            ->column('slot_id')
        ->column('action');

        return view('item.index',compact('itemTable'));
    }
    public function create(){
//        $slot=Slots::all();
//        $slotOp=$slot->pluck('')
            $itemForm=SpladeForm::make()->action(route('item.store'))->method('post')->fields([
                 Input::make('name')->placeholder('enter item name')->label('name')->required(),
                File::make('item_photo')->label('item image')->required(),
                Input::make('slot_id')->label('slot id')->placeholder('slot id')->required(),
                Submit::make('item')->label('item_create'),
            ]);
            return view('item.create',compact('itemForm'));
    }
    public function store(ItemRequest $request){
       $itemimage=Items::create($request->all());
        $image = $request->file('item_photo')->store('public/itemPhoto');
        $itemimage->item_photo = str_replace('public/', '', $image);
        $itemimage->save();
        return redirect()->route('item.index');

    }
    public function edit($item){
        $data=Items::find($item);
        $itemForm=SpladeForm::make()->fill($data)->action(route('item.update',['item'=>$item]))->method('put')->fields([
            Input::make('name')->placeholder('enter item name')->label('name')->required(),
            File::make('item_photo')->label('item image')->filepond(),
            Input::make('slot_id')->label('slot id')->placeholder('slot id')->required(),
            Submit::make('item')->label('item_create'),
        ]);
        return view('item.edit',compact('itemForm'));
    }
       public function update(Items $item ,ItemRequest $request){
            $item->update($request->all());
           $request->hasFile('item_photo') ? $item->update(['item_photo' => str_replace('public/', '', $request->file('item_photo')->store('public/itemPhoto'))]) : '';
           $item->save();
           return redirect()->route('item.index');
       }
    public function delete(Items $item){
             $item->delete();
             return redirect()->route('item.index');
    }

}
