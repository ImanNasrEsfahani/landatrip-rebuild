<?php

namespace App\Http\Resources\Teacher;

use App\Enums\TicketPriorityStatusEnum;
use BenSampo\Enum\Exceptions\InvalidEnumMemberException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $priority
 * @property mixed $status
 */
class TeacherTicketResource extends JsonResource
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
            "id"            =>  $this->id,
            "title"         =>  $this->title,
            "priority"      =>  $this->priority->description,
            "status"        =>  $this->status->description
        ];
    }
}
