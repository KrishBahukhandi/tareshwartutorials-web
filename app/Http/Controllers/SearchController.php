<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\FreeResource;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /** Words that describe a content type rather than a subject to search for. */
    private const CATEGORY_WORDS = [
        'note' => 'notes', 'notes' => 'notes',
        'pyq' => 'pyqs', 'pyqs' => 'pyqs', 'question' => 'pyqs', 'questions' => 'pyqs', 'previous' => 'pyqs',
        'assignment' => 'assignments', 'assignments' => 'assignments',
        'batch' => 'batches', 'batches' => 'batches', 'course' => 'batches', 'courses' => 'batches',
    ];

    /** Generic filler words that carry no search value on their own. */
    private const STOPWORDS = ['class', 'grade', 'standard', 'for', 'the', 'of', 'in', 'and', 'a', 'to', 'year'];

    /** Common informal subject abbreviations mapped to how the subject is actually stored. */
    private const SUBJECT_SYNONYMS = [
        'maths' => 'mathematics', 'math' => 'mathematics',
        'phy' => 'physics', 'phys' => 'physics',
        'chem' => 'chemistry',
        'bio' => 'biology',
        'eng' => 'english',
        'hin' => 'hindi',
        'geo' => 'geography',
        'hist' => 'history',
        'eco' => 'economics', 'econ' => 'economics',
        'polsci' => 'political science',
        'sst' => 'social science',
        'acc' => 'accountancy', 'accts' => 'accountancy',
    ];

    public function index(Request $request): View
    {
        $query = trim((string) $request->query('search'));

        $batches = collect();
        $totalBatches = 0;
        $notes = collect();
        $pyqs = collect();
        $assignments = collect();

        if (mb_strlen($query) >= 2) {
            [$classLevel, $types, $freeText] = $this->parseQuery($query);

            if (in_array('batches', $types, true)) {
                $batchQuery = Batch::active()->with(['teachers', 'subjects']);

                if ($classLevel) {
                    $batchQuery->where('grade', 'Class '.$classLevel);
                }

                if ($freeText !== '') {
                    $batchQuery->where(function ($q) use ($freeText): void {
                        $q->where('name', 'like', '%'.$freeText.'%')
                            ->orWhereHas('subjects', fn ($sq) => $sq->where('name', 'like', '%'.$freeText.'%'));
                    });
                }

                $totalBatches = (clone $batchQuery)->count();
                $batches = $batchQuery->orderBy('created_at', 'desc')->take(4)->get();
            }

            $resourceQuery = FreeResource::published();

            if ($classLevel) {
                $resourceQuery->where('class_level', $classLevel);
            }

            if ($freeText !== '') {
                $resourceQuery->where(function ($q) use ($freeText): void {
                    $q->where('title', 'like', '%'.$freeText.'%')
                        ->orWhere('subject', 'like', '%'.$freeText.'%')
                        ->orWhere('chapter', 'like', '%'.$freeText.'%')
                        ->orWhere('description', 'like', '%'.$freeText.'%');
                });
            }

            if (in_array('notes', $types, true)) {
                $notes = (clone $resourceQuery)->where('type', 'note')->orderBy('subject')->take(8)->get();
            }

            if (in_array('pyqs', $types, true)) {
                $pyqs = (clone $resourceQuery)->where('type', 'pyq')->orderBy('subject')->orderByDesc('year')->take(8)->get();
            }

            if (in_array('assignments', $types, true)) {
                $assignments = (clone $resourceQuery)->where('type', 'assignment')->orderBy('subject')->take(8)->get();
            }
        }

        $hasResults = $totalBatches > 0 || $notes->isNotEmpty() || $pyqs->isNotEmpty() || $assignments->isNotEmpty();

        return view('public.search', compact('query', 'batches', 'totalBatches', 'notes', 'pyqs', 'assignments', 'hasResults'));
    }

    /**
     * Break a natural-language query like "class 10 maths notes" into a class
     * level filter, the content types being asked for, and the remaining free
     * text to match against subject/title fields.
     *
     * @return array{0: ?string, 1: string[], 2: string}
     */
    private function parseQuery(string $query): array
    {
        $words = preg_split('/\s+/', mb_strtolower($query), -1, PREG_SPLIT_NO_EMPTY);

        $classLevel = null;
        $types = [];
        $freeTextWords = [];

        foreach ($words as $word) {
            $word = trim($word, '.,!?');

            if (preg_match('/^(10|11|12)(th)?$/', $word, $matches)) {
                $classLevel = $matches[1];

                continue;
            }

            if (isset(self::CATEGORY_WORDS[$word])) {
                $types[] = self::CATEGORY_WORDS[$word];

                continue;
            }

            if (in_array($word, self::STOPWORDS, true)) {
                continue;
            }

            $freeTextWords[] = self::SUBJECT_SYNONYMS[$word] ?? $word;
        }

        // No explicit category mentioned — search every category.
        if (empty($types)) {
            $types = ['notes', 'pyqs', 'assignments', 'batches'];
        }

        return [$classLevel, array_unique($types), implode(' ', $freeTextWords)];
    }
}
