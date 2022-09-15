<?php

namespace App\Http\Resources;

use Hashids\Hashids;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolPublicResource extends JsonResource
{

    public function toArray($request)
    {
        $hashids = new Hashids('krad',10);
        $code = $hashids->encode($this->id);
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'code' => $code,
            'name' => ucwords(strtolower($this->school->name)),
            'campus' => ucwords(strtolower($this->campus)),
            'shortcut' => $this->shortcut,
            'address' => $this->address,
            'avatar' => $this->school->avatar,
            'region' => $this->municipality->province->region,
            'province' => $this->municipality->province,
            'municipality' => $this->municipality,
            'status' => ($this->is_active) ? 'active' : 'inactive',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'courses' => ($this->courses != null) ? CoursePublicResource::collection($this->courses) : ''
        ];
    }
}
