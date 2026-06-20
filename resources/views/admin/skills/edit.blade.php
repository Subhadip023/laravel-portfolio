@extends('admin.layout')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Skills & Expertise</h2>
        <p class="text-sm text-gray-500 mt-1">Manage skill categories, proficiency levels, and technology badges.</p>
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

<form action="{{ route('admin.skills.update') }}" method="POST" id="skills-form">
    @csrf
    @method('PUT')

    <div class="space-y-6">

        {{-- Skill Categories --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-base font-semibold text-gray-700 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs"><i class="fas fa-layer-group"></i></span>
                    Skill Categories
                </h3>
                <button type="button" id="add-category"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                    <i class="fas fa-plus text-xs"></i> Add Category
                </button>
            </div>

            <div id="categories-container" class="space-y-6">
                @foreach($categories as $ci => $category)
                <div class="category-block border border-gray-200 rounded-xl p-5 bg-gray-50/50" data-index="{{ $ci }}">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Category {{ $ci + 1 }}</span>
                        <button type="button" class="remove-category text-gray-400 hover:text-red-500 transition-colors text-sm">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1.5">Category Name <span class="text-red-500">*</span></label>
                            <input type="text" name="categories[{{ $ci }}][name]"
                                value="{{ $category['name'] }}"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                                placeholder="e.g. Backend Development" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1.5">Icon <span class="text-red-500">*</span>
                                <a href="{{ route('admin.icons.index') }}" target="_blank" class="ml-1 text-xs text-indigo-500 hover:underline font-normal"><i class="fas fa-external-link-alt text-[10px]"></i> Manage Icons</a>
                            </label>
                            <div class="flex gap-2 items-center">
                                @if($icons->isEmpty())
                                <p class="text-xs text-amber-600 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2 flex-1">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    No icons yet. <a href="{{ route('admin.icons.index') }}" class="underline font-medium">Add icons first →</a>
                                </p>
                                @else
                                <select name="categories[{{ $ci }}][icon_id]"
                                    class="icon-select flex-1 px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all bg-white">
                                    <option value="">— Select an icon —</option>
                                    @foreach($icons as $icon)
                                    <option value="{{ $icon->id }}"
                                        data-svg="{{ htmlspecialchars($icon->render('w-5 h-5'), ENT_QUOTES) }}"
                                        {{ ($category['icon_id'] ?? '') == $icon->id ? 'selected' : '' }}>
                                        {{ $icon->name }} (ID: {{ $icon->id }})
                                    </option>
                                    @endforeach
                                </select>
                                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center text-white icon-preview">
                                    @if(!empty($category['icon_id']) && $icons->contains('id', $category['icon_id']))
                                        {!! $icons->firstWhere('id', $category['icon_id'])->render('w-5 h-5') !!}
                                    @else
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Skills within category --}}
                    <div class="skills-list space-y-3 mb-3">
                        @foreach($category['items'] as $si => $item)
                        <div class="skill-row flex items-center gap-3">
                            <div class="flex-1">
                                <input type="text" name="categories[{{ $ci }}][items][{{ $si }}][name]"
                                    value="{{ $item['name'] }}"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                                    placeholder="Skill name" required>
                            </div>
                            <div class="w-28 flex items-center gap-2">
                                <input type="number" name="categories[{{ $ci }}][items][{{ $si }}][pct]"
                                    value="{{ $item['pct'] }}"
                                    min="1" max="100"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all text-center"
                                    placeholder="%" required>
                                <span class="text-gray-400 text-xs flex-shrink-0">%</span>
                            </div>
                            <button type="button" class="remove-skill text-gray-300 hover:text-red-400 transition-colors flex-shrink-0">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>

                    <button type="button" class="add-skill-btn text-xs text-indigo-500 hover:text-indigo-700 font-medium flex items-center gap-1 mt-1">
                        <i class="fas fa-plus"></i> Add Skill
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Tools / Badges --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-base font-semibold text-gray-700 mb-5 flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs"><i class="fas fa-tags"></i></span>
                Technology Badges
            </h3>
            <label class="block text-sm font-medium text-gray-600 mb-1.5">Technologies & Tools <span class="text-gray-400 font-normal">(comma-separated)</span></label>
            <textarea name="skills_tools" id="skills_tools" rows="3"
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all resize-none"
                placeholder="PHP, Laravel, MySQL, JavaScript, ...">{{ old('skills_tools', $toolsRaw) }}</textarea>
            <p class="text-xs text-gray-400 mt-1">These appear as hashtag badges below the skill cards.</p>

            {{-- Live badge preview --}}
            <div class="mt-4 pt-4 border-t border-gray-100">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Preview</p>
                <div id="badge-preview" class="flex flex-wrap gap-2">
                    @foreach(array_filter(array_map('trim', explode(',', $toolsRaw))) as $tech)
                    <span class="inline-block bg-gray-200/80 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Save --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('home') }}" target="_blank"
                class="px-5 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm">
                <i class="fas fa-external-link-alt mr-1"></i> Open Site
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200 flex items-center gap-2">
                <i class="fas fa-save"></i> Save Changes
            </button>
        </div>

    </div>
</form>

@push('scripts')
<script>
    // ── Category counter for dynamic index ──────────────────────────────────
    let catCount = {{ count($categories) }};

    // ── Add Category ─────────────────────────────────────────────────────────
    // Pass icons from PHP to JS
    const allIcons = @json($icons->map(fn($i) => ['id' => $i->id, 'name' => $i->name, 'svg' => $i->render('w-5 h-5')]));

    document.getElementById('add-category').addEventListener('click', function () {
        const ci = catCount++;

        const iconOptions = allIcons.length
            ? '<option value="">— Select an icon —</option>' + allIcons.map(i =>
                `<option value="${i.id}" data-svg="${i.svg.replace(/"/g, '&quot;')}">${i.name} (ID: ${i.id})</option>`
              ).join('')
            : '<option value="">No icons — add them first</option>';

        const block = document.createElement('div');
        block.className = 'category-block border border-gray-200 rounded-xl p-5 bg-gray-50/50';
        block.dataset.index = ci;
        block.innerHTML = `
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">New Category</span>
                <button type="button" class="remove-category text-gray-400 hover:text-red-500 transition-colors text-sm"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Category Name <span class="text-red-500">*</span></label>
                    <input type="text" name="categories[${ci}][name]" class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="e.g. Backend Development" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1.5">Icon <span class="text-red-500">*</span></label>
                    <div class="flex gap-2 items-center">
                        <select name="categories[${ci}][icon_id]" class="icon-select flex-1 px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all bg-white">
                            ${iconOptions}
                        </select>
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center text-white icon-preview">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="skills-list space-y-3 mb-3">
                ${makeSkillRow(ci, 0)}
            </div>
            <button type="button" class="add-skill-btn text-xs text-indigo-500 hover:text-indigo-700 font-medium flex items-center gap-1 mt-1"><i class="fas fa-plus"></i> Add Skill</button>
        `;
        document.getElementById('categories-container').appendChild(block);
        bindCategoryEvents(block);
    });

    // ── Remove Category ────────────────────────────────────────────────────
    function bindCategoryEvents(block) {
        block.querySelector('.remove-category').addEventListener('click', () => block.remove());
        block.querySelector('.add-skill-btn').addEventListener('click', () => addSkillRow(block));
        block.querySelectorAll('.remove-skill').forEach(btn => {
            btn.addEventListener('click', () => btn.closest('.skill-row').remove());
        });
        // Live icon preview on dropdown change
        const sel     = block.querySelector('.icon-select');
        const preview = block.querySelector('.icon-preview');
        if (sel && preview) {
            sel.addEventListener('change', () => {
                const opt = sel.options[sel.selectedIndex];
                preview.innerHTML = opt.dataset.svg || '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>';
            });
        }
    }

    // ── Add Skill Row ──────────────────────────────────────────────────────
    function makeSkillRow(ci, si, name = '', pct = '') {
        return `
        <div class="skill-row flex items-center gap-3">
            <div class="flex-1">
                <input type="text" name="categories[${ci}][items][${si}][name]" value="${name}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all"
                    placeholder="Skill name" required>
            </div>
            <div class="w-28 flex items-center gap-2">
                <input type="number" name="categories[${ci}][items][${si}][pct]" value="${pct}"
                    min="1" max="100"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all text-center"
                    placeholder="%" required>
                <span class="text-gray-400 text-xs flex-shrink-0">%</span>
            </div>
            <button type="button" class="remove-skill text-gray-300 hover:text-red-400 transition-colors flex-shrink-0"><i class="fas fa-times"></i></button>
        </div>`;
    }

    function addSkillRow(block) {
        const ci = block.dataset.index;
        const list = block.querySelector('.skills-list');
        const si = list.querySelectorAll('.skill-row').length;
        const div = document.createElement('div');
        div.innerHTML = makeSkillRow(ci, si);
        const row = div.firstElementChild;
        row.querySelector('.remove-skill').addEventListener('click', () => row.remove());
        list.appendChild(row);
    }

    // ── Bind existing blocks ────────────────────────────────────────────────
    document.querySelectorAll('.category-block').forEach(block => bindCategoryEvents(block));

    // ── Badge preview ──────────────────────────────────────────────────────
    document.getElementById('skills_tools').addEventListener('input', function () {
        const preview = document.getElementById('badge-preview');
        const techs = this.value.split(',').map(t => t.trim()).filter(Boolean);
        preview.innerHTML = techs.map(t =>
            `<span class="inline-block bg-gray-200/80 rounded-full px-3 py-1 text-xs font-semibold text-gray-700">#${t}</span>`
        ).join('');
    });
</script>
@endpush

@endsection
