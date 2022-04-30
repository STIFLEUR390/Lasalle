<div>
    <h3></h3>
    <table style="margin-top: 2rem;">
        <thead>
        <tr>
            <th>@lang('Teacher')</th>
            <th>@lang('Faculty')</th>
            <th>@lang('Date')</th>
            <th>@lang('Hours')</th>
            <th>@lang('Room')</th>
            <th>@lang('Cours')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($schedules as $schedule)
            <tr>
                <td>
                    {{ $schedule->teacher->last_name }} {{ $schedule->teacher->first_name }}
                </td>
                <td>{{ $schedule->faculty->name }}</td>
                <td>{{ $schedule->date }}</td>
                <td>
                    {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                <td>{{ $schedule->room->name }}</td>
                <td>{{ $schedule->course->title }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
