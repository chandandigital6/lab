<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryRequest;
use App\Models\QuoteEnquery;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;

class QuoteEnquiryController extends Controller
{
    public function create(){
        $EnquiryForm=SpladeForm::make()->action()->method()->fields([
           Input::make('requirement')->label('Requirement')->required(),
            Input::make('category')->label('Category')->required(),
            Input::make('quantity')->label('Quantity')->required(),
            Submit::make('create')->label('create'),
        ]);
        return view('enquiry.create',compact('EnquiryForm'));
    }
    public function store(EnquiryRequest $request){
           $quoteEnquiry=QuoteEnquery::create($request->all());
    }
}
