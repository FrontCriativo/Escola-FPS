<?php

namespace App\Support;

use App\Models\EmailLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AdminEmail
{
    public static function send(User $recipient, string $subject, string $body): EmailLog
    {
        try {
            Mail::raw($body, function ($message) use ($recipient, $subject) {
                $message->to($recipient->email, $recipient->name)->subject($subject);
            });

            return EmailLog::create([
                'sender_id' => Auth::id(),
                'recipient_id' => $recipient->id,
                'recipient_email' => $recipient->email,
                'subject' => $subject,
                'body' => $body,
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        } catch (Throwable $exception) {
            return EmailLog::create([
                'sender_id' => Auth::id(),
                'recipient_id' => $recipient->id,
                'recipient_email' => $recipient->email,
                'subject' => $subject,
                'body' => $body,
                'status' => 'failed',
                'error' => $exception->getMessage(),
                'sent_at' => now(),
            ]);
        }
    }
}
