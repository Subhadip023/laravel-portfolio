<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Icon;
use App\Models\Setting;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create default icons
        $backendIcon = Icon::updateOrCreate(
            ['name' => 'Backend (Arrow)'],
            ['svg_html' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/></svg>']
        );

        $frontendIcon = Icon::updateOrCreate(
            ['name' => 'Frontend (Code)'],
            ['svg_html' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>']
        );

        $devopsIcon = Icon::updateOrCreate(
            ['name' => 'DevOps (Server)'],
            ['svg_html' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7v14"/></svg>']
        );

        $databaseIcon = Icon::updateOrCreate(
            ['name' => 'Database'],
            ['svg_html' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7a8 3 0 0 1 16 0M4 7v5a8 3 0 0 0 16 0V7M4 12v5a8 3 0 0 0 16 0v-5"/></svg>']
        );

        $mobileIcon = Icon::updateOrCreate(
            ['name' => 'Mobile'],
            ['svg_html' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>']
        );

        $cloudIcon = Icon::updateOrCreate(
            ['name' => 'Cloud'],
            ['svg_html' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>']
        );

        // 2. Seed skill categories using the newly created icon IDs
        $categories = [
            [
                'name' => 'Backend Development',
                'icon_id' => $backendIcon->id,
                'items' => [
                    ['name' => 'PHP', 'pct' => 95],
                    ['name' => 'Laravel', 'pct' => 92],
                    ['name' => 'MySQL', 'pct' => 85],
                    ['name' => 'REST APIs', 'pct' => 88],
                    ['name' => 'SAML Auth', 'pct' => 75],
                ],
            ],
            [
                'name' => 'Frontend Development',
                'icon_id' => $frontendIcon->id,
                'items' => [
                    ['name' => 'HTML & CSS', 'pct' => 90],
                    ['name' => 'JavaScript', 'pct' => 78],
                    ['name' => 'Alpine.js', 'pct' => 70],
                    ['name' => 'Tailwind CSS', 'pct' => 88],
                    ['name' => 'Blade Templates', 'pct' => 95],
                ],
            ],
            [
                'name' => 'DevOps & Tooling',
                'icon_id' => $devopsIcon->id,
                'items' => [
                    ['name' => 'Linux Server', 'pct' => 80],
                    ['name' => 'Git & GitHub', 'pct' => 88],
                    ['name' => 'AI Integration', 'pct' => 72],
                    ['name' => 'Docker (basics)', 'pct' => 60],
                    ['name' => 'Mentoring', 'pct' => 85],
                ],
            ],
        ];

        Setting::set('skills_categories', json_encode($categories), 'skills');
        Setting::set('skills_tools', 'PHP,Laravel,MySQL,JavaScript,Tailwind CSS,Alpine.js,Linux,Git,GitHub,SAML Auth,Gen AI,REST API,Blade,Composer', 'skills');
    }
}

// cd /home/subhadip/Herd/portfolio && php artisan db:seed --class=IconSeeder