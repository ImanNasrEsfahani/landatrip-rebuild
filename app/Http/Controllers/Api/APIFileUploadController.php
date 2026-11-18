<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTemporaryFileRequest;
use App\Http\Requests\UpdateUserHeaderRequest;
use App\Models\Image;
use App\Models\TemporaryFiles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class APIFileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index ()
    {
        dd("index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTemporaryFileRequest $request
     * @return Response
     */
    public function store (StoreTemporaryFileRequest $request): Response
    {
        $request->validate(['file' => ['required', 'file']]);
        $file = app(\App\Services\TemporaryUpload::class)->store($request->file('file'));
        return response($file->id, 200, ['content-type' => 'text/plain']);
    }

    public function tempStore(StoreTemporaryFileRequest $request): Response
    {
        return $this->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show ($id)
    {
        dd("show");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit ($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update (Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy ($id)
    {
        dd("destroy");
    }
    /**
     * @param UpdateUserHeaderRequest $request
     * @return void
     */
    public function header(UpdateUserHeaderRequest $request):Response
    {
        $upload = app(\App\Services\TemporaryUpload::class)->store($request->file('files'));
        return app(\App\Services\TemporaryUpload::class)->consume($upload->id, 'users/header', function ($file) {
            $image = Image::updateOrCreate([
                'parentable_id' => auth()->id(), 'parentable_type' => User::class, 'image_type' => 'header',
            ], ['url' => $file->name, 'alt' => auth()->user()->name.' - '.config('name')]);
            return response($image->id, 200, ['content-type' => 'text/plain']);
        });
    }
}
