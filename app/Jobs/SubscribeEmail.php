<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Models\User;
use App\Models\Subscription;


class SubscribeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $username, $password;
  
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {        
        $from_address = env('MAIL_FROM_ADDRESS');
        $from_name = env('MAIL_FROM_NAME'); 
        $userEmail_get = Subscription::where('email', $this->username)->first();

        $data = array(
            'email' =>  $this->username,
            'pwd' =>  $this->password,
        );

        try {

            Mail::send('emails.subscription.subscribe_email', ['data' => $data], function($message) use($from_address,$from_name) {
                $message->to( $this->username,  'Tejarh');
                $message->subject('Subscribe and receive latest Tejarh !');
                $message->from($from_address,$from_name);
            });

            $success = Subscription::where('email', $userEmail_get->email)->first();
            $success->email_send_status = 'Success';
            $success->save();
            
        } catch (Exception $e) {

            $fail = Subscription::where('email', $userEmail_get->email)->first();
            $fail->email_send_status = 'Fail';
            $fail->save();
          
        }
        
    }
}