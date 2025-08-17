<?php

namespace App\Http\Controllers\Api\UserPanel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserPanel\StoreUserDocumentRequest;
use App\Http\Resources\User\UserDocumentsResource;
use App\Models\TemporaryFiles;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Throwable;

class UserDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return UserDocumentsResource::collection(auth()->user()->userDocuments()->paginate($request->input("pageSize")));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserDocumentRequest $request
     * @return bool
     */
    public function store(StoreUserDocumentRequest $request): bool
    {
        $tempObj = TemporaryFiles::find($request->validated("file"));
        $userDocumentObj = new UserDocument([
            'user_id'   =>  auth()->user()->id,
            "title"     =>  $request->validated("title"),
            "type"      =>  $tempObj->type,
            "file"      =>  $tempObj->name,
            //"status"
        ]);
        $dest = "users/documents/";
        $tempFilesPath = "tmp-files/";
        Storage::disk('public')->move($tempFilesPath. $tempObj->name, $dest.$tempObj->name);
        return $userDocumentObj->save();
    }

    /**
     * Display the specified resource.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function show(UserDocument $userDocument): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function edit(UserDocument $userDocument): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUserDocumentRequest $request
     * @param UserDocument $userDocument
     * @return bool
     * @throws Throwable
     */
    public function update(StoreUserDocumentRequest $request, UserDocument $userDocument): bool
    {
        $tempObj = TemporaryFiles::find($request->validated("file"));
        $userDocument->updateOrFail($request->validated());
        $dest = "users/documents/";
        $tempFilesPath = "tmp-files/";
        Storage::disk('public')->move($tempFilesPath. $tempObj->name, $dest.$tempObj->name);
        return $userDocument->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserDocument $userDocument
     * @return bool
     * @throws Throwable
     */
    public function destroy(UserDocument $userDocument)
    {
        return $userDocument->deleteOrFail();
    }
}
