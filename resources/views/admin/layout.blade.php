<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Tailwind CSS (CDN for demo) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles Stack -->
    @stack('styles')
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent; 
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1; 
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; 
        }
        .sidebar-item.active {
            background-color: rgb(79 70 229 / 0.1);
            color: #4f46e5;
            border-right: 3px solid #4f46e5;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex h-screen overflow-hidden">

    <!-- Left Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex transition-all duration-300 z-20">
        <!-- Logo Area -->
        <div class="h-16 flex items-center px-6 border-b border-gray-100">
            <div class="flex items-center gap-2">
                <div class="bg-indigo-600 p-1.5 rounded-lg">
                    <i class="fas fa-layer-group text-white text-lg"></i>
                </div>
                <h1 class="text-xl font-bold text-gray-800 tracking-tight">Admin<span class="text-indigo-600">Panel</span></h1>
            </div>
        </div>
        
        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto py-4">
            <div class="px-4 mb-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Main Menu</p>
            </div>
            <nav class="space-y-1">
                <a href="{{ route('admin') }}" class="sidebar-item {{ request()->routeIs('admin') ? 'active' : '' }} flex items-center gap-3 px-6 py-3 text-sm font-medium transition-colors">
                    <i class="fas fa-home w-5 text-center"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="sidebar-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }} flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-blog w-5 text-center"></i>
                    Blogs
                </a>
                <a href="{{ route('admin.categories.index') }}" class="sidebar-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }} flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-folder w-5 text-center"></i>
                    Categories
                </a>
                <a href="{{ route('admin.tags.index') }}" class="sidebar-item {{ request()->routeIs('admin.tags.*') ? 'active' : '' }} flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-tags w-5 text-center"></i>
                    Tags
                </a>
            </nav>

            <div class="px-4 mt-8 mb-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Management</p>
            </div>
            <nav class="space-y-1">
                <a href="#" class="sidebar-item flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-users w-5 text-center"></i>
                    Users
                </a>
                <a href="#" class="sidebar-item flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-box w-5 text-center"></i>
                    Products
                </a>
                <a href="#" class="sidebar-item flex items-center justify-between px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-envelope w-5 text-center"></i>
                        Messages
                    </div>
                    <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">4</span>
                </a>
            </nav>
            
            <div class="px-4 mt-8 mb-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">System</p>
            </div>
            <nav class="space-y-1">
                <a href="#" class="sidebar-item flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-cog w-5 text-center"></i>
                    Settings
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="w-full sidebar-item flex items-center gap-3 px-6 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-indigo-600 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                    </button>
                </form>
            </nav>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 flex flex-col h-full relative w-full">
        
        <!-- Top Navbar -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 z-10 transition-shadow duration-300">
            <!-- Left Header -->
            <div class="flex items-center gap-4">
                <button class="text-gray-500 hover:text-indigo-600 focus:outline-none md:hidden transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <!-- Search -->
                <div class="hidden sm:flex relative items-center">
                    <i class="fas fa-search absolute left-3 text-gray-400"></i>
                    <input type="text" placeholder="Search anything..." class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all w-64">
                </div>
            </div>

            <!-- Right Header -->
            <div class="flex items-center gap-4 sm:gap-6">
                <!-- Action Icons -->
                <div class="flex items-center gap-3">
                    <button class="relative p-2 text-gray-400 hover:text-indigo-600 rounded-full hover:bg-indigo-50 transition-colors">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                    </button>
                    <button class="p-2 text-gray-400 hover:text-indigo-600 rounded-full hover:bg-indigo-50 transition-colors hidden sm:block">
                        <i class="fas fa-th-large"></i>
                    </button>
                </div>

                <!-- Divider -->
                <div class="h-6 w-px bg-gray-200 hidden sm:block"></div>

                <!-- User Profile -->
                <div class="flex items-center gap-3 cursor-pointer group">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-700 group-hover:text-indigo-600 transition-colors">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=4f46e5&color=fff&rounded=true" alt="User Avatar" class="w-9 h-9 rounded-full border-2 border-transparent group-hover:border-indigo-200 transition-all">
                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area content -->
        <main class="flex-1 overflow-y-auto overflow-x-hidden relative bg-gray-50/50">
            <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto pb-15">
                @yield('content')
            </div>
            
            <!-- Footer -->
            <footer class="mt-auto px-6 py-4 border-t border-gray-200 text-center text-sm text-gray-500">
                <p>&copy; 2026 AdminPanel Pro. All rights reserved.</p>
            </footer>
        </main>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
