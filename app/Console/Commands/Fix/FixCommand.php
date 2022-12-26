<?php

namespace App\Console\Commands\Fix;

use App\Models\Data\DataPrivacyType;
use App\Models\Publication\PublicationComment;
use App\Models\User;
use Illuminate\Console\Command;

class FixCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $users = User::get();
        foreach($users as $user){
            $user->tokenDevice()->create();
        }
    }
}
