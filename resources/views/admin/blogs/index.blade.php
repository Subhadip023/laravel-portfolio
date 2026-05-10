@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Manage Blogs</h2>
        <p class="text-sm text-gray-500 mt-1">View, edit, or delete your published and draft blog posts.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('admin.blogs.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200 inline-flex items-center">
            <i class="fas fa-plus mr-2"></i> Create New Blog
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
            <input type="text" placeholder="Search blogs..." class="pl-9 pr-4 py-1.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-64">
        </div>
        <div class="flex gap-2">
            <select class="bg-gray-50 border border-gray-200 text-gray-700 py-1.5 px-3 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option>All Status</option>
                <option>Published</option>
                <option>Draft</option>
            </select>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                    <th class="px-6 py-4 font-semibold">Post Title</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold">Views</th>
                    <th class="px-6 py-4 font-semibold">Likes</th>
                    <th class="px-6 py-4 font-semibold">Date</th>
                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($blogs as $blog)
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800">{{ $blog->title }}</div>
                        <div class="text-xs text-gray-500 mt-0.5">ID: {{ $blog->id }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($blog->status == '2')
                            <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">Published</span>
                        @elseif($blog->status == '1')
                            <span class="bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-full text-xs font-semibold">Draft</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold">Unpublished</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $blog->views }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $blog->likes }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $blog->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-gray-400 hover:text-indigo-600 mr-2 transition-colors" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="text-gray-400 hover:text-red-600 transition-colors" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        No blogs found. <a href="{{ route('admin.blogs.create') }}" class="text-indigo-600 hover:underline">Create one</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Footer -->
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $blogs->links() }}
    </div>
</div>
@endsection
