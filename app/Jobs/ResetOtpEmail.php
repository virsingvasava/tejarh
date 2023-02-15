<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class ResetOtpEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $user,$randomNumber;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user,$randomNumber)
    {
        $this->user = $user;
        $this->randomNumber = $randomNumber;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd($this->randomNumber);
        // Mail::to('monika@sevensquaretech.com')->send('hello');
        $from_address = env('MAIL_FROM_ADDRESS');
        $from_name = env('MAIL_FROM_NAME');
        $data = array('name'=> $this->user->first_name, 'OTP' => $this->randomNumber);                  
        Mail::send('frontend.users.mails.reset_otp', $data, function($message) use($from_address,$from_name) {
            $message->to($this->user->email, $this->user->first_name);
            $message->subject('OTP resend');
            $message->from($from_address,$from_name);
        });
        
    }
}
