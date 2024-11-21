<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AuthTrait;
use App\Models\HealthcareEntity;
use App\Models\Message;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Exception;
use App\Events\MessageReceived;

class ChatController extends Controller
{
    use AuthTrait;
    public function send_message_to(Request $request , $receiver_id , $type)
    {
            Try
            {
                $message = Message::create([
                    'sender_id'     => $this->get_current_auth()->id,
                    'receiver_id'   => $receiver_id,
                    'sender_type'   => ($this->get_current_auth() instanceof HealthcareEntity) ? 'healthcare' : 'patient',
                    'content'       => $request->get('content'),
                    'receiver_type' => $type
                ]);

                event(new MessageReceived($message));
                if($request->hasFile('file'))
                {
                    $message->addMedia($request->file('file'))->toMediaCollection('file');

                }

            }catch (Exception $exception)
            {
                flash('Message Has Not been Sent ' , ['alert alert-warning']);
            }
            return redirect()->back();
    }
}
