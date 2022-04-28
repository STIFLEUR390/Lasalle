<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('schedules.index') }}" class="btn btn-info">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Return to :appName', ['appName' => __('Manage schedules')]) }}
                    </a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form wire:submit.prevent='updateSchedule'>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" wire:ignore>
                                    <label>@lang("Teacher")</label>
                                    <select wire:model='teacher_id' class="form-control @error('teacher_id') is-invalid @enderror" id="select2-teacher" style="width: 100%;">
                                        <option value="" selected="">{{ trans_choice('Select a :name', 0, ['name' => __('Teacher')]) }}</option>
                                        @foreach ($teachers as $teacher)
                                            {{-- <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option> --}}
                                            <option value="{{ $teacher->id }}">{{ $teacher->last_name }} {{ $teacher->first_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('teacher_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" wire:ignore>
                                    <label>@lang("Faculty")</label>
                                    <select wire:model="faculty_id"class="form-control @error('faculty_id') is-invalid @enderror"id="select2-faculty" style="width: 100%;">
                                        <option value="" selected="">{{ trans_choice('Select a :name', 1, ['name' => __('faculty')]) }}</option>
                                        @foreach ($faculties as $faculty)
                                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('faculty_id') <span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Select date')</label>
                                    <input type="date" wire:model='date' class="form-control @error('date') is-invalid @enderror">
                                    @error('date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang("Select start time")</label>
                                    <input type="time" wire:model='start_time' class="form-control @error('start_time') is-invalid @enderror">
                                    @error('start_time') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Select end time')</label>
                                    <input type="time" wire:model='end_time' class="form-control @error('end_time') is-invalid @enderror">
                                    @error('end_time') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" wire:ignore>
                                    <label>@lang("Room")</label>
                                    <select wire:model='room_id' class="form-control @error('room_id') is-invalid @enderror" id="select2-room" style="width: 100%;">
                                        <option value="" selected="">{{ trans_choice('Select a :name', 1, ['name' => __('Room')]) }}</option>
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('room_id')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" wire:ignore>
                                    <label>@lang('Cours')</label>
                                    <select wire:model="course_id"class="form-control @error('course_id') is-invalid @enderror"id="select2-course" style="width: 100%;">
                                        <option value="" selected="">{{ trans_choice('Select a :name', 0, ['name' => __('Cours')]) }}</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('course_id') <span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('UE code')</label>
                                    <input type="text" wire:model='ue_code' placeholder="{{ trans_choice('Enter :name', 0, ['name' => __('UE code')]) }}" class="form-control @error('ue_code') is-invalid @enderror">
                                    @error('ue_code') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->

@push('style')
    <link rel="stylesheet" href="{{ asset('custom/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('script')
    <script src="{{ asset('custom/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('custom/select2/js/select2.full.min.js') }}" defer></script>
    <script>
        $(function() {
            $('#select2-teacher').select2({
                theme: 'bootstrap4'
            });
            $('#select2-teacher').on('change', function(e) {
                var data = $('#select2-teacher').select2("val");
                @this.set('teacher_id', data);
            });

            $('#select2-faculty').select2({
                theme: 'bootstrap4'
            });
            $('#select2-faculty').on('change', function(e) {
                var data = $('#select2-faculty').select2("val");
                @this.set('faculty_id', data);
            });

            $('#select2-room').select2({
                theme: 'bootstrap4'
            });
            $('#select2-room').on('change', function(e) {
                var data = $('#select2-room').select2("val");
                @this.set('room_id', data);
            });

            $('#select2-course').select2({
                theme: 'bootstrap4'
            });
            $('#select2-course').on('change', function(e) {
                var data = $('#select2-course').select2("val");
                @this.set('course_id', data);
            });
        })
    </script>
@endpush
