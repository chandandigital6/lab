<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendersRequest;
use App\Models\ProductCategory;
use App\Models\Vender;
use Illuminate\Http\Request;

use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\FormBuilder\Input;


class VenderController extends Controller
{
    public function index()
    {
        $venders = SpladeTable::for(Vender::class)
            ->column('company_name')
            ->column('contact_person_name')
            ->column('email_id')
            ->column('phone_no')
            ->column('product_categories')
            ->column('action')
            ->paginate(10);

        return view('vender.index', compact('venders'));
    }
    public  function create()
    {
        $spladeVender = SpladeForm::make()->action(route('vender.store'))->method('post')->fields([
            Input::make('company_name')->label('Company Name')->required()->placeholder('Company Name'),
            Input::make('contact_person_name')->label('Contact Person Name')->placeholder('Contact Person Name')->required(),
            Input::make('email_id')->label('Email Id')->placeholder('Email ID')->required(),
            Input::make('phone_no')->label('Phone Number')->placeholder('Phone Number')->required(),
            Select::make('product_categories')->options(ProductCategory::all()->toArray())->optionLabel('category_name')->optionValue('id')->label('Product Categories')->placeholder(' Select Product Categories')->choices()->multiple()->required(),
            Submit::make('Add vender')->label('Add Vender'),
        ]);
        return view('vender.create')->with('spladeVender', $spladeVender);
    }
    public function store(VendersRequest $request)
    {
        $request->merge(['product_categories'=> json_encode($request->product_categories)]);
        $vender = Vender::create($request->all());
        return redirect()->route('vender.index');
    }
    public function edit( $vender)
    {
        $data = Vender::find($vender);
        $spladeVender = SpladeForm::make()
        ->fill($data)
        ->action(route('vender.update',['vender'=>$vender]))->method('put')->fields([
            Input::make('company_name')->label('company_name')->required()->placeholder('enter company_name'),
            Input::make('contact_person_name')->label('contact_person_name')->placeholder('enter contact_person_name')->required(),
            Input::make('email_id')->label('email_id')->placeholder('enter email_id')->required(),
            Input::make('phone_no')->label('phone_no')->placeholder('enter phone_no')->required(),
            Input::make('product_categories')->label('product_categories')->placeholder('enter product_categories')->required(),
            Submit::make('Add vender')->label('update vender'),
        ]);
        return view('vender.edit', compact('spladeVender'));
    }
    public function update(Vender $vender, VendersRequest $request)
    {

        $vender->update($request->all());
        return redirect()->route('vender.index');
    }

    // public function delete($id){
    //     $vender = Vender::find($id);
    //     $vender->delete($id);
    //     return redirect()->route('venders.index');
    // }

    public function delete(Vender $vender)
    {
                $vender->delete();
        return redirect()->route('vender.index');
    }
}
