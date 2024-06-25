@extends($theme.'layouts.app')
@section('title',trans('Home'))

@section('content')
    @include($theme.'partials.heroBanner')
    @include($theme.'sections.property')
    @include($theme.'sections.how-it-work')
    @include($theme.'sections.blog')
    @include($theme.'sections.testimonial')
    {{--@include($theme.'sections.faq')--}}
@endsection

<!--extra-->