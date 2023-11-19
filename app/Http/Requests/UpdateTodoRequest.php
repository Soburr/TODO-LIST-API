<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'title' => ['required', 'string'],
            'status' => ['required', Rule::in(['C', 'P', 'c', 'p'])],
            'completed_date' => ['required', 'date'],
            'initiated_date' => ['required', 'date'],
        ];
    }
}
