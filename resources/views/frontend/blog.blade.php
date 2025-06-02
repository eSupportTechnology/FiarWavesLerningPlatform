
@extends('frontend.master')


@section('content')



    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>Our Blog Classic Posts</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog classic</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    
    <!-- blog section start here -->
    <div class="blog-section padding-tb section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <article>
                        <div class="section-wrapper">
                            <div class="row row-cols-1 justify-content-center g-4">
                                @forelse ($blogs as $blog)
                                    <div class="col">
                                        <div class="post-item style-2">
                                            <div class="post-inner">
                                                <!-- Media -->
                                                <div class="post-thumb" style="width: 100%; height: 300px; overflow: hidden; border-radius: 10px;">
                                                    @if ($blog->media_type === 'image' && $blog->media_path)
                                                        <a href="#"><img src="{{ asset('storage/' . $blog->media_path) }}" alt="{{ $blog->title }}" style="width: 100%; height: 100%; object-fit: cover;"></a>
                                                    @elseif ($blog->media_type === 'video' && $blog->media_path)
                                                        <video controls style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px;">
                                                            <source src="{{ asset('storage/' . $blog->media_path) }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    @else
                                                        <img src="{{ asset('frontend/assets/images/blog/default.jpg') }}" alt="No media" style="width: 100%; height: 100%; object-fit: cover;">
                                                    @endif
                                                </div>


                                                <!-- Content -->
                                                <div class="post-content">
                                                    <a href="#"><h3>{{ $blog->title }}</h3></a>
                                                    <div class="meta-post">
                                                        <ul class="lab-ul">
                                                            <i class="icofont-calendar" style=" margin-right:5px" ></i> {{ $blog->created_at->format('F d, Y') }}
                                                            <i class="icofont-ui-user" style="margin-left:20px; margin-right:5px"></i> Admin
                                                        </ul>
                                                    </div>
                                                    <p>{{ Str::limit(strip_tags($blog->content), 200) }}</p>
                                                    <a href="{{ route('frontend.blog.show', $blog->id) }}" class="lab-btn">
                                                        <span>Read More <i class="fas fa-arrow-up-right-from-square"></i></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <p>No blog posts available yet.</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Pagination -->
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $blogs->links() }}
                            </div>

                        </div>
                    </article>
                </div>
                <div class="col-lg-4 col-12">
                    <aside>
                        <div class="widget widget-search">
                            <form action="/" class="search-wrapper">
                                <input type="text" name="s" placeholder="Search...">
                                <button type="submit"><i class="icofont-search-2"></i></button>
                            </form>
                        </div>
                        
    
                        <div class="widget widget-post">
                            <div class="widget-header">
                                <h5 class="title">Most Popular Post</h5>
                            </div>
                            <ul class="widget-wrapper">
                                @foreach($blogs->take(4) as $post)
                                    <li class="d-flex flex-wrap justify-content-between align-items-center">
                                        <div class="post-thumb" style="width: 90px; height: 70px; overflow: hidden; border-radius: 5px;">
                                            @if ($post->media_type === 'image' && $post->media_path)
                                                <a href="#">
                                                    <img src="{{ asset('storage/' . $post->media_path) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                                </a>
                                            @elseif ($post->media_type === 'video' && $post->media_path)
                                                <a href="#">
                                                    <video muted autoplay loop style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                                                        <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                                                    </video>
                                                </a>
                                            @else
                                                <img src="{{ asset('frontend/assets/images/blog/default.jpg') }}" alt="No media" style="width: 100%; height: 100%; object-fit: cover;">
                                            @endif
                                        </div>
                                        <div class="post-content ps-2" style="width: calc(100% - 100px);">
                                            <a href="#"><h6 class="mb-1">{{ Str::limit($post->title, 40) }}</h6></a>
                                            <p class="mb-0" style="font-size: 13px; color: #777;">{{ $post->created_at->format('M d, Y') }}</p>
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
    <!-- blog section ending here -->


    @endsection