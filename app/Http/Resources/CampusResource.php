<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampusResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'campus' => ucwords(strtolower($this->campus)),
            'address' => ucwords(strtolower($this->address)),
            'shortcut' => $this->shortcut,
            'is_main' => $this->is_main,
            'municipality' => $this->municipality,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
