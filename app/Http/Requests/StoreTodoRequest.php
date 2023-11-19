<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTodoRequest extends FormRequest
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
            'completed_date' =>  ['nullable', 'date', 'date_format:Y-m-d'],
            'initiated_date' =>  ['required', 'date', 'date_format:Y-m-d'],
        ];
    }
}
