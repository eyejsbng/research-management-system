<?php

use Illuminate\Database\Seeder;
use App\User;
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
        User::create([
            'name' => 'Meljhon Aborde',
            'email' => 'ccerms@gmail.com',
            'password' => Hash::make('administrator'),
            'specialty' => 'Programmer',
            'typ_id' => 1,
            'crs_id' => 1,
            'us_id' => 1
        ]);
        User::create([
            'name' => 'Dummy for Groups',
            'email' => 'dummy@gmail.com',
            'password' => Hash::make('dummy101'),
            'specialty' => 'Programmer',
            'typ_id' => 3,
            'crs_id' => 1,
            'us_id' => 3
        ]);
    }
}
