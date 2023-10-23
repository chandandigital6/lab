{{--<form action="{{route('boxes.store')}}" method="post">--}}
{{--    @csrf--}}
{{--    <label for="">storage_id</label>--}}
{{--    <input type="text" name="storage_id">--}}
{{--    <br>--}}
{{--    <label for="">boxes_name</label>--}}
{{--    <input type="text" name="boxes_name" >--}}
{{--    <br>--}}
{{--    <label for="">boxes_categories</label>--}}
{{--    <input type="text" name="boxes_categories">--}}
{{--    <br>--}}
{{--    <label for="">number_of_boxes</label>--}}
{{--    <input type="number" name="number_of_boxes">--}}
{{--    <br>--}}
{{--    <input type="submit" value="create">--}}
{{--    --}}{{-- <button type="submit">create</button> --}}
{{--</form>--}}



<x-dashboard-layout>
    <x-section-content>
        <x-splade-modal>
            <x-splade-form :for="$boxesTable"></x-splade-form>
        </x-splade-modal>
    </x-section-content>

</x-dashboard-layout>
