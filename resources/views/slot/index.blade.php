<x-dashboard-layout>
    <x-section-content>
        <Link href="{{ route('slot.create') }}" class="bg-black text-white p-1 rounded-md">Create New</Link>
        <div class="">
            <x-splade-table :for="$slotTable">


                <x-splade-cell action as="$slotTable">
                    <Link href="{{ route('slot.edit',['slot'=>$slotTable->id]) }}" class="bg-black text-white p-2 rounded-md">Edit</Link>
                    <Link href="{{ route('slot.delete',['slot'=>$slotTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">delete</Link>
                    <Link href="{{ route('slot.show',['slot'=>$slotTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">show</Link>

                </x-splade-cell>
            </x-splade-table>

        </div>
    </x-section-content>

</x-dashboard-layout>
