<div class="container-fluid">
    <div class="row">

        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang("Profile Information")</h3><br>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form wire:submit.prevent="UpdateProfile">
                        <div class="card-body">
                            <p>@lang("Update your account's profile information and email address.")</p>
                            <div class="form-group">
                                <label>@lang('Name')</label>
                                <input type="text" wire:model='name'
                                    class="form-control @error('name') is-invalid @enderror" placeholder="@lang('Name')">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>@lang('Email Address')</label>
                                <input type="email" wire:model='email'
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="@lang('Email')">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>@lang('Photo')</label>
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
                                    <img class="mt-1 img-fluid img-thumbail" src="{{ asset($img) }}" width="100" />
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">@lang("Save")</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang("Update Password")</h3><br>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form wire:submit.prevent="UpdatePassword">
                        <div class="card-body">
                            <p>@lang("Ensure your account is using a long, random password to stay secure.")</p>
                            <div class="form-group">
                                <label>@lang('Current Password')</label>
                                <input type="password" wire:model='current_password' autofocus
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    placeholder="@lang('Current Password')">
                                @error('current_password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>@lang('New Password')</label>
                                <input type="password" wire:model='password' autocomplete="new-password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="@lang('New Password')">
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>@lang('Confirm Password')</label>
                                <input type="password" wire:model='password_confirmation' autocomplete="new-password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="@lang('Confirm Password')">
                                @error('password_confirmation')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">@lang("Save")</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">@lang("Two Factor Authentication")</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <p>@lang("Add additional security to your account using two factor authentication.")</p>

                        <hr>
                        @if (session('status') == 'two-factor-authentication-enabled')
                            <div class="my-4 text-sm font-medium text-green-600">
                                @lang("Two factor authentication has been enabled.")
                            </div>
                        @endif

                        @if (!empty($this->user->two_factor_secret))

                            @if ($showQrCode)
                                <p>
                                    @lang("Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application.")
                                </p>

                                <div>{!! $this->user->twoFactorQrCodeSvg() !!}</div>
                            @endif

                            @if ($showRecoveryCodes)
                                <div class="mt-4">
                                    <p>
                                        @lang("Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.")
                                    </p>

                                    <div>
                                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                                            <div>{{ $code }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="mt-4">
                                @if ($showRecoveryCodes)
                                    <button wire:click="regenerateRecoveryCodes" class="btn btn-secondary">
                                        @lang("Regenerate Recovery Codes")
                                    </button>
                                @else
                                    <button wire:click="showRecoveryCodes" class="btn btn-secondary">
                                        @lang("Show Recovery Codes")
                                    </button>
                                @endif

                                <button wire:click="disableTwoFactorAuth" class="btn btn-primary">
                                    @lang("Disable Two-Factor Authentication")
                                </button>
                            </div>
                        @else
                            <div>
                                <p>@lang("You have not enabled two factor authentication.")</p>

                                <button wire:click="enableTwoFactorAuth" class="btn btn-primary">
                                    @lang("Enable Two-Factor Authentication")
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        @endif

        {{-- @livewire('back.user.logout-other-browser-sessions-form')

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            @livewire('back.user.delete-user-form')
        @endif --}}
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
