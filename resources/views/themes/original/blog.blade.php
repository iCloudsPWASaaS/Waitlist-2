@extends($theme.'layouts.app') <!--extra-->
@section('title', trans($title))

@section('content')
@if (count($allBlogs) > 0)
<!-- blog section  -->
<section class="blog-page blog-details mt-5 overlay w-100" id="content">
    <div class="container">
        <div class="row g-lg-5">
            <div class="col-lg-12">
                <ul class="nav nav-pills my-3" id="pills-tab" role="tablist">
                    <li>
                        <a class="nav-link nav-pill-custom {{($slug == 'all') ? 'active':''}}" href="{{ route('blog') }}">All</a>
                    </li>
                    @foreach ($blogCategory as $category)
                    <li>
                        <a class="nav-link nav-pill-custom {{($slug == slug(@$category->details->name)) ? 'active':''}}" href="{{ route('CategoryWiseBlog', [slug(@$category->details->name), $category->id]) }}">@lang(optional(@$category->details)->name)</a>
                    </li>
                    @endforeach
                </ul>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-1">
                        {{ $allBlogs->links() }}
                    </ul>
                </nav>
            </div>

        </div>

        <div class="row">
            @forelse ($allBlogs as $blog)
            <div class="col-4">
                <div class="blog-box">
                    <div class="img-box">
                        <img src="{{ getFile(config('location.blog.path'). @$blog->image) }}" class="img-fluid" alt="@lang('blog image')" />
                    </div>
                    <div class="text-box p-3">
                        <div class="date-author">
                            <span><i class="fal fa-clock"></i> {{ dateTime(@$blog->created_at, 'M d, Y') }} </span>
                            <span><i class="fal fa-user-circle"></i> @lang(optional(@$blog->details)->author) </span>
                        </div>
                        <a href="{{route('blogDetails',[slug(@$blog->details->title), $blog->id])}}" class="title">{{ \Illuminate\Support\Str::limit(optional(@$blog->details)->title, 100) }}</a>
                        <!-- <p>
                            {{Illuminate\Support\Str::limit(strip_tags(optional(@$blog->details)->details),500)}}
                        </p> -->
                        <!-- <a href="{{route('blogDetails',[slug(@$blog->details->title), $blog->id])}}" class="btn-custom mt-3">@lang('Read more')</a> -->
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
@else
<div class="custom-not-found">
    <img src="{{ asset($themeTrue.'img/no_data_found.png') }}" alt="not found" class="img-fluid">
</div>
@endif
@endsection