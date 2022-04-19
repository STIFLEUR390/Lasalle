<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="input-group input-group-sm">
                        <input type="text" wire:model='search' style="width: 150px;" class="form-control"
                            placeholder="@lang('Search')">
                        <select wire:model='oderBy' class="mx-1 custom-select rounded-0">
                            <option value="desc">@lang('From newest to oldest')</option>
                            <option value="asc">@lang('From oldest to newest')</option>
                        </select>
                        <select wire:model='pageSize' class="mx-1 custom-select rounded-0">
                            <option value="5">5</option>
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>

                        <div class="float-right" style="margin-left: 10% !important;">
                            <a href="{{ route('teachers.create') }}" class="btn btn-primary">@lang("Add teacher")</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('Photo')</th>
                                <th>@lang('Name')</th>
                                <th>@lang('Matricule')</th>
                                <th>@lang('Email')</th>
                                {{-- <th>@lang('Gender')</th>
                                <th>@lang('phone')</th> --}}
                                <th>@lang('Actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $key => $teacher)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img width="50" src="{{ asset($teacher->photo) }}"
                                            alt="{{ $teacher->first_name }} {{ $teacher->last_name }}" /></td>
                                    <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                                    <td>{{ $teacher->matricule }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    {{-- <td>@lang($teacher->gender)</td>
                                    <td>{{ $teacher->phone }}</td> --}}
                                    <td class="row">
                                        <div class="col-md-3">
                                            <a class="btn btn-primary"
                                                href="{{ route('teachers.edit', $teacher->id) }}"><i
                                                    class="fa fa-edit"></i></a>
                                        </div>
                                        <div class="mx-2 col-md-3">
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#modal-lg-{{ $teacher->id }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <div class="modal fade" id="modal-lg-{{ $teacher->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">@lang("Show teacher details")</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="p-0 modal-body">
                                                            {{-- @livewire("teacher.show-teacher-component")> --}}
                                                            <livewire:teacher.show-teacher-component :id="$teacher->id" :wire:key="$teacher->id">
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            {{-- <a class="btn btn-info" href="{{ route('teachers.show', $teacher->id) }}"><i class="fa fa-eye"></i></a> --}}
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-danger"
                                                wire:click="confirmDeletion('{{ $teacher->id }}')"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="float-right">
                        {{ $teachers->links() }}
                    </span>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
