<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\FreeResource;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect();

        $urls->push(['loc' => route('home'), 'priority' => '1.0']);
        $urls->push(['loc' => route('batches.index'), 'priority' => '0.9']);
        $urls->push(['loc' => route('support'), 'priority' => '0.5']);
        $urls->push(['loc' => route('about'), 'priority' => '0.5']);
        $urls->push(['loc' => route('contact'), 'priority' => '0.5']);
        $urls->push(['loc' => route('terms'), 'priority' => '0.3']);
        $urls->push(['loc' => route('privacy'), 'priority' => '0.3']);

        foreach (['10', '11', '12'] as $class) {
            $urls->push(['loc' => route('notes.index', ['class' => $class]), 'priority' => '0.8']);
        }

        foreach (['10', '12'] as $class) {
            $urls->push(['loc' => route('pyqs.index', ['class' => $class]), 'priority' => '0.8']);
            $urls->push(['loc' => route('assignments.index', ['class' => $class]), 'priority' => '0.7']);
        }

        Batch::active()->select(['id', 'updated_at'])->each(function (Batch $batch) use ($urls): void {
            $urls->push([
                'loc' => route('batches.show', $batch),
                'lastmod' => $batch->updated_at?->toAtomString(),
                'priority' => '0.8',
            ]);
        });

        FreeResource::published()->select(['id', 'updated_at'])->each(function (FreeResource $resource) use ($urls): void {
            $urls->push([
                'loc' => route('notes.show', $resource),
                'lastmod' => $resource->updated_at?->toAtomString(),
                'priority' => '0.6',
            ]);
        });

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }

    public function robots(): Response
    {
        $disallow = ['/admin', '/teacher', '/student', '/login', '/register', '/forgot-password', '/reset-password', '/change-password'];

        $lines = ['User-agent: *'];
        foreach ($disallow as $path) {
            $lines[] = "Disallow: {$path}";
        }
        $lines[] = '';
        $lines[] = 'Sitemap: '.route('sitemap');

        return response(implode("\n", $lines), 200)->header('Content-Type', 'text/plain');
    }
}
