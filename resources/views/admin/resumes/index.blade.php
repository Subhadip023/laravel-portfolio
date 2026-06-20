@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Manage Resumes</h2>
        <p class="text-sm text-gray-500 mt-1">Create, update, and manage multiple resume configurations for your portfolio.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.resumes.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200 inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Create New Resume
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 flex items-center shadow-sm">
    <i class="fas fa-check-circle mr-3 text-lg text-green-500"></i>
    <span class="font-medium">{{ session('success') }}</span>
</div>
@endif

<!-- Data Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                    <th class="px-6 py-4 font-semibold">Resume Title</th>
                    <th class="px-6 py-4 font-semibold">Personal Info</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold">Last Updated</th>
                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($resumes as $resume)
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800">{{ $resume->title }}</div>
                        <div class="text-xs text-indigo-600 mt-0.5 font-medium">Created: {{ $resume->created_at->format('M d, Y') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-700">{{ $resume->name }}</div>
                        <div class="text-xs text-gray-400 mt-0.5">{{ $resume->email }} | {{ $resume->phone ?? 'No Phone' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($resume->is_active)
                            <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-semibold inline-flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Active (Public)
                            </span>
                        @else
                            <form action="{{ route('admin.resumes.toggle-active', $resume) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-gray-100 text-gray-600 hover:bg-indigo-50 hover:text-indigo-600 px-3 py-1 rounded-full text-xs font-medium transition-colors">
                                    Set Active
                                </button>
                            </form>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $resume->updated_at->format('M d, Y H:i') }}</td>
                    <td class="px-6 py-4 text-right flex justify-end gap-3 items-center mt-1">
                        <a href="{{ route('resume.show', $resume) }}" target="_blank" class="text-gray-400 hover:text-blue-600 transition-colors" title="Preview / Print">
                            <i class="fas fa-eye text-base"></i>
                        </a>
                        <a href="{{ route('admin.resumes.edit', $resume) }}" class="text-gray-400 hover:text-indigo-600 transition-colors" title="Edit">
                            <i class="fas fa-edit text-base"></i>
                        </a>
                        <form action="{{ route('admin.resumes.destroy', $resume) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this resume?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors" title="Delete">
                                <i class="fas fa-trash-alt text-base"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <i class="far fa-file-alt text-gray-300 text-4xl mb-3"></i>
                            <p class="font-medium text-gray-600">No resumes found.</p>
                            <a href="{{ route('admin.resumes.create') }}" class="text-indigo-600 hover:underline mt-1 text-sm font-semibold">Create your first resume</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
