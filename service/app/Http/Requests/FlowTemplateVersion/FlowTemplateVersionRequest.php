<?php

declare(strict_types=1);

namespace App\Http\Requests\FlowTemplateVersion;

use App\Constants\Enums\FlowTemplateVersion\StatusEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FlowTemplateVersionRequest extends FormRequest
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
            'index', 'show' => $this->index(),
            'store', 'update' => $this->store(),
            'status' => $this->status(),
            default  => [],
        };
    }

    public function attributes(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [
            'flow_template_id.required'   => '参数[flow_template_id]不能为空',
            'flow_template_id.string'     => '参数[flow_template_id]为string类型',
            'name.required'               => '参数[name]不能为空',
            'name.string'                 => '参数[name]为string类型',
            'callback.array'              => '参数[callback]为array类型',
            'status.required'             => '参数[status]不能为空',
            'status.string'               => '参数[status]为string类型',
            'status.in'                   => '参数[status]无效',
            'node_template_tree.required' => '参数[node_template_tree]不能为空',
            'node_template_tree.array'    => '参数[node_template_tree]为array类型',
        ];
    }

    private function index(): array
    {
        return [
            'flow_template_id' => ['required', 'string'],
        ];
    }

    private function store(): array
    {
        return [
            'flow_template_id'   => ['required', 'string'],
            'name'               => ['required', 'string', 'max:50'],
            'callback'           => ['array'],
            'node_template_tree' => ['required', 'array'],
        ];
    }

    private function status(): array
    {
        return [
            'flow_template_id' => ['required', 'string'],
            'status'           => ['required', 'string', 'in:'.implode(',', StatusEnum::values())],
        ];
    }
}
