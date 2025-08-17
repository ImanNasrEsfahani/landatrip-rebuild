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
        $file = $request->file('file');
        $filename = time() . "-" . auth()->user()->id . "-" . (auth()->user()->fname ?? "") . "-" . (auth()->user()->lname ?? "") . "." . $file->extension();
        $save = Storage::put("/public/tmp-files/{$filename}", file_get_contents($file));
        if ($save) {
            $tempFileObj = TemporaryFiles::create(['name' => $filename,
                                                   "type" => $file->getClientMimeType(),
                                                   "size" => $file->getSize()]);
            return response($tempFileObj->id, 200, ['content-type' => 'text/plain']);
        }
        return abort("403", "The file has not saved.");
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
        $file = $request->file('files');
        $filename = time() . "-" . auth()->user()->id . "-" . (auth()->user()->fname ?? "") . "-" . (auth()->user()->lname ?? "") . "." . $file->extension();
        $save = Storage::put("public/users/header/{$filename}", file_get_contents($file));
        if ($save) {
            $headerImageObj = Image::updateOrCreate([
                'parentable_id'     =>  auth()->user()->id,
                'parentable_type'   =>  User::class,
                "image_type"   =>  "header"
            ],
                [
                    "url"   =>  $filename,
                    "alt"   =>  auth()->user()->name . " - " . config("name")
                ]);
            return response($headerImageObj->id, 200, ['content-type' => 'text/plain']);
        }
        return response("The file has not saved.", 403);
    }
}
