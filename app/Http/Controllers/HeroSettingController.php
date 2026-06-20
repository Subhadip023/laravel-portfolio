<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class HeroSettingController extends Controller
{
    /**
     * Show the hero settings edit form.
     */
    public function edit()
    {
        $heroFields = [
            'hero_name'           => Setting::get('hero_name', 'Subhadip'),
            'hero_title'          => Setting::get('hero_title', 'Laravel Developer'),
            'hero_bio'            => Setting::get('hero_bio', ''),
            'hero_tagline'        => Setting::get('hero_tagline', ''),
            'hero_email'          => Setting::get('hero_email', ''),
            'hero_projects_label' => Setting::get('hero_projects_label', 'View Projects'),
            'hero_contact_label'  => Setting::get('hero_contact_label', 'Contact Me'),
        ];

        return view('admin.hero.edit', compact('heroFields'));
    }

    /**
     * Save the hero settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'hero_name'           => 'required|string|max:100',
            'hero_title'          => 'required|string|max:150',
            'hero_bio'            => 'nullable|string',
            'hero_tagline'        => 'nullable|string|max:255',
            'hero_email'          => 'nullable|email|max:255',
            'hero_projects_label' => 'nullable|string|max:100',
            'hero_contact_label'  => 'nullable|string|max:100',
        ]);

        $fields = [
            'hero_name', 'hero_title', 'hero_bio',
            'hero_tagline', 'hero_email',
            'hero_projects_label', 'hero_contact_label',
        ];

        foreach ($fields as $field) {
            Setting::set($field, $request->input($field, ''), 'hero');
        }

        return redirect()->route('admin.hero.edit')->with('success', 'Hero section updated successfully.');
    }
}
