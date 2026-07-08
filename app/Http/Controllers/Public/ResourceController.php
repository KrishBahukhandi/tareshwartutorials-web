<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\FreeResource;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResourceController extends Controller
{
    /** Browse notes — filter by class + subject. */
    public function index(Request $request): View
    {
        $classLevel = $request->query('class', '10');
        $subject = $request->query('subject');

        $query = FreeResource::published()
            ->where('class_level', $classLevel)
            ->orderBy('subject')
            ->orderBy('chapter');

        if ($subject) {
            $query->where('subject', $subject);
        }

        $resources = $query->get();
        $taxonomy = FreeResource::ncertSubjectsByClass();
        $subjects = FreeResource::subjectsForClass($classLevel);

        return view('public.resources.index', compact(
            'resources', 'taxonomy', 'classLevel', 'subject', 'subjects'
        ));
    }

    /** Browse PYQs — pick a subject, then filter by class + subject. */
    public function pyqs(Request $request): View
    {
        $classLevel = $request->query('class', '10');

        // Ensure only class 10 and 12 are valid for PYQs based on user request
        if (! in_array($classLevel, ['10', '12'])) {
            $classLevel = '10';
        }

        $subjects = FreeResource::pyqSubjectsForClass($classLevel);

        $subject = $request->query('subject');
        if ($subject && ! in_array($subject, $subjects)) {
            $subject = null;
        }

        $counts = FreeResource::published()
            ->where('type', 'pyq')
            ->where('class_level', $classLevel)
            ->selectRaw('subject, count(*) as aggregate')
            ->groupBy('subject')
            ->pluck('aggregate', 'subject');

        $resources = collect();

        if ($subject) {
            $resources = FreeResource::published()
                ->where('type', 'pyq')
                ->where('class_level', $classLevel)
                ->where('subject', $subject)
                ->orderBy('year', 'desc')
                ->get();
        }

        return view('public.resources.pyqs', compact('resources', 'classLevel', 'subject', 'subjects', 'counts'));
    }

    public function assignments(Request $request): View
    {
        $classLevel = $request->query('class', '10');

        if (! in_array($classLevel, ['10', '12'])) {
            $classLevel = '10';
        }

        $resources = FreeResource::published()
            ->where('type', 'assignment')
            ->where('class_level', $classLevel)
            ->orderBy('subject')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('public.resources.assignments', compact('resources', 'classLevel'));
    }

    /** View a single resource — inline PDF viewer. */
    public function show(FreeResource $freeResource): View
    {
        $isAdminPreview = auth()->check() && auth()->user()->isAdmin();

        abort_unless($freeResource->is_published || $isAdminPreview, 404);

        // Increment the view count for real public views only, not admin previews.
        if ($freeResource->is_published) {
            $freeResource->increment('view_count');
        }

        $related = FreeResource::published()
            ->where('class_level', $freeResource->class_level)
            ->where('subject', $freeResource->subject)
            ->where('id', '!=', $freeResource->id)
            ->limit(5)
            ->get();

        return view('public.resources.show', compact('freeResource', 'related'));
    }

    /** Direct PDF download. */
    public function download(FreeResource $freeResource): BinaryFileResponse
    {
        abort_unless($freeResource->is_published, 404);
        $freeResource->increment('download_count');

        return response()->download(storage_path('app/public/'.$freeResource->file_path));
    }
}
