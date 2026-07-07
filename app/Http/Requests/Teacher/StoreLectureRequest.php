<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class StoreLectureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isTeacher();
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'video_url' => ['required', 'url', 'max:500'],
            'duration' => ['required', 'string', 'max:10', 'regex:/^\d{1,2}:\d{2}$/'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'duration.regex' => 'Duration must be in MM:SS or H:MM:SS format (e.g., 45:12 or 1:04:15).',
        ];
    }
}
