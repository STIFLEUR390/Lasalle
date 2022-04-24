<table class="table table-striped">
    <tbody>
        <tr>
            <td>@lang('Photo')</td>
            <td><img width="100" src="{{ asset($teacher->photo) }}" alt="{{ $teacher->first_name }} {{ $teacher->last_name }}"></td>
        </tr>
        <tr>
            <td>@lang("First name")</td>
            <td>{{ $teacher->first_name }}</td>
        </tr>
        <tr>
            <td>@lang('Last name')</td>
            <td>{{ $teacher->last_name }}</td>
        </tr>
        <tr>
            <td>@lang('Email Address')</td>
            <td>{{ $teacher->email }}</td>
        </tr>
        <tr>
            <td>@lang('Phone number')</td>
            <td>{{ $teacher->phone }}</td>
        </tr>
        <tr>
            <td>@lang('Matricule')</td>
            <td>{{ $teacher->matricule }}</td>
        </tr>
        <tr>
            <td>@lang('Gender')</td>
            <td>@lang($teacher->gender)</td>
        </tr>
        <tr>
            <td>@lang('Grade')</td>
            <td>{{ $teacher->teacherGrade->name }}</td>
        </tr>
        <tr>
            <td>@lang('Status')</td>
            <td>{{ $teacher->teacherStatus->name }}</td>
        </tr>
        <tr>
            <td>{{ __('Create the') }}</td>
            <td>{{ Carbon\Carbon::parse($teacher->created_at)->format('Y-m-d') }}</td>
        </tr>
    </tbody>
</table>
