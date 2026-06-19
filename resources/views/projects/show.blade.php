@extends('layouts.app')

@section('title', ($project->meta_title ?: $project->title) . ' | Subhadip Chakraborty')

@section('head')
<meta name="description" content="{{ $project->meta_description ?: Str::limit(strip_tags($project->description), 160) }}">
@if($project->meta_keywords)
<meta name="keywords" content="{{ $project->meta_keywords }}">
@endif
{{-- Open Graph --}}
<meta property="og:title" content="{{ $project->meta_title ?: $project->title }}">
<meta property="og:description" content="{{ $project->meta_description ?: Str::limit(strip_tags($project->description), 160) }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
@if($project->image)
<meta property="og:image" content="{{ Str::startsWith($project->image, ['http://', 'https://']) ? $project->image : asset('storage/' . $project->image) }}">
@endif
{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $project->meta_title ?: $project->title }}">
<meta name="twitter:description" content="{{ $project->meta_description ?: Str::limit(strip_tags($project->description), 160) }}">
@endsection

@section('content')
<main class="flex-grow pt-20 pb-20 min-h-screen bg-gray-50">
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-16 items-center justify-center flex-col">
            <div class="w-full lg:w-3/4 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-12">
                @if($project->image)
                    <img class="w-full h-80 sm:h-96 object-cover object-center" alt="{{ $project->title }}" src="{{ Str::startsWith($project->image, ['http://', 'https://']) ? $project->image : asset('storage/' . $project->image) }}">
                @else
                    <div class="w-full h-80 sm:h-96 bg-gradient-to-r from-blue-600 to-indigo-700 flex items-center justify-center p-8 text-center">
                        <span class="text-white text-4xl sm:text-5xl font-extrabold tracking-tight">{{ $project->title }}</span>
                    </div>
                @endif

                <div class="p-8 sm:p-12">
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-6 border-b border-gray-100 pb-6">
                        <div>
                            <h3 class="tracking-widest text-blue-600 text-xs font-bold title-font uppercase mb-1.5">{{ $project->subtitle ?? 'WEB APPLICATION' }}</h3>
                            <h1 class="title-font sm:text-4xl text-3xl font-extrabold text-gray-900">{{ $project->title }}</h1>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            @if($project->url)
                                <a href="{{ $project->url }}" target="_blank" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition-colors shadow-sm shadow-blue-200 inline-flex items-center gap-2">
                                    <i class="fas fa-external-link-alt"></i> Live Demo
                                </a>
                            @endif
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="px-5 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-semibold hover:bg-black transition-colors shadow-sm inline-flex items-center gap-2">
                                    <i class="fab fa-github text-lg"></i> GitHub
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="prose max-w-none text-gray-700 text-lg leading-relaxed mb-8">
                        {!! $project->description !!}
                    </div>

                    @if($project->tags->count() > 0)
                    <div class="pt-6 border-t border-gray-100">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Technologies / Tags</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->tags as $tag)
                                <span class="bg-gray-100 text-gray-700 rounded-xl px-4 py-1.5 text-sm font-semibold hover:bg-gray-200 transition-colors">#{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="flex justify-start mt-12 border-t border-gray-100 pt-8">
                        <a href="{{ route('projects') }}" class="inline-flex items-center text-gray-700 bg-gray-100 border-0 py-2.5 px-6 focus:outline-none hover:bg-gray-200 rounded-xl text-base font-semibold transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Projects
                        </a>
                        <a href="{{ route('home') }}" class="ml-4 inline-flex items-center text-blue-600 bg-blue-50 border-0 py-2.5 px-6 focus:outline-none hover:bg-blue-100 rounded-xl text-base font-semibold transition-colors">
                            Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
