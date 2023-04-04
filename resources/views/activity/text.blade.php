<table>
    <thead>
    <tr>
        <th></th>
        @foreach ($eventStatistics as $eventName => $eventAttendances)
            <th>{{ $eventName }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach ($members as $member)
        <tr>
            <td>{{ $member->characters->first()->nickname }}</td>
            @foreach ($eventStatistics as $eventAttendances)
                @php
                    $eventPoints = 0;
                    if (isset($eventAttendances[$member->id])) {
                        $eventPoints = $eventAttendances[$member->characters->first()->id]['status'] === 'confirmed' ? $eventAttendances[$member->characters->first()->id]['points'] : 0;
                    }
                @endphp
                <td>{{ $eventPoints }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
