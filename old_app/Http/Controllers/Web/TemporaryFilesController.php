<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTemporaryFilesRequest;
use App\Http\Requests\UpdateTemporaryFilesRequest;
use App\Models\TemporaryFiles;

class TemporaryFilesController extends Controller
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
     * @param  \App\Http\Requests\StoreTemporaryFilesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemporaryFilesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TemporaryFiles  $temporaryFiles
     * @return \Illuminate\Http\Response
     */
    public function show(TemporaryFiles $temporaryFiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TemporaryFiles  $temporaryFiles
     * @return \Illuminate\Http\Response
     */
    public function edit(TemporaryFiles $temporaryFiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTemporaryFilesRequest  $request
     * @param  \App\Models\TemporaryFiles  $temporaryFiles
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTemporaryFilesRequest $request, TemporaryFiles $temporaryFiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TemporaryFiles  $temporaryFiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(TemporaryFiles $temporaryFiles)
    {
        //
    }
}
