<?php

namespace App\Console\Commands;

use App\Client;
use App\Mail\BirthdayWish;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AutoBirthdayWish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        $users = Client::whereMonth('dob', date('m'))
                    ->whereDay('dob', date('d'))
                    ->get();
            dd($users);
        if ($users->count() > 0) {
            foreach ($users as $user) {
                
                Mail::to($user->user->email)->send(new BirthdayWish($user));
            }
        }
        return Command::SUCCESS;
    }
}
