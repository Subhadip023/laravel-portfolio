<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Laravel', 'color' => '#ef4444'], // red
            ['name' => 'Vue.js', 'color' => '#10b981'], // green
            ['name' => 'UI/UX Design', 'color' => '#8b5cf6'], // purple
            ['name' => 'Tailwind CSS', 'color' => '#06b6d4'], // cyan
        ];

        $categoryMap = [];
        foreach ($categories as $cat) {
            $categoryObj = Category::firstOrCreate([
                'name' => $cat['name'],
            ], [
                'slug' => Str::slug($cat['name']),
                'color' => $cat['color'],
            ]);
            $categoryMap[$cat['name']] = $categoryObj->id;
        }

        $blogs = [
            [
                'title' => '10 Essential Laravel Tips & Tricks for 2026',
                'content' => '<p>Laravel continues to be the premier PHP framework for building modern web applications. In 2026, several new workflow enhancements and performance optimizations have emerged.</p><h3>1. Utilizing the new Eloquent features</h3><p>Make sure to leverage the latest query builder improvements to drastically reduce memory usage during large dataset processing.</p><h3>2. Advanced Queue Management</h3><p>Configuring your workers correctly ensures zero-downtime deployments and robust background job handling.</p>',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1200&q=80',
                'status' => '2',
                'category' => 'Laravel',
                'tags' => ['Laravel', 'PHP', 'Backend', 'Tips'],
            ],
            [
                'title' => 'Mastering Tailwind CSS Grid & Flexbox Layouts',
                'content' => '<p>Building complex, responsive user interfaces has never been easier thanks to Tailwind CSS. By understanding the core principles of Flexbox and CSS Grid, you can build adaptive designs in record time.</p><h3>Understanding Grid Columns</h3><p>Using utility classes like <code>grid-cols-1 md:grid-cols-3 lg:grid-cols-4</code> allows seamless transitions across mobile, tablet, and desktop viewports.</p>',
                'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=1200&q=80',
                'status' => '2',
                'category' => 'Tailwind CSS',
                'tags' => ['Tailwind', 'CSS', 'Frontend', 'Design'],
            ],
            [
                'title' => 'Building Scalable Single Page Apps with Vue 3 & Composition API',
                'content' => '<p>The Composition API in Vue 3 provides incredible flexibility for organizing component logic, managing shared state, and building reusable composables.</p><h3>Why Composables Rule</h3><p>Instead of relying on mixins, composables offer clean reactivity tracking and TypeScript support out of the box.</p>',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=1200&q=80',
                'status' => '2',
                'category' => 'Vue.js',
                'tags' => ['Vue', 'JavaScript', 'SPA', 'Frontend'],
            ],
        ];

        foreach ($blogs as $item) {
            $blog = Blog::firstOrCreate([
                'title' => $item['title'],
            ], [
                'content' => $item['content'],
                'image' => $item['image'],
                'status' => $item['status'],
                'category_id' => $categoryMap[$item['category']],
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

            $blog->tags()->syncWithoutDetaching($tagIds);
        }
    }
}
