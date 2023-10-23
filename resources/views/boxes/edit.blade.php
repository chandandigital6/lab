{{--<form action="{{route('boxes.update',['boxes'=>$boxes])}}" method="post">--}}
{{--    @csrf--}}
{{--    @method('put')--}}
{{--    <label for="">storage_id</label>--}}
{{--    <input type="text" name="storage_id" value="{{$boxes->storage_id}}">--}}
{{--    <br>--}}
{{--    <label for="">boxes_name</label>--}}
{{--    <input type="text" name="boxes_name" value="{{$boxes->boxes_name}}" >--}}
{{--    <br>--}}
{{--    <label for="">boxes_categories</label>--}}
{{--    <input type="text" name="boxes_categories" value="{{$boxes->boxes_categories}}">--}}
{{--    <br>--}}
{{--    <label for="">number_of_boxes</label>--}}
{{--    <input type="number" name="number_of_boxes" value="{{$boxes->number_of_boxes}}">--}}
{{--    <br>--}}
{{--    <input type="submit" value="update">--}}
{{--    --}}{{-- <button type="submit">create</button> --}}
{{--</form>--}}


<x-dashboard-layout>
    <x-section-content>
        <x-splade-modal>
            <x-splade-form :for="$boxesTable"></x-splade-form>
        </x-splade-modal>
    </x-section-content>

</x-dashboard-layout>
