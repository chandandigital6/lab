

<x-dashboard-layout>
    <x-section-content>
        <Link href="{{ route('product-category.create') }}" class="bg-black text-white p-1 rounded-md">Create New</Link>
        <Link href="{{ route('selectCategory.create') }}" class="bg-black text-white p-1 rounded-md">Select Category</Link>
{{--        <Link href="{{ route('enquiry-quote.create') }}" class="bg-red-500 text-white p-1 rounded-md ml-2">Quote Enqury</Link>--}}
        <div class="flex">
            <x-splade-table :for="$productCategoryTable">
{{--                <x-splade-cell user_id as="$user">--}}
{{--                    {{ $user->user->name }}--}}
{{--                </x-splade-cell>--}}

                <x-splade-cell action as="$productCategoryTable">
                    <Link href="{{ route('product-category.edit',['productCategory'=>$productCategoryTable->id]) }}" class="bg-black text-white p-2 rounded-md">Edit</Link>
                    <Link href="{{ route('product-category.delete',['productCategory'=>$productCategoryTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">delete</Link>
                </x-splade-cell>
            </x-splade-table>

        </div>
    </x-section-content>

</x-dashboard-layout>
