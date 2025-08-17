<?php

namespace App\Http\Controllers;

use App\Models\TeacherCertificate;
use App\Http\Requests\StoreTeacherCertificateRequest;
use App\Http\Requests\UpdateTeacherCertificateRequest;

class TeacherCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeacherCertificateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherCertificateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeacherCertificate  $teacherCertificate
     * @return \Illuminate\Http\Response
     */
    public function show(TeacherCertificate $teacherCertificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeacherCertificate  $teacherCertificate
     * @return \Illuminate\Http\Response
     */
    public function edit(TeacherCertificate $teacherCertificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherCertificateRequest  $request
     * @param  \App\Models\TeacherCertificate  $teacherCertificate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherCertificateRequest $request, TeacherCertificate $teacherCertificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeacherCertificate  $teacherCertificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeacherCertificate $teacherCertificate)
    {
        //
    }
}
