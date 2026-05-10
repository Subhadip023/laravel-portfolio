@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Create New Blog</h2>
        <p class="text-sm text-gray-500 mt-1">Write an amazing new article for your readers.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.blogs.index') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Blogs
        </a>
    </div>
</div>

<form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @csrf
    <!-- Main Form Area -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Blog Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. 10 Laravel Tips & Tricks for 2026" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Slug</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-200 bg-gray-50 text-gray-500 text-sm">
                            /blog/
                        </span>
                        <input type="text" placeholder="laravel-tips-2026" class="flex-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-r-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5">Leave blank to generate automatically from the title.</p>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Short Excerpt</label>
                    <textarea rows="3" placeholder="A brief summary of your blog post..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all"></textarea>
                </div>

                <div class="mb-6">
                    <div class="flex justify-between items-end mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Content <span class="text-red-500">*</span></label>
                        <div class="flex gap-2">
                            <button type="button" class="text-gray-400 hover:text-indigo-600 transition-colors p-1" title="Bold"><i class="fas fa-bold"></i></button>
                            <button type="button" class="text-gray-400 hover:text-indigo-600 transition-colors p-1" title="Italic"><i class="fas fa-italic"></i></button>
                            <button type="button" class="text-gray-400 hover:text-indigo-600 transition-colors p-1" title="Link"><i class="fas fa-link"></i></button>
                            <button type="button" class="text-gray-400 hover:text-indigo-600 transition-colors p-1" title="Image"><i class="fas fa-image"></i></button>
                            <button type="button" class="text-gray-400 hover:text-indigo-600 transition-colors p-1" title="Code"><i class="fas fa-code"></i></button>
                        </div>
                    </div>
                    <textarea name="content" rows="15" placeholder="Write your awesome content here..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all font-mono">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
        </div>
    </div>

    <!-- Sidebar Settings -->
    <div class="lg:col-span-1 space-y-6">
        
        <!-- Publish Settings -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Publish Options</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Draft (Private)</option>
                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Published (Public)</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Visibility Date</label>
                <input type="datetime-local" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-600">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="w-full py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-bold hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-200">
                    Save Blog
                </button>
            </div>
        </div>

        <!-- Categories & Tags -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Categorization</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Select a category...</option>
                    <option value="web-dev">Web Development</option>
                    <option value="design">Design</option>
                    <option value="personal">Personal</option>
                    <option value="tutorial">Tutorial</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                <input type="text" placeholder="Laravel, PHP, Web..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <p class="text-xs text-gray-400 mt-1.5">Separate tags with commas.</p>
            </div>
        </div>

        <!-- Featured Image -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Featured Image</h3>
            
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition-colors cursor-pointer group relative">
                <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 mx-auto flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-cloud-upload-alt text-xl"></i>
                </div>
                <p class="text-sm font-medium text-gray-700 mb-1">Click to upload image</p>
                <p class="text-xs text-gray-500">PNG, JPG or WEBP up to 2MB</p>
            </div>
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>
</form>
@endsection
