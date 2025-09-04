<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HAU Portal')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            position: relative;
        }
        
        /* Background Image Styles */
        .bg-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/bg-white.png') }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
            opacity: 0.3;
            z-index: -2;
        }
        
        .bg-gradient {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f9fafb 0%, #e5e7eb 50%, #f3f4f6 100%);
            z-index: -1;
        }
        
        .bg-overlay {
            background: rgba(255,255,255,0.9);
            min-height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            backdrop-filter: blur(1px);
        }
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
        .nav-shadow {
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        .nav-link {
            position: relative;
            transition: all 0.2s ease;
        }
        .nav-link:hover {
            transform: translateY(-1px);
        }
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: #70121D;
        }
        .logo-hover {
            transition: transform 0.2s ease;
        }
        .logo-hover:hover {
            transform: scale(1.05);
        }
        .main-content {
            padding-bottom: 2rem;
        }
        @media (max-width: 768px) {
            .nav-mobile {
                flex-direction: column;
                gap: 0.5rem;
                padding: 1rem;
            }
            .nav-mobile .ml-auto {
                margin-left: 0;
                margin-top: 0.5rem;
            }
            .bg-image {
                background-size: cover;
                opacity: 0.05;
            }
        }
    </style>
</head>
<body>
    <!-- Background Layers -->
    <div class="bg-gradient"></div>
    <div class="bg-image"></div>
    
    @if(isset($useWhiteOverlay) && $useWhiteOverlay)
        <div class="bg-overlay"></div>
    @endif
    <div class="content-wrapper">
        <!-- Enhanced Navigation Bar -->
        <nav class="w-full bg-white nav-shadow" style="position:sticky;top:0;z-index:50;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 nav-mobile">
                    <!-- Left Side: Logo + Navigation -->
                    <div class="flex items-center space-x-8">
                        <!-- Logo Section -->
                        <div class="flex items-center">
                            <a href="/" class="logo-hover">
                                <img src="{{ asset('images/logo-long.png') }}" alt="HAU Logo" 
                                     class="h-12 object-contain">
                            </a>
                        </div>
                        
                        <!-- Main Navigation -->
                        <div class="hidden md:flex items-center space-x-1">
                            <a href="/" class="nav-link {{ Request::is('/') ? 'active' : '' }} px-4 py-2 rounded-lg text-sm font-medium text-red-900 hover:bg-red-50 transition-all duration-200">
                                <i class="fas fa-home mr-1"></i>Home
                            </a>
                            <a href="{{ route('sharepoint.public') }}" class="nav-link {{ Request::is('sharepoint*') ? 'active' : '' }} px-4 py-2 rounded-lg text-sm font-medium text-red-900 hover:bg-red-50 transition-all duration-200">
                                <i class="fas fa-folder-open mr-1"></i>SharePoint Sites
                            </a>
                            <a href="{{ route('orgchart') }}" class="nav-link {{ Request::is('org-chart*') ? 'active' : '' }} px-4 py-2 rounded-lg text-sm font-medium text-red-900 hover:bg-red-50 transition-all duration-200">
                                <i class="fas fa-sitemap mr-1"></i>Organizational Chart
                            </a>
                        </div>
                    </div>
                    
                    <!-- Right Side Actions -->
                    <div class="flex items-center space-x-3">
                        <!-- User Menu / Login -->
                        <a href="{{ route('login') }}" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 shadow-sm hover:shadow-md">
                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                        </a>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button type="button" class="mobile-menu-btn text-red-900 hover:bg-red-50 p-2 rounded-lg">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Mobile Navigation Menu -->
                <div class="md:hidden mobile-menu hidden border-t border-gray-200 bg-white">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-red-900 hover:bg-red-50">
                            <i class="fas fa-home mr-2"></i>Home
                        </a>
                        <a href="{{ route('sharepoint.public') }}" class="block px-3 py-2 rounded-md text-base font-medium text-red-900 hover:bg-red-50">
                            <i class="fas fa-folder-open mr-2"></i>SharePoint
                        </a>
                        <a href="{{ route('orgchart') }}" class="block px-3 py-2 rounded-md text-base font-medium text-red-900 hover:bg-red-50">
                            <i class="fas fa-sitemap mr-2"></i>Org Chart
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Main Content Area -->
        <div class="main-content min-h-screen">
            @yield('content')
        </div>
        
        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="flex items-center justify-center mb-4">
                        <img src="{{ asset('images/logo-circle.png') }}" alt="HAU Logo" class="w-8 h-8 mr-2">
                        <span class="font-semibold">Holy Angel University</span>
                    </div>
                    <p class="text-gray-300 text-sm">
                        © {{ date('Y') }} Office of Institutional Effectiveness - Institutional Database Management Office
                    </p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
