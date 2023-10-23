

{{--<h2>Boxes:</h2>--}}
{{--<ul>--}}
{{--    @foreach($storage->boxes as $box)--}}
{{--        <li>--}}
{{--            Box Name: {{ $box->boxes_name }}--}}
{{--            Categories: {{ $box->boxes_categories }}--}}
{{--            Number of Boxes: {{ $box->number_of_boxes }}--}}
{{--        </li>--}}
{{--    @endforeach--}}
{{--</ul>--}}


{{--<x-dashboard-layout>--}}
{{--    <x-section-content>--}}
{{--        <x-splade-table :for="$storage">--}}

{{--        </x-splade-table>--}}
{{--    </x-section-content>--}}

{{--</x-dashboard-layout>--}}


<x-dashboard-layout>
    <x-section-content>
        <x-splade-table :for="$storageTable">
            <!-- Define the table columns -->
            <x-splade-cell action as="$boxesTable">
                <Link href="{{ route('boxes.show',['box'=>$boxesTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">show slot</Link>
            </x-splade-cell>

        </x-splade-table>
    </x-section-content>
</x-dashboard-layout>
