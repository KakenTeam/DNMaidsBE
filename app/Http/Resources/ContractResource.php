<?php

namespace App\Http\Resources;


use App\Models\Skill;
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
        $dow = [];
        foreach ($this->schedule as $day) {
            $dow[] = $day->day_of_week;
        }
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
            'schedule' => [
                'day_of_week' => $dow,
                'time' => ContractScheduleResource::collection($this->schedule)
                ],
            'skill' =>  SkillResource::collection($this->skills),
        ];
    }
}
