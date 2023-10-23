<x-dashboard-layout>

    <x-section-content>
        <x-splade-modal>
            <div class=" w-full flex justify-center mb-8">
                <div class="w-full">

                    @forelse($items as $item)
                        <div class="h-max w-full  border-b-2 border-gray-400 pl-[10px] flex gap-4 mt-[10px] p-[10px] ">
                            <a href="{{route('item.edit',['item'=>$item['id']])}}"> <i
                                    class="fa-regular fa-pen-to-square"></i> <span
                                    class="text-gray-800 lg:inline-block md:inline-block sm:inline-block hidden">Edit</span></a>
                            <a href="{{route('item.delete',['item'=>$item['id']])}}"><i
                                    class="fa-solid fa-trash-can"></i> <span
                                    class="text-gray-800 lg:inline-block md:inline-block sm:inline-block hidden">Delete</span>
                            </a>
                            <a href=""> <i class="fa-solid fa-download"></i> <span
                                    class="text-gray-800 lg:inline-block md:inline-block sm:inline-block hidden">Exports as Excel</span></a>
                            <a href=""> <i class="fa-regular fa-lock"></i> <span
                                    class="text-gray-800 lg:inline-block md:inline-block sm:inline-block hidden"> Print</span></a>
                            <a href=""> <i class="fa-solid fa-file-powerpoint"></i> <span
                                    class="text-gray-800 lg:inline-block md:inline-block sm:inline-block hidden">Print Lable</span>
                            </a>
                        </div>

                        <div class="w-full h-max flex mt-4">
                            <div class="w-[30%] p-2 bg-gray-200 pl-[10px] rounded-l-md">
                                <h1>Slot id:</h1>
                            </div>

                            <div class="w-[70%] p-2 bg-gray-100 pl-[10px]">
                                <h1 class="text-purple-900 font-semibold">{{$item['slot_id']}}</h1>
                            </div>


                        </div>

                        <div class="w-full h-max flex mt-4 ">
                            <div class="w-[30%]  bg-white pl-[10px] rounded-l-md">
                                <h1>Item Name: </h1>
                            </div>

                            <div class="w-[70%]  bg-white pl-[10px]">

                                <h1 class="text-black font-[500]">{{$item['name']}}</h1>
                            </div>

                        </div>

                        <div class="w-full h-max flex mt-4">
                            <div class="w-[30%] p-2 bg-gray-200 pl-[10px] rounded-l-md">
                                <h1>Items Photo</h1>
                            </div>

                            <div class="w-[70%] p-2 bg-gray-100 pl-[10px]">
                                <h1 class="text-black font-semibold"><img
                                        src="{{asset('storage/'.$item['item_photo'])}}" alt="img" style="width: 100px">
                                </h1>
                            </div>

                        </div>
                    @empty
                        <h1>No Items Added to this slot</h1>
                    @endforelse
                </div>

            </div>
            {{--        <x-splade-table :for="$boxesTable">--}}
            {{--                    <!-- Define the table columns -->--}}

            {{--                </x-splade-table>--}}

        </x-splade-modal>
    </x-section-content>
</x-dashboard-layout>
