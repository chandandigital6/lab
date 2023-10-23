<x-dashboard-layout>

    <x-section-content>
        <div class=" w-full flex justify-center mb-8">
            <div class="w-full">
                @foreach($slots as $slot)
                    <div class="h-max w-full  border-b-2 border-gray-400 pl-[10px] flex gap-4 mt-[10px] p-[10px] ">
                        <a href="{{route('slot.edit',['slot'=>$slot['id']])}}"> <i
                                class="fa-regular fa-pen-to-square"></i> <span
                                class="text-gray-800 lg:inline-block md:inline-block sm:inline-block hidden">Edit</span></a>
                        <a href="{{route('slot.delete',['slot'=>$slot['id']])}}"><i
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
                            <h1>Box id:</h1>
                        </div>

                        <div class="w-[70%] p-2 bg-gray-100 pl-[10px]">
                            <h1 class="text-purple-900 font-semibold">{{$slot['box_id']}}</h1>
                        </div>


                    </div>

                    <div class="w-full h-max flex mt-4 ">
                        <div class="w-[30%]  bg-white pl-[10px] rounded-l-md">
                            <h1>Occupied: </h1>
                        </div>

                        <div class="w-[70%]  bg-white pl-[10px]">
                            <h1 class="text-black font-[500]">{{$slot['occupied']}}</h1>
                        </div>

                    </div>

                    <div class="w-full h-max flex mt-4">
                        <div class="w-[30%] p-2 bg-gray-200 pl-[10px] rounded-l-md">
                            <h1>Items</h1>
                        </div>

                        <div class="w-[70%] p-2 bg-gray-100 pl-[10px]">
                            <h1 class="text-black font-semibold">{{$slot['item']}}</h1>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
        <div class="w-full px-4">
            <span class="font-bold">Bulk Actions</span><span class="text-red-800 ml-[5px]">(please select two stocks or more to enable bulk edting)</span>
        </div>
        <div class="w-full  px-4 py-[15px] flex gap-[20px] text-[20px]">
            <i class="fa-solid fa-heart"></i>
            <i class="fa-solid fa-heart"></i>
            <i class="fa-solid fa-heart"></i>
            <i class="fa-solid fa-heart"></i>
            <i class="fa-solid fa-heart"></i>
        </div>
        <div class="w-full mt-[10px] grid lg:grid-cols-8 md:grid-cols-4 grid-cols-2 gap-[4px] px-2">
            @foreach($slots as $slot)
                <div
                    class="bg-pink-300 h-[170px] flex justify-center items-center text-[15px] rounded-lg border border-sky-700">
                    @if($slot->items->count())
                        <Link modal href=" {{route('slot.show',['slot'=>$slot->id])}}">
                       {{ $slot->items->count() }} Items
                        </Link>
                    @else
                        Empty
                    @endif
                </div>
            @endforeach


        </div>
        {{--                <x-splade-table :for="$boxesTable">--}}
        {{--                    <!-- Define the table columns -->--}}

        {{--                </x-splade-table>--}}

        {{--        <div class="w-full flex justify-center mb-8">--}}
        {{--            <div class="w-full">--}}
        {{--                <table>--}}
        {{--                    <tr>--}}
        {{--                        <th>h</th>--}}
        {{--                        <th>hh</th>--}}
        {{--                        <th>fff</th>--}}
        {{--                    </tr>--}}
        {{--                    @foreach($data as $item)--}}
        {{--                        <tr>--}}
        {{--                            <td>{{ $item->box_id }}</td>--}}
        {{--                            <td>{{ $item->occupied }}</td>--}}
        {{--                            <td>{{ $item->item }}</td>--}}
        {{--                        </tr>--}}
        {{--                    @endforeach--}}
        {{--                </table>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </x-section-content>
</x-dashboard-layout>
