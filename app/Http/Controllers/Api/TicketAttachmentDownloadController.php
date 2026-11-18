<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\TicketRecord;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TicketAttachmentDownloadController extends Controller
{
    public function __invoke(Image $image): StreamedResponse
    {
        abort_unless($image->private_attachment && $image->parentable_type === (new TicketRecord)->getMorphClass()
            && $image->image_type === 'chat', 404);
        $record = TicketRecord::findOrFail($image->parentable_id);
        $ticket = $record->ticket;
        abort_unless($ticket && (Gate::allows('accessPanelOwnerTicket', $ticket)
            || Gate::allows('accessPanelSupportTicket', $ticket)), 404);
        $name = $image->getRawOriginal('url');
        abort_unless(preg_match('/^[0-9a-f-]{36}\.(jpg|jpeg|png|webp|pdf)$/D', $name), 404);
        $disk = Storage::disk('private');
        $path = 'ticket-attachments/'.$name;
        abort_unless($disk->exists($path), 404);
        return $disk->download($path, 'attachment-'.$image->id, [
            'Content-Type' => 'application/octet-stream', 'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'private, no-store',
        ]);
    }
}
