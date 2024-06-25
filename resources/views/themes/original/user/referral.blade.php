@extends($theme.'layouts.user')
@section('title',trans($title))
@section('content')

<!-- My Referral -->
<section class="transaction-history">
    <div class="container-fluid">
        <div class="row mt-4 mb-2">
            <div class="col ms-2">
                <div class="header-text-full">
                    <h3 class="dashboard_breadcurmb_heading mb-1">@lang('Rewards')</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('user.home') }}">@lang('Dashboard')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Rewards</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- refferal-information -->

        <div class="row">
            <div class="col-8">

                <div class="search-bar refferal-link coin-box-wrapper">

                    <div class="row">
                        <div class="col-2">
                            <img style="
                    position: relative;
                    width: 80px;
                    height: 80px;
                    overflow: hidden;
                    flex-shrink: 0;
                    object-fit: cover;
                  " alt="" src="{{ url('./public/referral/gift-2@2x.png') }}">
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-black">Refer and Earn</h3>
                                </div>
                                <div class="col-12 pt-2">
                                    <p style="font-size: 22px;">Invite your friends and you’ll both receive a rewards balance to invest in our properties!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form class="mb-3">
                        <div class="row g-3 align-items-end">
                            <div class="input-box col-lg-12">
                                <label for="">@lang('Share your link')</label>
                                <div class="input-group mt-0">
                                    <input type="text" value="{{route('register.sponsor',[Auth::user()->username])}}" class="form-control" id="sponsorURL" readonly />
                                    <button class="gold-btn copyReferalLink" type="button"><i class="fal fa-copy"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-4">
                <div class="search-bar refferal-link coin-box-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <p class="float-start">Total rewards earn</p>
                        </div>
                        <div class="col-12">
                            <p class="float-start" style="font-size: 38px; color: #189ad3;">£ 564.00</p>
                        </div>
                        <div class="col-6">
                            <p class="float-start">Cashback</p>
                        </div>
                        <div class="col-6">
                            <p class="float-end fw-bold">123</p>
                        </div>

                        <div class="col-6">
                            <p class="float-start">Referrals</p>
                        </div>
                        <div class="col-6">
                            <p class="float-end fw-bold">123</p>
                        </div>

                        <div class="col-6">
                            <p class="float-start">Promotions</p>
                        </div>
                        <div class="col-6">
                            <p class="float-end fw-bold">123</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(0 < count($referrals)) <div class="row mt-5">
            <div class="col-md-12 col-lg-12">
                <h5 class="text-black">@lang('Rewards Log')</h5>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="row" id="ref-label">
                    <div class="col-lg-2">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            @foreach($referrals as $key => $referral)
                            <a class=" btn-custom nav-link @if($key == '1')   active  @endif " id="v-pills-{{$key}}-tab" href="javascript:void(0)" data-bs-toggle="pill" data-bs-target="#v-pills-{{$key}}" role="tab" aria-controls="v-pills-{{$key}}" aria-selected="true">@lang('Level') {{$key}}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach($referrals as $key => $referral)
                            <div class="tab-pane fade @if($key == '1') show active  @endif " id="v-pills-{{$key}}" role="tabpanel" aria-labelledby="v-pills-{{$key}}-tab">
                                @if( 0 < count($referral)) <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">@lang('Username')</th>
                                                <th scope="col">@lang('Email')</th>
                                                <th scope="col">@lang('Phone Number')</th>
                                                <th scope="col">@lang('Upline')</th>
                                                <th scope="col">@lang('Joined At')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($referral as $user)
                                            <tr>

                                                <td data-label="@lang('Username')">
                                                    @lang($user->username)
                                                </td>
                                                <td data-label="@lang('Email')" class="">{{$user->email}}</td>
                                                <td data-label="@lang('Phone Number')">
                                                    {{$user->phone}}
                                                </td>
                                                <td data-label="@lang('Upline')">
                                                    {{ $user->uplineRefer($user->referral_id)->username }}
                                                </td>
                                                <td data-label="@lang('Joined At')">
                                                    {{dateTime($user->created_at)}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
    </div>
    @endif
    </div>
</section>

@endsection

@push('script')

<script>
    'use strict'
    $(document).on('click', '.copyReferalLink', function() {
        var _this = $(this)[0];
        var copyText = $(this).siblings('input');
        $(copyText).prop('disabled', false);
        copyText.select();
        document.execCommand("copy");
        $(copyText).prop('disabled', true);
        $(this).text('Copied');
        setTimeout(function() {
            $(_this).text('');
            $(_this).html('<i class="fal fa-copy"></i>');
        }, 500)
    });
</script>

@endpush