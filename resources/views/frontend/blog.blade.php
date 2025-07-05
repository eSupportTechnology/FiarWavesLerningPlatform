@extends('frontend.master')


@section('content')

<style>
/* Enhanced Pageheader Section with Beautiful Gradient - Matching Login Page */
.pageheader-section {
    position: relative;
    min-height: 300px;
    background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 25%, #E85D04 75%, #d34a02 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

/* Animated background patterns */
.pageheader-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(232, 93, 4, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(232, 93, 4, 0.2) 0%, transparent 50%);
    animation: backgroundMove 20s ease-in-out infinite;
}

@keyframes backgroundMove {
    0%, 100% { transform: translateX(0) translateY(0); }
    25% { transform: translateX(-20px) translateY(-10px); }
    50% { transform: translateX(20px) translateY(-20px); }
    75% { transform: translateX(-10px) translateY(10px); }
}

/* Content styling */
.pageheader-content {
    position: relative;
    z-index: 2;
    color: white;
    text-align: center;
    padding: 60px 20px;
}

.pageheader-content h2 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
    letter-spacing: 1px;
}

/* Enhanced breadcrumb styling - Perfect horizontal alignment */
.pageheader-content .breadcrumb {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50px;
    padding: 12px 24px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    flex-wrap: nowrap !important;
    white-space: nowrap;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin-bottom: 0 !important;
    margin-top: 0 !important;
    height: 44px !important; /* Fixed height for perfect alignment */
    min-height: 44px !important;
    max-height: 44px !important;
    overflow: hidden;
    vertical-align: middle !important;
}

.pageheader-content .breadcrumb-item {
    font-weight: 500;
    font-size: 1rem;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    white-space: nowrap;
    line-height: 1 !important;
    margin: 0 !important;
    padding: 0 !important;
    height: 100% !important;
    vertical-align: middle !important;
}

.pageheader-content .breadcrumb-item a {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    transition: all 0.3s ease;
    padding: 4px 8px;
    border-radius: 20px;
    display: inline-flex !important;
    align-items: center !important;
    line-height: 1 !important;
    height: 100% !important;
    vertical-align: middle !important;
}

.pageheader-content .breadcrumb-item a:hover {
    color: white;
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.pageheader-content .breadcrumb-item.active {
    color: white;
    font-weight: 600;
    display: inline-flex !important;
    align-items: center !important;
    line-height: 1 !important;
    margin: 0 !important;
    padding: 4px 8px !important;
    height: 100% !important;
    vertical-align: middle !important;
}

.pageheader-content .breadcrumb-item + .breadcrumb-item::before {
    content: "→";
    color: rgba(255, 255, 255, 0.7);
    font-weight: bold;
    margin: 0 8px;
    float: none !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    line-height: 1 !important;
    height: 100% !important;
    vertical-align: middle !important;
    font-size: 16px !important;
    padding: 0 !important;
}

/* Floating elements for visual appeal */
.pageheader-section::after {
    content: '';
    position: absolute;
    width: 200px;
    height: 200px;
    background: linear-gradient(45deg, rgba(232, 93, 4, 0.2), rgba(232, 93, 4, 0.1));
    border-radius: 50%;
    top: -100px;
    right: -100px;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Responsive design */
@media (max-width: 768px) {
    .pageheader-section {
        min-height: 250px;
    }
    
    .pageheader-content {
        padding: 40px 15px;
    }
    
    .pageheader-content h2 {
        font-size: 2.2rem;
    }
    
    .pageheader-content .breadcrumb {
        padding: 8px 16px;
        font-size: 0.9rem;
        flex-wrap: nowrap !important;
        white-space: nowrap;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
        height: 38px !important;
        min-height: 38px !important;
        max-height: 38px !important;
    }
    
    .pageheader-content .breadcrumb::-webkit-scrollbar {
        display: none;
    }
    
    .pageheader-content .breadcrumb-item + .breadcrumb-item::before {
        margin: 0 6px;
        font-size: 0.9rem !important;
    }
}

@media (max-width: 480px) {
    .pageheader-content h2 {
        font-size: 1.8rem;
    }
    
    .pageheader-content .breadcrumb {
        padding: 6px 12px;
        font-size: 0.8rem;
        flex-wrap: nowrap !important;
        white-space: nowrap;
        overflow-x: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
        height: 32px !important;
        min-height: 32px !important;
        max-height: 32px !important;
    }
    
    .pageheader-content .breadcrumb::-webkit-scrollbar {
        display: none;
    }
    
    .pageheader-content .breadcrumb-item + .breadcrumb-item::before {
        margin: 0 4px;
        font-size: 0.7rem !important;
    }
}
</style>

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