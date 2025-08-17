<?php

namespace App\Http\Controllers\Api\TeacherPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherPanel\UpdateTeacherWorkExperienceRequest;
use App\Http\Resources\Teacher\TeacherWorkExperienceResource;
use App\Models\UserCompany;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserWorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return TeacherWorkExperienceResource::collection(auth()->user()->userCompanies()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\TeacherPanel\UpdateTeacherWorkExperienceRequest $request
     * @return Response
     */
    public function store(UpdateTeacherWorkExperienceRequest $request)
    {
        return auth()->user()->userCompanies()->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Api\TeacherPanel\UpdateTeacherWorkExperienceRequest $request
     * @param UserCompany $work_experience
     * @return bool
     */
    public function update(UpdateTeacherWorkExperienceRequest $request, UserCompany $work_experience)
    {
        return $work_experience->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserCompany $work_experience
     * @return Response
     */
    public function destroy(UserCompany $work_experience)
    {
        $work_experience->delete();
    }
}
