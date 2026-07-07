<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        $featuredBatches = Batch::active()
            ->with(['teachers', 'subjects'])
            ->whereIn('grade', ['Class 10', 'Class 12'])
            ->withEnrollmentCount()
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
            
        return view('public.home', compact('featuredBatches'));
    }

    public function batches(Request $request): View
    {
        // Simple mock of category filters or search
        $query = Batch::active()
            ->with(['teachers', 'subjects'])
            ->withEnrollmentCount()
            ->orderBy('created_at', 'desc');
        
        if ($request->has('search')) {
            $query->where(function ($query) use ($request): void {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhereHas('subjects', fn($sq) => $sq->where('name', 'like', '%'.$request->search.'%'));
            });
        }

        if ($request->filled('grade')) {
            $query->where('grade', $request->grade);
        }
        
        $batches = $query->paginate(12);
        
        return view('public.batches', compact('batches'));
    }

    public function showBatch(Batch $batch): View
    {
        $batch->load(['teachers', 'subjects'])->loadCount([
            'enrollments as active_enrollments_count' => fn ($query) => $query->where('status', 'active'),
        ]);

        $enrollment = auth()->check() && auth()->user()->isStudent()
            ? auth()->user()->enrollments()->where('batch_id', $batch->id)->first()
            : null;

        return view('public.batches.show', compact('batch', 'enrollment'));
    }

    public function support(Request $request): View
    {
        $topics = [
            [
                'id' => 1,
                'title' => 'How to join a live session',
                'category' => 'Learning Portal',
                'icon' => 'article',
                'views' => '12k',
                'read_time' => '3 min',
                'content' => 'To join a live session, log into your student dashboard and click on the "Live Meetings" tab. Find your scheduled class and click the "Join" button. Make sure you have Google Meet installed or use a supported web browser.',
            ],
            [
                'id' => 2,
                'title' => 'Downloading study materials',
                'category' => 'Learning Portal',
                'icon' => 'download',
                'views' => '8.5k',
                'read_time' => '2 min',
                'content' => 'Study materials (notes and PYQs) can be downloaded directly from the "Notes" section. Just select your class and subject, then click the download icon next to the resource you want to save offline.',
            ],
            [
                'id' => 3,
                'title' => 'Understanding Certification Requirements',
                'category' => 'Learning Portal',
                'icon' => 'verified_user',
                'views' => '5.2k',
                'read_time' => '5 min',
                'content' => 'To receive a certificate, you must complete all assignments with a passing grade of at least 70% and maintain an attendance record of 80% or higher for live sessions.',
            ],
            [
                'id' => 4,
                'title' => 'Fixing video playback issues',
                'category' => 'Technical Issues',
                'icon' => 'video_settings',
                'views' => '4.1k',
                'read_time' => '4 min',
                'content' => 'If you experience buffering, check your internet connection. Try clearing your browser cache or switching to a different browser. If the issue persists, try lowering the video quality in the player settings.',
            ],
            [
                'id' => 5,
                'title' => 'How to reset my password',
                'category' => 'Account',
                'icon' => 'lock_reset',
                'views' => '15k',
                'read_time' => '1 min',
                'content' => 'Click "Forgot Password" on the login screen. Enter your registered email address, and we will send you a secure link to reset your password. The link expires in 24 hours.',
            ],
            [
                'id' => 6,
                'title' => 'Updating profile information',
                'category' => 'Account',
                'icon' => 'manage_accounts',
                'views' => '3k',
                'read_time' => '2 min',
                'content' => 'Log in, go to your dashboard, and click on "Profile". From there you can update your phone number, address, and profile picture. Email address changes require support assistance.',
            ],
            [
                'id' => 7,
                'title' => 'Refund Policy',
                'category' => 'Payments',
                'icon' => 'currency_rupee',
                'views' => '6k',
                'read_time' => '3 min',
                'content' => 'We offer a 7-day money-back guarantee for all live batches. If you are not satisfied within the first week of classes, contact support for a full refund.',
            ],
            [
                'id' => 8,
                'title' => 'Where to find my receipts',
                'category' => 'Payments',
                'icon' => 'receipt_long',
                'views' => '2k',
                'read_time' => '1 min',
                'content' => 'Receipts for all purchases are automatically emailed to you. You can also download them anytime from the "Billing" section of your account settings.',
            ],
        ];

        $filteredTopics = collect($topics);

        $search = $request->query('search');
        if ($search) {
            $search = strtolower($search);
            $filteredTopics = $filteredTopics->filter(function ($topic) use ($search) {
                return str_contains(strtolower($topic['title']), $search) || 
                       str_contains(strtolower($topic['content']), $search);
            });
        }

        $category = $request->query('category');
        if ($category) {
            $filteredTopics = $filteredTopics->where('category', $category);
        }

        return view('public.support', [
            'topics' => $filteredTopics->values(),
            'searchQuery' => $request->query('search'),
            'activeCategory' => $category,
        ]);
    }

    public function about(): View
    {
        // Placeholder for the "About" page
        return view('public.about');
    }

    public function contact(): View
    {
        return view('public.contact');
    }

    public function terms(): View
    {
        return view('public.terms');
    }

    public function privacy(): View
    {
        return view('public.privacy');
    }
}
