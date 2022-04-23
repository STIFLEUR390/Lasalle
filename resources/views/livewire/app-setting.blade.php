<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">@lang("App info")</h3><br>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form wire:submit.prevent="UpdateAppInfo">
                    <div class="card-body">
                        {{-- <p>@lang("Update your account's profile information and email address.")</p> --}}
                        <div class="form-group">
                            <label>@lang('App name')</label>
                            <input type="text" wire:model='name' class="form-control @error('name') is-invalid @enderror"
                                placeholder="@lang('App name')">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>@lang('App logo')</label>
                            <input type="file" wire:model="image" accept="image/*"
                                class="form-control-file @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <div wire:loading wire:target="image">
                                <i class="fa fa-spinner fa-pulse fa-3x"></i>
                            </div>
                            @if ($image)
                                <img class="mt-1 img-fluid img-thumbail" src="{{ $image->temporaryUrl() }}"
                                    width="100" />
                            @else
                                <img class="mt-1 img-fluid img-thumbail" src="{{ asset($logo) }}" width="100" />
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">@lang("Update")</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
