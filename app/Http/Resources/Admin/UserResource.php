<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => optional($this->roles->first())->id,
            'role' => optional($this->roles->first())->display_name,
            'status_class' => $this->deleted_at ? 'danger' : 'success',
            'status' => $this->deleted_at ? 'Disabled' : 'Active',
            'created_at' => $this->created_at->toIso8601String(),
            'deleted_at' => $this->deleted_at
        ];
    }
}
