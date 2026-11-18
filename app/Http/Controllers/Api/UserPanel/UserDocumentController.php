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
        return app(\App\Services\TemporaryUpload::class)->consume($request->validated('file'), 'users/documents', function ($file) use ($request) {
            return UserDocument::create([
                'user_id' => auth()->id(), 'title' => $request->validated('title'),
                'type' => $file->type, 'file' => $file->name,
            ])->exists;
        });
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
    public function update(StoreUserDocumentRequest $request, UserDocument $document): bool
    {
        return app(\App\Services\TemporaryUpload::class)->consume($request->validated('file'), 'users/documents', function ($file) use ($request, $document) {
            return $document->updateOrFail([
                'title' => $request->validated('title'), 'type' => $file->type, 'file' => $file->name,
            ]);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserDocument $userDocument
     * @return bool
     * @throws Throwable
     */
    public function destroy(UserDocument $document)
    {
        return $document->deleteOrFail();
    }
}
