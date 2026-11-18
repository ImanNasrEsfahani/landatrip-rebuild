<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TemporaryFiles;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MobileUploadDownloadController extends Controller
{
    public function __invoke(TemporaryFiles $temporaryFile): StreamedResponse
    {
        abort_unless($temporaryFile->owner_id === auth()->id() && $temporaryFile->expires_at !== null
            && now()->lt($temporaryFile->expires_at) && $temporaryFile->consumed_at === null, 404);
        abort_unless(preg_match('/^[0-9a-f-]{36}\.(jpg|jpeg|png|webp|pdf)$/D', $temporaryFile->name), 404);
        $disk = Storage::disk('private');
        $path = 'temporary-uploads/'.$temporaryFile->name;
        abort_unless($disk->exists($path), 404);
        return $disk->download($path, 'upload-'.$temporaryFile->id, [
            'Content-Type' => 'application/octet-stream', 'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, no-store',
        ]);
    }
}
