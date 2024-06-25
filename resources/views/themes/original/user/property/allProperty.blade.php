@if(count($properties) > 0)
<div class="col-lg-12">

    <!-- search area -->
    <div class="search-bar mt-3 p-0 d-none">
        <form action="" method="get" enctype="multipart/form-data" id="searchPropertyForm">
            <div class="row g-3 align-items-end">
                <div class="input-box col-lg-2">
                    <label for="">@lang('Property')</label>
                    <input type="text" class="form-control" name="name"
                                               value="{{ old('name', request()->name) }}" autocomplete="off"
                                               placeholder="@lang('Search property')"/>
                </div>

                <div class="input-box col-lg-2">
                    <label for="">@lang('Location')</label>
                    <select class="form-select" name="location">
                        <option selected disabled>@lang('Select Location')</option>
                        <option value="">All</option>
                        @foreach($allAddress as $address)
                                                <option value="{{ $address->id }}"
                                                        @if(request()->location == $address->id) selected @endif>@lang(optional($address->details)->title)</option>

                        @endforeach
                    </select>
                </div>

                <div class="input-box col-lg-2">
                        <label for="">@lang('Filter By Available Funding')</label>
                        <div class="input-box mb-2">
                            <input type="text" class="js-range-slider" name="my_range" value="" />
                        </div>
                </div>

                <div class="input-box col-lg-2">
                    <label for="from_date">@lang('Publish Date')</label>
                    <input type="text" class="form-control datepicker from_date" name="from_date" value="{{ old('from_date',request()->from_date) }}" placeholder="@lang('From date')" autocomplete="off" readonly />
                </div>

                <div class="input-box col-lg-2">
                    <label for="">@lang('Amenities')</label>
                    <select class="form-select" name="location">
                        <option selected disabled>@lang('Select Amenities')</option>
                        <option value="">All</option>
                        @foreach($allAmenities as $amenity)
                        <option value="{{ $amenity->id }}">@lang(optional($amenity->details)->title)</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-box col-lg-2">
                    <button id="searchProperty" class="btn-custom w-100" type="submit">@lang('Search')</button>
                </div>
            </div>
        </form>
    </div>



    <div class="row g-4 mb-5">
        @foreach($properties as $key => $property)
        <div class="col-md-4 col-lg-4">
            @include($theme.'partials.propertyBox')
        </div>
        @endforeach
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            {{ $properties->appends($_GET)->links() }}
        </ul>
    </nav>
</div>
@else
<div class="custom-not-found mt-5">
    <img src="{{ asset($themeTrue.'img/no_data_found.png') }}" alt="@lang('not found')" class="img-fluid">
</div>
@endif


@push('loadModal')
@include($theme.'partials.investNowModal')
@endpush


<!--extra-->
@push('css-lib')
<link rel="stylesheet" href="{{ asset($themeTrue.'css/owl.carousel.min.css') }}" />
<link rel="stylesheet" href="{{ asset($themeTrue.'css/owl.theme.default.min.css') }}" />
@endpush

@push('extra-js')
<!-- fancybox slider -->
<script src="{{ asset($themeTrue.'js/fancybox.umd.js') }}"></script>
@endpush



@push('script')
<script src="{{ asset($themeTrue.'js/investNow.js') }}"></script>

<!--extra-->
<script src="{{ asset($themeTrue.'js/carousel.js?v=1') }}"></script>
<script>
    "use strict";
    var min = '{{$min}}'
    var max = '{{$max}}'
    var minRange = '{{$minRange}}'
    var maxRange = '{{$maxRange}}'

    $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: min,
        max: max,
        from: minRange,
        to: maxRange,
        grid: true,
    });
</script>
@endpush