{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <title>Document</title>--}}
{{--</head>--}}
{{--<body>--}}
{{--   <div class="container">--}}
{{--         <div class="row">--}}
{{--            <div class="col-md-6">--}}
{{--                @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--                <form action="{{route('quote.store')}}" method="POST">--}}
{{--                    --}}
{{--                    @csrf--}}
{{--                   <label for="">user id</label>--}}
{{--                  <input type="text" name="user_id" class="form-control">--}}
{{--                    <label for="">quotation_submitted</label>--}}
{{--                    <input type="text" name="quotation_submitted" class="form-control">--}}
{{--                   --}}
{{--                    <label for="">accepted_quotation</label>--}}
{{--                    <input type="text" name="accepted_quotation" class="form-control">--}}
{{--                    <label for="">product_status_sheet_delivered</label>--}}
{{--                    <input type="text" name="product_status_sheet_delivered" class="form-control">--}}
{{--                    <label for="">delivery_time</label>--}}
{{--                    <input type="time" name="delivery_time" class="form-control">--}}
{{--                    <label for="">stock_status</label>--}}
{{--                    <input type="text" name="stock_status" class="form-control">--}}
{{--                    <input type="submit" value="Create" class="btn btn-success">--}}
{{--                </form>--}}
{{--            </div>--}}
{{--         </div>--}}
{{--   </div>--}}
{{--</body>--}}
{{--</html>--}}




<x-dashboard-layout>
    <x-section-content>
        <x-splade-modal>
            <x-splade-form :for="$quoteForm"></x-splade-form>
        </x-splade-modal>
    </x-section-content>

</x-dashboard-layout>
a
