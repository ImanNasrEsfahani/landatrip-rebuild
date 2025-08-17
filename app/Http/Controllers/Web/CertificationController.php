<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Web\StoreCertificationRequest;
use App\Http\Requests\Api\Web\UpdateCertificationRequest;
use App\Models\Certification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view("verification.verify");
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
     * @param StoreCertificationRequest $request
     * @return Response
     */
    public function store(StoreCertificationRequest $request)
    {
        $certificationObj = Certification::find($request->validated("input-code"));
        if($certificationObj) {
            return "Your Certificate";
        }
        return "Not Found Certificate";
    }

    /**
     * Display the specified resource.
     *
     * @param Certification $certification
     * @return Response
     */
    public function show(Certification $certification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Certification $certification
     * @return Response
     */
    public function edit(Certification $certification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCertificationRequest $request
     * @param Certification $certification
     * @return Response
     */
    public function update(UpdateCertificationRequest $request, Certification $certification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Certification $certification
     * @return Response
     */
    public function destroy(Certification $certification)
    {
        //
    }
}
