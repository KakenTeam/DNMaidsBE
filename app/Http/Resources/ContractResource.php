<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
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
            'address' => $this->address,
            'start_date' =>$this->start_date,
            'end_date' => $this->end_date,
            'fee' => $this->fee,
            'service_type' => $this->service_type,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'helper' => new HelperResource($this->helper),
            'schedule' => ContractScheduleResource::collection($this->schedule)
        ];
    }
}
