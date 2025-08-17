<?php

namespace App\Http\Controllers\Api\TeacherPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherPanel\StoreTeacherDocumentRequest;
use App\Http\Resources\Teacher\TeacherDocumentsResource;
use App\Models\TemporaryFiles;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class UserDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return TeacherDocumentsResource::collection(auth()->user()->userDocuments()->get());
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
     * @param StoreTeacherDocumentRequest $request
     * @return bool
     */
    public function store(StoreTeacherDocumentRequest $request)
    {
        $tempObj = TemporaryFiles::find($request->validated("file"));
        $userDocumentObj = new UserDocument([
            'user_id' => auth()->user()->id,
            "title"   => $request->validated("title"),
            "type"    => $tempObj->type,
            "file"    => $tempObj->name,
            //"status"
        ]);
        $dest = "users/documents/";
        $tempFilesPath = "tmp-files/";
        Storage::disk('public')->move($tempFilesPath . $tempObj->name, $dest . $tempObj->name);
        return $userDocumentObj->save();
    }

    /**
     * Display the specified resource.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function show(UserDocument $userDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function edit(UserDocument $userDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param UserDocument $userDocument
     * @return void
     */
    public function update(Request $request, UserDocument $userDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserDocument $userDocument
     * @return bool
     */
    public function destroy(UserDocument $userDocument)
    {
        return $userDocument->delete();
    }
}
