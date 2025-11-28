<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class BaseRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $ruleMethod = $this->getActionRuleMethod();
        if (method_exists(static::class, $ruleMethod)) {
            return static::$ruleMethod();
        }

        return [];
    }

    final protected function getActionRuleMethod(): string
    {
        return Str::of($this->route()->getActionMethod())->append('Rules')->toString();
    }
}
