<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageSendSubscribeUsersMail;

use App\Models\User;
use App\Models\Subscription;

class MessageSendSubscribeUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $to, $subject, $body_messages;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($to, $subject, $body_messages)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->body_messages = $body_messages;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userEmail_get = Subscription::where('email', $this->to)->first();

        $from_address = env('MAIL_FROM_ADDRESS');
        $from_name = env('MAIL_FROM_NAME'); 

        $data = array(
            'receiver_email' => $this->to,
            'subject' => $this->subject,
            'body_message' => $this->body_messages,
        );

        try {

            /*
            $message = new MessageSendSubscribeUsersMail();
            Mail::to($this->to)->send($message, ['data' => $data]);
            */
            
            Mail::send('emails.subscription.subscribe_users_message', ['data' => $data], function($message) use($from_address,$from_name) {
                $message->to( $this->to,  'Tejarh');
                $message->subject('Subscribe and receive latest Tejarh !');
                $message->from($from_address,$from_name);
            });


            $status_success = Subscription::where('email', $userEmail_get->email)->first();
            $status_success->email_send_status = 'Success';
            $status_success->after_subscribed_send_message_status = TRUE;
            $status_success->save();
            
        } catch (Exception $e) {

            $status_fail = Subscription::where('email', $userEmail_get->email)->first();
            $status_fail->email_send_status = 'Fail';
            $status_fail->after_subscribed_send_message_status = FALSE;
            $status_fail->save();
          
        }

    }
}
