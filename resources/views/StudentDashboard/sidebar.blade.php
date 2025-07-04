<!-- Page Sidebar Start -->
<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <!-- Logo Section - Matching Header Height -->
        <div class="logo-wrapper d-flex align-items-center justify-content-between" style="height: 150px; padding: 0 24px; border-bottom: 1px solid #e9ecef; background: white;">
            <a href="{{ route('customer.dashboard') }}" class="d-flex align-items-center">
                <img class="img-fluid" src="{{ asset('frontend/assets/images/newlogo.png') }}" 
                     alt="BetterWay Logo" style="height: 120px; max-width: 280px; object-fit: contain;">
                <span class="ms-2 fw-bold text-primary" style="font-size: 20px;"></span>
            </a>
            <div class="back-btn d-lg-none">
                <i class="fa fa-angle-left"></i>
            </div>
        </div>



        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu" style="max-height: calc(100vh - 90px); overflow-y: auto;">
                <ul class="sidebar-links" id="simple-bar">
                    <!-- Dashboard -->
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="{{ route('customer.dashboard') }}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>


                    <!-- Course Management -->
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i class="fa fa-book"></i>
                            <span>My Courses</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('student.bookings') }}">All Courses</a></li>
                        </ul>
                    </li>

                    <!-- Settings -->
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i class="fa fa-money"></i>
                            <span>Withdrawal</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('student.withdraw') }}">Withdraw</a></li>
                            <li><a href="{{ route('student.allPayments') }}">Withdrawal History</a></li>
                            <li><a href="{{ route('student.wallet.history') }}">Wallet History</a></li>

                        </ul>
                    </li>

                    <!-- Invitees Management -->
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i class="fa fa-group"></i>
                            <span>My Network</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('student.invitees.index') }}">All Invitees</a></li>
                            @php
                                $userType = session('user_type');
                            @endphp
                            @if ($userType === 'super_user')
                                <li><a href="{{ route('student.invitees.genealogy') }}">Genealogy</a></li>
                            @endif
                        </ul>
                    </li>

                    <!-- Settings -->
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#">
                            <i class="fa fa-cog"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('customer.profile') }}">User Profile</a></li>
                        </ul>
                    </li>





                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var sidebarTitles = document.querySelectorAll(".sidebar-title");

        sidebarTitles.forEach(function(title) {
            title.addEventListener("click", function(e) {
                e.preventDefault(); // Prevent default action

                let submenu = this.nextElementSibling; // Get the submenu
                if (submenu && submenu.classList.contains("sidebar-submenu")) {
                    submenu.classList.toggle("d-block"); // Toggle visibility
                }
            });
        });
    });
</script>
