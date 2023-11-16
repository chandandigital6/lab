{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <form action="{{route('venders.store')}}" method="post">
        @csrf
        <label for="">Company name</label>
        <input type="text" name="company_name" class="form-control">
        <label for="">contact person name</label>
        <input type="text" name="contact_person_name" class="form-control" >
        <label for="">Email Id</label>
        <input type="text" name="email_id" class="form-control">
        <label for="">phone no</label>
        <input type="number" name="phone_no" class="form-control">
        <label for="">product categories</label>
        <input type="text" name="product_categories" class="form-control">
        <input type="submit" value="create" class="btn btn-primary">
    </form>
</body>
</html> --}}


@seoTitle('Create Vendor')
<x-dashboard-layout>
    <x-section-content>
        <x-splade-modal>
            <x-splade-form :for="$spladeVender"></x-splade-form>
        </x-splade-modal>
    </x-section-content>

</x-dashboard-layout>
