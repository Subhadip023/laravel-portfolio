@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Edit Project</h2>
        <p class="text-sm text-gray-500 mt-1">Update your developed project details.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Projects
        </a>
    </div>
</div>

<form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @csrf
    @method('PUT')
    <!-- Main Form Area -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Project Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $project->title) }}" placeholder="e.g. E-Commerce Platform" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Subtitle / Tech Stack</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $project->subtitle) }}" placeholder="e.g. LARAVEL & VUE.JS" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                @error('subtitle')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Live Demo URL</label>
                    <input type="text" name="url" value="{{ old('url', $project->url) }}" placeholder="e.g. https://example.com" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                    @error('url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">GitHub Repository URL</label>
                    <input type="text" name="github_url" value="{{ old('github_url', $project->github_url) }}" placeholder="e.g. https://github.com/username/repo" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">
                    @error('github_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" placeholder="A comprehensive description of your project..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all">{{ old('description', $project->description) }}</textarea>
                @error('description')
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
            
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="1" {{ old('status', $project->status) == '1' ? 'selected' : '' }}>Draft (Private)</option>
                    <option value="2" {{ old('status', $project->status) == '2' ? 'selected' : '' }}>Published (Public)</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="w-full py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-bold hover:bg-indigo-700 transition-colors shadow-md shadow-indigo-200">
                    Update Project
                </button>
            </div>
        </div>

        <!-- Tags -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Categorization</h3>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <label class="inline-flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 cursor-pointer hover:bg-gray-100 transition-colors">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ (is_array(old('tags')) && in_array($tag->id, old('tags'))) || (!is_array(old('tags')) && $project->tags->contains($tag->id)) ? 'checked' : '' }}>
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
            <h3 class="font-bold text-gray-800 border-b border-gray-100 pb-3 mb-4">Project Screenshot</h3>
            
            <div id="image-preview-container" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition-colors cursor-pointer group relative overflow-hidden h-48 flex flex-col justify-center">
                <input type="file" name="image" id="image-upload" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" accept="image/*" onchange="previewImage(event)">
                
                <div id="upload-placeholder" class="z-10 relative pointer-events-none {{ $project->image ? 'hidden' : '' }}">
                    <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-600 mx-auto flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i class="fas fa-cloud-upload-alt text-xl"></i>
                    </div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Click to upload new image</p>
                    <p class="text-xs text-gray-500">PNG, JPG or WEBP up to 2MB</p>
                </div>

                <img id="image-preview" src="{{ $project->image ? asset('storage/' . $project->image) : '#' }}" alt="Preview" class="{{ $project->image ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover rounded-lg z-10 pointer-events-none">
            </div>
            @error('image')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>
</form>

@push('scripts')
<script>
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
