<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $resume->name }} - Resume</title>
    
    <!-- Tailwind CSS (CDN for page container/styling) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Times New Roman font style matching classic academic LaTeX resumes */
        .resume-paper {
            font-family: "Times New Roman", Times, Baskerville, Georgia, serif;
            color: #000000;
        }

        /* Prevent section breaking to guarantee single page print compatibility */
        .resume-section {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        /* Printable styles */
        @media print {
            body {
                background-color: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .resume-shadow {
                box-shadow: none !important;
                border: none !important;
            }
            .resume-container {
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
            }
            .resume-paper {
                padding: 0mm !important;
                margin: 0mm !important;
                font-size: 12px !important;
            }
        }

        @page {
            size: A4;
            margin: 10mm 12mm 10mm 12mm;
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen py-6 px-4 sm:px-6 lg:px-8">

    <!-- Floating Action Buttons (Hidden on Print) -->
    <div class="max-w-4xl mx-auto mb-4 flex justify-between items-center no-print">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 border border-gray-200 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors shadow-sm">
            <i class="fas fa-arrow-left"></i> Back to Portfolio
        </a>
        <div class="flex gap-2">
            @auth
                <a href="{{ route('admin.resumes.edit', $resume) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition-colors shadow-sm">
                    <i class="fas fa-edit"></i> Edit Resume
                </a>
            @endauth
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-semibold hover:bg-emerald-700 transition-colors shadow-sm">
                <i class="fas fa-print"></i> Print / Save PDF
            </button>
        </div>
    </div>

    <!-- Resume Page Container -->
    <div class="max-w-4xl mx-auto resume-container">
        <div class="bg-white p-6 sm:p-10 resume-shadow shadow-md border border-gray-200/50 rounded-sm resume-paper text-[13px] leading-snug">
            
            @if(!$resume)
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">No active resume template found. Please create one in the admin dashboard.</p>
                </div>
            @else
                <!-- Header -->
                <div class="text-center mb-4 resume-section">
                    <h1 class="text-xl font-bold tracking-normal text-black mb-1">{{ $resume->name }}</h1>
                    <div class="text-[12px] text-gray-800 space-x-1.5 flex flex-wrap justify-center items-center">
                        @if($resume->location)
                            <span>{{ $resume->location }}</span>
                        @endif
                        
                        @if($resume->email)
                            <span>•</span>
                            <a href="mailto:{{ $resume->email }}" class="hover:underline">{{ $resume->email }}</a>
                        @endif
                        
                        @if($resume->phone)
                            <span>•</span>
                            <span>{{ $resume->phone }}</span>
                        @endif
                        
                        @if($resume->linkedin)
                            <span>•</span>
                            <a href="https://{{ str_replace(['http://', 'https://'], '', $resume->linkedin) }}" target="_blank" class="hover:underline">{{ str_replace(['http://', 'https://'], '', $resume->linkedin) }}</a>
                        @endif

                        @if($resume->website)
                            <span>•</span>
                            <a href="https://{{ str_replace(['http://', 'https://'], '', $resume->website) }}" target="_blank" class="hover:underline">{{ str_replace(['http://', 'https://'], '', $resume->website) }}</a>
                        @endif
                    </div>
                </div>

                <!-- Education Section -->
                @if($resume->education && count($resume->education) > 0)
                    <div class="mb-4 resume-section">
                        <h2 class="text-[13px] font-bold tracking-wider uppercase text-black mb-0.5">Education</h2>
                        <hr class="border-black border-t-[1px] mb-2">
                        
                        <div class="space-y-2.5">
                            @foreach($resume->education as $edu)
                                <div class="flex flex-col sm:flex-row justify-between items-start text-black">
                                    <div class="w-full sm:w-2/3">
                                        <div class="font-bold">
                                            {{ $edu['institution'] ?? '' }}@if(!empty($edu['location'])), <span class="font-normal text-gray-700">{{ $edu['location'] }}</span>@endif
                                        </div>
                                        <div class="text-[12.5px] text-gray-900">
                                            {{ $edu['degree'] ?? '' }}
                                        </div>
                                    </div>
                                    <div class="w-full sm:w-1/3 sm:text-right text-[12px] mt-0.5 sm:mt-0 text-gray-800">
                                        @if(!empty($edu['enrolled']) || !empty($edu['expected']))
                                            <div>
                                                {{ $edu['enrolled'] ?? '' }} — {{ $edu['expected'] ?? '' }}
                                            </div>
                                        @endif
                                        @if(!empty($edu['percentage']))
                                            <div class="font-semibold text-black">
                                                Percentage: {{ $edu['percentage'] }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Experience Section -->
                @if($resume->experience && count($resume->experience) > 0)
                    <div class="mb-4 resume-section">
                        <h2 class="text-[13px] font-bold tracking-wider uppercase text-black mb-0.5">Experience</h2>
                        <hr class="border-black border-t-[1px] mb-2">
                        
                        <div class="space-y-3">
                            @foreach($resume->experience as $exp)
                                @if(!empty($exp['company']))
                                    <div>
                                        <div class="flex flex-col sm:flex-row justify-between items-start text-black">
                                            <div class="w-full sm:w-2/3 font-bold">
                                                {{ $exp['company'] }}@if(!empty($exp['location'])), <span class="font-normal text-gray-700">{{ $exp['location'] }}</span>@endif
                                            </div>
                                            <div class="w-full sm:w-1/3 sm:text-right text-[12px] text-gray-800 mt-0.5 sm:mt-0">
                                                @if(!empty($exp['start_date']) || !empty($exp['end_date']))
                                                    {{ $exp['start_date'] ?? '' }} — {{ $exp['end_date'] ?? '' }}
                                                @endif
                                            </div>
                                        </div>
                                        @if(!empty($exp['title']))
                                            <div class="text-[12.5px] italic text-gray-900 font-medium">
                                                {{ $exp['title'] }}
                                            </div>
                                        @endif
                                        @if(!empty($exp['points']) && is_array($exp['points']))
                                            <ul class="list-disc pl-4 text-[12.5px] text-black space-y-0.5 mt-0.5">
                                                @foreach($exp['points'] as $point)
                                                    @if(!empty($point))
                                                        <li>{{ $point }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Training Section -->
                @if($resume->training && count($resume->training) > 0)
                    <div class="mb-4 resume-section">
                        <h2 class="text-[13px] font-bold tracking-wider uppercase text-black mb-0.5">Training</h2>
                        <hr class="border-black border-t-[1px] mb-2">
                        
                        <div class="space-y-2.5">
                            @foreach($resume->training as $trn)
                                <div class="flex flex-col sm:flex-row justify-between items-start text-black">
                                    <div class="w-full sm:w-2/3">
                                        <div class="font-bold text-black">
                                            {{ $trn['organization'] ?? '' }}@if(!empty($trn['location'])), <span class="font-normal text-gray-700">{{ $trn['location'] }}</span>@endif
                                        </div>
                                        <div class="text-[12.5px] text-gray-900 italic">
                                            {{ $trn['title'] ?? '' }}
                                        </div>
                                    </div>
                                    <div class="w-full sm:w-1/3 sm:text-right text-[12px] text-gray-800 mt-0.5 sm:mt-0">
                                        @if(!empty($trn['start_date']) || !empty($trn['end_date']))
                                            {{ $trn['start_date'] ?? '' }} — {{ $trn['end_date'] ?? '' }}
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Projects Section -->
                @if($resume->projects && count($resume->projects) > 0)
                    <div class="mb-4 resume-section">
                        <h2 class="text-[13px] font-bold tracking-wider uppercase text-black mb-0.5">Projects</h2>
                        <hr class="border-black border-t-[1px] mb-2">
                        
                        <div class="space-y-3">
                            @foreach($resume->projects as $proj)
                                <div>
                                    <div class="font-bold text-black">
                                        {{ $proj['title'] ?? '' }}
                                    </div>
                                    @if(!empty($proj['link']))
                                        <div class="text-[12px] italic text-gray-800">
                                            Project Link: <a href="{{ $proj['link'] }}" target="_blank" class="hover:underline font-normal text-blue-900">{{ $proj['link'] }}</a>
                                        </div>
                                    @endif
                                    @if(!empty($proj['points']) && is_array($proj['points']))
                                        <ul class="list-disc pl-4 text-[12.5px] text-black space-y-0.5 mt-0.5">
                                            @foreach($proj['points'] as $point)
                                                @if(!empty($point))
                                                    <li>{{ $point }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Skills Section -->
                @if($resume->skills && count($resume->skills) > 0)
                    <div class="mb-2 resume-section">
                        <h2 class="text-[13px] font-bold tracking-wider uppercase text-black mb-0.5">Skills</h2>
                        <hr class="border-black border-t-[1px] mb-2">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-1 text-[12.5px] text-black">
                            @foreach($resume->skills as $sk)
                                @if(!empty($sk['category']) && !empty($sk['list']))
                                    <div class="flex items-start">
                                        <span class="mr-1.5 text-gray-600 flex-shrink-0">•</span>
                                        <span><strong>{{ $sk['category'] }}</strong>: {{ $sk['list'] }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

        </div>
    </div>

</body>
</html>
