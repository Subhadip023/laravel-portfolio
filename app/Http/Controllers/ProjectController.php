<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.projects.create', compact('tags'));
    }

    public function store(StoreProjectRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        $project = Project::create([
            'title'            => $validated['title'],
            'subtitle'         => $validated['subtitle'] ?? null,
            'description'      => $validated['description'],
            'image'            => $imagePath,
            'url'              => $validated['url'] ?? null,
            'github_url'       => $validated['github_url'] ?? null,
            'status'           => $validated['status'],
            'meta_title'       => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords'    => $validated['meta_keywords'] ?? null,
        ]);

        if (isset($validated['tags'])) {
            $project->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $tags = Tag::all();
        return view('admin.projects.edit', compact('project', 'tags'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        $data = [
            'title'            => $validated['title'],
            'subtitle'         => $validated['subtitle'] ?? null,
            'description'      => $validated['description'],
            'url'              => $validated['url'] ?? null,
            'github_url'       => $validated['github_url'] ?? null,
            'status'           => $validated['status'],
            'meta_title'       => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords'    => $validated['meta_keywords'] ?? null,
        ];

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        if (isset($validated['tags'])) {
            $project->tags()->sync($validated['tags']);
        } else {
            $project->tags()->detach();
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->tags()->detach();
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
