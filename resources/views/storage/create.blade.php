{{--<form action="{{route('storage.store')}}" method="POST">--}}
{{--    @csrf--}}
{{--    <lable>Storage name</lable>--}}
{{--    <input type="text" name="name" >--}}
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
