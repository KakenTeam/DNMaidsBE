<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class HelperResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $url = null;
        if ($this->image){
            $url = Storage::cloud()->url($this->image);
        }
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'birthday' => $this->birthday,
            'image' => $url,
        ];
    }
}
