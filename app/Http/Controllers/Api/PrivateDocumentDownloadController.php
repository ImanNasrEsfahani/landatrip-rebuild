<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserDocument;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PrivateDocumentDownloadController extends Controller
{
    public function __invoke(UserDocument $userDocument): StreamedResponse
    {
        $disk = Storage::disk('private');
        $id = $userDocument->getKey();
        $path = "user-documents/{$id}/content";

        abort_unless($disk->exists($path), 404);

        return $disk->download($path, "document-{$id}", [
            'Cache-Control' => 'private, no-store',
            'Content-Type' => 'application/octet-stream',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
