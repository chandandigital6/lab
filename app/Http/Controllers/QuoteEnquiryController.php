<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Mail\EnquiryQuote;
use App\Mail\QuoteEnquiry;
use App\Models\ProductCategory;
use App\Models\QuoteEnquery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;

class QuoteEnquiryController extends Controller
{
    public function index(){
        $enquiryTable=SpladeTable::for(QuoteEnquery::class)
            ->column('id')
            ->column('requirement')
            ->column('productCategory_id', 'Category')
            ->column('quantity')
            ->column('msg','Massage')
            ->column('action');
        return view('enquiry.index',compact('enquiryTable'));
    }
    public function create(){
           $productCategory=ProductCategory::all();
        $userOption = $productCategory->pluck('category_name','id')->toArray();

        $EnquiryForm=SpladeForm::make()->action(route('enquiry-quote.store'))->method('post')->fields([
           Input::make('requirement')->label('Requirement')->required(),
            Select::make('ProductCategory_id')
                ->label('Product category')
                ->options($userOption)->required(),
//            Input::make('category')->label('Category')->required(),
            Input::make('quantity')->label('Quantity')->required(),
            Input::make('msg')->label('Massage')->required(),
            Submit::make('create')->label('create'),
        ]);
        return view('enquiry.create',compact('EnquiryForm'));
    }
    public function store(EnquiryRequest $request){

        $enquiry = QuoteEnquery::create($request->all());
        $msg = 'sdklfjkdlajfklvn ojdkljfkdaj oijdlkjiovfnaxvc kjoeirdfv ioerdjfvnkcl xhrfdiovn ,adcoijqoiednv c';
        Mail::to('vinuthecoder@gmail.com')->send(new EnquiryQuote($msg));
        Toast::success('successfully created quote enquiry');
          return redirect()->route('enquiry-quote.index');

    }
    public function edit($quotEnquiry){
        $productCategory=ProductCategory::all();
        $userOption = $productCategory->pluck('category_name','id')->toArray();
        $quotEnquiry=QuoteEnquery::find($quotEnquiry);
        $EnquiryForm=SpladeForm::make()->fill($quotEnquiry)->action(route('enquiry-quote.update',['quotEnquiry'=>$quotEnquiry->id]))->method('put')->fields([
            Input::make('requirement')->label('Requirement')->required(),
            Select::make('ProductCategory_id')
                ->label('Product category')
                ->options($userOption)->required(),
            Input::make('quantity')->label('Quantity')->required(),
            Input::make('msg')->label('Massage')->required(),

            Submit::make('edit')->label('edit'),
        ]);
        return view('enquiry.edit',compact('EnquiryForm'));
    }
    public function update(QuoteEnquery $quotEnquiry ,EnquiryRequest $request){
        $quotEnquiry->update($request->all());
        Toast::success('successfully updated quote enquiry');
        return redirect()->route('enquiry-quote.index');

    }

    public function delete(QuoteEnquery $quotEnquiry){
        $quotEnquiry->delete();
        Toast::success('successfully deleted quote enquiry');

        return redirect()->route('enquiry-quote.index');
    }
}
