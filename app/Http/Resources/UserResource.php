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
        return [
            'role_id' => $request->role_id,
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
        ];
    }
}
