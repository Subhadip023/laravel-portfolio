<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDesignRequest;
use App\Http\Requests\UpdateDesignRequest;
use App\Models\Design;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class DesignController extends Controller
{
    public function index()
    {
        $designs = Design::latest()->paginate(10);
        return view('admin.designs.index', compact('designs'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.designs.create', compact('tags'));
    }

    public function store(StoreDesignRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('designs', 'public');
        }

        $design = Design::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'description' => $validated['description'],
            'image' => $imagePath,
            'bg_gradient' => $validated['bg_gradient'] ?? null,
            'url' => $validated['url'] ?? null,
            'status' => $validated['status'],
        ]);

        if (isset($validated['tags'])) {
            $design->tags()->sync($validated['tags']);
        }

        return redirect()->route('admin.designs.index')->with('success', 'Design created successfully.');
    }

    public function edit(Design $design)
    {
        $tags = Tag::all();
        return view('admin.designs.edit', compact('design', 'tags'));
    }

    public function update(UpdateDesignRequest $request, Design $design)
    {
        $validated = $request->validated();

        $data = [
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'description' => $validated['description'],
            'bg_gradient' => $validated['bg_gradient'] ?? null,
            'url' => $validated['url'] ?? null,
            'status' => $validated['status'],
        ];

        if ($request->hasFile('image')) {
            if ($design->image) {
                Storage::disk('public')->delete($design->image);
            }
            $data['image'] = $request->file('image')->store('designs', 'public');
        }

        $design->update($data);

        if (isset($validated['tags'])) {
            $design->tags()->sync($validated['tags']);
        } else {
            $design->tags()->detach();
        }

        return redirect()->route('admin.designs.index')->with('success', 'Design updated successfully.');
    }

    public function destroy(Design $design)
    {
        if ($design->image) {
            Storage::disk('public')->delete($design->image);
        }
        $design->tags()->detach();
        $design->delete();

        return redirect()->route('admin.designs.index')->with('success', 'Design deleted successfully.');
    }
}
