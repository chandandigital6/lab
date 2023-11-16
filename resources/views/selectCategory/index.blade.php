
<x-dashboard-layout>
    <x-section-content>
        <Link href="{{ route('selectCategory.create') }}" class="bg-black text-white p-1 rounded-md">select new</Link>
{{--        <Link href="{{ route('enquiry-quote.create') }}" class="bg-red-500 text-white p-1 rounded-md ml-2">Quote Enqury</Link>--}}
        <div class="flex">
            <x-splade-table :for="$selectCategoryTable">
                <x-splade-cell user_id as="$user">
                    {{ $user->user->name }}
                </x-splade-cell>
                <x-splade-cell product_category_id as="$product">
                    {{ $product->productCategory->category_name }}
                </x-splade-cell>
                <x-splade-cell action as="$selectCategoryTable">
{{--                    <Link href="{{ route('quote.edit',['quote'=>$quoteTable->id]) }}" class="bg-black text-white p-2 rounded-md">Edit</Link>--}}
                    <Link href="{{ route('selectCategory.delete',['selectCategory'=>$selectCategoryTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">delete</Link>
                </x-splade-cell>
            </x-splade-table>

        </div>
    </x-section-content>

</x-dashboard-layout>
