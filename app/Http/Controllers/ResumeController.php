<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resumes.
     */
    public function index()
    {
        $resumes = Resume::orderBy('created_at', 'desc')->get();
        return view('admin.resumes.index', compact('resumes'));
    }

    /**
     * Show the form for creating a new resume.
     */
    public function create()
    {
        return view('admin.resumes.create');
    }

    /**
     * Store a newly created resume in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'education' => 'nullable|array',
            'experience' => 'nullable|array',
            'training' => 'nullable|array',
            'projects' => 'nullable|array',
            'skills' => 'nullable|array',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($data['is_active']) {
            Resume::where('is_active', true)->update(['is_active' => false]);
        }

        Resume::create($data);

        return redirect()->route('admin.resumes.index')->with('success', 'Resume created successfully.');
    }

    /**
     * Show the form for editing the specified resume.
     */
    public function edit(Resume $resume)
    {
        return view('admin.resumes.edit', compact('resume'));
    }

    /**
     * Update the specified resume in storage.
     */
    public function update(Request $request, Resume $resume)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'education' => 'nullable|array',
            'experience' => 'nullable|array',
            'training' => 'nullable|array',
            'projects' => 'nullable|array',
            'skills' => 'nullable|array',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($data['is_active']) {
            Resume::where('is_active', true)->where('id', '!=', $resume->id)->update(['is_active' => false]);
        }

        $resume->update($data);

        return redirect()->route('admin.resumes.index')->with('success', 'Resume updated successfully.');
    }

    /**
     * Toggle the active status of a resume.
     */
    public function toggleActive(Resume $resume)
    {
        Resume::where('is_active', true)->update(['is_active' => false]);
        $resume->update(['is_active' => true]);

        return redirect()->route('admin.resumes.index')->with('success', 'Active resume updated.');
    }

    /**
     * Remove the specified resume from storage.
     */
    public function destroy(Resume $resume)
    {
        $resume->delete();
        return redirect()->route('admin.resumes.index')->with('success', 'Resume deleted successfully.');
    }

    /**
     * Display the public printable resume.
     */
    public function showPublic(Resume $resume = null)
    {
        if (!$resume) {
            $resume = Resume::where('is_active', true)->first();
        }

        if (!$resume) {
            $resume = Resume::latest()->first();
        }

        return view('resume.show', compact('resume'));
    }
}
