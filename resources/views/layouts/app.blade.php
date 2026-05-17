<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Subhadip Chakraborty is a Laravel Developer with professional experience building scalable backend systems, SAML authentication, and Gen AI–powered semantic search for production applications serving 1,000+ users.">
    <meta name="google-site-verification" content="RlRxry4zP_xFTq_AfDs6s3rGl0yKW7ahsy0fJV0Pphg" />
    <link rel="icon" href="{{ asset('assets/icon.png') }}" type="image/icon type">
    
    <title>@yield('title', 'Subhadip Chakraborty | Laravel Developer & Backend Engineer')</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Borel&display=swap");
    </style>
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <style>
        body {
            opacity: 0;
            transition: opacity 0.8s linear;
        }
    </style>
    
    @yield('head')
</head>

<body class="antialiased">
    <header class="text-gray-600 body-font md:z-10 md:fixed md:top-0 md:w-full bg-white/80">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a href="{{ route('home') }}" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-code-slash w-10 h-10 text-white p-2 bg-blue-500 rounded-full" viewBox="0 0 16 16">
                    <path
                        d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0m6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0" />
                </svg> <span class="ml-3 text-xl">Chakraborty</span>
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-blue-500 {{ request()->routeIs('home') ? 'text-blue-500 font-bold' : '' }}" href="{{ route('home') }}">Home</a>
                <a class="mr-5 hover:text-blue-500 {{ request()->routeIs('blog.*') ? 'text-blue-500 font-bold' : '' }}" href="{{ route('blog.index') }}">Blog</a> 
                 
                <a class="mr-5 hover:text-blue-500 {{ request()->routeIs('designs') ? 'text-blue-500 font-bold' : '' }}" href="{{ route('designs') }}">Designs</a>
                <a class="mr-5 hover:text-blue-500 {{ request()->routeIs('projects') ? 'text-blue-500 font-bold' : '' }}" href="{{ route('projects') }}">Projects</a>
            </nav>
            <button
                class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Button
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </header>

    <main class="min-h-screen mb-15">
        @yield('content')
    </main>

    <footer class="text-gray-600 body-font md:fixed md:bottom-0 md:w-full bg-white/90">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-code-slash w-10 h-10 text-white p-2 bg-blue-500 rounded-full" viewBox="0 0 16 16">
                    <path
                        d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0m6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0" />
                </svg> <span class="ml-3 text-xl">Chakraborty</span>
            </a>
            <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">
                © 2026 Chakraborty —
                <a href="https://twitter.com/Subhadi51529132" class="text-gray-600 ml-1" target="_blank"
                    rel="noopener noreferrer">
                    @Subhadi51529132
                </a>
                <span class="mx-2">•</span>
                <a href="https://github.com/subhadip023" class="text-gray-600" target="_blank" rel="noopener noreferrer">
                    subhadip023
                </a>
            </p>

            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                <a class="text-gray-500" target="_blank" href="https://www.facebook.com/subhadip.chakraborty.372">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                        viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500" target="_blank" href="https://twitter.com/Subhadi51529132">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5"
                        viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500" target="_blank" href="#">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500" target="_blank" href="#">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path stroke="none"
                            d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </span>
        </div>
    </footer>

    <script>
        window.onload = function () {
            document.body.style.opacity = 1;
        };
    </script>
    @stack('scripts')
</body>

</html>
