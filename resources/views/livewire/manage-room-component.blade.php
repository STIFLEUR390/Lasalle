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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                @lang("Add room")
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="p-0 card-body table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('Room name')</th>
                                <th>@lang('Is available')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $key => $room)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $room->name }}</td>
                                    <td>
                                        @if ($room->is_available)
                                            <span class="badge bg-primary">@lang("Yes")</span>
                                        @else
                                            <span class="badge bg-danger">@lang('No')</span>
                                        @endif
                                    </td>
                                    <td class="row">
                                        <div class="mr-2 col-md-3">
                                            <button type="button" wire:click="getData({{ $room->id }}, 'modal-default{{ $key + 1 }}')" class="btn btn-primary" data-toggle="modal" data-target="#modal-default{{ $key + 1 }}"><i class="fa fa-edit"></i></button>
                                            <div class="modal fade" id="modal-default{{ $key + 1 }}">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">@lang("Add room")</h4>
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
                                                        <div class="form-group col-md-6" style="margin-top: 2.5rem !important;">
                                                            <div class="custom-control custom-checkbox">
                                                              <input type="checkbox" class="custom-control-input" wire:model.defer='is_available' id="ckeck{{ $key + 1 }}">
                                                              <label class="custom-control-label" for="ckeck{{ $key + 1 }}">@lang('available ?')</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                      <button type="button" class="btn btn-danger" data-dismiss="modal">@lang("Close")</button>
                                                      <button type="button" wire:click="updateRoom('modal-default{{ $key + 1 }}')" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                  </div>
                                                  <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" class="btn btn-danger"
                                                wire:click="confirmDeletion('{{ $room->id }}')"><i
                                                    class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <span class="float-right mr-2">
                        {{ $rooms->links() }}
                    </span>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">@lang("Add room")</h4>
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
                        <div class="form-group col-md-6" style="margin-top: 2.5rem !important;">
                            <div class="custom-control custom-checkbox">
                              <input type="checkbox" name="terms" class="custom-control-input" wire:model.defer='is_available' id="exampleCheck1">
                              <label class="custom-control-label" for="exampleCheck1">@lang('available ?')</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">@lang("Close")</button>
                      <button type="button" wire:click="createRoom('modal-default')" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </div>
    </div>
</div>