<?php

declare(strict_types=1);

namespace App\Http\Requests\FlowTemplate;

use App\Constants\Enums\FlowTemplate\StatusEnum;
use App\Constants\Enums\FlowTemplate\TypeEnum;
use App\Http\Requests\BaseRequest;

class FlowTemplateRequest extends BaseRequest
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

    public function storeRules(): array
    {

        return [
            'type'   => ['required', 'string', 'in:'.implode(',', TypeEnum::values())],
            'code'   => ['required', 'string', 'max:50'],
            'name'   => ['required', 'string', 'max:50'],
            'remark' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function updateRules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:50'],
            'remark' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function statusRules(): array
    {
        return [
            'status' => ['required', 'string', 'in:'.implode(',', StatusEnum::values())],
        ];
    }

    public function attributes(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [
            'type.required'   => '参数[type]不能为空',
            'type.string'     => '参数[type]为string类型',
            'type.in'         => '参数[type]无效',
            'code.required'   => '参数[code]不能为空',
            'code.string'     => '参数[code]为string类型',
            'code.max'        => '参数[code]最长50个字符',
            'name.required'   => '参数[name]不能为空',
            'name.string'     => '参数[name]为string类型',
            'name.max'        => '参数[name]最长50个字符',
            'remark.max'      => '参数[remark]最长255个字符',
            'status.required' => '参数[status]不能为空',
            'status.string'   => '参数[status]为string类型',
            'status.in'       => '参数[status]无效',
        ];
    }
}
