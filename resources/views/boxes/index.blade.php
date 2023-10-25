{{--<a href="{{route('boxes.create')}}">add records</a>--}}
{{--<table>--}}
{{--    <tr>--}}
{{--        <th>id</th>--}}
{{--        <th>storage_id</th>--}}
{{--        <th>boxes_name</th>--}}
{{--        <th>boxes_categories</th>--}}
{{--        <th>number_of_boxes</th>--}}
{{--        <th>action</th>--}}
{{--    </tr>--}}
{{--    @foreach ($boxes as $boxes)--}}
{{--           <tr>--}}
{{--            <td>{{$loop->iteration}}</td>--}}
{{--            <td>{{$boxes->storage_id}}</td>--}}
{{--            <td>{{$boxes->boxes_name}}</td>--}}
{{--            <td>{{$boxes->boxes_categories}}</td>--}}
{{--            <td>{{$boxes->number_of_boxes}}</td>--}}
{{--            <td><a href="{{route('boxes.edit',['boxes'=>$boxes])}}">edit</a></td>--}}
{{--            <td>--}}
{{--                <form action="{{route('boxes.delete',['boxes'=>$boxes])}}" method="POST">--}}
{{--                    @csrf--}}
{{--                    @method('delete')--}}
{{--                   <button>delete</button>--}}
{{--                </form>--}}
{{--            </td>--}}
{{--           </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}



<x-dashboard-layout>
    <x-section-content>
        <Link href="{{ route('boxes.create') }}" class="bg-black text-white p-1 rounded-md">Create New</Link>

        <div class="flex ">
            <x-splade-table :for="$boxesTable">

                <x-splade-cell storage_id as="$box">
                    {{ $box->storage->name }}
                </x-splade-cell>

                <x-splade-cell action as="$boxesTable">
                    <Link href="{{ route('boxes.edit',['box'=>$boxesTable->id]) }}" class="bg-black text-white p-2 rounded-md">Edit</Link>
                    <Link href="{{ route('boxes.delete',['box'=>$boxesTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">delete</Link>
                    <Link href="{{ route('boxes.show',['box'=>$boxesTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">show</Link>
                </x-splade-cell>

            </x-splade-table>

        </div>
    </x-section-content>

</x-dashboard-layout>
