<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Mail::send('email_command',[], function($message){
            $config = config('mail');
            $name = "Arso";
            $message->subject('Renouvellement de mot de passe !')
                    ->from($config['from']['address'], $config['from']['name'])
                    ->to("arsenegnanhoungbe@gmail.com", $name);
        });
    }
}
