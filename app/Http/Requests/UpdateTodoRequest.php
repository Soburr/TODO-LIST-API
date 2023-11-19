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

        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'name' => ['required', 'string'],
                'title' => ['required', 'string'],
                'status' => ['required', Rule::in(['C', 'P', 'c', 'p'])],
                'completed_date' =>  ['nullable', 'date', 'date_format:Y-m-d'],
                'initiated_date' =>  ['required', 'date', 'date_format:Y-m-d'],
            ];
        } else {
            return [
                'name' => ['sometimes', 'required', 'string'],
                'title' => ['sometimes', 'required', 'string'],
                'status' => ['sometimes', 'required', Rule::in(['C', 'P', 'c', 'p'])],
                'completed_date' =>  ['sometimes', 'nullable', 'date', 'date_format:Y-m-d'],
                'initiated_date' =>  ['sometimes', 'required', 'date', 'date_format:Y-m-d'],
            ];
        }
        
    }
}
