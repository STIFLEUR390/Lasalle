<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>@lang('Filters')</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('Select the filter')</label>
                                <select wire:click="resetSearchValue" wire:model='search_type' class="form-control select2" id="select2-type" style="width: 100%;">
                                    <option value="" selected="">@lang('Select the filter')</option>
                                    <option value="teacher_id">@lang('Teacher')</option>
                                    <option value="faculty_id">@lang('Faculty')</option>
                                    {{-- <option value="date">@lang('Date')</option> --}}
                                    <option value="room_id">@lang('Room')</option>
                                    <option value="course_id">@lang('Cours')</option>
                                    <option value="status">@lang('Status')</option>
                                </select>
                            </div>
                        </div>

                        @isset($search_type)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>@lang('Filter value')</label>
                                    @if ($search_type == "teacher_id")
                                        <select wire:model='search_value'class="custom-select rounded-0">
                                            <option value="" selected="selected">@lang('Select filter value')</option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}">{{ $teacher->last_name }} {{ $teacher->first_name }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @if ($search_type == "faculty_id")
                                        <select wire:model='search_value'class="custom-select rounded-0">
                                            <option value="" selected="selected">@lang('Select filter value')</option>
                                            @foreach ($faculties as $faculty)
                                                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @if ($search_type == "room_id")
                                        <select wire:model='search_value'class="custom-select rounded-0">
                                            <option value="" selected="selected">@lang('Select filter value')</option>
                                            @foreach ($rooms as $room)
                                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @if ($search_type == "course_id")
                                        <select wire:model='search_value'class="custom-select rounded-0">
                                            <option value="" selected="selected">@lang('Select filter value')</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @if ($search_type == "date")
                                        <input type="date" wire:model='search_value' class="form-control">
                                    @endif

                                    @if ($search_type == "status")
                                        <select wire:model='search_value' class="custom-select rounded-0">
                                            <option value="" selected="selected">@lang('Select filter value')</option>
                                            <option value="waiting">@lang('waiting')</option>
                                            <option value="in_progress">@lang('in_progress')</option>
                                            <option value="finish">@lang('finish')</option>
                                            <option value="absent">@lang('absent')</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                        @endisset

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang("Date")</label>
                                <input type="date" wire:model='search_date' class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleSelectRounded0">@lang("Per Page")</label>
                                <select wire:model='pageSize' class="custom-select rounded-0" id="exampleSelectRounded0">
                                    <option value="5">5</option>
                                    <option value="7">7</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card">
                <div class="card-header">
                    <div class="float-right" style="margin-left: 10% !important;">
                        <a href="{{ route('schedules.create') }}" class="btn btn-primary">@lang('Add schedule')</a>
                    </div>
                </div>
                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>@lang('Teacher')</th>
                                <th>@lang('Faculty')</th>
                                <th>@lang('Date')</th>
                                <th>@lang('Start time')</th>
                                <th>@lang('End time')</th>
                                <th>@lang('Room')</th>
                                <th>@lang('Cours')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->teacher->last_name }} {{ $schedule->teacher->first_name }}</td>
                                    <td>{{ $schedule->faculty->name }}</td>
                                    <td>{{ $schedule->date }}</td>
                                    <td>{{ substr($schedule->start_time, 0, 5) }}</td>
                                    <td>{{ substr($schedule->end_time, 0, 5) }}</td>
                                    <td>{{ $schedule->room->name }}</td>
                                    <td>{{ $schedule->course->title }}</td>
                                    <td class="row">
                                        <div class="col-md-6">
                                            <a class="btn btn-primary"
                                                href="{{ route('schedules.edit', $schedule->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-danger"
                                                wire:click="confirmDeletion('{{ $schedule->id }}')"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="float-right mr-2">
                        {{ $schedules->links() }}
                    </span>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
