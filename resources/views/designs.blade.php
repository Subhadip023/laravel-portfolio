@extends('layouts.app')

@section('title', 'Designs | Subhadip Chakraborty')

@section('content')
<section class="text-gray-600 body-font pt-20">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap w-full mb-20">
            <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">My Design Projects</h1>
                <div class="h-1 w-20 bg-indigo-500 rounded"></div>
            </div>
            <div class="lg:w-1/2 w-full">
                <p class="text-gray-600 leading-relaxed text-lg mb-4">
                    <span class="font-medium text-gray-800">Showcasing my expertise</span> in creating beautiful, functional interfaces that deliver exceptional user experiences.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">UI/UX Design</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">Responsive Layouts</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">Modern Web</span>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -m-4">
            <!-- Newsroom Pro -->
            <div class="xl:w-1/3 md:w-1/2 p-4">
                <a href="{{ asset('projects/Design/newsroom-pro/public/index.html') }}" target="_blank" class="block h-full">
                    <div class="bg-gray-100 p-6 rounded-lg hover:shadow-lg transition-shadow h-full">
                        <img class="h-48 rounded w-full object-cover object-center mb-6" src="{{ asset('projects/Design/newsroom-pro/public/assets/logo.svg') }}" alt="Newsroom Pro">
                        <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">NEWS CMS</h3>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Newsroom Pro</h2>
                        <p class="leading-relaxed text-base">A modern content management system for news websites with article management, categories, and admin dashboard.</p>
                        <div class="mt-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#CMS</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#Admin</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#News</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Adminer Lite -->
            <div class="xl:w-1/3 md:w-1/2 p-4">
                <a href="{{ asset('projects/Design/adminer-lite/public/index.html') }}" target="_blank" class="block h-full">
                    <div class="bg-gray-100 p-6 rounded-lg hover:shadow-lg transition-shadow h-full">
                        <div class="h-48 bg-gradient-to-r from-blue-500 to-indigo-600 rounded flex items-center justify-center mb-6">
                            <span class="text-white text-2xl font-bold">Adminer Lite</span>
                        </div>
                        <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">ADMIN DASHBOARD</h3>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Adminer Lite</h2>
                        <p class="leading-relaxed text-base">A clean and responsive admin dashboard template with data tables, charts, and user management.</p>
                        <div class="mt-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#Dashboard</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#Analytics</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Landing Startup -->
            <div class="xl:w-1/3 md:w-1/2 p-4">
                <a href="{{ asset('projects/Design/landing-startup/index.html') }}" target="_blank" class="block h-full">
                    <div class="bg-gray-100 p-6 rounded-lg hover:shadow-lg transition-shadow h-full">
                        <div class="h-48 bg-gradient-to-r from-green-500 to-teal-600 rounded flex items-center justify-center mb-6">
                            <span class="text-white text-2xl font-bold">Startup</span>
                        </div>
                        <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">LANDING PAGE</h3>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Startup Landing</h2>
                        <p class="leading-relaxed text-base">A modern landing page template for startups and tech companies with call-to-action sections.</p>
                        <div class="mt-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#Landing</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#Startup</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Portfolio Minimal -->
            <div class="xl:w-1/3 md:w-1/2 p-4">
                <a href="{{ asset('projects/Design/portfolio-minimal/index.html') }}" target="_blank" class="block h-full">
                    <div class="bg-gray-100 p-6 rounded-lg hover:shadow-lg transition-shadow h-full">
                        <div class="h-48 bg-gradient-to-r from-purple-500 to-pink-600 rounded flex items-center justify-center mb-6">
                            <span class="text-white text-2xl font-bold">Portfolio</span>
                        </div>
                        <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">PORTFOLIO</h3>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Minimal Portfolio</h2>
                        <p class="leading-relaxed text-base">A clean and minimal portfolio template to showcase your work and skills effectively.</p>
                        <div class="mt-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#Portfolio</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#Minimal</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- New App -->
            <div class="xl:w-1/3 md:w-1/2 p-4">
                <a href="{{ asset('projects/Design/newapp_1/index.html') }}" target="_blank" class="block h-full">
                    <div class="bg-gray-100 p-6 rounded-lg hover:shadow-lg transition-shadow h-full">
                        <div class="h-48 bg-gradient-to-r from-yellow-500 to-orange-500 rounded flex items-center justify-center mb-6">
                            <span class="text-white text-2xl font-bold">New App</span>
                        </div>
                        <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">WEB APP</h3>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">New App Design</h2>
                        <p class="leading-relaxed text-base">A modern web application interface with clean design and intuitive user experience.</p>
                        <div class="mt-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#WebApp</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#UI/UX</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Dashboard Lite -->
            <div class="xl:w-1/3 md:w-1/2 p-4">
                <a href="{{ asset('projects/Design/dashboard-lite/index.html') }}" target="_blank" class="block h-full">
                    <div class="bg-gray-100 p-6 rounded-lg hover:shadow-lg transition-shadow h-full">
                        <div class="h-48 bg-gradient-to-r from-red-500 to-pink-600 rounded flex items-center justify-center mb-6">
                            <span class="text-white text-2xl font-bold">Dashboard</span>
                        </div>
                        <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">DASHBOARD</h3>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Analytics Dashboard</h2>
                        <p class="leading-relaxed text-base">A responsive analytics dashboard with charts, metrics, and data visualization components.</p>
                        <div class="mt-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#Analytics</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#Charts</span>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Sohoj News -->
            <div class="xl:w-1/3 md:w-1/2 p-4">
                <a href="{{ asset('projects/Design/Sohoj News/index.html') }}" target="_blank" class="block h-full">
                    <div class="bg-gray-100 p-6 rounded-lg hover:shadow-lg transition-shadow h-full">
                        <div class="h-48 bg-gradient-to-r from-blue-500 to-green-600 rounded flex items-center justify-center mb-6">
                            <span class="text-white text-2xl font-bold">Sohoj News</span>
                        </div>
                        <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">STATIC WEBSITE</h3>
                        <h2 class="text-lg text-gray-900 font-medium title-font mb-2">Sohoj News</h2>
                        <p class="leading-relaxed text-base">This is the Static Website of Sohoj News</p>
                        <div class="mt-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">#News</span>
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#Design</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
