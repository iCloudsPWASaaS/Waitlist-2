@extends('admin.layouts.app')
@section('title')
    @lang('Default Template')
@endsection
@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
        <div class="card-body">


            <div class="table-responsive">
                <table id="zero_config"
                       class="table table-striped table-bordered no-wrap">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('No.')</th>
                        <th scope="col">@lang('Name')</th>
                        <th scope="col">@lang('Subject')</th>
                        <th scope="col">@lang('Template Key')</th>
                        <th scope="col">@lang('Status')</th>
                        @if(adminAccessRoute(config('role.website_controls.access.edit')))
                        <th scope="col">@lang('Action')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($emailTemplate as $template)
                        <tr>
                            <td> {{$loop->iteration}} </td>
                            <td>{{ $template->name }}</td>
                            <td>{{ $template->subject }}</td>
                            <td>{{ $template->template_key }}</td>
                            <td>
                                <span class="custom-badge badge-pill bg-{{($template->mail_status == 1) ?'success' : 'danger'}}">{{($template->mail_status == 1) ?trans('Active') : trans('Deactive')}}</span>
                            </td>
                            @if(adminAccessRoute(config('role.website_controls.access.edit')))
                            <td>
                                <a  href="{{ route('admin.email-template.edit',$template->id) }}" class="btn btn-sm btn-outline-primary btn-rounded" title="@lang('Edit')"><i class="fas fa-edit" aria-hidden="true"></i></a>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('style-lib')
    <link href="{{asset('assets/admin/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/datatable-basic.init.js') }}"></script>
@endpush
