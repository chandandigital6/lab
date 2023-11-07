<x-dashboard-layout>
    <x-section-content>
        <Link href="{{route('project.create')}}" class="bg-black text-white p-1 rounded-md">Create New</Link>
        <Link href="{{route('project.pdf')}}" away class="bg-black text-white p-1 rounded-md">Download Pdf</Link>

        <div class="flex ">
            <x-splade-table :for="$projectTable">
                <x-splade-cell total_sum as="$project">

                     {{ number_format($project->total_fund - $project->fund_utilize, 2) }}


                </x-splade-cell>
                <x-splade-cell action as="$projectTable">
                    <Link href="{{ route('project.edit',['project'=>$projectTable->id]) }}" class="bg-black text-white p-2 rounded-md">Edit</Link>
                    <Link href="{{ route('project.delete',['project'=>$projectTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">delete</Link>
                    {{--                    <Link href="{{ route('boxes.show',['boxes'=>$boxesTable->id]) }}" class="bg-red-600 text-white p-2 rounded-md ml-2">show</Link>--}}
                </x-splade-cell>

            </x-splade-table>

        </div>
    </x-section-content>

</x-dashboard-layout>
