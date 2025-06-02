@extends('frontend.master')

@section('title', 'Home - Edukon')

@section('content')


    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>Shop Single Pages</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    
    <!-- blog section start here -->
    <div class="shop-single padding-tb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <article>
                        <div class="product-details">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <div class="product-thumb">
                                        <div class="swiper-container pro-single-top">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="single-thumb"><img src="assets/images/shop/01.jpg" alt="shop"></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="single-thumb"><img src="assets/images/shop/02.jpg" alt="shop"></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="single-thumb"><img src="assets/images/shop/03.jpg" alt="shop"></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="single-thumb"><img src="assets/images/shop/04.jpg" alt="shop"></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="single-thumb"><img src="assets/images/shop/05.jpg" alt="shop"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-container pro-single-thumbs">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <div class="single-thumb"><img src="assets/images/shop/01.jpg" alt="shop"></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="single-thumb"><img src="assets/images/shop/02.jpg" alt="shop"></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="single-thumb"><img src="assets/images/shop/03.jpg" alt="shop"></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="single-thumb"><img src="assets/images/shop/04.jpg" alt="shop"></div>
                                                </div>
                                                <div class="swiper-slide">
                                                    <div class="single-thumb"><img src="assets/images/shop/05.jpg" alt="shop"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="pro-single-next"><i class="icofont-rounded-left"></i></div>
                                        <div class="pro-single-prev"><i class="icofont-rounded-right"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="post-content">
                                        <h4>Product Text here</h4>
                                        <p class="rating">
                                            <i class="icofont-star"></i>
                                            <i class="icofont-star"></i>
                                            <i class="icofont-star"></i>
                                            <i class="icofont-star"></i>
                                            <i class="icofont-star"></i>
                                            (3 review)
                                        </p>
                                        <h4>$ 340.00</h4>
                                        <h6>Product Description</h6>
                                        <p>Energistia an deliver atactica metrcs after avsionary Apropria trnsition enterpris an sources applications emerging 	psd template communities.</p>
                                        <form>
                                            <div class="select-product size">
                                                <select>
                                                    <option>Select Size</option>
                                                    <option>SM</option>
                                                    <option>MD</option>
                                                    <option>LG</option>
                                                    <option>XL</option>
                                                    <option>XXL</option>
                                                </select>
                                                <i class="icofont-rounded-down"></i>
                                            </div>
                                            <div class="select-product color">
                                                <select>
                                                    <option>Select Color</option>
                                                    <option>Pink</option>
                                                    <option>Ash</option>
                                                    <option>Red</option>
                                                    <option>White</option>
                                                    <option>Blue</option>
                                                </select>
                                                <i class="icofont-rounded-down"></i>
                                            </div>
                                            <div class="cart-plus-minus">
                                                <div class="dec qtybutton">-</div>
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1">
                                                <div class="inc qtybutton">+</div>
                                            </div>
                                            <div class="discount-code">
                                                <input type="text" placeholder="Enter Discount Code">
                                            </div>
                                            <button type="submit" class="lab-btn"><span>Add To Cart</span></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="review">
                            <ul class="review-nav lab-ul">
                                <li class="desc" data-target="description-show">Description</li>
                                <li class="rev active" data-target="review-content-show">Reviews 4</li>
                            </ul>
                            <div class="review-content review-content-show">
                                <div class="review-showing">
                                    <ul class="content lab-ul">
                                        <li>
                                            <div class="post-thumb">
                                                <img src="assets/images/instructor/01.jpg" alt="shop">
                                            </div>
                                            <div class="post-content">
                                                <div class="entry-meta">
                                                    <div class="posted-on">
                                                        <a href="#">Ganelon Boileau</a>
                                                        <p>Posted on December 25, 2017 at 6:57 am</p>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                    </div>
                                                </div>
                                                <div class="entry-content">
                                                    <p>Enthusiast build innovativ initiatives before lonterm high-impact awesome theme seo psd porta monetize covalent leadership after without resource.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-thumb">
                                                <img src="assets/images/instructor/02.jpg" alt="shop">
                                            </div>
                                            <div class="post-content">
                                                <div class="entry-meta">
                                                    <div class="posted-on">
                                                        <a href="#">Morgana Cailot</a>
                                                        <p>Posted on December 25, 2017 at 6:57 am</p>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                    </div>
                                                </div>
                                                <div class="entry-content">
                                                    <p>Enthusiast build innovativ initiatives before lonterm high-impact awesome theme seo psd porta monetize covalent leadership after without resource.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-thumb">
                                                <img src="assets/images/instructor/03.jpg" alt="shop">
                                            </div>
                                            <div class="post-content">
                                                <div class="entry-meta">
                                                    <div class="posted-on">
                                                        <a href="#">Telford Bois</a>
                                                        <p>Posted on December 25, 2017 at 6:57 am</p>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                    </div>
                                                </div>
                                                <div class="entry-content">
                                                    <p>Enthusiast build innovativ initiatives before lonterm high-impact awesome theme seo psd porta monetize covalent leadership after without resource.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="post-thumb">
                                                <img src="assets/images/instructor/04.jpg" alt="shop">
                                            </div>
                                            <div class="post-content">
                                                <div class="entry-meta">
                                                    <div class="posted-on">
                                                        <a href="#">Cher Daviau</a>
                                                        <p>Posted on December 25, 2017 at 6:57 am</p>
                                                    </div>
                                                    <div class="rating">
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                    </div>
                                                </div>
                                                <div class="entry-content">
                                                    <p>Enthusiast build innovativ initiatives before lonterm high-impact awesome theme seo psd porta monetize covalent leadership after without resource.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="client-review">
                                        <div class="review-form">
                                            <div class="review-title">
                                                <h5>Add a Review</h5>
                                            </div>
                                            <form action="action" class="row">
                                                <div class="col-md-4 col-12 order-md-2">
                                                    <div class="rating">
                                                        <span class="rating-title">Your Rating : </span>
                                                        <ul class="lab-ul">
                                                            <li>
                                                                <i class="icofont-star"></i>
                                                            </li>
                                                            <li>
                                                                <i class="icofont-star"></i>
                                                            </li>
                                                            <li>
                                                                <i class="icofont-star"></i>
                                                            </li>
                                                            <li>
                                                                <i class="icofont-star"></i>
                                                            </li>
                                                            <li>
                                                                <i class="icofont-star"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12 order-md-0">
                                                    <input type="text" name="name" placeholder="Full Name">
                                                </div>
                                                <div class="col-md-4 col-12 order-md-1">
                                                    <input type="text" name="email" placeholder="Email Adress">
                                                </div>
                                                <div class="col-md-12 col-12 order-md-3">
                                                    <textarea rows="5" placeholder="Type Here Message"></textarea>
                                                </div>
                                                <div class="col-12 order-md-4">
                                                    <button class="defult-btn" type="submit">Submit Review</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                    <div class="post-item">
                                        <div class="post-thumb">
                                            <img src="assets/images/shop/01.jpg" alt="shop">
                                        </div>
                                        <div class="post-content">
                                            <ul class="lab-ul">
                                                <li>
                                                    Donec non est at libero vulputate rutrum.
                                                </li>
                                                <li>
                                                    Morbi ornare lectus quis justo gravida semper.
                                                </li>
                                                <li>
                                                    Pellentesque aliquet, sem eget laoreet ultrices.
                                                </li>
                                                <li>
                                                    Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.
                                                </li>
                                                <li>
                                                    Donec a neque libero.
                                                </li>
                                                <li>
                                                    Pellentesque aliquet, sem eget laoreet ultrices.
                                                </li>
                                                <li>
                                                    Morbi ornare lectus quis justo gravida semper..
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    </p>
                                </div>
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
                        <div class="widget shop-widget">
                            <div class="widget-header">
                                <h5>All Categories</h5>
                            </div>
                            <div class="widget-wrapper">
                                <ul class="shop-menu lab-ul">
                                    <li>
                                        <a href="#0">Code Optimization</a>
                                        <ul class="shop-submenu lab-ul">
                                            <li><a href="#0">All Products</a>
                                                <ul class="shop-submenu lab-ul">
                                                    <li><a href="#0">All Products</a></li>
                                                    <li><a href="#0">Seo</a></li>
                                                    <li><a href="#0">Marketing</a></li>
                                                    <li><a href="#0">Email Marketing</a></li>
                                                    <li><a href="#0">Seo Support</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#0">Seo</a></li>
                                            <li><a href="#0">Marketing</a></li>
                                            <li><a href="#0">Email Marketing</a></li>
                                            <li><a href="#0">Seo Support</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#0">Monitoring Ranking</a>
                                        <ul class="shop-submenu lab-ul">
                                            <li><a href="#0">All Products</a></li>
                                            <li><a href="#0">Seo</a></li>
                                            <li><a href="#0">Marketing</a></li>
                                            <li><a href="#0">Email Marketing</a></li>
                                            <li><a href="#0">Seo Support</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#0">Target Strategy</a>
                                        <ul class="shop-submenu lab-ul">
                                            <li><a href="#0">All Products</a></li>
                                            <li><a href="#0">Seo</a></li>
                                            <li><a href="#0">Marketing</a></li>
                                            <li><a href="#0">Email Marketing</a></li>
                                            <li><a href="#0">Seo Support</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#0">Nap Syndication</a>
                                        <ul class="shop-submenu lab-ul">
                                            <li><a href="#0">All Products</a></li>
                                            <li><a href="#0">Seo</a></li>
                                            <li><a href="#0">Marketing</a></li>
                                            <li><a href="#0">Email Marketing</a></li>
                                            <li><a href="#0">Seo Support</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#0">SEO Support</a>
                                        <ul class="shop-submenu lab-ul">
                                            <li><a href="#0">All Products</a></li>
                                            <li><a href="#0">Seo</a></li>
                                            <li><a href="#0">Marketing</a></li>
                                            <li><a href="#0">Email Marketing</a></li>
                                            <li><a href="#0">Seo Support</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#0">Email Marketing</a>
                                        <ul class="shop-submenu lab-ul">
                                            <li><a href="#0">All Products</a></li>
                                            <li><a href="#0">Seo</a></li>
                                            <li><a href="#0">Marketing</a></li>
                                            <li><a href="#0">Email Marketing</a></li>
                                            <li><a href="#0">Seo Support</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#0">Engine Marketing</a>
                                        <ul class="shop-submenu lab-ul">
                                            <li><a href="#0">All Products</a></li>
                                            <li><a href="#0">Seo</a></li>
                                            <li><a href="#0">Marketing</a></li>
                                            <li><a href="#0">Email Marketing</a></li>
                                            <li><a href="#0">Seo Support</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
    
                        <div class="widget widget-post">
                            <div class="widget-header">
                                <h5 class="title">Most Popular Post</h5>
                            </div>
                            <ul class="widget-wrapper">
                                <li class="d-flex flex-wrap justify-content-between">
                                    <div class="post-thumb">
                                        <a href="blog-single.html"><img src="assets/images/blog/01.jpg" alt="rajibraj91"></a>
                                    </div>
                                    <div class="post-content">
                                        <a href="blog-single.html"><h6>Poor People’s Campaign Our Resources</h6></a>
                                        <p>July 23,2021</p>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <div class="post-thumb">
                                        <a href="blog-single.html"><img src="assets/images/blog/02.jpg" alt="rajibraj91"></a>
                                    </div>
                                    <div class="post-content">
                                        <a href="blog-single.html"><h6>Boosting Social For NGO And Charities </h6></a>
                                        <p>July 23,2021</p>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <div class="post-thumb">
                                        <a href="blog-single.html"><img src="assets/images/blog/03.jpg" alt="rajibraj91"></a>
                                    </div>
                                    <div class="post-content">
                                        <a href="blog-single.html"><h6>Poor People’s Campaign Our Resources</h6></a>
                                        <p>July 23,2021</p>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap justify-content-between">
                                    <div class="post-thumb">
                                        <a href="blog-single.html"><img src="assets/images/blog/04.jpg" alt="rajibraj91"></a>
                                    </div>
                                    <div class="post-content">
                                        <a href="blog-single.html"><h6>Boosting Social For NGO And Charities </h6></a>
                                        <p>July 23,2021</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="widget widget-tags">
                            <div class="widget-header">
                                <h5 class="title">Our Popular Tags</h5>
                            </div>
                            <ul class="widget-wrapper">
                                <li><a href="#">envato</a></li>
                                <li><a href="#" class="active">themeforest</a></li>
                                <li><a href="#">codecanyon</a></li>
                                <li><a href="#">videohive</a></li>
                                <li><a href="#">audiojungle</a></li>
                                <li><a href="#">3docean</a></li>
                                <li><a href="#">envato</a></li>
                                <li><a href="#">themeforest</a></li>
                                <li><a href="#">codecanyon</a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- blog section ending here -->

    @endsection