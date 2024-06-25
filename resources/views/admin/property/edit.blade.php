@extends('admin.layouts.app')
@section('title')
@lang('Edit a Property')
@endsection
@section('content')

<div class="card card-primary m-0 m-md-4 my-4 m-md-0 shadow">
    <div class="card-body">
        <div class="media justify-content-end">
            <a href="{{route('admin.propertyList',['all'])}}" class="btn btn-sm  btn-primary btn-rounded mr-2">
                <span><i class="fas fa-arrow-left"></i> @lang('Back')</span>
            </a>
        </div>

        <!--<ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($languages as $key => $language)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }} language_tab" data-toggle="tab"
                           href="#lang-tab-{{ $key }}" role="tab" aria-controls="lang-tab-{{ $key }}"
                           aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-languageid="{{ $language->id }}">@lang($language->name)</a>
                    </li>
                @endforeach
            </ul>-->

        <div class="tab-content mt-5" id="myTabContent">
            @foreach($languages as $key => $language)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="lang-tab-{{ $key }}" role="tabpanel">
                <form method="post" action="{{route('admin.propertyUpdate', [$id, $language->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card">
                        <div class="card-header text-primary">
                            <span class="propertyDetailsLabel">@lang('Update Property Details')</span>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>@lang('Title') <span class="text-danger">*</span></label>
                                        <input type="text" name="property_title[{{ $language->id }}]" value="<?php echo old('property_title' . $language->id, isset($singlePropertyDetails[$language->id]) ? $singlePropertyDetails[$language->id][0]->property_title : '') ?>" class="form-control">
                                        @error('property_title'.'.'.$language->id)
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @if ($loop->index == 0)
                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold">@lang('Address') <span class="text-danger">*</span></label>
                                        <select name="address_id" class="form-control  type addressList">
                                            @foreach($allAddress as $address)
                                            <option value="{{ $address->id }}" {{ optional($singlePropertyDetails[$language->id][0]->manageProperty)->address_id == $address->id ? 'selected' : '' }}>@lang(optional($address->details)->title)</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('address_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>@lang('Location')</label>
                                        <input type="text" name="location" value="{{ $singlePropertyDetails[$language->id][0]->manageProperty->location }}" class="form-control @error('location') is-invalid @enderror">
                                        @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-xl-3">
                                    <label for="before_expiry_date"> @lang('Amenities')</label>
                                    <select name="amenity_id[]" class="form-control propertyAmenities @error('amenity_id') is-invalid @enderror" multiple="multiple">
                                        <option disabled>@lang('Choose items')</option>
                                        @foreach($allAmenities as $amenity)
                                        <option value="{{ $amenity->id }}" {{ in_array($amenity->id, $singlePropertyDetails[$language->id][0]->manageProperty->amenity_id) ? 'selected' : '' }}>@lang(optional($amenity->details)->title)</option>
                                        @endforeach
                                    </select>
                                    @error('amenity_id')
                                    <span class="text-danger">@lang($message)</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-xl-6">
                                    <label for="before_expiry_date"> @lang('Facilities')</label>
                                    <select name="facility_id[]" class="form-control propertyAmenities @error('facility_id') is-invalid @enderror" multiple>
                                        <option disabled>@lang('Choose items')</option>
                                        @if($facilities)
                                        @foreach($facilities as $facility)
                                        <option value="{{ $facility->id }}" {{ in_array($facility->id, $singlePropertyDetails[$language->id][0]->manageProperty->facility_id ? $singlePropertyDetails[$language->id][0]->manageProperty->facility_id : []) ? 'selected' : '' }}>{{ $facility->title }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('facility_id')
                                    <span class="text-danger">@lang($message)</span>
                                    @enderror
                                </div>

                                <style>
                                    .bootstrap-tagsinput .badge {
                                        margin: 2px 5px;
                                    }
                                </style>

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label>@lang('Tags') (with comma separator)</label>
                                        <input type="text" name="property_tags" value="{{ $singlePropertyDetails[$language->id][0]->manageProperty->property_tags }}" placeholder="@lang('Property Tags')" class="form-control @error('property_tags') is-invalid @enderror" data-role="tagsinput">
                                        @error('property_tags')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                            </div>


                            <div class="row">
                                <div class="col-md-12 col-xl-12 col-12 property__details">
                                    <div class="form-group">
                                        <label for="details"> @lang('Details') </label>
                                        <textarea class="form-control summernote @error('details'.'.'.$language->id) is-invalid @enderror" name="details[{{ $language->id }}]" id="summernote" rows="15" value="<?php echo old('details' . $language->id, isset($singlePropertyDetails[$language->id]) ? $singlePropertyDetails[$language->id][0]->details : '') ?>">{{ @$singlePropertyDetails[$language->id][0]->details }}</textarea>
                                        @error('details')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-xl-12 col-12 property__details">
                                    <div class="form-group">
                                        <label for="details"> @lang('Funding Timeline') </label>
                                        <textarea class="form-control summernote @error('funding_timeline'.'.'.$language->id) is-invalid @enderror" name="funding_timeline[{{ $language->id }}]" id="summernote" rows="15" value="<?php echo old('funding_timeline' . $language->id, isset($singlePropertyDetails[$language->id]) ? $singlePropertyDetails[$language->id][0]->funding_timeline : '') ?>">{{ @$singlePropertyDetails[$language->id][0]->funding_timeline }}</textarea>
                                        @error('funding_timeline')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 col-xl-12 col-12 property__details">
                                    <div class="form-group">
                                        <label for="details"> @lang('Other Details') </label>
                                        <textarea class="form-control summernote @error('details_other'.'.'.$language->id) is-invalid @enderror" name="details_other[{{ $language->id }}]" id="summernote" rows="15" value="<?php echo old('details_other' . $language->id, isset($singlePropertyDetails[$language->id]) ? $singlePropertyDetails[$language->id][0]->details_other : '') ?>">{{ @$singlePropertyDetails[$language->id][0]->details_other }}</textarea>
                                        @error('details_other')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                @if ($loop->index == 0)
                                <div class="col-md-5 col-xl-5 col-12">
                                    <div class="form-group">
                                        <label for="thumbnail">{{ ('Thumbnail') }} <span class="text-danger">*</span></label>
                                        <div class="image-input property_image_input">
                                            <label for="image-upload" id="image-label"><i class="fas fa-upload"></i></label>
                                            <input type="file" name="thumbnail" placeholder="@lang('Choose image')" id="image" class="form-control @error('thumbnail') is-invalid @enderror">
                                            <img id="image_preview_container" class="preview-image" src="{{ asset(getFile(config('location.propertyThumbnail.path').(isset($singlePropertyDetails[$language->id]) ? @$singlePropertyDetails[$language->id][0]->manageProperty->thumbnail : ''))) }}" alt="@lang('preview image')">
                                        </div>
                                        @error('thumbnail')
                                        <span class="text-danger">@lang($message)</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-7 col-xl-7 col-12">
                                    <div class="form-group" id="tab3">
                                        <label for="details"> @lang('Property Galary Images') </label>
                                        <div class="property-image"></div>
                                        @error('property_image.*')
                                        <span class="text-danger">@lang($message)</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3 col-xl-3">
                                    <div class="form-group">
                                        <label>@lang('Featured Property')</label>
                                        <div class="custom-switch-btn">
                                            <input type='hidden' value='1' name="is_featured" {{ old('is_featured', $singlePropertyDetails[$language->id][0]->manageProperty->is_featured) == "1" ? 'checked' : '' }}>
                                            <input type="checkbox" name="is_featured" id="is_featured" class="custom-switch-checkbox" value="0" {{ old('is_featured', $singlePropertyDetails[$language->id][0]->manageProperty->is_featured) == "0" ? 'checked' : '' }}>
                                            <label class="custom-switch-checkbox-label" for="is_featured">
                                                <span class="custom-switch-checkbox-for-installments"></span>
                                                <span class="custom-switch-checkbox-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="col-md-3 col-xl-3">
                                                <div class="form-group">
                                                    <label>@lang('Can investors see available funds?')</label>
                                                    <div class="custom-switch-btn">
                                                        <input type='hidden' value='1'
                                                               name="is_available_funding" {{ old('is_available_funding', $singlePropertyDetails[$language->id][0]->manageProperty->is_available_funding) == "1" ? 'checked' : '' }}>
                                                        <input type="checkbox" name="is_available_funding" id="is_available_funding"
                                                               class="custom-switch-checkbox"
                                                               value="0" {{ old('is_available_funding', $singlePropertyDetails[$language->id][0]->manageProperty->is_available_funding) == "0" ? 'checked' : '' }}>
                                                        <label class="custom-switch-checkbox-label" for="is_available_funding">
                                                            <span class="custom-switch-checkbox-for-installments"></span>
                                                            <span class="custom-switch-checkbox-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>-->

                                <div class="col-md-3 col-xl-3">
                                    <div class="form-group">
                                        <label>Property No</label>
                                        <div class="custom-switch-btn">
                                            <input type='text' value="{{ old('property_no', $singlePropertyDetails[$language->id][0]->manageProperty->property_no) }}" name="property_no" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-xl-3">
                                    <div class="form-group">
                                        <label>Property Type</label>
                                        <select name="property_type" class="form-control property_type" id="property_type">
                                            @foreach($property_type as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $singlePropertyDetails[$language->id][0]->manageProperty->type_of_property ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-xl-6 mt-4 mb-3 pl-2 pr-2 pt-1 pb-1 ml-2">
                                    <a href="javascript:void(0)" class="btn btn-primary btn-rounded generate" data-lang="{{$language->id}}"><i class="fa fa-plus-circle"></i> @lang('Add Document')</a>
                                </div>
                            </div>

                            @if(!empty($singlePropertyDetails[$language->id][0]->faq))
                            @foreach($singlePropertyDetails[$language->id][0]->faq as $key => $value)
                            <div class="row">
                                <div class="col-md-12 col-log-12 col-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="faq_title[]" class="form-control" type="text" value="{{ @$value->field_name }}">
                                            <textarea class="form-control" name="faq_details[]" rows="1" placeholder="@lang('Google Doc Link')">{{ @$value->field_value }}</textarea>
                                            <span class="input-group-btn">
                                                <button class="btn btn-danger delete_desc" type="button">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif

                            @php
                            $maxNum = old('faq_title') && old('faq_details') ? max(count(old('faq_title')), count(old('faq_details'))) : (old('faq_title') && !old('faq_details') ? count(old('faq_title')) : (!old('faq_title') && old('faq_details') ? count(old('faq_title')) : 0));
                            @endphp

                            <div class="row addedField{{ $language->id }}">
                                @for($i = 0; $i < $maxNum; $i++) <div class="col-md-12 col-log-12 col-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="faq_title[]" class="form-control" type="text" value="{{ old('faq_title.'.$i) }}" placeholder="{{trans('Document Title')}}">
                                            <textarea class="form-control" name="faq_details[]" id="summernote" rows="1" placeholder="@lang('Google Doc Link')">{{ old('faq_details.'.$i) }}</textarea>
                                            <span class="input-group-btn">
                                                <button class="btn btn-danger delete_desc" type="button">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                            </div>
                            @endfor
                        </div>

                    </div>
            </div>

            @if ($loop->index == 0)
            <div class="card">
                <div class="card-header text-primary">
                    <span class="propertyDetailsLabel">Update Card Details</span>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Type of Deal</label>
                                <select name="type_of_deal" class="form-control" id="type_of_deal">
                                    @foreach($property_deal as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $singlePropertyDetails[$language->id][0]->manageProperty->type_of_deal ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Property Value</label>
                                <div class="input-group">
                                    <input type="text" name="property_value" id="property_value" class="form-control @error('property_value') is-invalid @enderror" placeholder="0.00" value="{{ old('property_value', $singlePropertyDetails[$language->id][0]->manageProperty->property_value) }}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Annual Rental Income (Net)</label>
                                <div class="input-group">
                                    <input type="text" name="rental_income" id="rental_income" class="form-control @error('rental_income') is-invalid @enderror" placeholder="0.00" value="{{ old('rental_income', $singlePropertyDetails[$language->id][0]->manageProperty->rental_income) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Annual Rental Income (Gross)</label>
                                <div class="input-group">
                                    <input type="text" name="rental_income_gross" id="rental_income_gross" class="form-control @error('rental_income_gross') is-invalid @enderror" placeholder="0.00" value="{{ old('rental_income_gross', $singlePropertyDetails[$language->id][0]->manageProperty->rental_income_gross) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>@lang('Invest Type')</label>
                                <div class="custom-switch-btn">
                                    <input type='hidden' value='0' name="is_invest_type" {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" ? 'checked' : '' }}>
                                    <input type="checkbox" name="is_invest_type" id="is_invest_type" class="custom-switch-checkbox" value="1" {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "1" ? 'checked' : '' }}>
                                    <label class="custom-switch-checkbox-label" for="is_invest_type">
                                        <span class="custom-switch-checkbox-for-investType"></span>
                                        <span class="custom-switch-checkbox-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 fixedAmount {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" ? 'd-block' : 'd-none' }}">
                            <div class="form-group">
                                <label>Property Card Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="fixed_amount" class="form-control @error('fixed_amount') is-invalid @enderror" placeholder="0.00" value="{{ old('fixed_amount', $singlePropertyDetails[$language->id][0]->manageProperty->fixed_amount) }}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" id="fixedAmount" autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                                @error('fixed_amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 rangeAmount {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" ? 'd-none' : '' }} ">
                            <div class="form-group">
                                <label>Property Card Price (Min) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="minimum_amount" class="form-control @error('minimum_amount') is-invalid @enderror" placeholder="0.00" value="{{ old('minimum_amount', $singlePropertyDetails[$language->id][0]->manageProperty->minimum_amount) }}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                                @error('minimum_amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3 rangeAmount {{ old('is_invest_type', $singlePropertyDetails[$language->id][0]->manageProperty->is_invest_type) == "0" ? 'd-none' : '' }}">
                            <div class="form-group">
                                <label>Property Card Price (Max) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" id="maximum_amount" name="maximum_amount" class="form-control @error('maximum_amount') is-invalid @enderror" placeholder="0.00" value="{{ old('maximum_amount', $singlePropertyDetails[$language->id][0]->manageProperty->maximum_amount) }}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                                @error('maximum_amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>@lang('Raised Amount')</label>
                                <div class="input-group">
                                    <input type="text" name="total_investment_amount" id="total_investment_amount"
                                        class="form-control @error('total_investment_amount') is-invalid @enderror"
                                        placeholder="0.00"
                                        value="{{ old('total_investment_amount', $singlePropertyDetails[$language->id][0]->manageProperty->total_investment_amount) }}"
                                        onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                    <div class="input-group-append">
                                    <span
                                        class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                                @error('total_investment_amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Property Yield</label>
                                <div class="input-group">
                                    <input type="text" name="property_yield" id="property_yield" class="form-control @error('property_yield') is-invalid @enderror" placeholder="0.00" value="{{ old('property_yield', $singlePropertyDetails[$language->id][0]->manageProperty->property_yield) }}" onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Annual Income (Est.)</label>
                                <div class="input-group">
                                    <input type="text" name="rental_income_est" id="rental_income_est" class="form-control @error('rental_income_est') is-invalid @enderror" placeholder="0.00" value="{{ old('rental_income_est', $singlePropertyDetails[$language->id][0]->manageProperty->rental_income_est) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <!--<label>@lang('Profit Range')</label>-->
                                <label>ROI (Return on Investment)</label>
                                <div class="input-group">
                                    <input type="text" name="profit" id="profit" class="form-control @error('profit') is-invalid @enderror" placeholder="0.00" value="{{ old('profit', $singlePropertyDetails[$language->id][0]->manageProperty->profit) }}">
                                    <span class="input-group-text">%</span>
                                </div>
                                @error('profit')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>ROI (months)</label>
                                <input type="text" name="roi_month" id="roi_month" class="form-control @error('roi_month') is-invalid @enderror" placeholder="" value="{{ old('roi_month', $singlePropertyDetails[$language->id][0]->manageProperty->roi_month) }}">
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <!--<label>@lang('After how many days?')</label>-->
                                <label>ROI Time</label>
                                <select name="how_many_days" id="how_many_days" class="form-control @error('how_many_days') is-invalid @enderror">
                                    <option value="" disabled>@lang('Select a Period')</option>
                                    @foreach($allSchedule as $schedule)
                                    <option value="{{ $schedule->id }}" {{ old('how_many_days', $singlePropertyDetails[$language->id][0]->manageProperty->how_many_days)  == $schedule->id ? 'selected' : ''}}>@lang($schedule->time) @lang($schedule->time_type)</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('how_many_days')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>@lang('Can Share Investment?')</label>
                                <div class="custom-switch-btn">
                                    <input type='hidden' value='1' name="is_investor" {{ old('is_investor', $singlePropertyDetails[$language->id][0]->manageProperty->is_investor) == "1" ? 'checked' : '' }}>
                                    <input type="checkbox" name="is_investor" id="is_investor" class="custom-switch-checkbox" value="0" {{ old('is_investor', $singlePropertyDetails[$language->id][0]->manageProperty->is_investor) == "0" ? 'checked' : '' }}>
                                    <label class="custom-switch-checkbox-label" for="is_investor">
                                        <span class="custom-switch-checkbox-for-installments"></span>
                                        <span class="custom-switch-checkbox-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <!--<label>@lang('Start Date')</label>-->
                                <label>Estimated Date of Repayment</label>
                                <input type="datetime-local" class="form-control start_date" name="start_date" value="{{\Illuminate\Support\Carbon::parse($singlePropertyDetails[$language->id][0]->manageProperty->start_date)}}" autocomplete="off" />
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>@lang('Status')</label>
                                <div class="custom-switch-btn">
                                    <input type='hidden' value='1' name='status' {{ old('status', $singlePropertyDetails[$language->id][0]->manageProperty->status) == "1" ? 'checked' : '' }}>
                                    <input type="checkbox" name="status" class="custom-switch-checkbox" id="status" value="0" {{ old('status', $singlePropertyDetails[$language->id][0]->manageProperty->status) == "0" ? 'checked' : '' }}>
                                    <label class="custom-switch-checkbox-label" for="status">
                                        <span class="custom-switch-checkbox-propertyStatus"></span>
                                        <span class="custom-switch-checkbox-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>How many cards issued</label>
                                <div class="input-group">
                                    <input type="text" name="card_issued" class="form-control @error('card_issued') is-invalid @enderror" placeholder="0" value="{{ old('card_issued', $singlePropertyDetails[$language->id][0]->manageProperty->card_issued) }}">
                                </div>
                                @error('card_issued')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> -->

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Payout Terms</label>
                                <select name="payout_terms" class="form-control" id="payout_terms">
                                    <option value="1" {{ $singlePropertyDetails[$language->id][0]->manageProperty->payout_terms == 1 ? 'selected' : '' }}>Quarterly</option>
                                    <option value="2" {{ $singlePropertyDetails[$language->id][0]->manageProperty->payout_terms == 2 ? 'selected' : '' }}>Bi-Annually</option>
                                    <option value="3" {{ $singlePropertyDetails[$language->id][0]->manageProperty->payout_terms == 3 ? 'selected' : '' }}>Annually</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Purchase Price</label>
                                <div class="input-group">
                                    <input type="text" name="purchase_price" id="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" placeholder="0.00" value="{{ old('purchase_price', $singlePropertyDetails[$language->id][0]->manageProperty->purchase_price) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Capital Appreciation</label>
                                <div class="input-group">
                                    <input type="text" name="capital_appreciation" id="capital_appreciation" class="form-control @error('capital_appreciation') is-invalid @enderror" placeholder="0.00" value="{{ old('capital_appreciation', $singlePropertyDetails[$language->id][0]->manageProperty->capital_appreciation) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Bonus</label>
                                <select name="bonus" class="form-control" id="bonus">
                                    <option value="0" {{ $singlePropertyDetails[$language->id][0]->manageProperty->is_bonus == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $singlePropertyDetails[$language->id][0]->manageProperty->is_bonus == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Development cost</label>
                                <div class="input-group">
                                    <input type="text" name="development_cost" id="development_cost" class="form-control @error('development_cost') is-invalid @enderror" placeholder="0.00" value="{{ old('development_cost', $singlePropertyDetails[$language->id][0]->manageProperty->development_cost) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Service charges</label>
                                <div class="input-group">
                                    <input type="text" name="service_charges" id="service_charges" class="form-control @error('service_charges') is-invalid @enderror" placeholder="0.00" value="{{ old('service_charges', $singlePropertyDetails[$language->id][0]->manageProperty->service_charges) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">@lang(config('basic.currency_symbol'))</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>Mgmt. and maintenance</label>
                                <input type="text" name="maintenance" id="maintenance" class="form-control @error('maintenance') is-invalid @enderror" placeholder="" value="{{ old('maintenance', $singlePropertyDetails[$language->id][0]->manageProperty->maintenance) }}">
                                <!-- <select name="maintenance" class="form-control" id="maintenance">
                                    <option value="0" {{ $singlePropertyDetails[$language->id][0]->manageProperty->maintenance == 0 ? 'selected' : '' }}>Outsourced</option>
                                    <option value="1" {{ $singlePropertyDetails[$language->id][0]->manageProperty->maintenance == 1 ? 'selected' : '' }}>Other</option>
                                </select> -->
                            </div>
                        </div>

                        <div class="col-md-3 col-xl-3">
                            <div class="form-group">
                                <label>User Card Limit</label>
                                <input type="text" name="user_card_limit" id="user_card_limit" class="form-control @error('user_card_limit') is-invalid @enderror" placeholder="" value="{{ old('user_card_limit', $singlePropertyDetails[$language->id][0]->manageProperty->user_card_limit) }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-12">
                <button type="submit" class="btn waves-effect waves-light btn-rounded btn-primary btn-block mt-3">
                    <span><i class="fas fa-save pr-2"></i> @lang('Save Changes')</span></button>
            </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection

@push('style-lib')
<link rel="stylesheet" href="{{ asset('assets/admin/css/summernote.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/global/css/image-uploader.css') }}" />
@endpush

@push('js-lib')
<script src="{{ asset('assets/admin/js/summernote.min.js')}}"></script>
<script src="{{ asset('assets/global/js/image-uploader.js') }}"></script>
@endpush

@push('js')

<script>
    'use strict'

    $('.summernote').summernote({
        height: 250,
        callbacks: {
            onBlurCodeview: function() {
                let codeviewHtml = $(this).siblings('div.note-editor').find('.note-codable').val();
                $(this).val(codeviewHtml);
            }
        }
    });

    $('#image').on("change", function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(document).ready(function() {
        $(".generate").on('click', function() {
            var lang = $(this).data('lang');
            var form = `<div class="col-md-12 col-log-12 col-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input name="faq_title[]" class="form-control" type="text"
                                        placeholder="{{trans('Document Title')}}">
                                        <textarea class="form-control summernote " name="faq_details[]" rows="1" placeholder="@lang('Google Doc Link')"></textarea>
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger delete_desc" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>`;

            $(`.addedField${lang}`).append(form)
        });

        $(document).on('click', '.delete_desc', function() {
            $(this).closest('.input-group').parent().remove();
        });

        /*$('.propertyAmenities').select2({
            width: '100%',
            placeholder: '@lang("Select Amenities")',
        });*/

        var property_images = {!!json_encode(optional(optional($singlePropertyDetails[1][0]->manageProperty)->image)->toArray()) !!};

        let preloaded = [];
        property_images.forEach(function(value, index) {
            preloaded.push({
                id: value.id,
                image_name: value.image,
                src: "{{ asset(config('location.property.path')) }}/" + value.image
            });
        });

        let propertyImageOptions = {
            preloaded: preloaded,
            imagesInputName: 'property_image',
            preloadedInputName: 'old_property_image',
            label: 'Drag & Drop files here or click to browse images',
            extensions: ['.jpg', '.jpeg', '.png'],
            mimes: ['image/jpeg', 'image/png'],
            maxSize: 5242880
        };

        $('.property-image').imageUploader(propertyImageOptions);

        $(document).on('input', '#totalInstallments', function() {
            let total_installments = $('#totalInstallments').val();
            let fixed_amount = $('#fixedAmount').val();
            let installment_amount = parseInt(fixed_amount) / parseInt(total_installments);
            let final_installment_amount = installment_amount.toFixed(2);
            $('#installmentAmount').val(final_installment_amount);
        });


        $(document).on('change', '#is_invest_type', function() {
            var isCheck = $(this).prop('checked');
            if (isCheck == false) {
                $('.rangeAmount').addClass('d-none');
                $('.rangeAmount').removeClass('d-block');
                $('.fixedAmount').removeClass('d-none');   
            } else {
                $('.rangeAmount').addClass('d-block');
                $('.rangeAmount').removeClass('d-none');
                $('.fixedAmount').removeClass('d-block');
                $('.fixedAmount').addClass('d-none');
            }
        });

        $(document).on('change', '#is_return_type', function() {
            var isCheck = $(this).prop('checked');

            if (isCheck == false) {
                $('.howManyTimes').removeClass('d-block');
                $('.howManyTimes').addClass('d-none');
            } else {
                $('.howManyTimes').removeClass('d-none');
                $('.howManyTimes').addClass('d-block');
            }
        });

        $(document).on('change', '#is_installment', function() {
            var isCheck = $(this).prop('checked');
            if (isCheck == false) {
                $('.installmentField').removeClass('d-none');
            } else {
                $('.installmentField').addClass('d-none');
            }
        });

        $('.propertyAmenities').select2({
            width: '100%',
            placeholder: '@lang("Select items")',
            tags: true
        });

        $('.addressList').select2({
            width: '100%',
            placeholder: '@lang("Select Address")',
        });

        $('select[name=period_duration]').select2({
            selectOnClose: true
        });

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })

        //extra
        $('#property_type').select2({
            width: '100%',
            placeholder: '@lang("Select Property Type")',
        });

        $('#type_of_deal').select2({
            width: '100%',
            placeholder: '@lang("Select Type of Deal")',
        });

        $(document).on("keydown keyup", "#rental_income_gross", function() {
            if ($('#is_invest_type').is(':checked')) {
                //console.log($('#is_invest_type:checked').val());
                $("#property_yield").val(parseFloat(parseFloat($("#rental_income_gross").val()) / parseFloat($("#maximum_amount").val()) * 100).toFixed(2));
                if (isNaN($("#property_yield").val())) {
                    $("#property_yield").val(0);
                }
            } else {
                $("#property_yield").val(parseFloat(parseFloat($("#rental_income_gross").val()) / parseFloat($("#fixedAmount").val()) * 100).toFixed(2));
                if (isNaN($("#property_yield").val())) {
                    $("#property_yield").val(0);
                }
            }  

            //$("#rental_income_est").val(parseFloat(parseFloat($("#rental_income").val()) / 12).toFixed(2));   
        });

        $(document).on("keydown keyup", "#total_investment_amount", function() {
            if ($('#is_invest_type').is(':checked')) {
                //console.log($('#is_invest_type:checked').val());
                $("#rental_income_est").val(parseFloat(parseFloat(parseFloat($("#total_investment_amount").val()) / parseFloat($("#maximum_amount").val()) * parseFloat($("#rental_income").val()))/12).toFixed(2));
                $("#profit").val(parseFloat(parseFloat(parseFloat($("#rental_income_est").val())/parseFloat($("#maximum_amount").val()))*100).toFixed(2));
                if (isNaN($("#rental_income_est").val())) {
                    $("#rental_income_est").val(0);
                }
                if (isNaN($("#profit").val())) {
                    $("#profit").val(0);
                }
            } else {
                $("#rental_income_est").val(parseFloat(parseFloat(parseFloat($("#total_investment_amount").val()) / parseFloat($("#fixedAmount").val()) * parseFloat($("#rental_income").val()))/12).toFixed(2));
                if (isNaN($("#rental_income_est").val())) {
                    $("#rental_income_est").val(0);
                }
            }  

            //$("#rental_income_est").val(parseFloat(parseFloat($("#rental_income").val()) / 12).toFixed(2));   
        });

        /* $(document).on("keydown keyup", "#purchase_price", function() {
            $("#capital_appreciation").val(parseFloat($("#property_value").val()) - parseFloat($("#purchase_price").val()));
            if (isNaN($("#capital_appreciation").val())) {
                $("#capital_appreciation").val(0);
            }
        }); */

    });
</script>

@endpush