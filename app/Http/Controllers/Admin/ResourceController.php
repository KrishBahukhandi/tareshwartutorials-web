<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreeResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResourceController extends Controller
{
    public function index(): View
    {
        $resources = FreeResource::orderByDesc('created_at')->paginate(20);

        return view('admin.resources.index', compact('resources'));
    }

    public function create(): View
    {
        $taxonomy = FreeResource::ncertSubjectsByClass();

        return view('admin.resources.create', compact('taxonomy'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'in:note,pyq,assignment'],
            'class_level' => ['required', 'in:10,11,12'],
            'subject' => ['required', 'string', 'max:100'],
            'chapter' => ['nullable', 'string', 'max:200'],
            'board' => ['nullable', 'string', 'max:50'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:2099'],
            'file' => ['required', 'file', 'mimes:pdf', 'max:20480'],
            'is_published' => ['boolean'],
        ]);

        $path = $request->file('file')->store('free-resources', config('filesystems.public_files'));

        FreeResource::create([
            ...$validated,
            'file_path' => $path,
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()->route('admin.resources.index')
            ->with('success', 'Resource uploaded successfully.');
    }

    public function destroy(FreeResource $resource): RedirectResponse
    {
        \Storage::disk(config('filesystems.public_files'))->delete($resource->file_path);
        $resource->delete();

        return back()->with('success', 'Resource deleted.');
    }

    public function toggle(FreeResource $resource): RedirectResponse
    {
        $resource->update(['is_published' => ! $resource->is_published]);

        return back()->with('success', $resource->is_published ? 'Resource published.' : 'Resource hidden.');
    }
}
