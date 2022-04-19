<div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('teachers.index') }}" class="btn btn-info">
                        <i class="fa fa-arrow-left"></i>
                        {{ __('Return to :appName', ['appName' => __('Manage teachers')]) }}
                    </a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form wire:submit.prevent='updateTeacher'>
                    <div class="card-body row">
                        <div class="form-group col-md-3">
                            <label>@lang("First name")</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"" wire:model='first_name' placeholder="{{ trans_choice("Enter :name", 0, ['name'=> __('First name')]) }}">
                            @error('first_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>@lang('Last name')</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" wire:model='last_name' placeholder="{{ trans_choice("Enter :name", 0, ['name'=> __('Last name')]) }}">
                            @error('last_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>@lang('Grade')</label>
                            <input type="text" class="form-control @error('grade') is-invalid @enderror" wire:model='grade' placeholder="{{ trans_choice("Enter :name", 0, ['name'=> __('Grade')]) }}">
                            @error('grade')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>@lang("Matricule")</label>
                            <input type="text" class="form-control @error('matricule') is-invalid @enderror" wire:model='matricule' placeholder="{{ trans_choice("Enter :name", 0, ['name'=> __('Matricule')]) }}">
                            @error('matricule')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>@lang('Status')</label>
                            <input type="text" class="form-control @error('status') is-invalid @enderror" wire:model='status' placeholder="{{ trans_choice("Enter :name", 0, ['name'=> __('Status')]) }}">
                            @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>@lang('Email Address')</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model='email' placeholder="{{ trans_choice("Enter :name", 2, ['name'=> __('Email')]) }}">
                            @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>@lang('Gender')</label>
                            <select class="custom-select rounded-0 @error('gender') is-invalid @enderror" wire:model='gender'>
                                <option value="">{{ trans_choice("Select a :name", 0, ['name'=> __('Gender')]) }}</option>
                                <option value="male">@lang("male")</option>
                                <option value="female">@lang("female")</option>
                            </select>
                            @error('gender')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label>@lang('Phone number')</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" wire:model='phone' placeholder="{{ trans_choice("Enter :name", 0, ['name'=> __('Phone number')]) }}">
                            @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>@lang('Photo')</label>
                            <input type="file" wire:model="img" accept="image/*"
                                class="form-control-file @error('img') is-invalid @enderror">
                            @error('img')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <div wire:loading wire:target="img">
                                <i class="fa fa-spinner fa-pulse fa-3x"></i>
                            </div>
                            @if ($img)
                                <img class="mt-1 img-fluid img-thumbail" src="{{ $img->temporaryUrl() }}" width="100" />
                            @else
                                <img class="mt-1 img-fluid img-thumbail" src="{{ asset($photo) }}" width="100" />
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" wire:click='updateTeacher' class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
