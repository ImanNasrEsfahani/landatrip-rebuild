<?php

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Gate;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('chat.{id}', function (User $user, string $id): bool {
    $conversation = Conversation::find($id);

    return $conversation !== null && Gate::forUser($user)->allows('view', $conversation);
});

Broadcast::channel('list-channel.{userId}', function (User $user, string $userId): bool {
    return $user->id === $userId;
});

