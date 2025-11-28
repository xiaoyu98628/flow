<?php

declare(strict_types=1);

namespace App\Http\Requests\Flow;

use App\Constants\Enums\Flow\TypeEnum;
use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class FlowRequest extends BaseRequest
{
    /**
     * 是否有权发出此请求
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
            'is_draft.required'    => '参数[is_draft]不能为空',
            'is_draft.boolean'     => '参数[business_id]为boolean类型',
            'code.required'        => '参数[code]不能为空',
            'code.string'          => '参数[code]为string类型',
            'code.in'              => '参数[code]无效',
            'business_id.required' => '参数[business_id]不能为空',
            'business_id.string'   => '参数[business_id]为string类型',
        ];
    }

    private function store(): array
    {
        return [
            'is_draft'    => ['required', 'boolean'],
            'code'        => ['required', 'string', 'in:'.implode(',', TypeEnum::values())],
            'business_id' => ['required', 'string'],
        ];
    }
}
