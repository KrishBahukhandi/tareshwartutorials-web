<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeetingRequest extends FormRequest
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
            'meeting_link' => ['required', 'url', 'max:500'],
            'meeting_title' => ['required', 'string', 'max:255'],
            'meeting_scheduled_at' => ['nullable', 'date', 'after:now'],
        ];
    }

    public function messages(): array
    {
        return [
            'meeting_link.url' => 'Please enter a valid URL (e.g., https://meet.google.com/abc-defg).',
        ];
    }
}
