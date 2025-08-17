<?php

namespace App\Http\Controllers\Api\TeacherPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherPanel\StoreTeacherEducationRequest;
use App\Http\Requests\Api\TeacherPanel\UpdateTeacherEducationRequest;
use App\Http\Resources\Teacher\TeacherEducationalBackgroundResource;
use App\Models\UserEducation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserEducationBackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return TeacherEducationalBackgroundResource::collection(auth()->user()->userEducations()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTeacherEducationRequest $request
     * @return Response
     */
    public function store(StoreTeacherEducationRequest $request)
    {
        return auth()->user()->userEducations()->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param UserEducation $userEducation
     * @return Response
     */
    public function show(UserEducation $userEducation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserEducation $userEducation
     * @return Response
     */
    public function edit(UserEducation $userEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTeacherEducationRequest $request
     * @param UserEducation $userEducation
     * @return bool
     */
    public function update(UpdateTeacherEducationRequest $request, UserEducation $educational_background)
    {
        return $educational_background->updateOrFail($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserEducation $educational_background
     * @return bool
     */
    public function destroy(UserEducation $educational_background)
    {
        return $educational_background->deleteOrFail();
    }
}
