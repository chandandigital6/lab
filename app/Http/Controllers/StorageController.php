<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageRequest;
use App\Models\Boxes;
use App\Models\Storage;
use Illuminate\Http\Request;

use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;
use function Ramsey\Uuid\v1;

class StorageController extends Controller
{

    public function showStorageWithBoxes($storage)
    {
        // Retrieve the Storage record with its associated Boxes using Eloquent


        // Create a SpladeTable instance for the retrieved data
        $storageTable = SpladeTable::for( Boxes::all()->where('storage_id',$storage))
            ->column('storage_id')
            ->column('boxes_name') // Access the related boxes' columns using dot notation
            ->column('boxes_categories')
            ->column('number_of_boxes')
        ->column('action');

        return view('storage.show', compact('storageTable'));
    }
//    public function showStorageWithBoxes($storage)
//    {
//        $storage = SpladeTable::for(Storage::with('boxes')->find($storage))
//            ->column('name')
//        ->column('boxes_name')
//        ->column('boxes_categories')
//        ->column('number_of_boxes');
//
//        return view('storage.show', compact('storage'));
//    }
    public function index(){
        $storageTable=SpladeTable::for(Storage::class)
            ->column('name')
        ->column('action');
        return view('storage.index',compact('storageTable'));
    }
    public function create(){
         $storageForm=SpladeForm::make()->action(route('storage.store'))->method('post')->fields([
             Input::make('name')->label('storage')->placeholder('enter storage name')->required(),
             Submit::make('add storage')->label('Add storage'),
         ]);
        return view('storage.create',compact('storageForm'));

    }
    public  function store(StorageRequest $request){
          $storage=Storage::create($request->all());
          return redirect()->route('storage.index');
    }
    public function edit($storage){
        $data=Storage::find($storage);
        $storageForm=SpladeForm::make()->fill($data)->action(route('storage.update',['storage'=>$storage]))->method('put')->fields([
            Input::make('name')->label('storage')->placeholder('enter storage name')->required(),
            Submit::make('add storage')->label('Update storage'),
        ]);
        return view('storage.edit',compact('storageForm'));
    }
   public function update(Storage $storage, StorageRequest $request){
      $storage->update($request->all());
      return redirect()->route('storage.index');
   }

   public function delete(Storage $storage){
    $storage->delete();
    return redirect()->route('storage.index');
   }
}
