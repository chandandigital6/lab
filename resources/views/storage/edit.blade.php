{{--<form action="{{route('storage.update',['storage'=>$storage])}}" method="POST">--}}
{{--    @csrf--}}
{{--    @method('put')--}}
{{--    <lable>Storage name</lable>--}}
{{--    <input type="text" name="name"  value="{{$storage->name}}">--}}
{{--    <input type="submit" value="create">--}}

{{--</form>--}}
<x-dashboard-layout>
    <x-section-content>
        <x-splade-modal>
            <x-splade-form :for="$storageForm"></x-splade-form>
        </x-splade-modal>
    </x-section-content>

</x-dashboard-layout>
a
