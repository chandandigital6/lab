@seoTitle('Vender List')
<x-dashboard-layout>
    <x-section-content>
        <Link href="{{ route('vender.create') }}" class="bg-black text-white p-1 rounded-md">
        Create New</Link>
        <div class="flex">
            <x-splade-table :for="$venders">
                <x-splade-cell action as="$venders">
                    <Link href="{{route('vender.edit',['vender'=>$venders->id])}}"
                          class="bg-black text-white p-2 rounded-md ">
                    Edit</Link>
                    <Link href="{{route('vender.delete',['vender'=>$venders->id])}}"
                          class="bg-red-700 text-white p-2 rounded-md ml-2">
                    delete</Link>
                </x-splade-cell>

                <x-splade-cell product_categories as="$vender">
                    <ul>
                        @foreach($vender->categories as $category)
                            <li>
                                {{ $category->category_name }}
                            </li>
                        @endforeach
                    </ul>
                </x-splade-cell>
            </x-splade-table>

        </div>
    </x-section-content>

</x-dashboard-layout>

