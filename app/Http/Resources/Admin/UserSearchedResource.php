<?php

namespace App\Http\Resources\Admin;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserSearchedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        $label = $this->name . " Gender: " . $this->sex;
        $label .= $this->location ? " Location: " . $this->location : "";
        $label .= $this->userCompanies()->count() > 0 ? " Last Company: " . $this->userCompanies()->first()->company_name : "";

        return [
            'value'         =>  $this->id,
            'label'         =>  $label,
            'short_label'   =>  $this->name,
            'id'            =>  $this->id,
            'profile'       =>  $this->profileImage ? $this->profileImage->url : "",
            'isFixed'       =>  "true",
            $this->suspended ? 'isDisabled' : "true"
        ];
    }
}

//[
//    [ 'value' => 'jafar', 'label' => 'jafar', 'color' => '#00B8D9', 'isFixed' => true ],
//    [ 'value' => 'akbar', 'label' => 'akbar', 'color' => '#0052CC', 'isDisabled' => true ]
//]
