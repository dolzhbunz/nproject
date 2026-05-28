<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    protected $signature = 'user:create {name} {email} {password} {role=member}';
    protected $description = 'Create a new user';

    public function handle()
    {
        $user = User::create([
            'name' => $this->argument('name'),
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
            'role' => $this->argument('role'),
        ]);

        $this->info("User {$user->email} created successfully!");
        return Command::SUCCESS;
    }
}
