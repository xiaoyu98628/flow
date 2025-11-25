<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $defaultFields = $this->getDefaultFields($request);
        $withFields    = $this->getWithFields($request);
        $customFields  = $this->getCustomFields($request);

        return [...$defaultFields, ...$withFields, ...$customFields];
    }

    abstract public function getDefaultFields(Request $request): array;

    abstract public function getWithFields(Request $request): array;

    abstract public function getCustomFields(Request $request): array;
}
