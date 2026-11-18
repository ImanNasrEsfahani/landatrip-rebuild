<?php

namespace App\Services;

use App\Models\TemporaryFiles;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class TemporaryUpload
{
    public function store(UploadedFile $file): TemporaryFiles
    {
        abort_unless(auth()->check(), 401);
        Validator::make(['file' => $file], [
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:10240'],
        ])->validate();
        $name = Str::uuid().'.'.$file->extension();
        $path = 'temporary-uploads/'.$name;
        abort_unless(Storage::disk('private')->putFileAs('temporary-uploads', $file, $name), 500);
        try {
            return TemporaryFiles::create([
                'name' => $name, 'type' => $file->getMimeType(), 'size' => $file->getSize(),
                'owner_id' => auth()->id(), 'expires_at' => now()->addDay(),
            ]);
        } catch (Throwable $error) {
            Storage::disk('private')->delete($path);
            throw $error;
        }
    }

    /** The callback saves the consuming record inside the same database transaction. */
    public function consume($id, string $directory, callable $save, string $disk = 'public')
    {
        $destination = null;
        try {
            return DB::transaction(function () use ($id, $directory, $save, $disk, &$destination) {
                abort_unless(auth()->check(), 401);
                $file = TemporaryFiles::query()->whereKey($id)->where('owner_id', auth()->id())
                    ->where('expires_at', '>', now())->whereNull('consumed_at')->lockForUpdate()->firstOrFail();
                abort_unless(preg_match('/^[0-9a-f-]{36}\.(jpg|jpeg|png|webp|pdf)$/D', $file->name), 404);
                $source = 'temporary-uploads/'.$file->name;
                abort_unless(Storage::disk('private')->exists($source), 404);
                $target = trim($directory, '/').'/'.$file->name;
                abort_if(Storage::disk($disk)->exists($target), 409);
                $destination = $target;
                $stream = Storage::disk('private')->readStream($source);
                abort_unless(is_resource($stream), 500);
                try {
                    abort_unless(Storage::disk($disk)->put($destination, $stream), 500);
                } finally {
                    fclose($stream);
                }
                $result = $save($file);
                abort_if($result === false, 500);
                $file->forceFill(['consumed_at' => now()])->saveOrFail();
                return $result;
            });
        } catch (Throwable $error) {
            if ($destination !== null) {
                Storage::disk($disk)->delete($destination);
            }
            throw $error;
        }
    }
}
