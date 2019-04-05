<?php

namespace App\Http\Resources;

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
        $per = null;
        foreach ($this->groups as $group) {
            foreach ($group->permissions as $permission) {
                $per[] = [
                    'group' => $group->group_name,
                    'permission' => $permission->permission,
                ];
            }
        }
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'permission' => $per,
        ];
    }
}
