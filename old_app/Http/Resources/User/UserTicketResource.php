<?php

namespace App\Http\Resources\User;

use App\Enums\TicketPriorityStatusEnum;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTicketResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     * @throws InvalidEnumMemberException
     */
    public function toArray($request)
    {
        return [
            //"user_id",
            //"assigned_agent_id",
            "id"            =>  $this->id,
            "title"         =>  $this->title,
            "priority"      =>  $this->priority->description,
            "status"        =>  $this->status->description,
            "rate"          =>$this->rete,
            "feedback"      =>$this->feedback,

        ];
    }
}
