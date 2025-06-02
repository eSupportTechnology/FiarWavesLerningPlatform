@extends('frontend.master')

@section('title', $blog->title)

@section('content')

<!-- Page Header -->
<div class="pageheader-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pageheader-content text-center">
                    <h2>{{ $blog->title }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Blog Section Start -->
<div class="blog-section blog-single padding-tb section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Blog Content -->
            <div class="col-lg-8 col-12">
                <article>
                    <div class="section-wrapper">
                        <div class="post-item style-2">
                            <div class="post-inner">
                                <!-- Media -->
                                <div class="post-thumb mb-4" style="width: 100%; height: 400px; overflow: hidden; border-radius: 10px;">
                                    @if($blog->media_type === 'image' && $blog->media_path)
                                        <img src="{{ asset('storage/' . $blog->media_path) }}" alt="{{ $blog->title }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    @elseif($blog->media_type === 'video' && $blog->media_path)
                                        <video controls style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                            <source src="{{ asset('storage/' . $blog->media_path) }}" type="video/mp4">
                                        </video>
                                    @endif
                                </div>



                                <!-- Content -->
                                <div class="post-content">
                                    <h2>{{ $blog->title }}</h2>

                                    <div class="meta-post mb-3">
                                        <ul class="lab-ul d-flex flex-wrap gap-3">
                                            <i class="fas fa-calendar-alt text-danger me-1"></i> {{ $blog->created_at->format('F d, Y') }}
                                            <i class="fas fa-user text-danger me-1"></i> Admin
                                        </ul>
                                    </div>

                                    <div class="blog-body-content">
                                        {!! $blog->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Comments Section Placeholder (Future) -->
                        {{-- You can add comment system later here --}}
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 col-12">
                <aside>
                    <div class="widget widget-post">
                        <div class="widget-header">
                            <h5 class="title">Recent Blog Posts</h5>
                        </div>
                        <ul class="widget-wrapper">
                            @foreach($recentBlogs as $recent)
                                <li class="d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="post-thumb" style="width: 80px; height: 60px; overflow: hidden; border-radius: 5px;">
                                        @if($recent->media_type === 'image')
                                            <a href="{{ route('frontend.blog.show', $recent->id) }}">
                                                <img src="{{ asset('storage/' . $recent->media_path) }}" alt="{{ $recent->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            </a>
                                        @elseif($recent->media_type === 'video')
                                            <a href="{{ route('frontend.blog.show', $recent->id) }}">
                                                <video muted autoplay loop style="width: 100%; height: 100%; object-fit: cover;">
                                                    <source src="{{ asset('storage/' . $recent->media_path) }}" type="video/mp4">
                                                </video>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="post-content ps-2" style="width: calc(100% - 100px);">
                                        <a href="{{ route('frontend.blog.show', $recent->id) }}">
                                            <h6 class="mb-1">{{ Str::limit($recent->title, 50) }}</h6>
                                        </a>
                                        <p class="mb-0 text-muted" style="font-size: 13px;">{{ $recent->created_at->format('M d, Y') }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>

        </div>
    </div>
</div>
<!-- Blog Section End -->

@endsection
