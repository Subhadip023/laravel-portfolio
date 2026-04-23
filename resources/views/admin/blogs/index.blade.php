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
                    <th class="px-6 py-4 font-semibold">Author</th>
                    <th class="px-6 py-4 font-semibold">Category</th>
                    <th class="px-6 py-4 font-semibold">Status</th>
                    <th class="px-6 py-4 font-semibold">Date</th>
                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                <!-- Demo Blog 1 -->
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800">10 Laravel Tips & Tricks for 2026</div>
                        <div class="text-xs text-gray-500 mt-0.5">/blog/laravel-tips-2026</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff" class="w-6 h-6 rounded-full">
                            <span class="text-gray-700">Admin User</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">Web Development</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">Published</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">Oct 24, 2026</td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-gray-400 hover:text-indigo-600 mr-2 transition-colors" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="text-gray-400 hover:text-red-600 transition-colors" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>

                <!-- Demo Blog 2 -->
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800">Tailwind CSS vs Bootstrap: The Final Verdict</div>
                        <div class="text-xs text-gray-500 mt-0.5">/blog/tailwind-vs-bootstrap</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff" class="w-6 h-6 rounded-full">
                            <span class="text-gray-700">Admin User</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">Design</td>
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">Published</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">Oct 20, 2026</td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-gray-400 hover:text-indigo-600 mr-2 transition-colors" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="text-gray-400 hover:text-red-600 transition-colors" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>

                <!-- Demo Blog 3 -->
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="font-semibold text-gray-800">My Journey as an Agentic AI Developer</div>
                        <div class="text-xs text-gray-500 mt-0.5">/blog/ai-developer-journey</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=fff" class="w-6 h-6 rounded-full">
                            <span class="text-gray-700">Admin User</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">Personal</td>
                    <td class="px-6 py-4">
                        <span class="bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-full text-xs font-semibold">Draft</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">-</td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-gray-400 hover:text-indigo-600 mr-2 transition-colors" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="text-gray-400 hover:text-red-600 transition-colors" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Footer -->
    <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between text-sm text-gray-500 bg-gray-50/50">
        <div>Showing 1 to 3 of 12 entries</div>
        <div class="flex gap-1">
            <button class="px-3 py-1 border border-gray-200 rounded text-gray-400 cursor-not-allowed bg-white">Prev</button>
            <button class="px-3 py-1 bg-indigo-600 text-white rounded font-medium">1</button>
            <button class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 text-gray-700 bg-white transition-colors">2</button>
            <button class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 text-gray-700 bg-white transition-colors">3</button>
            <button class="px-3 py-1 border border-gray-200 rounded hover:bg-gray-50 text-gray-700 bg-white transition-colors">Next</button>
        </div>
    </div>
</div>
@endsection
