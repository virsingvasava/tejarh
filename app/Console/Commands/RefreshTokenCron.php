<?php

namespace App\Console\Commands;

use App\Models\AccessToken;
use Illuminate\Console\Command;
use DateTime;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class RefreshTokenCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expiredrefreshToken:cron';

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
        $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tryoto.com/rest/v2/refreshToken',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"refresh_token": "AOkPPWRZljv46I7_3LMmVqZovTrVMQ038ibe3eM09a4VLFRdAp77npbFk2gDXlwEHZ956qC-JHnmjLGOcMN9ZmKDr9sVwX6boo2tZL_NG89izBUd45G76RHESQI6xTgWc0IKX_paOigV8B4NIqloAp7rx7KoN4o3ozDFj6D6JaVRT5PyHjDsRhK63HK0xq9YVcS2EARRTwLM00kFnl6d7fT0Q7kNcZRUXw"}',
            CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            $json = json_decode($response, true);
            $access_token = $json['access_token'];
            $refresh_token = $json['refresh_token'];
            $success = $json['success'];
            $token_type = $json['token_type'];
            $expires_in = $json['expires_in'];
             
            
            $insertToken = new AccessToken;
            $insertToken->access_token = $access_token;
            $insertToken->refresh_token = $refresh_token;
            $insertToken->success = $success;
            $insertToken->token_type = $token_type;
            $insertToken->expires_in = $expires_in;
            $insertToken->save();
    }
}
