<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class expert extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'photo'=>$this->photo,

            'phone'=>$this->phone,

            'address'=>$this->address,
            'time1'=>$this->time1,
            'time2'=>$this->time2,

            'experience'=>$this->experience,
            'consultation_type'=>$this->consultation_type,
            'type'=>$this->type=1,
            'rate'=>$this->rate,
            'money'=>$this->money,



        ];
    }
}
