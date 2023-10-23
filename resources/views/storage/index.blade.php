
<x-dashboard-layout>
    <x-section-content>
        <Link href="{{ route('storage.create') }}" class="bg-black text-white p-1 rounded-md">Create New</Link>
        <div class="">
            <x-splade-table :for="$storageTable">

                <x-splade-cell action as="$storageTable">
                    <Link href="{{ route('storage.edit',['storage'=>$storageTable->id]) }}" class="bg-black text-white p-2 rounded-md">Edit</Link>
                    <Link href="{{ route('storage.delete',['storage'=>$storageTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">delete</Link>
                    <Link href="{{ route('storage.show',['storage'=>$storageTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">show</Link>

                </x-splade-cell>
            </x-splade-table>

        </div>
    </x-section-content>

</x-dashboard-layout>

























{{--<table >--}}
{{--    <tr>--}}
{{--        <th>Id</th>--}}
{{--        <th>Storage name</th>--}}
{{--    </tr>--}}
{{--    @foreach ($storage as $storage)--}}
{{--     <tr>--}}
{{--        <td>{{$loop->iteration}}</td>--}}
{{--        <td>{{$storage->name}}</td>--}}
{{--        <td><a href="{{route('storage.edit',['storage'=>$storage])}}">edit</a></td>--}}
{{--        <td><form action="{{route('storage.delete',['storage'=>$storage])}}" method="POST">--}}
{{--        @csrf--}}
{{--        @method('delete')--}}
{{--        <button>delete</button>--}}
{{--        </form></td>--}}
{{--     </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}
