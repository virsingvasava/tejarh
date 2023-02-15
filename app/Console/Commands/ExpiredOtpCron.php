<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ExpiredOtpCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expiredotp:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dat = Carbon::now();


        $newDateTime = Carbon::now()->addMinute(-5);
        DB::table('user_otp')->where('created_at',"<=",$newDateTime)->update(["OTP" => "NULL"]);;
    }
}
