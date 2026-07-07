<?php

namespace App\Http\Requests\Student;

use App\Models\Batch;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreEnrollmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->isStudent() === true && $this->user()?->is_active === true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return array<int, callable>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                /** @var Batch|null $batch */
                $batch = $this->route('batch');

                if (! $batch) {
                    $validator->errors()->add('batch', 'The selected batch could not be found.');

                    return;
                }

                if (! $batch->is_active) {
                    $validator->errors()->add('batch', 'This batch is inactive and is not accepting enrollments.');
                }

                if ($this->user()?->isEnrolledInBatch($batch)) {
                    $validator->errors()->add('batch', 'You are already enrolled in this batch.');
                }

                if ($batch->isFull()) {
                    $validator->errors()->add('batch', 'This batch is full.');
                }
            },
        ];
    }
}
