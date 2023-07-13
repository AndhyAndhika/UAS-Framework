<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $InputUser = [
            [
                'kode' => "PLNGN050720230000",
                'name' => "Andhika Nur Rohman",
                'email' => "dhikbang@gmail.com",
                'password' => Hash::make('admin'),
                'member' => "vvvip",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        User::insert($InputUser);
    }
}
