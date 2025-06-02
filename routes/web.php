<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendTemplateController;
use App\Http\Controllers\BackendTemplateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseFileController;
use App\Http\Controllers\CourseRecordingController;
use App\Http\Controllers\CourseZoomLinkController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VipPackageController;
use App\Http\Controllers\YoutubeVideoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\VipPackageBookingController;
use App\Http\Controllers\EmployeeAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CallCenterController;

// Verification notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth:customer')->name('verification.notice');

// Verification link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/'); // 👈 redirect to wherever you want
})->middleware(['auth:customer', 'signed'])->name('verification.verify');

// Resend verification email
Route::post('/email/verification-notification', function () {
    auth('customer')->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth:customer', 'throttle:6,1'])->name('verification.send');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// frontend
Route::get('/', [FrontendTemplateController::class, 'home'])->name('frontend.home');
Route::get('/Home_Two', [FrontendTemplateController::class, 'Home_Two'])->name('frontend.Home_Two');
Route::get('/Home_Three', [FrontendTemplateController::class, 'Home_Three'])->name('frontend.Home_Three');
Route::get('/Home_Four', [FrontendTemplateController::class, 'Home_Four'])->name('frontend.Home_Four');
Route::get('/Home_Five', [FrontendTemplateController::class, 'Home_Five'])->name('frontend.Home_Five');
Route::get('/Home_Six', [FrontendTemplateController::class, 'Home_Six'])->name('frontend.Home_Six');
Route::get('/Home_Seven', [FrontendTemplateController::class, 'Home_Seven'])->name('frontend.Home_Seven');
Route::get('/Course', [CourseController::class, 'showCourses'])->name('frontend.Course');
Route::get('/Course_Details/{id}', [CourseController::class, 'viewdetails'])->name('frontend.Course_Details');

Route::get('/blog', [FrontendTemplateController::class, 'blog'])->name('frontend.blog');
Route::get('/blog/{id}', [FrontendTemplateController::class, 'blog_style2'])->name('frontend.blog.show');
Route::get('/blog_style3', [FrontendTemplateController::class, 'blog_style3'])->name('frontend.blog_style3');
Route::get('/blog_single', [FrontendTemplateController::class, 'blog_single'])->name('frontend.blog_single');
Route::get('/about', [FrontendTemplateController::class, 'about'])->name('frontend.about');
Route::get('/team', [FrontendTemplateController::class, 'team'])->name('frontend.team');
Route::get('/instructor', [FrontendTemplateController::class, 'instructor'])->name('frontend.instructor');
Route::get('/shop', [FrontendTemplateController::class, 'shop'])->name('frontend.shop');
Route::get('/shop_single', [FrontendTemplateController::class, 'shop_single'])->name('frontend.shop_single');
Route::get('/cart_page', [FrontendTemplateController::class, 'cart_page'])->name('frontend.cart_page');
Route::get('/search_page', [FrontendTemplateController::class, 'search_page'])->name('frontend.search_page');
Route::get('/search_none', [FrontendTemplateController::class, 'search_none'])->name('frontend.search_none');
Route::get('/404', [FrontendTemplateController::class, 'error'])->name('frontend.404');
Route::get('/contact', [FrontendTemplateController::class, 'contact'])->name('frontend.contact');
Route::get('/team_single', [FrontendTemplateController::class, 'team_single'])->name('frontend.team_single');
Route::get('/forgetpass', [FrontendTemplateController::class, 'forgetpass'])->name('frontend.forgetpass');
Route::get('/study', [FrontendTemplateController::class, 'study'])->name('frontend.study');
Route::view('international-stu', 'frontend.international-stu')->name('international-stu');
Route::get('/vip_Packages', [FrontendTemplateController::class, 'vipPackages'])->name('frontend.vip.packages');
Route::get('/vip-packages/{id}', [FrontendTemplateController::class, 'showVipPackage'])->name('frontend.vip.package.show');
Route::get('/vippackage/book/{id}', [VipPackageBookingController::class, 'create'])->name('vip-packages.book');
Route::post('/vippackage/submit', [VipPackageBookingController::class, 'store'])->name('vip-packages.booking.submit');




// Auth Routes for Customer
Route::get('/customer/register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');
Route::get('/customer/login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
Route::get('/register/old', [CustomerAuthController::class, 'showOldRegisterForm'])->name('customer.old.register');
Route::post('/register/old', [CustomerAuthController::class, 'submitOldRegister'])->name('customer.old.register.submit');


Route::get('/verify-code', [CustomerAuthController::class, 'showCodeForm'])->name('customer.verify.code.form');
Route::post('/verify-code', [CustomerAuthController::class, 'verifyCode'])->name('customer.verify.code');

//buy course
Route::middleware('web')->group(function () {
    Route::get('/course/{id}/book', [BookingController::class, 'showForm'])->name('course.booking.form');
    Route::post('/course/book', [BookingController::class, 'store'])->name('course.booking.submit');
    Route::get('/payment/callback', [BookingController::class, 'callback'])->name('payment.callback');
    Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');
    Route::get('/booking/failed', [BookingController::class, 'failed'])->name('booking.failed');
    // Real payment notification (webhook)
Route::post('/payment/notify', [BookingController::class, 'notify'])->name('payment.notify');
});

Route::get('/booking/success', function () {
    return view('frontend.booking-success');
})->name('booking.success');



Route::get('/frontend/international-stu', function (){
    return view('frontend.international-stu');
})->name('frontend.international-stu');
Route::get('/contact', function (){
    return view('frontend.contact');
})->name('frontend.contact');
require __DIR__.'/auth.php';


use App\Http\Controllers\PopupContactController;
Route::post('/popup-contact-submit', [PopupContactController::class, 'store'])->name('popup.contact.submit');
Route::get('popup-leads', [PopupContactController::class, 'index'])->name('popupcontacts.index');



//admindashboard

// Admin Login
Route::get('/admin/login', [EmployeeAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [EmployeeAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [EmployeeAuthController::class, 'logout'])->name('admin.logout');
Route::get('/admin/register', [EmployeeAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [EmployeeAuthController::class, 'register'])->name('admin.register.submit');


// Employee Management Routes
Route::prefix('admin/employees')->name('admin.employees.')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('index'); // List employees
    Route::get('/create', [EmployeeController::class, 'create'])->name('create'); // Show form
    Route::post('/', [EmployeeController::class, 'store'])->name('store'); // Save employee

    Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit'); // Edit form
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update'); // Update employee

    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy'); // Delete employee
});


// Dashboard (protected)
Route::middleware(['auth:employee'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('AdminDashboard.home');
    })->name('admin.dashboard');
});



Route::get('/admin', [BackendTemplateController::class, 'index'])->name('admin.dashboard');




Route::get('/adminksjjd', [BackendTemplateController::class, 'indexasdasd'])->name('admin');

//course Managment
Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/store', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/{id}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
});

//branch Managment
Route::prefix('branches')->group(function () {
    Route::get('/', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/store', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/{id}', [BranchController::class, 'show'])->name('branches.show');
    Route::get('/{id}/edit', [BranchController::class, 'edit'])->name('branches.edit');
    Route::put('/{id}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/{id}', [BranchController::class, 'destroy'])->name('branches.destroy');
});

//course Files Managment
Route::prefix('coursesFiles')->group(function () {
    Route::get('/', [CourseFileController::class, 'index'])->name('courseFile.index');
    Route::get('/courses/{courseId}/files', [CourseFileController::class, 'second'])->name('courseFile.second');
    Route::get('/create', [CourseFileController::class, 'create'])->name('courseFile.create');
    Route::put('/admin/course-files/{id}/update', [CourseFileController::class, 'update'])->name('courseFile.update');
    Route::post('/courses/{courseId}/files', [CourseFileController::class, 'store'])->name('courseFile.store');
    Route::delete('/{id}', [CourseFileController::class, 'destroy'])->name('courseFile.destroy');
});

//course Recordings Managment
Route::prefix('coursesRecording')->group(function () {
    Route::get('/courses/{courseId}/files', [CourseRecordingController::class, 'index'])->name('coursesRecording.index');
    Route::post('/courses/{courseId}/files', [CourseRecordingController::class, 'store'])->name('coursesRecording.store');
    Route::put('/course/course-Recordings/{id}/update', [CourseRecordingController::class, 'update'])->name('coursesRecording.update');
    Route::delete('/{id}', [CourseRecordingController::class, 'destroy'])->name('coursesRecording.destroy');
});


//course Zoom Links Managment
Route::prefix('coursesZoomLinks')->group(function () {
    Route::get('/courses/{courseId}/files', [CourseZoomLinkController::class, 'index'])->name('coursesZoomLinks.index');
    Route::post('/courses/{courseId}/files', [CourseZoomLinkController::class, 'store'])->name('coursesZoomLinks.store');
    Route::put('/course/ZoomLinks/{id}/update', [CourseZoomLinkController::class, 'update'])->name('coursesZoomLinks.update');
    Route::delete('/{id}', [CourseZoomLinkController::class, 'destroy'])->name('coursesZoomLinks.destroy');
});


//Bookings Managment
Route::prefix('Bookings')->group(function () {
    Route::get('/bookings/pending', [BookingController::class, 'pending'])->name('bookings.pending');
    Route::get('/bookings/approved', [BookingController::class, 'approved'])->name('bookings.approved');
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
});

Route::prefix('admin/bookings')->name('admin.bookings.')->group(function () {
    Route::get('/pending', [BookingController::class, 'pending'])->name('bookings.pending');
    Route::get('/approved', [BookingController::class, 'approved'])->name('bookings.approved');
    Route::post('/approve/{id}', [BookingController::class, 'approve'])->name('approve');
    Route::get('/{id}', [BookingController::class, 'show'])->name('show');
    Route::delete('/{id}', [BookingController::class, 'destroy'])->name('destroy');
});


// VIP Package Resource Routes
Route::prefix('vip-packages')->group(function () {

    Route::get('/', [VipPackageController::class, 'index'])->name('vip-packages.index');
    Route::get('/vip-packages/create', [VipPackageController::class, 'create'])->name('vip-packages.create');
    Route::post('/vip-packages', [VipPackageController::class, 'store'])->name('vip-packages.store');
    Route::get('/vip-packages/{vipPackage}', [VipPackageController::class, 'show'])->name('vip-packages.show');
    Route::get('/vip-packages/{vipPackage}/edit', [VipPackageController::class, 'edit'])->name('vip-packages.edit');
    Route::put('/vip-packages/{vipPackage}', [VipPackageController::class, 'update'])->name('vip-packages.update');
    Route::delete('/vip-packages/{vipPackage}', [VipPackageController::class, 'destroy'])->name('vip-packages.destroy');

});



Route::prefix('admin/youtube-videos')->name('admin.youtube-videos.')->group(function () {
    Route::get('/', [YoutubeVideoController::class, 'index'])->name('index');
    Route::post('/', [YoutubeVideoController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [YoutubeVideoController::class, 'edit'])->name('edit');
    Route::put('/{id}', [YoutubeVideoController::class, 'update'])->name('update');
    Route::delete('/{id}', [YoutubeVideoController::class, 'destroy'])->name('destroy');
});



Route::prefix('admin/call-center')->name('admin.callcenter.')->group(function () {
    Route::get('/', [CallCenterController::class, 'index'])->name('index');
    Route::post('/', [CallCenterController::class, 'store'])->name('store');
    Route::get('/create', [CallCenterController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [CallCenterController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CallCenterController::class, 'update'])->name('update');
    Route::delete('/{id}', [CallCenterController::class, 'destroy'])->name('destroy');
});
Route::get('/call-center-contacts', [CallCenterController::class, 'getContacts'])->name('callcenter.contacts');



Route::prefix('admin/reviews')->name('admin.reviews.')->group(function () {
    Route::get('/', [ReviewController::class, 'index'])->name('index');
    Route::get('/create', [ReviewController::class, 'create'])->name('create');
    Route::post('/', [ReviewController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ReviewController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ReviewController::class, 'update'])->name('update');
    Route::delete('/{id}', [ReviewController::class, 'destroy'])->name('destroy');
    Route::post('/admin/reviews/{id}/toggle-status', [ReviewController::class, 'toggleStatus'])->name('toggleStatus');

});


Route::prefix('admin/settings/banners')->name('admin.banners.')->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('index');
    Route::get('/create', [BannerController::class, 'create'])->name('create');
    Route::post('/', [BannerController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [BannerController::class, 'update'])->name('update');
    Route::delete('/{id}', [BannerController::class, 'destroy'])->name('destroy');
});


use App\Http\Controllers\BlogController;

Route::prefix('admin/blogs')->name('admin.blogs.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/create', [BlogController::class, 'create'])->name('create');
    Route::post('/', [BlogController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('edit');
    Route::put('/{id}', [BlogController::class, 'update'])->name('update');
    Route::delete('/{id}', [BlogController::class, 'destroy'])->name('destroy');
});


// Customer Admin Actions
Route::prefix('admin/customers')->name('admin.customers.')->group(function () {
    Route::get('/', [BackendTemplateController::class, 'index1'])->name('index');
    Route::get('/{customer}', [BackendTemplateController::class, 'show'])->name('show');
    Route::post('/{customer}/toggle-status', [BackendTemplateController::class, 'toggleStatus'])->name('toggleStatus');
    Route::delete('/{customer}', [BackendTemplateController::class, 'destroy'])->name('destroy');
});

// Order Management
Route::prefix('admin/orders')->name('admin.orders.')->group(function () {
    Route::get('/pending', [BackendTemplateController::class, 'pendingOrders'])->name('pending');
    Route::get('/success', [BackendTemplateController::class, 'successOrders'])->name('success');
    Route::get('/half', [BackendTemplateController::class, 'halfPaidOrders'])->name('half'); // ✅ MOVE THIS HERE
    Route::get('/{id}', [BackendTemplateController::class, 'showOrder'])->name('show');
    Route::patch('/{id}/status/{status}', [BackendTemplateController::class, 'updateOrderStatus'])->name('updateStatus');
    Route::put('/admin/orders/update-booking/{id}', [BackendTemplateController::class, 'updateBooking'])->name('updateBooking');

});


use App\Http\Controllers\AdBannerController;
// adbanners
Route::prefix('admin/adbanners')->name('admin.adbanners.')->group(function () {
    Route::get('/', [AdBannerController::class, 'index'])->name('index');
    Route::get('/create', [AdBannerController::class, 'create'])->name('create');
    Route::post('/', [AdBannerController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AdBannerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdBannerController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdBannerController::class, 'destroy'])->name('destroy');
});


use App\Http\Controllers\BatchController;

// Batches
Route::prefix('admin/batches')->name('admin.batches.')->group(function () {
    Route::get('/', [BatchController::class, 'index'])->name('index');
    Route::get('/create', [BatchController::class, 'create'])->name('create');
    Route::post('/', [BatchController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [BatchController::class, 'edit'])->name('edit');
    Route::put('/{id}', [BatchController::class, 'update'])->name('update');
    Route::delete('/{id}', [BatchController::class, 'destroy'])->name('destroy');
    Route::put('/customers/batch/{id}', [BatchController::class, 'updateBatch'])->name('updateBatch');

});





//-----------------------student dashboard

use App\Http\Controllers\StudentDashboardController;

//student dashboard

Route::middleware(['web'])->group(function () {
    Route::get('/customer/dashboard', [StudentDashboardController::class, 'index'])
        ->name('customer.dashboard');
});
Route::get('/student/bookings', [StudentDashboardController::class, 'bookings'])->name('student.bookings');
Route::get('/student/bookings/{booking}/details', [StudentDashboardController::class, 'courseDetails'])->name('student.course.details');
// Course File Access
Route::get('/student/course/{booking}/files', [StudentDashboardController::class, 'courseFiles'])->name('student.course.files');
Route::get('/student/course/{booking}/recordings', [StudentDashboardController::class, 'courseRecordings'])->name('student.course.recordings');
Route::get('/student/course/{booking}/zoom-links', [StudentDashboardController::class, 'courseZoomLinks'])->name('student.course.zoom');
Route::get('/student/profile', [StudentDashboardController::class, 'profile'])->name('customer.profile');
Route::post('/student/profile', [StudentDashboardController::class, 'updateProfile'])->name('customer.profile.update');
Route::post('/student/profile/password', [StudentDashboardController::class, 'updatePassword'])->name('customer.password.update');



