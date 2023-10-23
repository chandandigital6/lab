
<x-dashboard-layout>
    <x-section-content>
        <Link href="{{ route('labInstrument.create') }}" class="bg-black text-white p-1 rounded-md">Create New</Link>
        <div class="flex">
            <x-splade-table :for="$labInstruments">
               <x-splade-cell instrument_photo as="$labInstruments">
                   <img src="{{asset('storage/'.$labInstruments->instrument_photo)}}" alt="">
               </x-splade-cell>
                <x-splade-cell calibration_detail_image as="$labInstruments">
                    <img src="{{asset('storage/'.$labInstruments->calibration_detail_image)}}" alt="">
                </x-splade-cell>
                <x-splade-cell action as="$labInstruments">
                    <Link href="{{ route('labInstrument.edit',['labInstrument'=>$labInstruments->id]) }}" class="bg-black text-white p-2 rounded-md">Edit</Link>
                    <Link href="{{ route('labInstrument.delete',['labInstrument'=>$labInstruments->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">delete</Link>
                </x-splade-cell>
            </x-splade-table>

        </div>
    </x-section-content>

</x-dashboard-layout>
