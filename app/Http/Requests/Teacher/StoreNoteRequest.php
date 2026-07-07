<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
            'note_file' => [
                'required',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx',
                'max:20480', // 20 MB max
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'note_file.mimes' => 'Only PDF, Word (DOC/DOCX), and PowerPoint (PPT/PPTX) files are allowed.',
            'note_file.max' => 'File size must not exceed 20 MB.',
        ];
    }
}
