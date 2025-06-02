<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\VipPackage;
use App\Models\Blog;
use App\Models\YoutubeVideo;
use App\Models\Review;
use App\Models\AdBanner;
use App\Models\Banner;

class FrontendTemplateController extends Controller
{
    public function home()
    {
        $featuredCourses = Course::latest()->take(6)->get();
        $vipPackages = VipPackage::where('status', 'active')->latest()->get();
        $latestBlogs = Blog::where('status', true)->latest()->take(3)->get();
        $youtubeVideos = YoutubeVideo::latest()->take(3)->get();
        $reviews = Review::where('status', 'approved')->latest()->get();
        $banners = AdBanner::where('status', true)->latest()->get();
        $bannersss = Banner::where('status', 1)->latest()->get();

        // Real stats (you can use actual counts)
        $stats = [
            'students' => 12000,
            'courses' => 30,
            'teachers' => 10,
            'experience' => 12
        ];


        return view('frontend.Home', compact('featuredCourses','vipPackages' , 'latestBlogs', 'youtubeVideos',
        'stats','reviews','banners','bannersss' ));
    }

    public function Home_Two()
    {
        return view('frontend.Home_Two');
    }
    public function Home_Three()
    {
        return view('frontend.Home_Three');
    }
    public function Home_Four()
    {
        return view('frontend.Home_Four');
    }
    public function Home_Five()
    {
        return view('frontend.Home_Five');
    }
    public function Home_Six()
    {
        return view('frontend.Home_Six');
    }
    public function Home_Seven()
    {
        return view('frontend.Home_Seven');
    }
    public function Course()
    {
        return view('frontend.Course');
    }
    public function Course_Details()
    {
        return view('frontend.Course_Details');
    }
    public function blog()
    {
        return view('frontend.blog');
    }


    public function blog_style2($id)
    {
        $blog = Blog::findOrFail($id);

        $recentBlogs = Blog::where('id', '!=', $id)
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.blogSingle' , compact('blog' ,  'recentBlogs'));
    }


    public function blog_style3()
    {
        $blogs = Blog::where('status', 1)
            ->latest()
            ->paginate(6); // Adjust per page as needed

        return view('frontend.blog', compact('blogs'));
    }

    public function blog_single()
    {
        return view('frontend.blog_single');
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function team()
    {
        return view('frontend.team');
    }
    public function instructor()
    {
        return view('frontend.instructor');
    }
    public function shop()
    {
        return view('frontend.shop');
    }
    public function shop_single()
    {
        return view('frontend.shop_single');
    }
    public function cart_page()
    {
        return view('frontend.cart_page');
    }
    public function search_page()
    {
        return view('frontend.search_page');
    }
    public function search_none()
    {
        return view('frontend.search_none');
    }
    public function error()
    {
        return view('frontend.404');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    
    public function team_single()
    {
        return view('frontend.team_single');
    }
    public function forgetpass()
    {
        return view('frontend.forgetpass');
    }
    public function study()
    {
        return view('frontend.study');
    }

    

    public function vipPackages()
    {
        $packages = VipPackage::where('status', 'active')->latest()->get();
        return view('frontend.vip_packages', compact('packages'));
    }

    public function showVipPackage($id)
    {
        $package = VipPackage::where('id', $id)->where('status', 'active')->firstOrFail();

        return view('frontend.vip-package-details', compact('package'));
    }

}
