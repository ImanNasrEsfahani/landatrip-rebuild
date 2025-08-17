<?php

namespace App\Http\Resources\Application\v1\ClientApp;

use App\Http\Resources\UserBadgeLevelResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileInfoResource extends JsonResource
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
            "user_companies"       => ProfileInfoCompaniesResource::collection($this->userCompanies),
            "user_education"       => ProfileInfoEducationResource::collection($this->userEducations),
            "about_me"             => $this->about_me,
            "skills"               => $this->skills,
            "Badges"               => UserBadgeLevelResource::collection($this->userBadgeLevels)
        ];
    }
}
