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

                        @hasanyrole('Admin|Super Admin')
                            <div class="float-right" style="margin-left: 10% !important;">
                                <button type="button" class="btn btn-primary" wire:click='initializeForCreateTeacherGrade'>
                                    @lang("Add grade")
                                </button>
                            </div>
                        @endhasanyrole
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                @hasanyrole('Admin|Super Admin')
                                    <th>@lang('Action')</th>
                                @endhasanyrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teacherGrades as $teacherGrade)
                                <tr>
                                    <td>{{ $teacherGrade->name }}</td>
                                    @hasanyrole('Admin|Super Admin')
                                        <td>
                                            <button type="button" wire:click="getData('{{ $teacherGrade->id }}')" class="btn btn-primary"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="ml-1 btn btn-danger" wire:click="confirmDeletion('{{ $teacherGrade->id }}')"><i class="fa fa-trash"></i></button>
                                        </td>
                                    @endhasanyrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="float-right mr-2">
                        {{ $teacherGrades->links() }}
                    </span>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="modal fade" id="modal-update">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">@lang("Edit a grade")</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label>@lang("Name")</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer='name' placeholder="{{ trans_choice("Enter :name", 0, ['name'=> __('Name')]) }}">
                            @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">@lang("Close")</button>
                      <button type="button" wire:click="updateTeacherGrade" class="btn btn-primary">@lang('Update')</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">@lang("Add grade")</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label>@lang("Name")</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer='name' placeholder="{{ trans_choice("Enter :name", 0, ['name'=> __('Name')]) }}">
                            @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">@lang("Close")</button>
                      <button type="button" wire:click="createTeacherGrade" class="btn btn-primary">@lang('Save')</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </div>
    </div>
</div>
