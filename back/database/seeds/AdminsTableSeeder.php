<?php

use Illuminate\Database\Seeder;
use App\Admins;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admins::create([
            'username' => 'alishkeir',
            'email' => 'ali_shkeir1996@hotmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
