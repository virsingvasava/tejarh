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

class PasswordresetEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $userUnique, $userOTP;
  
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userUnique, $userOTP)
    {
        $this->userUnique = $userUnique;
        $this->userOTP = $userOTP;

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
        $token = generateRandomToken(40);
        $url = route('frontend.users.site.index','resetpassword/?token='.$this->userOTP->token);        
        $data = array('name'=>  $this->userUnique->first_name, 'url' => $url, 'OTP' => $this->userOTP->OTP, 'email' =>  $this->userUnique->email);
        Mail::send('frontend.users.mails.reset_link', $data, function($message) use($from_address,$from_name) {
            $message->to( $this->userUnique->email,  $this->userUnique->first_name);
            $message->subject('Password reset request');
            $message->from($from_address,$from_name);
        });
    }
}
