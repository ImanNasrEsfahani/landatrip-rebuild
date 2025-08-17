<?php

namespace App\Http\Requests\Api\TeacherPanel;

use App\Enums\TicketPriorityStatusEnum;
use BenSampo\Enum\Rules\EnumKey;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeacherTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //"user_id",
            //"assigned_agent_id",
            "title"     =>  ["required", "min:3", "max:150"],
            "priority"  =>  ["required", Rule::in(TicketPriorityStatusEnum::getValues())],
//            "priority"  =>  ["required", new EnumValue(TicketPriorityStatusEnum::class)],
            //"status"

            "message"   =>  ["required", "min:20", "max:450"],
        ];
    }
}
