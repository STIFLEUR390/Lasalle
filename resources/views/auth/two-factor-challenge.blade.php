<x-guest-layout>
    <div class="card-body register-card-body" x-data="{ recovery: false }">
        <p class="login-box-msg" x-show="! recovery">@lang("Please confirm access to your account by entering the authentication code provided by your authenticator application.")</p>
        <p class="login-box-msg" x-show="recovery">@lang("Please confirm access to your account by entering one of your emergency recovery codes.")</p>

        <!-- Session Status -->
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />


        <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf

            <div class="input-group mb-3" x-show="! recovery">
                <input type="text" class="form-control @error('code') is-invalid @enderror" placeholder="@lang('Code')" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3" x-show="recovery">
                <input type="text" class="form-control @error('recovery_code') is-invalid @enderror" placeholder="@lang('Recovery Code')" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" >
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-8">
                    <button type="button" class="btn btn-secondary btn-block" x-show="! recovery" x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })">@lang('Use a recovery code')</button>

                    <button type="button" class="btn btn-secondary btn-block" x-show="recovery" x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })">@lang('Use an authentication code')</button>
                </div>
                {{-- <div class="col-8">
                </div> --}}
                <!-- /.col -->
                <div class="col-4">
                    <button type="button" class="btn btn-primary btn-block">@lang('Log in')</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
</x-guest-layout>
