<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => ucwords(strtolower($this->school->name)),
            'campus' => ucwords(strtolower($this->campus)),
            'grading' => $this->grading->name,
            'term' => $this->term->name,
            'class' => $this->school->class->name,
            'region' => $this->municipality->province->region->region,
            'province' => $this->municipality->province->name,
            'municipality' => $this->municipality->name,
            'status' => ($this->is_active) ? 'active' : 'inactive',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
