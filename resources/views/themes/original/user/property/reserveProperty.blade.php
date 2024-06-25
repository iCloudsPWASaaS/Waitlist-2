@if(count($myProperties) > 0)
    <div class="col-lg-12">
        <div class="row g-4 mb-5">
            @foreach($myProperties as $key => $myProperty)
                <div class="col-md-4 col-lg-4">
                    @include($theme.'partials.propertyBox2')
                </div>
            @endforeach
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{ $myProperties->appends($_GET)->links() }}
            </ul>
        </nav>
    </div>
@else
    <div class="custom-not-found mt-5">
        <img src="{{ asset($themeTrue.'img/no_data_found.png') }}" alt="@lang('not found')" class="img-fluid">
    </div>
@endif

@push('script')
    <script>
        'use strict'
    </script>
@endpush