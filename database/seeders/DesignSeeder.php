<?php

namespace Database\Seeders;

use App\Models\Design;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DesignSeeder extends Seeder
{
    public function run(): void
    {
        $designs = [
            [
                'title' => 'Newsroom Pro',
                'subtitle' => 'NEWS CMS',
                'description' => 'A modern content management system for news websites with article management, categories, and admin dashboard.',
                'url' => 'https://subhadip023.github.io/projects/Design/newsroom-pro/public/index.html',
                'bg_gradient' => 'from-blue-500 to-indigo-600',
                'status' => '2',
                'tags' => ['CMS', 'Admin', 'News'],
            ],
            [
                'title' => 'Adminer Lite',
                'subtitle' => 'ADMIN DASHBOARD',
                'description' => 'A clean and responsive admin dashboard template with data tables, charts, and user management.',
                'url' => 'https://subhadip023.github.io/projects/Design/adminer-lite/public/index.html',
                'bg_gradient' => 'from-blue-500 to-indigo-600',
                'status' => '2',
                'tags' => ['Dashboard', 'Analytics'],
            ],
            [
                'title' => 'Startup Landing',
                'subtitle' => 'LANDING PAGE',
                'description' => 'A modern landing page template for startups and tech companies with call-to-action sections.',
                'url' => 'https://subhadip023.github.io/projects/Design/landing-startup/index.html',
                'bg_gradient' => 'from-green-500 to-teal-600',
                'status' => '2',
                'tags' => ['Landing', 'Startup'],
            ],
            [
                'title' => 'Minimal Portfolio',
                'subtitle' => 'PORTFOLIO',
                'description' => 'A clean and minimal portfolio template to showcase your work and skills effectively.',
                'url' => 'https://subhadip023.github.io/projects/Design/portfolio-minimal/index.html',
                'bg_gradient' => 'from-purple-500 to-pink-600',
                'status' => '2',
                'tags' => ['Portfolio', 'Minimal'],
            ],
            [
                'title' => 'New App Design',
                'subtitle' => 'WEB APP',
                'description' => 'A modern web application interface with clean design and intuitive user experience.',
                'url' => 'https://subhadip023.github.io/projects/Design/newapp_1/index.html',
                'bg_gradient' => 'from-yellow-500 to-orange-500',
                'status' => '2',
                'tags' => ['WebApp', 'UI/UX'],
            ],
            [
                'title' => 'Analytics Dashboard',
                'subtitle' => 'DASHBOARD',
                'description' => 'A responsive analytics dashboard with charts, metrics, and data visualization components.',
                'url' => 'https://subhadip023.github.io/projects/Design/dashboard-lite/index.html',
                'bg_gradient' => 'from-red-500 to-pink-600',
                'status' => '2',
                'tags' => ['Analytics', 'Charts'],
            ],
            [
                'title' => 'Exciting New Project',
                'subtitle' => 'WEB APP',
                'description' => 'A modern website showcasing the latest features and designs.',
                'url' => 'https://subhadip023.github.io/projects/Design/new-website/index.html',
                'bg_gradient' => 'from-blue-500 to-indigo-600',
                'status' => '2',
                'tags' => ['Modern', 'Design'],
            ],
            [
                'title' => 'Sohoj News',
                'subtitle' => 'STATIC WEBSITE',
                'description' => 'This is the Static Website of Sohoj News',
                'url' => 'https://subhadip023.github.io/projects/Design/Sohoj%20News/index.html',
                'bg_gradient' => 'from-green-500 to-teal-600',
                'status' => '2',
                'tags' => ['News', 'Design'],
            ],
        ];

        foreach ($designs as $item) {
            $design = Design::firstOrCreate([
                'title' => $item['title'],
                'url' => $item['url'],
            ], [
                'subtitle' => $item['subtitle'],
                'description' => $item['description'],
                'bg_gradient' => $item['bg_gradient'],
                'status' => $item['status'],
            ]);

            $tagIds = [];
            foreach ($item['tags'] as $tagName) {
                $tag = Tag::firstOrCreate([
                    'slug' => Str::slug($tagName),
                ], [
                    'name' => $tagName,
                ]);
                $tagIds[] = $tag->id;
            }

            $design->tags()->syncWithoutDetaching($tagIds);
        }
    }
}
