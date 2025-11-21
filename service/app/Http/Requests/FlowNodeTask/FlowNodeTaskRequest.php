<?php

declare(strict_types=1);

namespace App\Http\Requests\FlowNodeTask;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FlowNodeTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 验证器之前的操作
     * @return void
     */
    public function prepareForValidation(): void {}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function attributes(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
