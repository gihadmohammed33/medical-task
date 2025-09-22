<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email'=>'admin1@example.com'],
            ['name'=>'Admin','password'=>Hash::make('password1'),'role'=>'admin']
        );
    }
}
