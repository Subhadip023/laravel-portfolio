@extends('layouts.app')

@section('content')
<section class="text-gray-600 body-font min-h-screen flex items-center pt-20">
    <div class="container mx-auto flex px-5 md:flex-row flex-col items-center">

        <!-- Profile Image -->
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            <img class="object-cover object-center rounded" alt="Subhadip Chakraborty" src="{{ asset('assets/user/profile.png') }}">
        </div>

        <!-- Content -->
        <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">

            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                Hi, I'm <span class="text-blue-600">Subhadip</span><br class="hidden lg:inline-block">
                <span class="text-gray-800">Laravel Developer</span>
            </h1>

            <p class="mb-6 leading-relaxed text-gray-600">
                I am a Laravel Developer with professional experience since <strong>November 2024</strong> at
                <strong>Matainja Technologies</strong>. I have worked on multiple production projects, including
                implementing <strong>SAML authentication</strong> and integrating
                <strong>Gen AI–based semantic search</strong> in a live application serving
                <strong>1,000+ users</strong>. My role also includes Linux-based deployment, mentoring junior developers,
                and collaborating directly with clients to build scalable backend systems.
            </p>

            <p class="mb-8 leading-relaxed text-gray-600">
                Currently focused on developing efficient backend systems and modern frontend experiences.
            </p>

            <div class="flex justify-center md:justify-start">
                <a href="{{ route('projects') }}" class="inline-flex text-white bg-blue-500 py-2 px-6 hover:bg-blue-600 rounded text-lg">
                    View Projects
                </a>
                <a href="#contact"
                    class="ml-4 inline-flex text-gray-700 bg-gray-100 py-2 px-6 hover:bg-gray-200 rounded text-lg">
                    Contact Me
                </a>
            </div>

        </div>

    </div>
</section>
@endsection
