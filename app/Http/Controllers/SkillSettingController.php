<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SkillSettingController extends Controller
{
    /**
     * Default skill categories structure.
     */
    private function defaultCategories(): array
    {
        return [
            [
                'name'  => 'Backend Development',
                'icon'  => 'M5 12h14M12 5l7 7-7 7',
                'items' => [
                    ['name' => 'PHP',        'pct' => 95],
                    ['name' => 'Laravel',    'pct' => 92],
                    ['name' => 'MySQL',      'pct' => 85],
                    ['name' => 'REST APIs',  'pct' => 88],
                    ['name' => 'SAML Auth',  'pct' => 75],
                ],
            ],
            [
                'name'  => 'Frontend Development',
                'icon'  => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
                'items' => [
                    ['name' => 'HTML & CSS',      'pct' => 90],
                    ['name' => 'JavaScript',       'pct' => 78],
                    ['name' => 'Alpine.js',        'pct' => 70],
                    ['name' => 'Tailwind CSS',     'pct' => 88],
                    ['name' => 'Blade Templates',  'pct' => 95],
                ],
            ],
            [
                'name'  => 'DevOps & Tooling',
                'icon'  => 'M5 12h14m-7-7v14',
                'items' => [
                    ['name' => 'Linux Server',   'pct' => 80],
                    ['name' => 'Git & GitHub',   'pct' => 88],
                    ['name' => 'AI Integration', 'pct' => 72],
                    ['name' => 'Docker (basics)','pct' => 60],
                    ['name' => 'Mentoring',      'pct' => 85],
                ],
            ],
        ];
    }

    /**
     * Show the skill settings edit form.
     */
    public function edit()
    {
        $raw = Setting::get('skills_categories');
        $categories = $raw ? json_decode($raw, true) : $this->defaultCategories();

        $toolsRaw = Setting::get('skills_tools', 'PHP,Laravel,MySQL,JavaScript,Tailwind CSS,Alpine.js,Linux,Git,GitHub,SAML Auth,Gen AI,REST API,Blade,Composer');

        $icons = \App\Models\Icon::orderBy('name')->get();

        return view('admin.skills.edit', compact('categories', 'toolsRaw', 'icons'));
    }

    /**
     * Save skills settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'categories'              => 'required|array|min:1|max:6',
            'categories.*.name'       => 'required|string|max:100',
            'categories.*.icon_id'    => 'nullable|integer|exists:icons,id',
            'categories.*.items'      => 'required|array|min:1|max:10',
            'categories.*.items.*.name' => 'required|string|max:100',
            'categories.*.items.*.pct'  => 'required|integer|min:1|max:100',
            'skills_tools'            => 'nullable|string',
        ]);

        Setting::set('skills_categories', json_encode($request->input('categories')), 'skills');
        Setting::set('skills_tools', $request->input('skills_tools', ''), 'skills');

        return redirect()->route('admin.skills.edit')->with('success', 'Skills updated successfully.');
    }
}
