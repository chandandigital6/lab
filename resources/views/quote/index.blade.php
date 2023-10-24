
<x-dashboard-layout>
    <x-section-content>
        <Link href="{{ route('quote.create') }}" class="bg-black text-white p-1 rounded-md">Create New</Link>
        <Link href="{{ route('enquiry-quote.create') }}" class="bg-red-500 text-white p-1 rounded-md ml-2">Quote Enqury</Link>
        <div class="flex">
            <x-splade-table :for="$quoteTable">

                <x-splade-cell action as="$quoteTable">
                    <Link href="{{ route('quote.edit',['quote'=>$quoteTable->id]) }}" class="bg-black text-white p-2 rounded-md">Edit</Link>
                    <Link href="{{ route('quote.delete',['quote'=>$quoteTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">delete</Link>
                </x-splade-cell>
            </x-splade-table>

        </div>
    </x-section-content>

</x-dashboard-layout>
