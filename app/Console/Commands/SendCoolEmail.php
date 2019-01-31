<?php

namespace App\Console\Commands;

use SendGrid;
use Illuminate\Console\Command;

class SendCoolEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newYear';

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
     * @return mixed
     */
    public function handle()
    {
    $from = new SendGrid\Email('Beacon Systems','no-reply@beacons-bay.com');
      $subject = "Testing";
      $to = new SendGrid\Email('Kevin','david.ngu@beaconsbay.com');
      
      $content = new SendGrid\Content('text/html',"
        Testing Email.
      ");

      $mail = new SendGrid\Mail($from, $subject, $to, $content);
      $apiKey = env('SENDGRID_API_KEY');
      $sg = new \SendGrid($apiKey);

      $response = $sg->client->mail()->send()->post($mail);
      echo $response->statusCode();
      print_r($response->headers());
      echo $response->body();

    }
}
