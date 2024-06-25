@extends($theme.'layouts.app')
@section('title',__('Login'))

@section('content')

<style>
    .sign-up-page {
        overflow-x: hidden;
    }

    .sign-up-right-content {
        align-items: center;
        display: flex;
    }

    .sign-up-left-content,
    .sign-up-right-content {
        min-height: 100vh;
        height: 100%;
    }

    .sign-up-right-content form {
        width: 479px;
        margin: 0 auto;
    }

    .bg-white {
        --bs-bg-opacity: 1;
        background-color: rgba(var(--bs-white-rgb), var(--bs-bg-opacity)) !important;
    }


    .sign-up-left-content,
    .sign-up-right-content {
        min-height: 100vh;
        height: 100%;
    }

    .sign-up-left-content {
        background-color: var(--bgLight2);
        padding: 30px 100px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        color: white;
    }
</style>
<!-- login section -->
<section class="login-section sign-up-page bg-white">
    <div class="container-fluid p-0">
        <div class="row h-100 justify-content-center">
            <div class="col-md-6">
                <div class="sign-up-right-content bg-white">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="row g-4">
                        <div class="col-12" align="center">
                                <a href="{{url('/')}}">
                                    <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="{{config('basic.site_title')}}" />
                                    <h3>{{config('basic.site_title')}}</h3>
                                </a>
                            </div>
                            <div class="col-12" align="center">
                                <h4>@lang('Login To Your Account')</h4>
                            </div>
                            <div class="input-box col-12">
                                <input type="text" name="username" class="form-control" placeholder="@lang('Email Or Username')" />
                                @error('username')<span class="text-danger float-left">@lang($message)</span>@enderror
                                @error('email')<span class="text-danger float-left">@lang($message)</span>@enderror
                            </div>

                            <div class="input-box col-12">
                                <input type="hidden" name="timezone" class="form-control timezone" placeholder="@lang('timezone')" />
                            </div>

                            <!-- <div class="input-box col-12">
                                <input type="password" name="password" class="form-control" placeholder="@lang('Password')" />
                                @error('password')
                                <span class="text-danger mt-1">@lang($message)</span>
                                @enderror
                            </div> -->

                            <div class="box" style="margin-top:0px;">
                                <div class="input-box input-group col-12">
                                    <input type="password" name="password" id="password" class="form-control password" placeholder="@lang('Password')" />
                                    <span class="input-group-text">
                                        <i class="far fa-eye-slash" id="togglePassword" style="cursor: pointer"></i>
                                    </span>
                                </div>
                                @error('password')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>

                            @if(basicControl()->reCaptcha_status_login)
                            <div class="box mb-4 form-group">
                                {!! NoCaptcha::renderJs(session()->get('trans')) !!}
                                {!! NoCaptcha::display($basic->theme == 'original' ? ['data-theme' => 'dark'] : []) !!}
                                @error('g-recaptcha-response')
                                <span class="text-danger mt-1">@lang($message)</span>
                                @enderror
                            </div>
                            @endif


                            <div class="col-12">
                                <div class="links">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} id="flexCheckDefault" />
                                        <label class="form-check-label" for="flexCheckDefault" style="color: black;"> @lang('Remember me') </label>
                                    </div>
                                    <a href="{{ route('password.request') }}" style="color: black;">@lang('Forget password?')</a>
                                </div>
                            </div>
                        </div>
                        <button class="btn-custom" type="submit">@lang('Sign in')</button>
                        <div class="bottom" style="color: black;">
                            @lang("Don't have an account?")

                            <a href="{{ route('register') }}">@lang('Create account')</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="sign-up-left-content position-relative">
                    <div style="margin: 60px; display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start; gap: 50px;">
                        <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start; gap: 20px;">
                            <div style="align-self: stretch; position: relative; font-size: 20px; line-height: 34px;">
                            <h3 style="color: white;">Join the future of real estate investing today</h3> <p>Start building your financial portfolio with confidence</p>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start; gap: 20px; font-size: 20px;">
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px;">
                                <img style="position: relative; width: 24px; height: 24px; overflow: hidden; flex-shrink: 0;" alt="" src="./public/charmtick.svg" />

                                <div style="position: relative;">Diverse Investment Options</div>
                            </div>
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px;">
                                <img style="position: relative; width: 24px; height: 24px; overflow: hidden; flex-shrink: 0;" alt="" src="./public/charmtick.svg" />

                                <div style="position: relative;">Expert Guidance</div>
                            </div>
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px;">
                                <img style="position: relative; width: 24px; height: 24px; overflow: hidden; flex-shrink: 0;" alt="" src="./public/charmtick.svg" />

                                <div style="position: relative;">Risk Mitigation</div>
                            </div>
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px;">
                                <img style="position: relative; width: 24px; height: 24px; overflow: hidden; flex-shrink: 0;" alt="" src="./public/charmtick.svg" />

                                <div style="position: relative;">Transparent Transactions</div>
                            </div>
                            <div style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start; gap: 20px;">
                                <img style="position: relative; width: 24px; height: 24px; overflow: hidden; flex-shrink: 0;" alt="" src="./public/charmtick.svg" />

                                <div style="position: relative;">Flexible Financing</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('script')
<script>
    'use strict'
    $(document).ready(function() {
        $('.timezone').val(Intl.DateTimeFormat().resolvedOptions().timeZone);
    });

    $("#togglePassword").click(function(e) {
        e.preventDefault();
        var type = $(this).parent().parent().find(".password").attr("type");
        console.log(type);
        if (type == "password") {
            $(this).removeClass("fa-eye-slash");
            $(this).addClass("fa-eye");
            $(this).parent().parent().find(".password").attr("type", "text");
        } else if (type == "text") {
            $(this).removeClass("fa-eye");
            $(this).addClass("fa-eye-slash");
            $(this).parent().parent().find(".password").attr("type", "password");
        }
    });
</script>
@endpush