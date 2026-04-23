@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>
        <p class="text-sm text-gray-500 mt-1">Welcome back, John! Here's what's happening today.</p>
    </div>
    <div class="flex gap-2">
        <button class="px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm">
            <i class="fas fa-download mr-2"></i> Export
        </button>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200">
            <i class="fas fa-plus mr-2"></i> New Project
        </button>
    </div>
</div>

<!-- Metric Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Value Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Revenue</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">$54,239</h3>
            </div>
            <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-green-500 font-medium flex items-center bg-green-50 px-2 py-0.5 rounded-full text-xs">
                <i class="fas fa-arrow-up mr-1 text-[10px]"></i> 12.5%
            </span>
            <span class="text-gray-400 ml-2 text-xs">vs last month</span>
        </div>
    </div>

    <!-- Users Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Active Users</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">2,845</h3>
            </div>
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-green-500 font-medium flex items-center bg-green-50 px-2 py-0.5 rounded-full text-xs">
                <i class="fas fa-arrow-up mr-1 text-[10px]"></i> 5.2%
            </span>
            <span class="text-gray-400 ml-2 text-xs">vs last month</span>
        </div>
    </div>

    <!-- Orders Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">New Orders</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">1,240</h3>
            </div>
            <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-500">
                <i class="fas fa-shopping-bag"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-red-500 font-medium flex items-center bg-red-50 px-2 py-0.5 rounded-full text-xs">
                <i class="fas fa-arrow-down mr-1 text-[10px]"></i> 2.1%
            </span>
            <span class="text-gray-400 ml-2 text-xs">vs last month</span>
        </div>
    </div>

    <!-- Conversion Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Conversion Rate</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">4.28%</h3>
            </div>
            <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                <i class="fas fa-chart-pie"></i>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-green-500 font-medium flex items-center bg-green-50 px-2 py-0.5 rounded-full text-xs">
                <i class="fas fa-arrow-up mr-1 text-[10px]"></i> 1.8%
            </span>
            <span class="text-gray-400 ml-2 text-xs">vs last month</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Data Table -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
            <h3 class="font-bold text-gray-800">Recent Transactions</h3>
            <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View All</button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="px-6 py-4 font-semibold">TID</th>
                        <th class="px-6 py-4 font-semibold">Customer</th>
                        <th class="px-6 py-4 font-semibold">Date</th>
                        <th class="px-6 py-4 font-semibold">Amount</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-gray-500 font-medium">#5834</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Emma+Stone&background=random" class="w-8 h-8 rounded-full">
                                <span class="font-medium text-gray-800">Emma Stone</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">Oct 24, 2023</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">$124.00</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Completed</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-gray-500 font-medium">#5835</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=Marcus+Doe&background=random" class="w-8 h-8 rounded-full">
                                <span class="font-medium text-gray-800">Marcus Doe</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">Oct 24, 2023</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">$85.50</td>
                        <td class="px-6 py-4">
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-gray-500 font-medium">#5836</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs">AJ</div>
                                <span class="font-medium text-gray-800">Alex Johnson</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">Oct 23, 2023</td>
                        <td class="px-6 py-4 font-semibold text-gray-800">$210.00</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Completed</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right Column: Demo Chart / Info -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-gray-800">Traffic Sources</h3>
            <button class="text-gray-400 hover:text-gray-600"><i class="fas fa-ellipsis-v"></i></button>
        </div>
        
        <div class="flex-1 flex flex-col justify-center gap-6">
            <!-- Progress Bars -->
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-medium text-gray-700">Direct Search</span>
                    <span class="text-gray-500">45%</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-indigo-500 h-2 rounded-full" style="width: 45%"></div>
                </div>
            </div>
            
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-medium text-gray-700">Social Media</span>
                    <span class="text-gray-500">30%</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="bg-blue-400 h-2 rounded-full" style="width: 30%"></div>
                </div>
            </div>
            
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <button class="text-indigo-600 text-sm font-medium hover:text-indigo-800 transition-colors">See Detailed Report Request</button>
        </div>
    </div>
</div>
@endsection
