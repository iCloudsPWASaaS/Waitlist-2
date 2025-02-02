@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-content-wrapper bg-white p-30 radius-20">
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between border-bottom mb-20">
                                <div class="page-title-left">
                                    <h3 class="mb-sm-0">{{ $pageTitle }}</h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                                title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="billing-center-area bg-off-white theme-border radius-4 p-25">
                            <table id="allDataTable" class="table responsive theme-border p-20 ">
                                <thead>
                                    <th class="all">{{ __('SL') }}</th>
                                    <th class="all">{{ __('Name') }}</th>
                                    <th class="all">{{ __('Package Name') }}</th>
                                    <th class="all">{{ __('Gateway') }}</th>
                                    <th class="desktop">{{ __('Start Date') }}</th>
                                    <th class="desktop">{{ __('End Date') }}</th>
                                    <th class="desktop">{{ __('Payment Status') }}</th>
                                    <th class="desktop">{{ __('Status') }}</th>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="packagesOwnerRoute" value="{{ route('admin.packages.owner') }}">
@endsection

@push('style')
    @include('common.layouts.datatable-style')
@endpush

@push('script')
    @include('common.layouts.datatable-script')
    <script src="{{ asset('assets/js/custom/packages-owner.js') }}"></script>
@endpush
