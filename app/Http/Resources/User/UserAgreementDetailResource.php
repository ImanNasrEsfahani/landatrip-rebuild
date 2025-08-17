<?php

namespace App\Http\Resources\User;

use App\Enums\UserAgreementStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAgreementDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            "title"      => $this->title,
            "link"       => $this->link,
            "text"       => $this->text,
            "acceptance" => $this->pivot->acceptance,
            "status"     => UserAgreementStatusEnum::getDescription($this->pivot->status)
        ];
    }
}
