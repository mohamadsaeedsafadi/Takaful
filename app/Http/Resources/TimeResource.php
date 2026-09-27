<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Transaction number'=>$this->id,
            'Start time'=>$this->start_time,
            'End time' => $this->end_time,
            'Expert id' => $this->expert_id,
            'User name'=>$this->name,
            'User email'=>$this->email,
            'User phone'=>$this->phone,
            'Money transferred'=>$this->money_transferred,
            'User image'=>$this->photo,

        ];
    }
}
