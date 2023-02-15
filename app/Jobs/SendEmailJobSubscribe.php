<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailSubscribe;

use App\Models\User;
use App\Models\Subscription;

class SendEmailJobSubscribe implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendEmailSubscribe();
        $userEmail_get = Subscription::where('email', $_POST['email'])->first();

        try {

            Mail::to($_POST['email'])->send($email);

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
