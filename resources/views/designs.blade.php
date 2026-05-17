@extends('layouts.app')

@section('title', 'Designs | Subhadip Chakraborty')

@section('content')
<section class="text-gray-600 body-font pt-20 min-h-screen">
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
            @forelse($designs as $design)
            <div class="xl:w-1/3 md:w-1/2 p-4 w-full">
                <a href="{{ $design->url ?? '#' }}" {{ $design->url ? 'target="_blank"' : '' }} class="block h-full">
                    <div class="bg-gray-100 p-6 rounded-lg hover:shadow-lg transition-shadow h-full flex flex-col justify-between border border-gray-200/60">
                        <div>
                            @if($design->image)
                                <img class="h-48 rounded w-full object-cover object-center mb-6 shadow-sm" src="{{ asset('storage/' . $design->image) }}" alt="{{ $design->title }}">
                            @elseif($design->bg_gradient)
                                <div class="h-48 bg-gradient-to-r {{ $design->bg_gradient }} rounded flex items-center justify-center mb-6 shadow-sm">
                                    <span class="text-white text-2xl font-bold px-4 text-center">{{ $design->title }}</span>
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-r from-blue-500 to-indigo-600 rounded flex items-center justify-center mb-6 shadow-sm">
                                    <span class="text-white text-2xl font-bold px-4 text-center">{{ $design->title }}</span>
                                </div>
                            @endif
                            <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font uppercase">{{ $design->subtitle ?? 'UI/UX DESIGN' }}</h3>
                            <h2 class="text-lg text-gray-900 font-medium title-font mb-2">{{ $design->title }}</h2>
                            <p class="leading-relaxed text-base mb-4">{{ $design->description }}</p>
                        </div>
                        @if($design->tags->count() > 0)
                        <div class="mt-auto pt-4 border-t border-gray-200/60">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($design->tags as $tag)
                                    <span class="inline-block bg-gray-200/80 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </a>
            </div>
            @empty
            <div class="w-full p-12 text-center text-gray-500 bg-gray-50 rounded-xl mx-4 border border-gray-200 shadow-sm">
                <i class="fas fa-palette text-4xl mb-4 text-gray-400"></i>
                <p class="text-xl font-semibold text-gray-700">No designs showcased yet.</p>
                <p class="text-base mt-2 text-gray-500 max-w-md mx-auto">Check back soon for amazing new UI/UX design updates and interactive prototypes!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
