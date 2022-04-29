<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('users.index') }}" class="btn btn-info">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Return to :appName', ['appName' => __('Manage users')]) }}
                    </a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form wire:submit.prevent='createUser'>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang("User name")</label>
                                    <input type="text" wire:model='name' class="form-control @error('name') is-invalid @enderror">
                                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang("User email")</label>
                                    <input type="email" wire:model='email' class="form-control @error('email') is-invalid @enderror">
                                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang("User password")</label>
                                    <input type="text" wire:model='password' disabled class="form-control @error('password') is-invalid @enderror">
                                    @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang("User role")</label>
                                    <select wire:model='role' class="custom-select rounded-0 @error('role') is-invalid @enderror">
                                        <option value="" selected="selected">@lang('Select role')</option>
                                        <option value="Invite">@lang('Guest')</option>
                                        <option value="Admin">@lang('Admin')</option>
                                        <option value="Super Admin">@lang("Super admin")</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang("User photo")</label>
                                    <input type="file" wire:model='img' accept="image/*" class="form-control-file @error('img') is-invalid @enderror">
                                    @error('img')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <div wire:loading wire:target="img">
                                        <i class="fa fa-spinner fa-pulse fa-3x"></i>
                                    </div>
                                    @if ($img)
                                        <img class="mt-1 img-fluid img-thumbail" src="{{ $img->temporaryUrl() }}" width="100" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
