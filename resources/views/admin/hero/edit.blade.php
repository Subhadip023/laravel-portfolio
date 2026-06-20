@extends('admin.layout')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Hero Section Settings</h2>
        <p class="text-sm text-gray-500 mt-1">Edit the content shown in the homepage hero section.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank"
        class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm">
        <i class="fas fa-external-link-alt"></i> Preview Page
    </a>
</div>

@if(session('success'))
<div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl shadow-sm">
    <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<form action="{{ route('admin.hero.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: Main form --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Identity Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs"><i class="fas fa-user"></i></span>
                    Identity
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="hero_name" class="block text-sm font-medium text-gray-600 mb-1.5">First Name <span class="text-red-500">*</span></label>
                        <input type="text" id="hero_name" name="hero_name"
                            value="{{ old('hero_name', $heroFields['hero_name']) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all @error('hero_name') border-red-400 @enderror"
                            placeholder="e.g. Subhadip">
                        @error('hero_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="hero_title" class="block text-sm font-medium text-gray-600 mb-1.5">Professional Title <span class="text-red-500">*</span></label>
                        <input type="text" id="hero_title" name="hero_title"
                            value="{{ old('hero_title', $heroFields['hero_title']) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all @error('hero_title') border-red-400 @enderror"
                            placeholder="e.g. Laravel Developer">
                        @error('hero_title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Bio Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs"><i class="fas fa-align-left"></i></span>
                    Biography
                </h3>

                <div class="space-y-5">
                    <div>
                        <label for="hero_bio" class="block text-sm font-medium text-gray-600 mb-1.5">Main Bio Paragraph</label>
                        <textarea id="hero_bio" name="hero_bio" rows="6"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all resize-none"
                            placeholder="Describe your experience, skills, and achievements...">{{ old('hero_bio', $heroFields['hero_bio']) }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Plain text. Line breaks will be preserved.</p>
                    </div>

                    <div>
                        <label for="hero_tagline" class="block text-sm font-medium text-gray-600 mb-1.5">Tagline / Current Focus</label>
                        <input type="text" id="hero_tagline" name="hero_tagline"
                            value="{{ old('hero_tagline', $heroFields['hero_tagline']) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                            placeholder="e.g. Currently focused on developing efficient backend systems...">
                    </div>
                </div>
            </div>

            {{-- Contact & CTA --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs"><i class="fas fa-link"></i></span>
                    CTA Buttons & Contact
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="hero_projects_label" class="block text-sm font-medium text-gray-600 mb-1.5">Primary Button Label</label>
                        <input type="text" id="hero_projects_label" name="hero_projects_label"
                            value="{{ old('hero_projects_label', $heroFields['hero_projects_label']) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                            placeholder="e.g. View Projects">
                    </div>

                    <div>
                        <label for="hero_contact_label" class="block text-sm font-medium text-gray-600 mb-1.5">Secondary Button Label</label>
                        <input type="text" id="hero_contact_label" name="hero_contact_label"
                            value="{{ old('hero_contact_label', $heroFields['hero_contact_label']) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                            placeholder="e.g. Contact Me">
                    </div>

                    <div class="sm:col-span-2">
                        <label for="hero_email" class="block text-sm font-medium text-gray-600 mb-1.5">Contact Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                            <input type="email" id="hero_email" name="hero_email"
                                value="{{ old('hero_email', $heroFields['hero_email']) }}"
                                class="w-full pl-9 pr-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all @error('hero_email') border-red-400 @enderror"
                                placeholder="e.g. you@example.com">
                        </div>
                        @error('hero_email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        {{-- Right: Preview sidebar --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-violet-100 flex items-center justify-center text-violet-600 text-xs"><i class="fas fa-eye"></i></span>
                    Live Preview
                </h3>

                <div class="bg-gray-50 rounded-lg p-4 border border-dashed border-gray-200">
                    <p class="text-sm text-gray-500 mb-1">Hi, I'm</p>
                    <p id="preview_name" class="text-2xl font-bold text-blue-600">{{ $heroFields['hero_name'] }}</p>
                    <p id="preview_title" class="text-gray-700 font-medium mt-0.5">{{ $heroFields['hero_title'] }}</p>
                    <p id="preview_bio" class="text-xs text-gray-500 mt-3 leading-relaxed line-clamp-4">{{ $heroFields['hero_bio'] ?: '(no bio yet)' }}</p>
                    <p id="preview_tagline" class="text-xs text-gray-400 mt-2 italic">{{ $heroFields['hero_tagline'] ?: '(no tagline yet)' }}</p>

                    <div class="flex gap-2 mt-4">
                        <span id="preview_btn1" class="px-3 py-1 bg-blue-500 text-white text-xs rounded">{{ $heroFields['hero_projects_label'] ?: 'View Projects' }}</span>
                        <span id="preview_btn2" class="px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded">{{ $heroFields['hero_contact_label'] ?: 'Contact Me' }}</span>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-100">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="{{ route('home') }}" target="_blank"
                        class="mt-2 w-full flex items-center justify-center gap-2 px-4 py-2 text-gray-500 rounded-lg text-sm hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                        <i class="fas fa-external-link-alt text-xs"></i> Open live site
                    </a>
                </div>
            </div>
        </div>

    </div>
</form>

@push('scripts')
<script>
    // Real-time preview update
    function bindPreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        if (!input || !preview) return;
        input.addEventListener('input', () => {
            preview.textContent = input.value || preview.dataset.placeholder || '';
        });
    }

    bindPreview('hero_name', 'preview_name');
    bindPreview('hero_title', 'preview_title');
    bindPreview('hero_bio', 'preview_bio');
    bindPreview('hero_tagline', 'preview_tagline');
    bindPreview('hero_projects_label', 'preview_btn1');
    bindPreview('hero_contact_label', 'preview_btn2');
</script>
@endpush

@endsection
