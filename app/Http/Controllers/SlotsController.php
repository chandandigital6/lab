<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlotRequest;
use App\Models\Boxes;
use App\Models\Items;
use App\Models\slots;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\Facades\Toast;

class SlotsController extends Controller
{
    public function show(Slots $slot){
            $items = $slot->items;
          return view('slot.show',compact('items'));
    }
    public  function index(){
        $slotTable=SpladeTable::for(slots::class)
            ->column('box_id')
            ->column('occupied')
            ->column('item')
            ->column('action');
        return view('slot.index',compact('slotTable'));
    }
    public  function create(){
        $slotForm=SpladeForm::make()->action(route('slot.store'))->method('post')->fields([
          Input::make('box_id')->label('box id')->placeholder('box id')->required(),
            Input::make('occupied')->label('occupied')->placeholder('occupied')->required(),
            Input::make('item')->label('item')->placeholder('item')->required(),
            Submit::make('add slot')->label('add slot'),
        ]);
        return view('slot.create',compact('slotForm'));
    }

//    public function store(SlotRequest $request){
//           $slot=Slots::create($request->all());
//
//           return redirect()->route('slot.index');
//    }

    public function store(SlotRequest $request)
    {
        // Create a new slot
        $slot = Slots::create($request->all());

        // Get the associated box's ID from the request
        $boxId = $request->input('box_id');
        $boxSlot  = Boxes::where('id', $boxId)->first();
        $numberOfSlotsToCreate = $boxSlot->number_of_slot;

        // Find the associated box
        $box = Slots::where('box_id', $boxId)->get();
        $num_of_slot = $box->count();

        if ($num_of_slot <= $numberOfSlotsToCreate) {


        }else{
            Toast::success("only create number of: $numberOfSlotsToCreate  slots");
            return redirect()->back();
        }

        return redirect()->route('slot.index');
    }

    public function edit($slots){
        $data=Slots::find($slots);
        $slotForm=SpladeForm::make()->fill($data)->action(route('slot.update',['slots'=>$slots]))->method('put')->fields([
            Input::make('box_id')->label('box id')->placeholder('box id')->required(),
            Input::make('occupied')->label('occupied')->placeholder('occupied')->required(),
            Input::make('item')->label('item')->placeholder('item')->required(),
            Submit::make('add slot')->label('edit slot'),
        ]);
        return view('slot.edit',compact('slotForm'));
    }
    public  function update($slots, SlotRequest $request){
                   $data=Slots::find($slots);
                   $data->update($request->all());
                   return redirect()->route('slot.index');
    }
    public  function delete(Slots $slots){
         $slots->delete();
         return redirect()->route('slot.index');
    }
}
