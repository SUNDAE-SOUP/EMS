<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Puple Bug',
            'email' => 'purple.bug@purplebug.com',
            'role_id' => 1,
            'password' => Hash::make('purplebug'),
            'email_verified_at' => now(),   
        ]);
    }
}
