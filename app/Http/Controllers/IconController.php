<?php

namespace App\Http\Controllers;

use App\Models\Icon;
use Illuminate\Http\Request;

class IconController extends Controller
{
    public function index()
    {
        $icons = Icon::latest()->get();
        return view('admin.icons.index', compact('icons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'svg_html' => 'required|string',
        ]);

        Icon::create($request->only('name', 'svg_html'));

        return redirect()->route('admin.icons.index')->with('success', 'Icon added successfully.');
    }

    public function update(Request $request, Icon $icon)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'svg_html' => 'required|string',
        ]);

        $icon->update($request->only('name', 'svg_html'));

        return redirect()->route('admin.icons.index')->with('success', 'Icon updated.');
    }

    public function destroy(Icon $icon)
    {
        $icon->delete();
        return redirect()->route('admin.icons.index')->with('success', 'Icon deleted.');
    }
}
