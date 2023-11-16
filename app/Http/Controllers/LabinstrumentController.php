<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabInstrumentRequest;
use App\Models\LabInstrument;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Date as FormBuilderDate;
use ProtoneMedia\Splade\FormBuilder\Email;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\File;
use ProtoneMedia\Splade\FormBuilder\Date;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeTable;


class LabinstrumentController extends Controller
{
    public function index()
    {
        $labInstruments = SpladeTable::for(LabInstrument::class)
            ->column('instrument_name')
            ->column('date_of_purchase')
            ->column('supplier_company_name')
            ->column('warranty_period')
            ->column('company_name')
            ->column('engineer_name')
            ->column('email_id')
            ->column('phone_no')
            ->column('company_contact_no')
            ->column('po_invoice_no')
            ->column('instrument_photo')
            ->column('bought_from_research_project_fund_name')
            ->column('calibration_detail')
            ->column('calibration_detail_image')
            ->column('instrument_training_manual_protocol')
            ->column('instrument_working_status')
            ->column('instrument_periodical_service_date')
            ->column('action')
            ->paginate(10);
        return view('labinstrument.index', compact('labInstruments'));
    }
    public function create()
    {
        $spladeInstrumentForm = SpladeForm::make()
            ->action(route('labInstrument.store'))->method('post')
            ->fields([

                Input::make('instrument_name')->label('Instrument name')->placeholder('enter instrument name')->required(),
                Date::make('date_of_purchase')->label('Date of purchase')->placeholder('enter date of purchase')->required(),
                Input::make('supplier_company_name')->label('Supplier company name')->required(),
                Date::make('warranty_period')->label('Warranty period')->placeholder('enter warranty period')->required(),
                Input::make('company_name')->label('Company name')->placeholder('enter company name')->required(),
                Input::make('engineer_name')->label('Engineer name')->placeholder('enter engineer name')->required(),
                Email::make('email_id')->label('Email id')->placeholder('enter email id')->required(),
                Input::make('phone_no')->label('Phone no')->placeholder('enter phone no')->required(),
                Input::make('company_contact_no')->label('Company contact no')->placeholder('enter company contact no')->required(),
                Input::make('po_invoice_no')->label('PO invoice no')->placeholder('enter po invoice no')->required(),
                File::make('instrument_photo')->label('Instrument photo')->required(),
                Input::make('bought_from_research_project_fund_name')->label('Bought from research project fund name')->required(),
                File::make('calibration_detail_image')->label('Calibration detail image')->required(),

                Input::make('calibration_detail')->label('OR  calibration detail')->placeholder('calibration detail')->required(),
                Input::make('instrument_training_manual_protocol')->label('Instrument training manual protocol')->placeholder('instrument training manual protocol')->required(),
                File::make('instrument_training_manual_protocol_image')->label('OR instrument training manual protocol')->required(),

//                Input::make('instrument_training_manual_protocol')->label('instrument_training_manual_protocol')->placeholder('instrument_training_manual_protocol')->required(),
                Input::make('instrument_working_status')->label('Instrument working status')->placeholder('instrument working status')->required(),
                Date::make('instrument_periodical_service_date')->label('Instrument periodical service date')->placeholder('instrument periodical service date')->required(),


                Submit::make('Add Instrument')->label('Add Instrument'),
            ]);
        return view('labinstrument.create')->with('spladeInstrumentForm', $spladeInstrumentForm);
    }

//    public function store(LabInstrumentRequest $request)
//    {
//        $labInstrument = labInstrument::create($request->all());
//        $image = $request->file('instrument_photo')->store('public/instrumentPhoto');
//        $labInstrument->instrument_photo = str_replace('public/', '', $image);
//        $labInstrument->save();
//        return redirect()->route('labInstrument.index');
//    }
    public function store(LabInstrumentRequest $request)
    {
        try {
                // Validate the request and create a new LabInstrument instance
                $labInstrument = LabInstrument::create($request->except('instrument_photo', 'calibration_detail_image', 'instrument_training_manual_protocol_image'));

                // Handle 'instrument_photo' upload
                if ($request->hasFile('instrument_photo')) {
                    $image = $request->file('instrument_photo')->store('public/instrumentPhoto');
                    $labInstrument->instrument_photo = str_replace('public/', '', $image);
                }

                // Handle 'calibration_detail_image' upload
                if ($request->hasFile('calibration_detail_image')) {
                    $image = $request->file('calibration_detail_image')->store('public/calibrationDetailImage');
                    $labInstrument->calibration_detail_image = str_replace('public/', '', $image);
                }

                // Handle 'instrument_training_manual_protocol_image' upload
                if ($request->hasFile('instrument_training_manual_protocol_image')) {
                    $image = $request->file('instrument_training_manual_protocol_image')->store('public/trainingManualImage');
                    $labInstrument->instrument_training_manual_protocol_image = str_replace('public/', '', $image);
                }

                // Save the LabInstrument instance
                $labInstrument->save();

            return redirect()->route('labInstrument.index')->with('success', 'Lab Instrument created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('labInstrument.create')->with('error', 'Failed to create Lab Instrument. Please try again.');
        }
    }

    public function edit($labInstrument)
    {

        $data = LabInstrument::find($labInstrument);
        $spladeInstrumentForm = SpladeForm::make()
        ->fill($data)
            ->action(route('labInstrument.update',['labInstrument'=>$labInstrument]))->method('put')
            ->fields([

                Input::make('instrument_name')->label('Instrument name')->placeholder('enter instrument name')->required(),
                Date::make('date_of_purchase')->label('Date of purchase')->placeholder('enter date of purchase')->required(),
                Input::make('supplier_company_name')->label('Supplier company name')->required(),
                Date::make('warranty_period')->label('Warranty period')->placeholder('enter warranty period')->required(),
                Input::make('company_name')->label('Company name')->placeholder('enter company name')->required(),
                Input::make('engineer_name')->label('Engineer name')->placeholder('enter engineer name')->required(),
                Email::make('email_id')->label('Email id')->placeholder('enter email id')->required(),
                Input::make('phone_no')->label('Phone no')->placeholder('enter phone no')->required(),
                Input::make('company_contact_no')->label('Company contact no')->placeholder('enter company contact no')->required(),
                Input::make('po_invoice_no')->label('PO invoice no')->placeholder('enter po invoice no')->required(),
                File::make('instrument_photo')->label('Instrument photo')->required()->filepond(),
                Input::make('bought_from_research_project_fund_name')->label('Bought from research project fund name')->required(),
                File::make('calibration_detail_image')->label('calibration_detail_image')->required()->filepond(),
                Input::make('calibration_detail')->label('Calibration detail')->placeholder('Calibration detail')->required(),
                File::make('instrument_training_manual_protocol_image')->label('Instrument training manual protocol image')->required()->filepond(),
                Input::make('instrument_training_manual_protocol')->label('Instrument training manual protocol')->placeholder('instrument training manual protocol')->required(),
                Input::make('instrument_working_status')->label('Instrument working status')->placeholder('instrument working status')->required(),
                Date::make('instrument_periodical_service_date')->label('Instrument periodical service date')->placeholder('instrument periodical service date')->required(),


                Submit::make('Add Instrument')->label('update Instrument'),
            ]);
        return view('labinstrument.edit', compact('labInstrument'))->with('spladeInstrumentForm',$spladeInstrumentForm);
    }
    public function update(LabInstrument $labInstrument, LabInstrumentRequest $request)
    {
        $labInstrument->update($request->all());
        $request->hasFile('instrument_training_manual_protocol_image') ? $labInstrument->update(['instrument_training_manual_protocol_image' => str_replace('public/', '', $request->file('instrument_training_manual_protocol_image')->store('public/trainingManualImage'))]) : '';
        $request->hasFile('calibration_detail_image') ? $labInstrument->update(['calibration_detail_image' => str_replace('public/', '', $request->file('calibration_detail_image')->store('public/calibrationDetailImage'))]) : '';
        $request->hasFile('instrument_photo') ? $labInstrument->update(['instrument_photo' => str_replace('public/', '', $request->file('instrument_photo')->store('public/instrumentPhoto'))]) : '';
        $labInstrument->save();
        return redirect()->route('labInstrument.index');
    }



    public function delete(LabInstrument $labInstrument)
    {
        $labInstrument->delete();
        return redirect()->route('labInstrument.index');
    }
}
