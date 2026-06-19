@extends('layouts.app')

@section('title', 'Projects | Subhadip Chakraborty')

@section('content')
<section class="text-gray-600 body-font pt-20 min-h-screen">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap w-full mb-20">
            <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Featured Projects</h1>
                <div class="h-1 w-20 bg-blue-500 rounded"></div>
            </div>
            <div class="lg:w-1/2 w-full">
                <p class="text-gray-600 leading-relaxed text-lg mb-4">
                    <span class="font-medium text-gray-800">Exploring my developed applications</span> and full-stack software solutions built with modern web technologies.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">Full Stack</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">Laravel </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-teal-100 text-teal-800">APIs & Microservices</span>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -m-4">
            @forelse($projects as $project)
            <div class="xl:w-1/3 md:w-1/2 p-4 w-full">
                <div class="bg-gray-100 p-6 rounded-lg hover:shadow-lg transition-shadow h-full flex flex-col justify-between border border-gray-200/60 group">
                    <div>
                        @if($project->image)
                            <div class="overflow-hidden rounded mb-6 shadow-sm">
                                <img class="h-48 w-full object-cover object-center group-hover:scale-105 transition-transform duration-300" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-r from-blue-600 to-indigo-700 rounded flex items-center justify-center mb-6 shadow-sm">
                                <span class="text-white text-2xl font-bold px-4 text-center">{{ $project->title }}</span>
                            </div>
                        @endif
                        <h3 class="tracking-widest text-blue-500 text-xs font-medium title-font uppercase">{{ $project->subtitle ?? 'WEB APPLICATION' }}</h3>
                        <h2 class="text-xl text-gray-900 font-semibold title-font mb-3">{{ $project->title }}</h2>
                        <p class="leading-relaxed text-base mb-4 text-gray-600">{{ Str::limit(strip_tags($project->description), 150) }}</p>
                        <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm inline-flex items-center gap-1 mb-4">
                            Learn More <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                    
                    <div class="mt-auto space-y-4">
                        @if($project->tags->count() > 0)
                        <div class="pt-4 border-t border-gray-200/60">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($project->tags as $tag)
                                    <span class="inline-block bg-gray-200/80 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="pt-3 flex items-center gap-3 border-t border-gray-200/60">
                            @if($project->url)
                                <a href="{{ $project->url }}" target="_blank" class="flex-1 py-2 px-4 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors shadow-sm text-center inline-flex items-center justify-center gap-2">
                                    <i class="fas fa-external-link-alt mr-1"></i> Live Demo
                                </a>
                            @endif
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="flex-1 py-2 px-4 bg-gray-800 text-white rounded-lg text-sm font-medium hover:bg-gray-900 transition-colors shadow-sm text-center inline-flex items-center justify-center gap-2">
                                    <i class="fab fa-github text-base mr-1"></i> GitHub
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="w-full p-12 text-center text-gray-500 bg-gray-50 rounded-xl mx-4 border border-gray-200 shadow-sm">
                <i class="fas fa-project-diagram text-4xl mb-4 text-gray-400"></i>
                <p class="text-xl font-semibold text-gray-700">No projects showcased yet.</p>
                <p class="text-base mt-2 text-gray-500 max-w-md mx-auto">We're building something amazing! Developed web applications and open-source tools will be listed here soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
