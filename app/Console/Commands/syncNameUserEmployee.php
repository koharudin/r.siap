<?php

namespace App\Console\Commands;

use App\Models\Administrator;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Console\Command;

class syncNameUserEmployee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:name-user-employee';

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
        $this->info("Test");
        $list_users = Administrator::all();
        $list_users->each(function($user){
            $this->info("User ".$user->name);
            $emp = Employee::where("nip_baru",$user->username)->get()->first();
            if($emp){
                $user->name = $emp->first_name;
                $user->save();
            }
        });
        return 0;
    }
}
