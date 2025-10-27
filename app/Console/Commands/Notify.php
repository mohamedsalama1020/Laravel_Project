<?php

namespace App\Console\Commands;

use App\Mail\Notify as MailNotify;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'email notify';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emails = User::pluck('email')->toArray();

        $data = ['title' => 'programming','body' => 'laravel'];

        foreach($emails as $e){

            Mail::to($e)->send(new MailNotify($data));
        }
    }
}
