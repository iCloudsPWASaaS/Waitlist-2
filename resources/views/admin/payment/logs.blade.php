

@extends('admin.layouts.app')
@section('title')
    @lang($page_title)
@endsection
@section('content')
    <div class="page-header card card-primary m-0 m-md-4 my-4 m-md-0 p-5 shadow">
        <form action="{{ route('admin.payment.search') }}" method="get">
            <div class="row justify-content-between align-items-center">

                <div class="col-md-4 col-lg-3 col-12">
                    <div class="form-group">
                        <label for="user">@lang('User')</label>
                        <input type="text" name="user" value="{{@request()->user}}" class="form-control"
                               placeholder="@lang('User name')">
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-12">
                    <div class="form-group">
                        <label for="trx_id">@lang('Transaction Id')</label>
                        <input type="text" name="trx_id" value="{{@request()->trx_id}}" class="form-control"
                               placeholder="@lang('Transaction id')">
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-12">
                    <div class="form-group">
                        <label for="trx_id">@lang('Property Reference')</label>
                        <input type="text" name="property_reference" value="{{@request()->property_reference}}" class="form-control"
                               placeholder="@lang('Property Reference')">
                    </div>
                </div>


                <div class="col-md-3 col-lg-3">
                    <div class="form-group">
                        <label>@lang('Payment Status')</label>
                        <select name="status" class="form-control">
                            <option value="">@lang('All Payment')</option>
                            <option value="1"
                                    @if(@request()->status == '1') selected @endif>@lang('Complete Payment')</option>
                            <option value="2"
                                    @if(@request()->status == '2') selected @endif>@lang('Pending Payment')</option>
                            <option value="3"
                                    @if(@request()->status == '3') selected @endif>@lang('Cancel Payment')</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4 col-12">
                    <label for="from_date">@lang('From Date')</label>
                    <input type="date" class="form-control from_date" name="from_date" value="{{ old('from_date',request()->from_date) }}" placeholder="@lang('From date')" autocomplete="off"/>
                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <label for="to_date">@lang('To Date')</label>
                    <input type="date" class="form-control to_date" name="to_date" value="{{ old('to_date',request()->to_date) }}" placeholder="@lang('To date')" autocomplete="off" disabled="true"/>
                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <label class="opacity-0">@lang('...')</label>
                    <button type="submit" class="btn waves-effect w-100 waves-light btn-primary"><i
                            class="fas fa-search"></i> @lang('Search')</button>
                </div>
            </div>
        </form>
    </div>


    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">

            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Trx Number')</th>
                        <th scope="col">@lang('Property Reference')</th>
                        <th scope="col">@lang('Method')</th>
                        <th scope="col">@lang('Amount')</th>
                        <th scope="col">@lang('Charge')</th>
                        <!-- <th scope="col">@lang('Payable')</th> --> <!-- extra -->
                        <th scope="col">@lang('Status')</th>
                        <th scope="col">@lang('Date')</th>
                        @if(adminAccessRoute(config('role.payment_settings.access.edit')))
                        <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($funds as $key => $fund)
                        <tr>
                            <td data-label="@lang('Name')">
                                <a href="{{route('admin.user-edit',[$fund->user_id])}}" target="_blank">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-3"><img src="{{getFile(config('location.user.path').optional($fund->user)->image) }}" alt="user" class="rounded-circle" width="45" height="45">
                                        </div>
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                @lang(optional($fund->user)->firstname) @lang(optional($fund->user)->lastname)
                                            </h5>
                                            <span class="text-muted font-14"><span>@</span>@lang(optional($fund->user)->username)</span>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td data-label="@lang('Trx Number')"
                                class="font-weight-bold text-uppercase">{{ $fund->transaction }}</td>

                            <td data-label="@lang('Trx Number')"
                                class="font-weight-bold text-uppercase">{{ $fund->property_reference }}</td>
                                
                            <td data-label="@lang('Method')">{{ optional($fund->gateway)->name }}</td>
                            <td data-label="@lang('Amount')"
                                class="font-weight-bold">{{ getAmount($fund->amount ) }} {{ $basic->currency }}</td>
                            <td data-label="@lang('Charge')"
                                class="text-success">{{ getAmount($fund->charge)}} {{ $basic->currency }}</td>
                            <!-- <td data-label="@lang('Payable')"
                                class="font-weight-bold">{{ getAmount($fund->final_amount) }} {{$fund->gateway_currency}}</td> -->


                            <td data-label="@lang('Status')">
                                @if($fund->status == 2)
                                    <span class="custom-badge bg-warning">@lang('Pending')</span>
                                @elseif($fund->status == 1)
                                    <span class="custom-badge bg-success">@lang('Approved')</span>
                                @elseif($fund->status == 3)
                                    <span class="custom-badge bg-danger">@lang('Rejected')</span>
                                @endif
                            </td>

                            <td data-label="@lang('Date')"> {{ dateTime($fund->created_at,'d M,Y H:i') }}</td>

                            @if(adminAccessRoute(config('role.payment_settings.access.edit')))
                            <td data-label="@lang('Action')">
                                @php
                                    if($fund->detail){
                                            $details =[];
                                              foreach($fund->detail as $k => $v){
                                                    if($v->type == "file"){
                                                        $details[kebab2Title($k)] = [
                                                            'type' => $v->type,
                                                            'field_name' => getFile(config('location.deposit.path').date('Y',strtotime($fund->created_at)).'/'.date('m',strtotime($fund->created_at)).'/'.date('d',strtotime($fund->created_at)) .'/'.$v->field_name)
                                                            ];
                                                    }else{
                                                        $details[kebab2Title($k)] =[
                                                            'type' => $v->type,
                                                            'field_name' => $v->field_name
                                                        ];
                                                    }
                                              }
                                        }else{
                                            $details = null;
                                        }
                                @endphp

                        
                                    <button
                                        class="edit_button btn  {{($fund->status == 2) ?  'btn-outline-primary btn-rounded' : 'btn-outline-primary btn-rounded'}}  btn-sm "
                                        data-toggle="modal" data-target="#myModal"
                                        data-title="{{($fund->status == 2) ?  trans('Edit') : trans('Details')}}"

                                        data-id="{{ $fund->id }}"
                                        data-feedback="{{ $fund->feedback }}"
                                        data-info="{{json_encode($details)}}"
                                        data-amount="{{ getAmount($fund->amount)}} {{ $basic->currency }}"
                                        data-username="{{ optional($fund->user)->username }}"
                                        data-route="{{route('admin.payment.action',$fund->id)}}"
                                        data-status="{{$fund->status}}">

                                        @if(($fund->status == 2))
                                            <i class="fa fa-pencil-alt"></i>
                                        @else
                                            <i class="fa fa-eye"></i>
                                        @endif

                                    </button>
                     
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">
                                <p class="text-na text-center" >@lang('No Data Found')</p>
                            </td>
                        </tr>

                    @endforelse
                    </tbody>
                </table>
                {{ $funds->appends($_GET)->links('partials.pagination') }}
            </div>
        </div>
    </div>

    <!-- Modal for Edit button -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content ">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="myModalLabel">@lang('Deposit Information')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <form role="form" method="POST" class="actionRoute" action="" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <ul class="list-group withdraw-detail">
                        </ul>

                        <div class="get-feedback">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark btn-rounded" data-dismiss="modal">@lang('Close')</button>
                        @if(Request::routeIs('admin.payment.pending'))
                            <input type="hidden" class="action_id" name="id">
                            <button type="submit" class="btn btn-primary btn-rounded" name="status"
                                    value="1">@lang('Approve')</button>
                            <button type="submit" class="btn btn-danger btn-rounded" name="status"
                                    value="3">@lang('Reject')</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        "use strict";
        $(document).ready(function () {
            $('.from_date').on('change', function (){
                $('.to_date').removeAttr('disabled');
            });
            $(document).on("click", '.edit_button', function (e) {
                var id = $(this).data('id');
                var feedback = $(this).data('feedback');

                $(".action_id").val(id);
                $(".actionRoute").attr('action', $(this).data('route'));
                var details = Object.entries($(this).data('info'));
                var list = [];
                details.map(function (item, i) {
                    if (item[1].type == 'file') {
                        var singleInfo = `<br><img src="${item[1].field_name}" alt="..." class="w-100">`;
                    } else {
                        var singleInfo = `<span class="font-weight-bold ml-3">${item[1].field_name}</span>  `;
                    }
                    list[i] = ` <li class="list-group-item"><span class="font-weight-bold "> ${item[0].replace('_', " ")} </span> : ${singleInfo}</li>`
                });
                $('.withdraw-detail').html(list);

                if (feedback == '') {
                    var $res = `<div class="form-group"><br>
                                <label class="font-weight-bold">{{trans('Send You Feedback')}}</label>
                                <textarea name="feedback" class="form-control" row="3" required>{{old('feedback')}}</textarea>
                            </div>`
                } else {
                    var $res = `<h5>{{trans('Feedback')}}</h5>
                    <p>${feedback}</p>`
                }

                $('.get-feedback').html($res)
            });
        });
    </script>
@endpush
