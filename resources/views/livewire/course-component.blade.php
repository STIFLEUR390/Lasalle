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
                        <select wire:model='search_ue' class="mx-1 custom-select rounded-0">
                            <option value="">@lang('Select teaching unit')</option>
                            @foreach ($ue_codes as $ue_code)
                                    <option value="{{ $ue_code->id }}">{{ $ue_code->name }}</option>
                            @endforeach
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

                        @hasanyrole('Admin|Super Admin') @endhasanyrole
                            <div class="float-right" style="margin-left: 1% !important;">
                                <button wire:click='initializeForCreateCourse' type="button" class="btn btn-primary">
                                    @lang("Add cours")
                                </button>
                            </div>
                        @hasanyrole('Admin|Super Admin') @endhasanyrole
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('Teaching unit')</th>
                                @hasanyrole('Admin|Super Admin')
                                    <th>@lang('Action')</th>
                                @endhasanyrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $cours)
                                <tr>
                                    <td>{{ $cours->title }}</td>
                                    <td>{{ $cours->ue_code->name }}</td>
                                    @hasanyrole('Admin|Super Admin')
                                        <td>
                                            <button type="button" wire:click="getData('{{ $cours->id }}')" class="btn btn-primary"><i class="fa fa-edit"></i></button>

                                            <button type="button" class="ml-1 btn btn-danger" wire:click="confirmDeletion('{{ $cours->id }}')"><i class="fa fa-trash"></i></button>
                                        </td>
                                    @endhasanyrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="float-right mr-2">
                        {{ $courses->links() }}
                    </span>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="modal fade" id="modal-update">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">@lang("Edit a cours")</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label>@lang("Name")</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model.defer='title' placeholder="{{ trans_choice("Enter :name", 0, ['name'=> __('Name')]) }}">
                            @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ue-code">@lang("Select teaching unit")</label>
                            <select wire:model.defer='ue_id' class="custom-select rounded-0 @error('ue_id') is-invalid @enderror" id="ue-code">
                                @foreach ($ue_codes as $ue_code)
                                    <option value="{{ $ue_code->id }}">{{ $ue_code->name }}</option>
                                @endforeach
                            </select>
                            @error('ue_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">@lang("Close")</button>
                      <button type="button" wire:click="updateCourse" class="btn btn-primary">@lang('Update')</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">@lang("Add cours")</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label>@lang("Name")</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model.defer='title' placeholder="{{ trans_choice("Enter :name", 0, ['name'=> __('Name')]) }}">
                            @error('title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ue-code">@lang("Select teaching unit")</label>
                            <select wire:model.defer='ue_id' class="custom-select rounded-0 @error('ue_id') is-invalid @enderror" id="ue-code">
                                @foreach ($ue_codes as $ue_code)
                                    <option value="{{ $ue_code->id }}">{{ $ue_code->name }}</option>
                                @endforeach
                            </select>
                            @error('ue_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">@lang("Close")</button>
                      <button type="button" wire:click="createCourse" class="btn btn-primary">@lang('Save')</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </div>
    </div>
</div>
