@extends('admin.layout')

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow { border: none; border-bottom: 1px solid #e5e7eb; background: #f9fafb; padding: 12px; }
    .ql-container.ql-snow { border: none; font-family: 'Inter', sans-serif; font-size: 0.875rem; }
    .ql-editor { color: #374151; padding: 1rem; }
    .ql-editor.ql-blank::before { color: #9ca3af; font-style: normal; }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Edit Blog Post</h2>
        <p class="text-sm text-gray-500 mt-1">Update your existing article content and settings.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.blogs.index') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Blogs
        </a>
    </div>
</div>

<form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @csrf
    @method('PUT')
    <!-- Main Form Area -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Blog Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $blog->title) }}" placeholder="e.g. 10 Laravel Tips & Tricks for 2026" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
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
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Content <span class="text-red-500">*</span></label>
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-indigo-500 transition-all">
                        <div id="quill-editor" style="height: 350px;">{!! old('content', $blog->content) !!}</div>
                    </div>
                    <input type="hidden" name="content" id="hidden-content" value="{{ old('content', $blog->content) }}">
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
                    <option value="1" {{ old('status', $blog->status) == '1' ? 'selected' : '' }}>Draft (Private)</option>
                    <option value="2" {{ old('status', $blog->status) == '2' ? 'selected' : '' }}>Published (Public)</option>
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
                    Update Blog
                </button>
            </div>
        </div>

        <!-- Categories & Tags -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Categorization</h3>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category_id" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">Select a category...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 cursor-pointer hover:bg-gray-100 transition-colors">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ (is_array(old('tags')) && in_array($tag->id, old('tags'))) || (!is_array(old('tags')) && $blog->tags->contains($tag->id)) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">{{ $tag->name }}</span>
                        </label>
                    @endforeach
                </div>
                <p class="text-xs text-gray-400 mt-1.5">Select applicable tags.</p>
                @error('tags')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Featured Image -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Featured Image</h3>
            
            <div id="image-preview-container" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition-colors cursor-pointer group relative overflow-hidden h-48 flex flex-col justify-center mb-4">
                <input type="file" name="image" id="image-upload" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" accept="image/*" onchange="previewImage(event)">
                
                <div id="upload-placeholder" class="z-10 relative pointer-events-none {{ $blog->image ? 'hidden' : '' }}">
                    <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 mx-auto flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-cloud-upload-alt text-xl"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Click to upload new image</p>
                    <p class="text-xs text-gray-500">PNG, JPG or WEBP up to 2MB</p>
                </div>

                <img id="image-preview" src="{{ $blog->image ? (Str::startsWith($blog->image, ['http://', 'https://']) ? $blog->image : asset('storage/' . $blog->image)) : '#' }}" alt="Preview" class="{{ $blog->image ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover rounded-lg z-10 pointer-events-none">
            </div>
            @error('image')
                <p class="text-red-500 text-xs mt-1 mb-2">{{ $message }}</p>
            @enderror

            <div class="pt-4 border-t border-gray-100">
                <label class="block text-sm font-medium text-gray-700 mb-2">Or Provide Image URL</label>
                <input type="url" name="image_url" value="{{ old('image_url', (isset($blog) && Str::startsWith($blog->image, ['http://', 'https://'])) ? $blog->image : '') }}" placeholder="https://example.com/image.jpg" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                <p class="text-xs text-gray-400 mt-1.5">If both file and URL are provided, the uploaded file takes priority.</p>
                @error('image_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

    </div>
</form>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Write your awesome content here...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });

        var contentInput = document.querySelector('#hidden-content');
        
        // Sync the hidden input on every text change
        quill.on('text-change', function() {
            var html = quill.root.innerHTML;
            if (html === '<p><br></p>') html = '';
            contentInput.value = html;
        });

        // Also sync right before submit as a fallback
        var form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function() {
                var html = quill.root.innerHTML;
                if (html === '<p><br></p>') html = '';
                contentInput.value = html;
            });
        }
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            var placeholder = document.getElementById('upload-placeholder');
            output.src = reader.result;
            output.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endpush
@endsection
