<x-dashboard-layout>
    <x-section-content>
        <Link href="{{route('item.create')}}" class="bg-black text-white p-1 rounded-md">Create New</Link>

        <div class="flex ">
            <x-splade-table :for="$itemTable">
                <x-splade-cell item_photo as="$itemimage">
                    <img src="{{asset('storage/'.$itemimage->item_photo)}}" alt="" style="width: 100px;">
                </x-splade-cell>
                <x-splade-cell action as="$itemTable">
                    <Link href="{{ route('item.edit',['item'=>$itemTable->id]) }}" class="bg-black text-white p-2 rounded-md">Edit</Link>
                    <Link href="{{ route('item.delete',['item'=>$itemTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">delete</Link>
{{--                    <Link href="{{ route('boxes.show',['boxes'=>$boxesTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">show</Link>--}}
                </x-splade-cell>

            </x-splade-table>

        </div>
    </x-section-content>

</x-dashboard-layout>
