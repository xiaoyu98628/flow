<?php

declare(strict_types=1);

namespace App\Http\Requests\FlowTemplate;

use App\Constants\Enums\FlowTemplate\TypeEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FlowTemplateRequest extends FormRequest
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
        return match ($this->route()->getActionMethod()) {
            'store' => $this->store(),
            default => [],
        };
    }

    public function attributes(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [
            'type.required' => '参数[type]不能为空',
            'type.string'   => '参数[type]为string类型',
            'type.in'       => '参数[type]错误',
            'code.required' => '参数[code]不能为空',
            'code.string'   => '参数[code]为string类型',
            'code.max'      => '参数[code]最长50个字符',
            'name.required' => '参数[name]不能为空',
            'name.string'   => '参数[name]为string类型',
            'name.max'      => '参数[name]最长50个字符',
            'remark.max'    => '参数[remark]最长255个字符',
        ];
    }

    private function store(): array
    {
        return [
            'type'   => ['required', 'string', 'in:'.implode(',', TypeEnum::values())],
            'code'   => ['required', 'string', 'max:50'],
            'name'   => ['required', 'string', 'max:50'],
            'remark' => ['nullable', 'string', 'max:255'],
        ];
    }
}
