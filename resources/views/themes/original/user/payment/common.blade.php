<style>
.card {
    border: 0px solid rgba(0,0,0,.125);
    border-radius: 0.5rem;
}

#content form {
    margin-bottom: 0px;
    -webkit-box-shadow: 0 0px 0px rgba(0, 0, 0, 0.2) !important;
    box-shadow: 0 0px 0px rgba(0, 0, 0, 0.2) !important;
    background: var(--white);
    border-radius: 0px;
    padding: 0px;
}
</style>
<div class="row">
            <div class="col-8">
                <div class="card secbg br-4 bg-white">
                    <div class="card-body br-4">
                        <div class="row align-items-start">
                            <div class="col-md-3">
                                {{-- dd(optional($order->property)->thumbnail) --}}
                                <img
                                    src="{{getFile(config('location.propertyThumbnail.path').optional($order->property)->thumbnail)}}"
                                    class="card-img-top gateway-img br-4" alt="..">
                            </div>
                            <div class="col-md-9">
                                <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                    @lang(\Str::limit(optional($order->property->details)->property_title, 30))
                                </h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card secbg br-4 bg-white">
                    <div class="card-body br-4">
                        <div class="row">
                            <!--<div class="col-md-3">
                                <img
                                    src="{{getFile(config('location.gateway.path').optional($order->gateway)->image)}}"
                                    class="card-img-top gateway-img br-4" alt="..">
                            </div>-->
                            <div class="col-md-12">
                                <!--<h4>@lang('Please Pay') {{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h4>
                                @if(!$order->property_id)
                                    <h4 class="my-3">@lang('To Get') {{getAmount($order->amount)}}  {{$basic->currency}}</h4>
                                @endif
                                <form action="{{$data->url}}" method="{{$data->method}}">
                                    <script
                                        src="{{$data->src}}"
                                        class="stripe-button"
                                        @foreach($data->val as $key=> $value)
                                        data-{{$key}}="{{$value}}"
                                        @endforeach>
                                    </script>
                                </form>-->

                                <div class="row align-items-center">
                                    <div class="col-6">
                                          <h4>@lang('Total')</h4>
                                    </div>
                                    <div class="col-6 text-end">
                                        <h4>{{getAmount($order->final_amount)}} {{$order->gateway_currency}}</h4>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-md-12 ms-auto">
                                        <form action="{{$data->url}}" method="{{$data->method}}">
                                            <script
                                                src="{{$data->src}}"
                                                class="stripe-button"
                                                @foreach($data->val as $key=> $value)
                                                data-{{$key}}="{{$value}}"
                                                @endforeach>
                                            </script>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>