<?php

namespace App\Http\Resources\User;

use App\Enums\UserAgreementStatusEnum;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAgreementResource extends JsonResource
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
            "id"         => $this->id,
            "title"      => $this->title,
            "link"       => $this->link,
            "created_at" => Carbon::parse($this->created_at)->format('Y/m/d'),
            "status"     => UserAgreementStatusEnum::getDescription($this->pivot->status)
        ];
    }
}
