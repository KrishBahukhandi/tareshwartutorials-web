<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function prepareForValidation(): void
    {
        if ($this->has('subjects_input')) {
            $subjects = array_filter(array_map('trim', explode(',', $this->subjects_input)));
            $this->merge([
                'subjects' => $subjects,
            ]);
        }
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'subjects' => ['required', 'array', 'min:1'],
            'subjects.*' => ['string', 'max:100'],
            'grade' => ['required', 'string', 'max:50'],
            'schedule_days' => ['required', 'array', 'min:1'],
            'schedule_days.*' => ['string', 'in:MON,TUE,WED,THU,FRI,SAT'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'student_limit' => ['required', 'integer', 'min:1', 'max:500'],
            'teacher_id' => ['nullable', 'exists:users,id'],
        ];
    }
}
