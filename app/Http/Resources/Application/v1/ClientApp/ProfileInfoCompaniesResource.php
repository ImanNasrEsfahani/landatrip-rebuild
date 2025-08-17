<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileInfoCompaniesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "company_name"      =>$this->company_name,
            "position"          =>$this->position,
            "from"              =>$this->from,
            "to"                =>$this->to === null ? "Until now" : $this->to
        ];
    }
}
