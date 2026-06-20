@extends('layouts.app')

@section('title', $blog->title . ' | Subhadip Chakraborty')

@section('seo')
<meta name="description" content="{{ Str::limit(strip_tags($blog->content), 160) }}">
@if($blog->tags && $blog->tags->count() > 0)
<meta name="keywords" content="{{ $blog->tags->pluck('name')->implode(', ') }}">
@endif
{{-- Open Graph --}}
<meta property="og:title" content="{{ $blog->title }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($blog->content), 160) }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
@if($blog->image)
<meta property="og:image" content="{{ Str::startsWith($blog->image, ['http://', 'https://']) ? $blog->image : asset('storage/' . $blog->image) }}">
@endif
{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $blog->title }}">
<meta name="twitter:description" content="{{ Str::limit(strip_tags($blog->content), 160) }}">
@endsection

@section('content')
<main class="flex-grow pt-20 pb-20 min-h-screen">
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-12 items-center justify-center flex-col">
            @if($blog->image)
            <img class="lg:w-2/3 w-full mb-10 object-cover object-center rounded-lg shadow-md" alt="{{ $blog->title }}" src="{{ Str::startsWith($blog->image, ['http://', 'https://']) ? $blog->image : asset('storage/' . $blog->image) }}">
            @else
            <img class="lg:w-2/3 w-full mb-10 object-cover object-center rounded-lg shadow-md" alt="{{ $blog->title }}" src="https://dummyimage.com/1200x600/3b82f6/ffffff&text={{ urlencode($blog->title) }}">
            @endif
            
            <div class="w-full lg:w-2/3">
                <p class="text-gray-500 mb-2 font-semibold">{{ $blog->created_at->format('F d, Y') }}</p>
                <h1 class="title-font sm:text-4xl text-3xl mb-6 font-bold text-gray-900">{{ $blog->title }}</h1>
                
                <div class="prose max-w-none text-gray-700 prose-blue">
                    {!! $blog->content !!}
                </div>
                
                <div class="flex justify-start mt-10 border-t border-gray-200 pt-6">
                    <a href="{{ route('home') }}" class="inline-flex text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded-lg text-lg transition-colors">Home</a>
                    <a href="{{ route('blog.index') }}" class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded-lg text-lg transition-colors">Back to Blogs</a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
