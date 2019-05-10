<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

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
        $per= [];
        foreach ($this->groups as $group) {
            foreach ($group->permissions as $permission) {
                if(!in_array($permission->permission, $per)) {
                    $per[] = $permission->permission;
                }
            }
        }
        $url = null;
        if ($this->image){
            $url = Storage::cloud()->url($this->image);
        }
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'image' =>$url,
            'role' => $this->role,
            'permission' => $per,
            'skill' => $this->skills,
            'status' => $this->status,

        ];
    }
}
