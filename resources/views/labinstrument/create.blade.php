{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Create</title>
</head>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-dark text-center text-white p-3 ">
                <h3>Lab Instrument Create </h3>
            </div>
            <form action="{{route('labInstrument.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="">Instrument name </label>
                <input type="text" name="instrument_name" class="form-control">
                <label for="">Date of purchase</label>
                <input type="date" name="date_of_purchase" class="form-control">
                <label for="">Supplier company name</label>
                <input type="text" name="supplier_company_name" class="form-control">
                <label for="">Warranty period</label>
                <input type="date" name="warranty_period" class="form-control">
                <label for="">Company name</label>
                <input type="text" name="company_name" class="form-control">
                <label for="">Engineer name</label>
                <input type="text" name="engineer_name" class="form-control">
                <label for="">Email id</label>
                <input type="text" name="email_id" class="form-control">
                <label for="">Phone no</label>
                <input type="text" name="phone_no" class="form-control">
                <label for="">Company contact no</label>
                <input type="text" name="company_contact_no" class="form-control">
                <label for="">Po invoice no</label>
                <input type="text" name="po_invoice_no" class="form-control">
                <label for="">instrument_photo</label>
                <input type="file" name="instrument_Photo" class="form-control">
                <label for="">bought_from_research_project_fund_name</label>
                <input type="text" name="bought_from_research_project_fund_name" class="form-control">
                <label for="">calibration_detail</label>
                <input type="text" name="calibration_detail" class="form-control">
                <label for="">instrument_training_manual_protocol</label>
                <input type="text" name="instrument_training_manual_protocol" class="form-control">
                <label for="">instrument_working_status</label>
                <input type="text" name="instrument_working_status" class="form-control">
                <label for="">instrument_periodical_service_date</label>
                <input type="date" name="instrument_periodical_service_date" id="" class="form-control">
                <input type="submit" value="Create" class="btn btn-primary mt-2 w-100">
            </form>
        </div>
    </div>
</div>
</body>

</html> --}}


<x-dashboard-layout>
    <x-section-content>
        <x-splade-modal>
            <x-splade-form :for="$spladeInstrumentForm"></x-splade-form>
        </x-splade-modal>
    </x-section-content>

</x-dashboard-layout>
