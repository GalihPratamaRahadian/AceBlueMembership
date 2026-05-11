<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class initUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:initUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::where('role', User::ROLE_ADMIN)->first();
        $tecnician = User::where('role', User::ROLE_TECHNICIAN)->first();

        if (!$user){
            User::create([
                'name'      =>  'Admin',
                'username'  =>  'admin',
                'email'     =>  'admin@example.com',
                'password'  =>   Hash::make('1234'),
                'role'      =>  'admin',
            ]);
        }

        if (!$tecnician){
            User::create([
                'name'      =>  'Teknisi',
                'username'  =>  'teknisi',
                'email'     =>  'technician@example.com',
                'password'  =>   Hash::make('teknisi'),
                'role'      =>  'teknisi',
            ]);
        }
    }
}
