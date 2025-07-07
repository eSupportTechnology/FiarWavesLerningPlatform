<!-- Page Header Start-->
<div class="page-header">
    <div class="header-wrapper row m-0">

        <!-- Search Bar -->
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search..." name="q" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div>
                        <i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>

        <!-- Logo Section -->
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="{{ route('admin.dashboard') }}">
                    <img class="img-fluid" src="{{ asset('frontend/assets/images/logo/logo.png') }}" alt="">
                </a>
            </div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
            </div>
        </div>

        <!-- Right Header Content -->
        <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">

                <!-- Website Link -->
                <li class="nav-item website-nav">
                    <a href="{{ url('/') }}" target="_blank" class="website-button">
                        <div class="website-icon-wrapper">
                            <i class="fa fa-globe"></i>
                        </div>
                        <div class="website-text">
                            <span>Website</span>
                            <small>Visit Site</small>
                        </div>
                    </a>
                </li>

                <!-- Theme Mode Toggle -->
                <li>
                    <div class="mode">
                        <svg>
                            <use href="{{ asset('frontend/assets/svg/icon-sprite.svg#moon') }}"></use>
                        </svg>
                    </div>
                </li>

                <!-- Profile Dropdown -->
                <li class="profile-nav profile-dropdown-toggle pe-0 py-0">
                    <div class="media profile-media profile-trigger">
                        <div class="profile-icon-wrapper">
                            <svg class="profile-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2" fill="none"/>
                                <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="currentColor" stroke-width="2" fill="none"/>
                            </svg>
                        </div>
                        <div class="media-body">
                            @if(Auth::guard('employee')->check())
                                <span>{{ Auth::guard('employee')->user()->name }}</span>
                                <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
                            @else
                                <span>Guest</span>
                            @endif
                        </div>
                    </div>

                    <ul class="profile-dropdown dropdown-menu-click" style="display: none;">
                        <li class="dropdown-header">
                            <div class="user-info">
                                <div class="user-avatar">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2" fill="none"/>
                                        <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="currentColor" stroke-width="2" fill="none"/>
                                    </svg>
                                </div>
                                <div class="user-details">
                                    @if(Auth::guard('employee')->check())
                                        <span class="user-name">{{ Auth::guard('employee')->user()->name }}</span>
                                        <small class="user-role">Administrator</small>
                                    @else
                                        <span class="user-name">Guest User</span>
                                        <small class="user-role">Guest</small>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li>
                            <a href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="dropdown-item logout-item">
                                <i data-feather="log-out"></i>
                                <span>Sign Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Page Header Ends -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile dropdown click functionality
    const profileTrigger = document.querySelector('.profile-trigger');
    const profileDropdown = document.querySelector('.dropdown-menu-click');
    
    if (profileTrigger && profileDropdown) {
        profileTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Toggle dropdown visibility
            if (profileDropdown.style.display === 'none' || profileDropdown.style.display === '') {
                profileDropdown.style.display = 'block';
            } else {
                profileDropdown.style.display = 'none';
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileTrigger.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.style.display = 'none';
            }
        });
        
        // Prevent dropdown from closing when clicking inside it
        profileDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
});
</script>

<style>
/* Enhanced Professional Dropdown Styling */
.profile-dropdown.dropdown-menu-click {
    position: absolute !important;
    top: calc(100% + 8px) !important;
    right: 0 !important;
    left: auto !important;
    background: #ffffff !important;
    border: 1px solid #e0e6ed !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1), 0 2px 8px rgba(0, 0, 0, 0.06) !important;
    min-width: 280px !important;
    padding: 0 !important;
    margin: 0 !important;
    z-index: 9999 !important;
    overflow: hidden !important;
    animation: slideDown 0.2s ease-out !important;
    transform-origin: top right !important;
}

/* Dropdown Animation */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Dropdown Header with User Info */
.profile-dropdown .dropdown-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    color: white !important;
    padding: 20px !important;
    border: none !important;
    margin: 0 !important;
    border-radius: 0 !important;
}

.profile-dropdown .user-info {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}

.profile-dropdown .user-avatar {
    width: 40px !important;
    height: 40px !important;
    background: rgba(255, 255, 255, 0.2) !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    color: white !important;
}

.profile-dropdown .user-details {
    flex: 1 !important;
}

.profile-dropdown .user-name {
    display: block !important;
    font-weight: 600 !important;
    font-size: 16px !important;
    color: white !important;
    margin: 0 !important;
    line-height: 1.3 !important;
}

.profile-dropdown .user-role {
    display: block !important;
    font-size: 12px !important;
    color: rgba(255, 255, 255, 0.8) !important;
    margin: 2px 0 0 0 !important;
    font-weight: 400 !important;
}

/* Dropdown Divider */
.profile-dropdown .dropdown-divider {
    margin: 0 !important;
    border-color: #f1f3f4 !important;
    opacity: 1 !important;
}

/* Dropdown Items */
.profile-dropdown .dropdown-item {
    padding: 16px 20px !important;
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
    color: #374151 !important;
    text-decoration: none !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    border: none !important;
    background: transparent !important;
    transition: all 0.2s ease !important;
    margin: 0 !important;
    border-radius: 0 !important;
}

.profile-dropdown .dropdown-item:hover {
    background: #f8fafc !important;
    color: #1f2937 !important;
    transform: translateX(4px) !important;
}

.profile-dropdown .dropdown-item.logout-item:hover {
    background: #fef2f2 !important;
    color: #dc2626 !important;
}

/* Icons in dropdown items */
.profile-dropdown .dropdown-item i,
.profile-dropdown .dropdown-item svg {
    width: 18px !important;
    height: 18px !important;
    color: #6b7280 !important;
    stroke-width: 2 !important;
    flex-shrink: 0 !important;
    transition: color 0.2s ease !important;
}

.profile-dropdown .dropdown-item:hover i,
.profile-dropdown .dropdown-item:hover svg {
    color: #374151 !important;
}

.profile-dropdown .dropdown-item.logout-item:hover i,
.profile-dropdown .dropdown-item.logout-item:hover svg {
    color: #dc2626 !important;
}

/* Profile trigger hover effect */
.profile-trigger {
    cursor: pointer !important;
    transition: transform 0.2s ease !important;
    border-radius: 8px !important;
    padding: 4px !important;
}

.profile-trigger:hover {
    transform: scale(1.02) !important;
    background: rgba(0, 0, 0, 0.05) !important;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .profile-dropdown.dropdown-menu-click {
        min-width: 260px !important;
        right: 10px !important;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
    }
    
    .profile-dropdown .dropdown-header {
        padding: 16px !important;
    }
    
    .profile-dropdown .user-name {
        font-size: 15px !important;
    }
}

@media (max-width: 480px) {
    .profile-dropdown.dropdown-menu-click {
        min-width: 240px !important;
        max-width: calc(100vw - 20px) !important;
    }
}

/* Ensure dropdown appears above other elements */
.profile-dropdown-toggle {
    position: relative !important;
    z-index: 1000 !important;
}
</style>
