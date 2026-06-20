@extends('admin.layout')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Edit Resume</h2>
        <p class="text-sm text-gray-500 mt-1">Modify your professional resume configuration: {{ $resume->title }}</p>
    </div>
    <a href="{{ route('admin.resumes.index') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm inline-flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Resumes
    </a>
</div>

@if ($errors->any())
<div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl shadow-sm">
    <div class="flex items-center gap-2 mb-2 font-semibold">
        <i class="fas fa-exclamation-circle text-red-500"></i>
        <span>Validation Errors:</span>
    </div>
    <ul class="list-disc pl-5 text-sm space-y-1">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.resumes.update', $resume) }}" method="POST" id="resume-form" 
      x-data="resumeBuilder()" class="space-y-8 pb-20">
    @csrf
    @method('PUT')

    {{-- Basic / Header Details --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-base font-semibold text-gray-700 mb-6 flex items-center gap-2">
            <span class="w-7 h-7 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs"><i class="fas fa-user"></i></span>
            Header / Personal Details
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Resume Title (Internal identification) <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $resume->title) }}" required placeholder="e.g. Senior Laravel Developer Resume"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $resume->name) }}" required placeholder="Subhadip Chakraborty"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $resume->email) }}" required placeholder="subhadip240420@gmail.com"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $resume->phone) }}" placeholder="6290765575"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Location (e.g. Kolkata, West Bengal)</label>
                <input type="text" name="location" value="{{ old('location', $resume->location) }}" placeholder="Kolkata, West Bengal"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">LinkedIn Profile Link</label>
                <input type="text" name="linkedin" value="{{ old('linkedin', $resume->linkedin) }}" placeholder="linkedin.com/in/subhadip-chakraborty"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Website / Other Portfolio Link</label>
                <input type="text" name="website" value="{{ old('website', $resume->website) }}" placeholder="github.com/subhadip023"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
            </div>
        </div>
    </div>

    {{-- Education Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-semibold text-gray-700 flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-xs"><i class="fas fa-graduation-cap"></i></span>
                Education
            </h3>
            <button type="button" @click="addEducation()"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-sm font-medium hover:bg-blue-100 transition-colors">
                <i class="fas fa-plus text-xs"></i> Add Education
            </button>
        </div>

        <div class="space-y-6">
            <template x-for="(edu, index) in education" :key="index">
                <div class="border border-gray-200 rounded-xl p-5 bg-gray-50/50 relative">
                    <button type="button" @click="removeEducation(index)"
                            class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors text-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-4">Education Entry <span x-text="index + 1"></span></span>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Institution <span class="text-red-500">*</span></label>
                            <input type="text" :name="`education[${index}][institution]`" x-model="edu.institution" required placeholder="e.g. Aliah University"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Location</label>
                            <input type="text" :name="`education[${index}][location]`" x-model="edu.location" placeholder="e.g. Kolkata, West Bengal"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Degree / Course <span class="text-red-500">*</span></label>
                            <input type="text" :name="`education[${index}][degree]`" x-model="edu.degree" required placeholder="e.g. B.Tech In Electronics Communication Engineering"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Percentage / GPA</label>
                            <input type="text" :name="`education[${index}][percentage]`" x-model="edu.percentage" placeholder="e.g. 86.00 or 8.6 CGPA"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Start / Enrollment Date</label>
                            <input type="text" :name="`education[${index}][enrolled]`" x-model="edu.enrolled" placeholder="e.g. Sep 2021"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">End / Graduation Date</label>
                            <input type="text" :name="`education[${index}][expected]`" x-model="edu.expected" placeholder="e.g. July 2024"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Experience Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-semibold text-gray-700 flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600 text-xs"><i class="fas fa-briefcase"></i></span>
                Experience (Optional)
            </h3>
            <button type="button" @click="addExperience()"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-teal-50 text-teal-600 rounded-lg text-sm font-medium hover:bg-teal-100 transition-colors">
                <i class="fas fa-plus text-xs"></i> Add Experience
            </button>
        </div>

        <div class="space-y-6">
            <template x-for="(exp, index) in experience" :key="index">
                <div class="border border-gray-200 rounded-xl p-5 bg-gray-50/50 relative">
                    <button type="button" @click="removeExperience(index)"
                            class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors text-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-4">Experience Entry <span x-text="index + 1"></span></span>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Company / Organization <span class="text-red-500">*</span></label>
                            <input type="text" :name="`experience[${index}][company]`" x-model="exp.company" required placeholder="e.g. Flynn Labs"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Location</label>
                            <input type="text" :name="`experience[${index}][location]`" x-model="exp.location" placeholder="e.g. Remote / Kolkata, WB"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Role / Job Title <span class="text-red-500">*</span></label>
                            <input type="text" :name="`experience[${index}][title]`" x-model="exp.title" required placeholder="e.g. Laravel Developer"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Start Date</label>
                            <input type="text" :name="`experience[${index}][start_date]`" x-model="exp.start_date" placeholder="e.g. Jan 2024"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">End Date</label>
                            <input type="text" :name="`experience[${index}][end_date]`" x-model="exp.end_date" placeholder="e.g. Present"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                    </div>

                    {{-- Experience Bullet Points --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Key Contributions / Bullet Points</label>
                            <button type="button" @click="addExperiencePoint(index)"
                                    class="text-xs text-indigo-500 hover:text-indigo-700 font-semibold flex items-center gap-1">
                                <i class="fas fa-plus text-[10px]"></i> Add Point
                            </button>
                        </div>
                        
                        <div class="space-y-2">
                            <template x-for="(pt, pIdx) in exp.points" :key="pIdx">
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-400 text-sm flex-shrink-0">•</span>
                                    <input type="text" :name="`experience[${index}][points][${pIdx}]`" 
                                           x-model="exp.points[pIdx]" required
                                           placeholder="e.g. Designed and implemented scalable REST API endpoints..."
                                           class="w-full px-3 py-1.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                    <button type="button" @click="removeExperiencePoint(index, pIdx)"
                                            class="text-gray-300 hover:text-red-400 transition-colors flex-shrink-0">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Training Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-semibold text-gray-700 flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 text-xs"><i class="fas fa-certificate"></i></span>
                Training
            </h3>
            <button type="button" @click="addTraining()"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg text-sm font-medium hover:bg-emerald-100 transition-colors">
                <i class="fas fa-plus text-xs"></i> Add Training Entry
            </button>
        </div>

        <div class="space-y-6">
            <template x-for="(trn, index) in training" :key="index">
                <div class="border border-gray-200 rounded-xl p-5 bg-gray-50/50 relative">
                    <button type="button" @click="removeTraining(index)"
                            class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors text-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-4">Training Entry <span x-text="index + 1"></span></span>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Company / Organization <span class="text-red-500">*</span></label>
                            <input type="text" :name="`training[${index}][organization]`" x-model="trn.organization" required placeholder="e.g. Flynn Labs"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Location</label>
                            <input type="text" :name="`training[${index}][location]`" x-model="trn.location" placeholder="e.g. Kolkata, WB"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Role / Course Name <span class="text-red-500">*</span></label>
                            <input type="text" :name="`training[${index}][title]`" x-model="trn.title" required placeholder="e.g. Machine Learning Intern"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Start Date</label>
                            <input type="text" :name="`training[${index}][start_date]`" x-model="trn.start_date" placeholder="e.g. June 2023"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">End Date</label>
                            <input type="text" :name="`training[${index}][end_date]`" x-model="trn.end_date" placeholder="e.g. Aug 2023"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Projects Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-semibold text-gray-700 flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600 text-xs"><i class="fas fa-project-diagram"></i></span>
                Projects
            </h3>
            <button type="button" @click="addProject()"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-50 text-amber-600 rounded-lg text-sm font-medium hover:bg-amber-100 transition-colors">
                <i class="fas fa-plus text-xs"></i> Add Project
            </button>
        </div>

        <div class="space-y-6">
            <template x-for="(proj, index) in projects" :key="index">
                <div class="border border-gray-200 rounded-xl p-5 bg-gray-50/50 relative">
                    <button type="button" @click="removeProject(index)"
                            class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors text-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    
                    <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-4">Project Entry <span x-text="index + 1"></span></span>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Project Title <span class="text-red-500">*</span></label>
                            <input type="text" :name="`projects[${index}][title]`" x-model="proj.title" required placeholder="e.g. Heart Disease Prediction Web App"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Project link (e.g. GitHub URL)</label>
                            <input type="text" :name="`projects[${index}][link]`" x-model="proj.link" placeholder="e.g. https://github.com/..."
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                    </div>

                    {{-- Project Bullet Points --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide">Key Points / Bullet Points <span class="text-red-500">*</span></label>
                            <button type="button" @click="addPoint(index)"
                                    class="text-xs text-indigo-500 hover:text-indigo-700 font-semibold flex items-center gap-1">
                                <i class="fas fa-plus text-[10px]"></i> Add Point
                            </button>
                        </div>
                        
                        <div class="space-y-2">
                            <template x-for="(pt, pIdx) in proj.points" :key="pIdx">
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-400 text-sm flex-shrink-0">•</span>
                                    <input type="text" :name="`projects[${index}][points][${pIdx}]`" 
                                           x-model="proj.points[pIdx]" required
                                           placeholder="e.g. Built with Flask, this web application enables users to input key health metrics..."
                                           class="w-full px-3 py-1.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                    <button type="button" @click="removePoint(index, pIdx)"
                                            class="text-gray-300 hover:text-red-400 transition-colors flex-shrink-0">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Skills Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-semibold text-gray-700 flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-pink-100 flex items-center justify-center text-pink-600 text-xs"><i class="fas fa-tools"></i></span>
                Skills (Summary)
            </h3>
            <button type="button" @click="addSkill()"
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-pink-50 text-pink-600 rounded-lg text-sm font-medium hover:bg-pink-100 transition-colors">
                <i class="fas fa-plus text-xs"></i> Add Skill Group
            </button>
        </div>

        <div class="space-y-4">
            <template x-for="(sk, index) in skills" :key="index">
                <div class="flex items-start gap-4 border border-gray-200 rounded-xl p-4 bg-gray-50/50 relative">
                    <button type="button" @click="removeSkill(index)"
                            class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors text-sm">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full pr-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Category <span class="text-red-500">*</span></label>
                            <input type="text" :name="`skills[${index}][category]`" x-model="sk.category" required placeholder="e.g. Programming Languages"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Skill List <span class="text-red-500">*</span> <span class="text-gray-400 font-normal">(comma-separated)</span></label>
                            <input type="text" :name="`skills[${index}][list]`" x-model="sk.list" required placeholder="e.g. Python, JavaScript (Node.js)"
                                   class="w-full px-4 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Visibility / Active settings --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-base font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <span class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 text-xs"><i class="fas fa-cog"></i></span>
            Settings
        </h3>
        
        <label class="flex items-center gap-3 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" {{ $resume->is_active ? 'checked' : '' }}
                   class="w-4.5 h-4.5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 transition-colors">
            <div>
                <span class="text-sm font-semibold text-gray-700">Set as Active Resume</span>
                <p class="text-xs text-gray-400">If checked, this resume configuration will be set as the main resume displayed on your public portfolio page.</p>
            </div>
        </label>
    </div>

    {{-- Form Buttons --}}
    <div class="flex justify-end gap-3 mt-6">
        <a href="{{ route('admin.resumes.index') }}"
           class="px-5 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors shadow-sm">
            Cancel
        </a>
        <button type="submit"
                class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm shadow-indigo-200 flex items-center gap-2">
            <i class="fas fa-save"></i> Update Resume
        </button>
    </div>
</form>

@push('scripts')
<!-- Load AlpineJS from CDN (ensure layout doesn't conflict, fallback included) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script>
    function resumeBuilder() {
        return {
            // Initial structures pre-loaded from PHP JSON values
            education: @json($resume->education ?? []),
            experience: @json($resume->experience ?? []),
            training: @json($resume->training ?? []),
            projects: @json($resume->projects ?? []),
            skills: @json($resume->skills ?? []),

            init() {
                // Ensure at least one entry exists if empty (except experience, which is optional)
                if (this.education.length === 0) this.addEducation();
                if (this.training.length === 0) this.addTraining();
                if (this.projects.length === 0) this.addProject();
                if (this.skills.length === 0) this.addSkill();
            },

            // Education Actions
            addEducation() {
                this.education.push({ institution: '', location: '', degree: '', enrolled: '', expected: '', percentage: '' });
            },
            removeEducation(idx) {
                this.education.splice(idx, 1);
            },

            // Experience Actions
            addExperience() {
                this.experience.push({ company: '', location: '', title: '', start_date: '', end_date: '', points: [''] });
            },
            removeExperience(idx) {
                this.experience.splice(idx, 1);
            },
            addExperiencePoint(pIdx) {
                this.experience[pIdx].points.push('');
            },
            removeExperiencePoint(pIdx, ptIdx) {
                this.experience[pIdx].points.splice(ptIdx, 1);
                if (this.experience[pIdx].points.length === 0) {
                    this.experience[pIdx].points.push('');
                }
            },

            // Training Actions
            addTraining() {
                this.training.push({ organization: '', location: '', title: '', start_date: '', end_date: '' });
            },
            removeTraining(idx) {
                this.training.splice(idx, 1);
            },

            // Projects Actions
            addProject() {
                this.projects.push({ title: '', link: '', points: [''] });
            },
            removeProject(idx) {
                this.projects.splice(idx, 1);
            },
            addPoint(pIdx) {
                this.projects[pIdx].points.push('');
            },
            removePoint(pIdx, ptIdx) {
                this.projects[pIdx].points.splice(ptIdx, 1);
                if (this.projects[pIdx].points.length === 0) {
                    this.projects[pIdx].points.push('');
                }
            },

            // Skills Actions
            addSkill() {
                this.skills.push({ category: '', list: '' });
            },
            removeSkill(idx) {
                this.skills.splice(idx, 1);
            }
        }
    }
</script>
@endpush
@endsection
