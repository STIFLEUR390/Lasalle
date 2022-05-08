<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Export to :attribute', ['attribute'=> 'EXCEL']) }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('Select the filter')</label>
                                <select wire:click="resetSearchValue" wire:model='search_type'
                                    class="form-control select2" id="select2-type" style="width: 100%;">
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
                            @if (!empty($search_type))
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('Filter value')</label>
                                        @if ($search_type == 'teacher_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->last_name }}
                                                        {{ $teacher->first_name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'faculty_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'room_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'course_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'date')
                                            <input type="date" wire:model='search_value' class="form-control">
                                        @endif

                                        @if ($search_type == 'status')
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
                            @endif
                        @endisset

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang("Date")</label>
                                <input type="date" wire:model='search_date' class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button wire:click='exportExcel' type="button" class="btn btn-primary" style="margin-top: 2rem !important;">
                                <i class="fa fa-file-excel"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Export to :attribute', ['attribute'=> 'CSV']) }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('Select the filter')</label>
                                <select wire:click="resetSearchValue" wire:model='search_type'
                                    class="form-control select2" id="select2-type" style="width: 100%;">
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
                            @if (!empty($search_type))
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('Filter value')</label>
                                        @if ($search_type == 'teacher_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->last_name }}
                                                        {{ $teacher->first_name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'faculty_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'room_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'course_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'date')
                                            <input type="date" wire:model='search_value' class="form-control">
                                        @endif

                                        @if ($search_type == 'status')
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
                            @endif
                        @endisset

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang("Date")</label>
                                <input type="date" wire:model='search_date' class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button type="button" wire:click='exportCSV' class="btn btn-primary" style="margin-top: 2rem !important;">
                                <i class="fa fa-file-csv"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Export to :attribute', ['attribute'=> 'PDF']) }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang('Select the filter')</label>
                                <select wire:click="resetSearchValue" wire:model='search_type'
                                    class="form-control select2" id="select2-type" style="width: 100%;">
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
                            @if (!empty($search_type))
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>@lang('Filter value')</label>
                                        @if ($search_type == 'teacher_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}">{{ $teacher->last_name }}
                                                        {{ $teacher->first_name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'faculty_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($faculties as $faculty)
                                                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'room_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($rooms as $room)
                                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'course_id')
                                            <select wire:model='search_value' class="custom-select rounded-0">
                                                <option value="" selected="selected">@lang('Select filter value')</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                        @endif

                                        @if ($search_type == 'date')
                                            <input type="date" wire:model='search_value' class="form-control">
                                        @endif

                                        @if ($search_type == 'status')
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
                            @endif
                        @endisset

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>@lang("Date")</label>
                                <input type="date" wire:model='search_date' class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button type="button" wire:click='exportPDF' class="btn btn-primary" style="margin-top: 2rem !important;">
                                <i class="fa fa-file-pdf"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
