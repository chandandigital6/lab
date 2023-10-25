<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Models\LabInstrument;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;

use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Number;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Time;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;



class QuoteController extends Controller
{

  public function index(){
      $quoteTable=SpladeTable::for(Quote::class)
          ->column('user_id','User name')
          ->column('quotation_submitted')
          ->column('accepted_quotation')
          ->column('product_status_sheet_delivered')
          ->column('delivery_time')
          ->column('stock_status')
          ->column('action');
       return view('quote.index',compact('quoteTable'));

  }
    public function create(){
        $user = User::all();
        $userOption = $user->pluck('name','id')->toArray();

        $quoteForm = SpladeForm::make()->action(route('quote.store'))->method('post')->fields([
            Select::make('user_id')
                ->label('user name')
                ->options($userOption)->required(),
            Input::make('quotation_submitted')->label('quotation_submitted')->placeholder('enter quotation_submitted')->required(),
            Input::make('accepted_quotation')->label('accepted_quotation')->placeholder('enter accepted_quotation')->required(),
            Input::make('product_status_sheet_delivered')->label('product_status_sheet_delivered')->placeholder('product_status_sheet_delivered')->required(),
            Time::make('delivery_time')->label('delivery time')->placeholder('enter deliver time')->required(),
            Input::make('stock_status')->label('stock_status')->placeholder('enter stock_status')->required(),
            Submit::make('add quote')->label('add quote')
        ]);

        return view('quote.create', compact('quoteForm'));
    }

  public function store(QuoteRequest $request){
    $quote=Quote::create($request->all());
  return redirect('quote/index');

  }
  public function edit($quote){
      $user = User::all();
      $userOption = $user->pluck('name','id')->toArray();
    $data=Quote::find($quote);
      $quoteForm=SpladeForm::make()->fill($data)
          ->action(route('quote.update',['quote'=>$quote]))
          ->method('put')->fields([
              Select::make('user_id')
                  ->label('user name')
                  ->options($userOption)->required(),
          Input::make('quotation_submitted')->label('quotation_submitted')->placeholder('enter quotation_submitted')->required(),
          Input::make('accepted_quotation')->label('accepted_quotation')->placeholder('enter accepted_quotation')->required(),
          Input::make('product_status_sheet_delivered')->label('product_status_sheet_delivered')->placeholder('product_status_sheet_delivered')->required(),
          Time::make('delivery_time')->label('delivery time')->placeholder('enter deliver time')->required(),
          Input::make('stock_status')->label('stock_status')->placeholder('enter stock_status')->required(),
          Submit::make('update quote')->label('update quote')
      ]);
    return view('quote.edit',compact('quoteForm'));
  }
  public function update($quote,QuoteRequest $request){
      $model = Quote::find($quote);
           $model->update($request->all());
           return redirect()->route('quote.index');

  }
  public function delete(Quote $quote){
        $quote->delete();
        return redirect()->route('quote.index');
  }
}
