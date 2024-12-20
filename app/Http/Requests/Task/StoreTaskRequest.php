<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>[
                'sometimes',
                'required',
                'integer',
                Rule::exists('users','id')
            ],
            'category_id'=>[
                'required',
                'integer',
                Rule::exists('categories','id')
            ],
            'status_id'=>[
                'required',
                'integer',
                Rule::exists('statuses','id')
            ],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks', 'name')
            ],
            'description' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
