@extends('layouts.app')

@section('content')
<section class="text-gray-600 body-font mt-30 flex items-center">
    <div class="container mx-auto flex px-5 md:flex-row flex-col items-center">

        <!-- Profile Image -->
        <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            <img class="object-cover object-center rounded" alt="Subhadip Chakraborty" src="{{ asset('assets/user/profile.png') }}">
        </div>

        <!-- Content -->
        <div class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">

            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                Hi, I'm <span class="text-blue-600">{{ $hero['name'] }}</span><br class="hidden lg:inline-block">
                <span class="text-gray-800">{{ $hero['title'] }}</span>
            </h1>

            @if($hero['bio'])
            <p class="mb-6 leading-relaxed text-gray-600">
                {!! nl2br(e($hero['bio'])) !!}
            </p>
            @endif

            @if($hero['tagline'])
            <p class="mb-8 leading-relaxed text-gray-600">
                {{ $hero['tagline'] }}
            </p>
            @endif

            <div class="flex justify-center md:justify-start">
                <a href="{{ route('projects') }}" class="inline-flex text-white bg-blue-500 py-2 px-6 hover:bg-blue-600 rounded text-lg">
                    {{ $hero['projects_label'] }}
                </a>
                @if($hero['email'])
                <a href="mailto:{{ $hero['email'] }}"
                    class="ml-4 inline-flex text-gray-700 bg-gray-100 py-2 px-6 hover:bg-gray-200 rounded text-lg">
                    {{ $hero['contact_label'] }}
                </a>
                @endif
            </div>

        </div>

    </div>
</section>
{{-- ===================== SKILLS SECTION ===================== --}}
<section id="skills" class="text-gray-600 body-font mb-10">
    <div class="container px-5 py-24 mx-auto">

        {{-- Section Heading --}}
        <div class="flex flex-wrap w-full mb-20">
            <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                <h2 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">Skills & Expertise</h2>
                <div class="h-1 w-20 bg-blue-500 rounded"></div>
            </div>
            <div class="lg:w-1/2 w-full">
                <p class="text-gray-600 leading-relaxed text-lg mb-4">
                    <span class="font-medium text-gray-800">Technologies and tools</span> I use to build scalable backend systems and modern web experiences.
                </p>
                <div class="flex flex-wrap gap-2">
                    @foreach($skillCategories as $cat)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">{{ $cat['name'] }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Skill Cards Grid --}}
        <div class="flex flex-wrap -m-4 mb-12">
            @foreach($skillCategories as $category)
            <div class="xl:w-1/3 md:w-1/2 p-4 w-full">
                <div class="p-6 rounded-lg hover:shadow-lg transition-shadow border border-gray-200/60">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center text-white flex-shrink-0">
                            @if(!empty($category['icon_id']) && isset($iconMap[$category['icon_id']]))
                                {!! $iconMap[$category['icon_id']]->render('w-5 h-5') !!}
                            @else
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            @endif
                        </div>
                        <h3 class="text-lg font-semibold title-font text-gray-900">{{ $category['name'] }}</h3>
                    </div>
                    <div class="space-y-4">
                        @foreach($category['items'] as $skill)
                        <div>
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="font-medium text-gray-700">{{ $skill['name'] }}</span>
                                <span class="text-gray-500 text-xs">{{ $skill['pct'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                <div class="skill-bar bg-blue-500 h-1.5 rounded-full" data-width="{{ $skill['pct'] }}%" style="width:0%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Tech Badges --}}
        @if(count($skillTools) > 0)
        <div class="p-6 rounded-lg border border-gray-200/60">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">Technologies & Tools</p>
            <div class="flex flex-wrap gap-2">
                @foreach($skillTools as $tech)
                <span class="inline-block bg-gray-200/80 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-colors cursor-default">#{{ $tech }}</span>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@push('scripts')
<script>
    // Animate skill bars when they scroll into view
    const bars = document.querySelectorAll('.skill-bar');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bar = entry.target;
                bar.style.transition = 'width 1s ease-out';
                bar.style.width = bar.dataset.width;
                observer.unobserve(bar);
            }
        });
    }, { threshold: 0.2 });

    bars.forEach(bar => observer.observe(bar));
</script>
@endpush
@endsection
