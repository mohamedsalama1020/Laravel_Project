<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'user expire';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('expire',0)->get();
        foreach($users as $usr){

            $usr->update(['expire'=>1]);
        }
    }
}
