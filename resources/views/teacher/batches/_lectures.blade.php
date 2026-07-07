{{-- Lectures Tab --}}
<div>
    {{-- Header with Upload Button --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <p class="text-sm text-gray-500">
                {{ $batch->name }} • {{ $batch->grade }} • {{ $batch->student_limit }} Students Enrolled
            </p>
        </div>
        <button id="open-lecture-modal"
                class="flex items-center gap-2 px-4 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
            </svg>
            Upload New Lecture
        </button>
    </div>

    @if($batch->lectures->isEmpty())
        <div class="bg-white rounded-xl border-2 border-dashed border-gray-200 p-16 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h3 class="font-bold text-gray-700 mb-1">No Lectures Yet</h3>
            <p class="text-sm text-gray-400 mb-4">Upload your first recorded lecture for students to watch.</p>
            <button id="open-lecture-modal-empty"
                    onclick="document.getElementById('open-lecture-modal').click()"
                    class="px-5 py-2.5 bg-[#1e3a5f] text-white text-sm font-semibold rounded-lg hover:bg-[#162d4a] transition-colors">
                Upload First Lecture
            </button>
        </div>
    @else
        {{-- Lecture Cards Grid --}}
        <div class="grid grid-cols-3 gap-4">
            @foreach($batch->lectures as $lecture)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow group">

                    {{-- Thumbnail --}}
                    <div class="relative aspect-video bg-gray-900 overflow-hidden">
                        <img src="{{ $lecture->thumbnailUrl() }}"
                             alt="{{ $lecture->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        {{-- Play overlay --}}
                        <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="w-12 h-12 bg-white/90 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-[#1e3a5f] ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        {{-- Duration Badge --}}
                        <span class="absolute bottom-2 right-2 bg-black/75 text-white text-[11px] font-bold px-2 py-0.5 rounded">
                            {{ $lecture->duration }}
                        </span>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-2">
                            <h4 class="text-sm font-bold text-gray-900 leading-snug flex-1">{{ $lecture->title }}</h4>
                            {{-- 3-dot menu --}}
                            <div class="relative shrink-0" x-data="{ open: false }">
                                <button onclick="this.nextElementSibling.classList.toggle('hidden')"
                                        class="w-6 h-6 flex items-center justify-center text-gray-400 hover:text-gray-700 rounded transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 5a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7a1.5 1.5 0 110-3 1.5 1.5 0 010 3zm0 7a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"/>
                                    </svg>
                                </button>
                                <div class="hidden absolute right-0 top-7 w-36 bg-white rounded-xl border border-gray-100 shadow-lg z-10 py-1">
                                    <a href="{{ $lecture->video_url }}" target="_blank"
                                       class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                        Open Link
                                    </a>
                                    <form method="POST"
                                          action="{{ route('teacher.batches.lectures.destroy', [$batch, $lecture]) }}"
                                          onsubmit="return confirm('Delete this lecture?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-left">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1 mb-3">
                            Uploaded on {{ $lecture->created_at->format('F j, Y') }}
                        </p>
                        <div class="flex items-center gap-4 text-xs text-gray-500">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ number_format($lecture->views_count) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
