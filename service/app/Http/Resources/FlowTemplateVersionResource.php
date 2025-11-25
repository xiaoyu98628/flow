<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Constants\Enums\FlowTemplateVersion\StatusEnum;
use Illuminate\Http\Request;

class FlowTemplateVersionResource extends BaseResource
{
    public function getDefaultFields(Request $request): array
    {
        return [
            'id'         => (string) $this->id,
            'version'    => (int) $this->version,
            'status'     => (string) $this->status,
            'name'       => (string) $this->name,
            'callback'   => (array) $this->callback,
            'extend'     => (array) $this->current_version,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
        ];
    }

    public function getWithFields(Request $request): array
    {
        return [];
    }

    public function getCustomFields(Request $request): array
    {
        return [
            'version_txt' => (string) sprintf('V%s', $this->version),
            'status_txt'  => (string) StatusEnum::tryFrom($this->status)->label(),
        ];
    }
}
