<table style="width: 100%; border-collapse: collapse;">
    <thead>
    <tr>
        <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Name</th>
        <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Project Details</th>
        <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Project Number</th>
        <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Total Fund</th>
        <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Fund Utilized</th>
        {{--        <th style="border: 1px solid #ccc; padding: 8px; text-align: left; background-color: #f2f2f2;">Action</th>--}}
    </tr>
    </thead>
    <tbody>
    @foreach($data as $project)
        <tr>
            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">{{ $project['name'] }}</td>
            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">{{ $project['project_details'] }}</td>
            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">{{ $project['project_number'] }}</td>
            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">{{ $project['total_fund'] }}</td>
            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">{{ $project['fund_utilize'] }}</td>
            {{--            <td style="border: 1px solid #ccc; padding: 8px; text-align: left;">--}}{{-- Any action buttons you want to include --}}{{--</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>
