<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Constants\Enums\FlowTemplate\StatusEnum;
use App\Constants\Enums\FlowTemplate\TypeEnum;
use Illuminate\Http\Request;

class FlowTemplateResource extends BaseResource
{
    public function getDefaultFields(Request $request): array
    {
        return [
            'id'              => (string) $this->id,
            'type'            => (string) $this->type,
            'code'            => (string) $this->code,
            'name'            => (string) $this->name,
            'remark'          => (string) $this->remark,
            'current_version' => (int) $this->current_version,
            'status'          => (string) $this->status,
            'created_at'      => (string) $this->created_at,
            'updated_at'      => (string) $this->updated_at,
        ];
    }

    public function getWithFields(Request $request): array
    {
        return [];
    }

    public function getCustomFields(Request $request): array
    {
        return [
            'type_txt'            => (string) TypeEnum::tryFrom($this->type)->label(),
            'current_version_txt' => (string) sprintf('V%s', $this->current_version),
            'status_txt'          => (string) StatusEnum::tryFrom($this->status)->label(),
        ];
    }
}
