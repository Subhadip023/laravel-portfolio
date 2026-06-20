@extends('admin.layout')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Icon Library</h2>
        <p class="text-sm text-gray-500 mt-1">Upload and manage SVG icons used across the portfolio.</p>
    </div>
</div>

@if(session('success'))
<div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl shadow-sm">
    <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- ── Left: Add New Icon ── --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
            <h3 class="text-base font-semibold text-gray-700 mb-5 flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs"><i class="fas fa-plus"></i></span>
                Add New Icon
            </h3>

            <form action="{{ route('admin.icons.store') }}" method="POST" id="add-icon-form">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1.5">Icon Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="new-icon-name"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                            placeholder="e.g. Arrow Right, Code Slash" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1.5">SVG Content <span class="text-red-500">*</span></label>
                        <textarea name="svg_html" id="new-icon-svg" rows="6"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all resize-none"
                            placeholder="Paste a full <svg>...</svg> tag or raw HTML"></textarea>
                        <p class="text-xs text-gray-400 mt-1">Accepts a full <code class="bg-gray-100 px-1 rounded">&lt;svg&gt;...&lt;/svg&gt;</code> tag or any HTML code.</p>
                        @error('svg_html') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Live Preview --}}
                    <div class="border border-dashed border-gray-200 rounded-lg p-4 bg-gray-50">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Live Preview</p>
                        <div class="flex items-center gap-3">
                            <div id="new-icon-preview" class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </div>
                            <span id="new-icon-label" class="text-sm text-gray-500 italic">(paste SVG to preview)</span>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200">
                        <i class="fas fa-save"></i> Save Icon
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ── Right: Icon Grid ── --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-semibold text-gray-700 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs"><i class="fas fa-icons"></i></span>
                    Saved Icons <span class="ml-2 text-xs font-normal text-gray-400">({{ $icons->count() }} total)</span>
                </h3>
            </div>

            @if($icons->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <i class="fas fa-image text-4xl mb-3 opacity-30"></i>
                <p class="text-sm">No icons yet. Add your first icon from the form.</p>
            </div>
            @else
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @foreach($icons as $icon)
                <div class="group border border-gray-200 rounded-xl p-4 hover:border-indigo-300 hover:shadow-sm transition-all bg-gray-50/50" id="icon-card-{{ $icon->id }}">
                    {{-- Preview --}}
                    <div class="flex justify-center mb-3">
                        <div class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center text-white">
                            {!! $icon->render('w-6 h-6') !!}
                        </div>
                    </div>

                    {{-- Name & ID --}}
                    <p class="text-sm font-semibold text-gray-800 text-center truncate">{{ $icon->name }}</p>
                    <p class="text-xs text-gray-400 text-center mt-0.5">ID: {{ $icon->id }}</p>

                    {{-- Actions --}}
                    <div class="flex gap-2 mt-3">
                        <button type="button"
                            class="flex-1 py-1.5 text-xs font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors edit-btn"
                            data-id="{{ $icon->id }}"
                            data-name="{{ $icon->name }}"
                            data-svg="{{ htmlspecialchars($icon->svg_html, ENT_QUOTES) }}">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </button>
                        <form action="{{ route('admin.icons.destroy', $icon) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Delete {{ $icon->name }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full py-1.5 text-xs font-medium text-red-500 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                                <i class="fas fa-trash-alt mr-1"></i> Del
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

</div>

{{-- ── Edit Modal ── --}}
<div id="edit-modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-lg font-bold text-gray-800">Edit Icon</h3>
            <button id="close-modal" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times text-xl"></i></button>
        </div>
        <form id="edit-form" method="POST">
            @csrf @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Icon Name</label>
                    <input type="text" name="name" id="edit-name"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">SVG Content</label>
                    <textarea name="svg_html" id="edit-svg" rows="6"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm font-mono focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all resize-none"></textarea>
                </div>

                {{-- Preview --}}
                <div class="border border-dashed border-gray-200 rounded-lg p-4 bg-gray-50">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Preview</p>
                    <div id="edit-preview" class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center text-white"></div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" id="close-modal-2"
                        class="flex-1 py-2.5 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">Cancel</button>
                    <button type="submit"
                        class="flex-1 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition-colors">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // ── Helper: build SVG preview HTML from raw input ─────────────────────
    function buildPreviewHtml(raw) {
        raw = raw.trim();
        if (!raw) return '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>';
        if (raw.toLowerCase().startsWith('<svg')) {
            // Inject class attribute
            if (/<svg[^>]*class=["\']/.test(raw)) {
                return raw.replace(/class=["\']([^"\']*)["\']/, 'class="w-6 h-6"');
            } else {
                return raw.replace(/<svg/, '<svg class="w-6 h-6"');
            }
        }
        return raw;
    }

    // ── New icon live preview ──────────────────────────────────────────────
    const newSvgInput = document.getElementById('new-icon-svg');
    const newNameInput = document.getElementById('new-icon-name');
    const newPreview   = document.getElementById('new-icon-preview');
    const newLabel     = document.getElementById('new-icon-label');

    newSvgInput.addEventListener('input', () => {
        newPreview.innerHTML = buildPreviewHtml(newSvgInput.value);
        newLabel.textContent = newNameInput.value || '(unnamed)';
    });
    newNameInput.addEventListener('input', () => {
        newLabel.textContent = newNameInput.value || '(unnamed)';
    });

    // ── Edit modal ────────────────────────────────────────────────────────
    const modal     = document.getElementById('edit-modal');
    const editForm  = document.getElementById('edit-form');
    const editName  = document.getElementById('edit-name');
    const editSvg   = document.getElementById('edit-svg');
    const editPrev  = document.getElementById('edit-preview');

    function openModal(id, name, svg) {
        editForm.action = `/admin/icons/${id}`;
        editName.value = name;
        editSvg.value  = svg;
        editPrev.innerHTML = buildPreviewHtml(svg);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            openModal(btn.dataset.id, btn.dataset.name, btn.dataset.svg);
        });
    });

    editSvg.addEventListener('input', () => {
        editPrev.innerHTML = buildPreviewHtml(editSvg.value);
    });

    document.getElementById('close-modal').addEventListener('click', closeModal);
    document.getElementById('close-modal-2').addEventListener('click', closeModal);
    modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
</script>
@endpush

@endsection
