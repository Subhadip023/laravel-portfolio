@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Manage Projects</h2>
        <p class="text-sm text-gray-500 mt-1">View, edit, or delete your developed web applications and software projects.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200 inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Create New Project
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 flex items-center">
    <i class="fas fa-check-circle mr-3"></i>
    {{ session('success') }}
</div>
@endif

<!-- Data Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
        <div class="relative">
            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
            <input type="text" placeholder="Search projects..." class="pl-9 pr-4 py-1.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-64">
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                    <th class="px-6 py-4 font-semibold">Image</th>
                    <th class="px-6 py-4 font-semibold">Title & Subtitle</th>
                    <th class="px-6 py-4 font-semibold">Links</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold">Date</th>
                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($projects as $project)
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4 w-24">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-16 h-12 object-cover rounded">
                        @else
                            <div class="w-16 h-12 bg-gray-200 rounded flex items-center justify-center text-gray-500 text-xs font-bold shadow-sm">
                                PROJ
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800">{{ $project->title }}</div>
                        <div class="text-xs text-indigo-600 mt-0.5 font-medium">{{ $project->subtitle ?? 'Web Application' }}</div>
                    </td>
                    <td class="px-6 py-4 text-xs space-y-1">
                        @if($project->url)
                            <div><a href="{{ $project->url }}" target="_blank" class="text-indigo-600 hover:underline"><i class="fas fa-external-link-alt mr-1"></i> Live Demo</a></div>
                        @endif
                        @if($project->github_url)
                            <div><a href="{{ $project->github_url }}" target="_blank" class="text-gray-700 hover:underline"><i class="fab fa-github mr-1"></i> GitHub</a></div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($project->status == '2')
                            <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">Published</span>
                        @elseif($project->status == '1')
                            <span class="bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-full text-xs font-semibold">Draft</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold">Unpublished</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $project->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2 items-center">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="text-gray-400 hover:text-indigo-600 transition-colors" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        No projects found. <a href="{{ route('admin.projects.create') }}" class="text-indigo-600 hover:underline">Create one</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Footer -->
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $projects->links() }}
    </div>
</div>
@endsection
