@extends('admin.layouts.app')
@section('title')
    @lang('Manage Facility')
@endsection

@section('content')

    <div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">

        <div class="card-body">

            <button class="btn btn-sm  btn-primary btn-rounded float-right mb-2" type="button"
                    data-toggle="modal"
                    data-target="#addModal">
                <span><i class="fas fa-plus"></i> @lang('Create New')</span>
            </button>


            <div class="table-responsive">
                <table class="categories-show-table table table-hover table-striped table-bordered" id="zero_config">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">@lang('Title')</th>
                        <th scope="col">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($facilities as $item)
                        <tr>
                            <td data-label="@lang('Duration')">
                                @lang($item->title)
                            </td>

                            <td data-label="@lang('Action')">
                                <button class="btn btn-sm  btn-outline-primary btn-rounded btn-sm edit-button" type="button"
                                        data-toggle="modal"
                                        data-target="#editModal"
                                        data-title="{{$item->title}}"
                                        data-route="{{route('admin.update.facility',['id'=>$item->id])}}">
                                    <span><i class="fas fa-edit"></i></span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center text-na">@lang('No Data Found')</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Create New Facility')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.store.facility')}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label>@lang('Time')</label>
                            <div class="input-group mb-3">
                                <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="@lang('Title')">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">
                            <span>@lang('Cancel')</span>
                        </button>
                        <button type="submit" class="btn btn-primary btn-rounded">
                            <span><i class="fas fa-save"></i> @lang('Save Changes')</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">@lang('Edit Facility')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="editForm">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Title')</label>
                            <div class="input-group mb-3">
                                <input type="text" name="title" class="form-control edit_title" value="{{old('title')}}" placeholder="@lang('Title')">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">
                            <span>@lang('Cancel')</span>
                        </button>
                        <button type="submit" class="btn btn-primary btn-rounded">
                            <span><i class="fas fa-save"></i> @lang('Save Changes')</span></button>
                    </div>
                </form>
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


    @if ($errors->any())
        @php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        @endphp
        <script>
            "use strict";
            @foreach ($errors as $error)
            Notiflix.Notify.Failure("{{trans($error)}}");
            @endforeach
        </script>
    @endif

    <script>
        "use strict";
        $(document).ready(function () {
            $(document).on('click', '.edit-button', function () {
                $('#editForm').attr('action', $(this).data('route'))
                $('.edit_title').val($(this).data('title'))
            })

        });

    </script>
@endpush
