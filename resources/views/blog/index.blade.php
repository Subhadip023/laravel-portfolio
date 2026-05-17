@extends('layouts.app')

@section('title', 'Blog | Subhadip Chakraborty')

@section('content')
<section class="text-gray-600 body-font min-h-screen pt-20 bg-gray-50">
    <div class="container px-5 py-24 mx-auto">
        <!-- <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">My Latest <span class="text-blue-500">Blogs</span></h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-gray-500">Discover my latest thoughts, tutorials, and insights on web development and design.</p>
        </div> -->
         <div class="flex flex-wrap w-full mb-20">
            <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
            <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">My Latest <span class="text-blue-500">Blogs</span></h1>
            <div class="h-1 w-20 bg-indigo-500 rounded"></div>
            </div>
            <div class="lg:w-1/2 w-full">
                <p class="text-gray-600 leading-relaxed text-lg mb-4">
                    <span class="font-medium text-gray-800">Discover my latest</span> thoughts, tutorials, and insights on web development and design.
                </p>
                <!-- loop blog catgories here -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">All Categories</a>
                    @foreach($categories as $category)
                        <a href="{{ route('blog.index', ['id' => $category->id]) }}" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white shadow-sm hover:opacity-90 transition" style="background-color: {{ $category->color ?? '#3b82f6' }}">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -m-4">
            @forelse($blogs as $blog)
            <div class="p-4 md:w-1/3">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden bg-white shadow-sm hover:shadow-lg transition duration-300">
                    <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ $blog->image ? (Str::startsWith($blog->image, ['http://', 'https://']) ? $blog->image : asset('storage/' . $blog->image)) : 'https://dummyimage.com/720x400/3b82f6/ffffff&text=' . urlencode($blog->title) }}" alt="{{ $blog->title }}">
                    <div class="p-6">
                        <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">{{ $blog->created_at->format('M d, Y') }}</h2>
                        <h1 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $blog->title }}</h1>
                        <p class="leading-relaxed mb-3 text-gray-600">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
                        <div class="flex items-center flex-wrap ">
                            <a href="{{ route('blog.show', $blog->id) }}" class="text-blue-500 inline-flex items-center md:mb-2 lg:mb-0 hover:text-blue-600">Learn More
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="w-full text-center py-12">
                <p class="text-gray-500 text-lg">No blogs published yet. Check back soon!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
