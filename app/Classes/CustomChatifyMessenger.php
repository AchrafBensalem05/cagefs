<?php

namespace App\Classes;

use App\Http\Controllers\Traits\AuthTrait;
use App\Models\ChMessage as Message;
use Chatify\ChatifyMessenger;
use Illuminate\Support\Facades\Auth;

class CustomChatifyMessenger extends ChatifyMessenger
{
    use AuthTrait;
    public function makeSeen($user_id)
    {
        Message::Where('from_id', $user_id)
            ->where('to_id', $this->get_current_auth()->id)
            ->where('seen', 0)
            ->update(['seen' => 1]);
        return 1;
    }

    public function fetchMessagesQuery($user_id)
    {
        return Message::where('from_id', $this->get_current_auth()->id)->where('to_id', $user_id)
            ->orWhere('from_id', $user_id)->where('to_id', Auth::user()->id);
    }
}
