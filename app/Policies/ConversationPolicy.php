<?php

namespace App\Policies;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConversationPolicy
{
    public function view(User $user, Conversation $conversation): Response
    {
        return $user->id === $conversation->user_id || $user->id === $conversation->assigned_by
            ? Response::allow()
            : Response::denyAsNotFound();
    }
}
