<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractScheduleResource extends JsonResource
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
            "start_time" => $this->start_time,
            "end_time" => $this->end_time,
            "day_of_week"=> $this->day_of_week,
            "shift" => $this->shift,
        ];
    }
}
