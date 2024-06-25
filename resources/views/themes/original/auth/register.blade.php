@extends($theme.'layouts.app')
@section('title',__('Register'))

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
        width: 579px;
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


    /* extra link hover */
    /* .bottom a:hover {
        color: black;
    } */

    .input-box {
        margin-top: 10px;
    }
</style>

<!-- Register section -->
<section class="login-section sign-up-page bg-white">
    <div class="container-fluid p-0">
        <div class="row h-100 justify-content-center">
            <div class="col-lg-6">
                <!--<div class="img-box">
                        <img src="{{ asset($themeTrue.'img/login.png') }}" alt="" class="img-fluid" />
                    </div>-->

                <div class="sign-up-right-content bg-white">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-12 mt-4" align="center">
                                <a href="{{url('/')}}">
                                    <img src="{{getFile(config('location.logoIcon.path').'logo.png')}}" alt="{{config('basic.site_title')}}" style="width:70px;"/>
                                    <h4>{{config('basic.site_title')}}</h4>
                                </a>
                            </div>
                            <div class="col-12 mt-0" align="center">
                                <h5 style="color: black;">@lang('Sign Up For New Account')</h5>
                            </div>
                            <div class="input-box col-6">
                                <input type="text" name="firstname" class="form-control" value="{{old('firstname')}}" placeholder="@lang('First Name')" />
                                @error('firstname')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>

                            <div class="input-box col-6">
                                <input type="text" name="lastname" class="form-control" value="{{old('lastname')}}" placeholder="@lang('Last Name')" />
                                @error('lastname')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>

                            <div class="input-box col-12">
                                <input type="text" name="username" class="form-control" value="{{old('username')}}" placeholder="@lang('Username')" />
                                @error('username')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>

                            <div class="input-box col-12">
                                <input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="@lang('Email Address')" />
                                @error('email')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>

                            <div class="col-md-12 phonenumber input-box">
                                <div class="form-group mb-30">
                                    @php
                                    $country_code = (string) @getIpInfo()['code'] ?: null;
                                    $myCollection = collect(config('country'))->map(function($row) {
                                    return collect($row);
                                    });
                                    $countries = $myCollection->sortBy('code');
                                    @endphp

                                    <div class="box mb-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend w-50 me-1">
                                                <select name="phone_code" class="form-control country_code dialCode-change">
                                                    @foreach(config('country') as $value)
                                                    <option value="{{$value['phone_code']}}" data-name="{{$value['name']}}" data-code="{{$value['code']}}" {{$country_code == $value['code'] ? 'selected' : ''}}> {{$value['name']}} {{$value['phone_code']}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <input type="text" name="phone" id="phone" class="form-control dialcode-set" value="{{old('phone')}}" placeholder="@lang('Phone Number')">
                                        </div>
                                        @error('phone')
                                        <span class="text-danger mt-1">@lang($message)</span>
                                        @enderror
                                    </div>


                                    <input type="hidden" name="country_code" value="{{old('country_code')}}" class="text-dark">
                                </div>
                            </div>

                            <!-- <div class="input-box col-12">
                                    <input type="password" name="password" class="form-control" placeholder="@lang('Password')" />
                                    @error('password')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div> -->

                            <div class="input-box input-group col-12 mt-0">
                                <span class="input-group-append">
                                    <i class="fa fa-info-circle" rel="tooltip" data-html="true" title="Your password should be a minimum of 6 characters and contain at least 1: Uppercase letter, lowercase letter, number and symbol." id="password_info"></i>
                                </span>
                            </div>

                            <div class="box mt-0">
                                <div class="input-box input-group col-12">
                                    <input type="password" name="password" id="password" class="form-control password" placeholder="@lang('Password')" />
                                    <span class="input-group-text">
                                        <i class="far fa-eye-slash" id="togglePassword" style="cursor: pointer"></i>
                                    </span>

                                </div>
                                @error('password')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>


                            <div class="input-box col-12">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('Confirm Password')" />
                                @error('password_confirmation')<span class="text-danger mt-1">@lang($message)</span>@enderror
                            </div>

                            @if(basicControl()->reCaptcha_status_registration)
                            <div class="col-md-6 box mb-4 form-group">
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
                                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="terms_conditions" />
                                        <label class="form-check-label" for="flexCheckDefault" required style="color: black;">
                                            @lang('I Agree with the ') <a href="{{url('/terms-amp-conditions/33')}}" target="_blank">Terms & Conditions</a>
                                        </label><br />
                                        @error('terms_conditions')
                                        <span class="text-danger mt-1">@lang($message)</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn-custom" type="submit" style="color: white; background-image:none">@lang('Sign up')</button>
                        <div class="bottom" style="color: black;">
                            @lang('Already have an account?')
                            <a href="{{ route('login') }}">@lang('Login here')</a>
                        </div>
                    </form>

                </div>




            </div>
            <div class="col-lg-6">
                <div class="sign-up-left-content position-relative">
                    <div style="
                            display: flex;
                            flex-direction: column;
                            align-items: flex-start;
                            justify-content: flex-start;
                            gap: 50px;
                        ">
                        <div style="
                                display: flex;
                                flex-direction: column;
                                align-items: flex-start;
                                justify-content: flex-start;
                                gap: 20px;
                            ">

                            <div style="
                                    align-self: stretch;
                                    position: relative;
                                    font-size: 20px;
                                    line-height: 34px;
                                ">
                                <h3 style="color: white;">Join the future of real estate investing today</h3> <p>Start
                                building your financial portfolio with confidence</p>
                            </div>
                        </div>
                        <div style="
                                display: flex;
                                flex-direction: column;
                                align-items: flex-start;
                                justify-content: flex-start;
                                gap: 20px;
                                font-size: 20px;
                            ">
                            <div style="
                                    display: flex;
                                    flex-direction: row;
                                    align-items: center;
                                    justify-content: flex-start;
                                    gap: 20px;
                                ">
                                <img style="
                                        position: relative;
                                        width: 24px;
                                        height: 24px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="./public/charmtick.svg" />

                                <div style="position: relative">Diverse Investment Options</div>
                            </div>
                            <div style="
                                    display: flex;
                                    flex-direction: row;
                                    align-items: center;
                                    justify-content: flex-start;
                                    gap: 20px;
                                ">
                                <img style="
                                        position: relative;
                                        width: 24px;
                                        height: 24px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="./public/charmtick.svg" />

                                <div style="position: relative">Expert Guidance</div>
                            </div>
                            <div style="
                                    display: flex;
                                    flex-direction: row;
                                    align-items: center;
                                    justify-content: flex-start;
                                    gap: 20px;
                                ">
                                <img style="
                                        position: relative;
                                        width: 24px;
                                        height: 24px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="./public/charmtick.svg" />

                                <div style="position: relative">Risk Mitigation</div>
                            </div>
                            <div style="
                                    display: flex;
                                    flex-direction: row;
                                    align-items: center;
                                    justify-content: flex-start;
                                    gap: 20px;
                                ">
                                <img style="
                                        position: relative;
                                        width: 24px;
                                        height: 24px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="./public/charmtick.svg" />

                                <div style="position: relative">Transparent Transactions</div>
                            </div>
                            <div style="
                                    display: flex;
                                    flex-direction: row;
                                    align-items: center;
                                    justify-content: flex-start;
                                    gap: 20px;
                                ">
                                <img style="
                                        position: relative;
                                        width: 24px;
                                        height: 24px;
                                        overflow: hidden;
                                        flex-shrink: 0;
                                    " alt="" src="./public/charmtick.svg" />

                                <div style="position: relative">Flexible Financing</div>
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
    "use strict";
    $(document).ready(function() { //extra

        /* setDialCode();
        $(document).on('change', '.dialCode-change', function() {
            setDialCode();
        });

        function setDialCode() {
            let currency = $('.dialCode-change').val();
            $('.dialcode-set').val(currency);
        } */

        $('#password_info').tooltip();

        var allInputs = $(":input");
        allInputs.focus(function() {
            $(this).siblings(".text-danger").hide();
        });

        $("#phone").focus(function() {
            $(this).parent().siblings(".text-danger").hide();
        });

        $("#password").focus(function() {
            $(this).parent().siblings(".text-danger").hide();
        });
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