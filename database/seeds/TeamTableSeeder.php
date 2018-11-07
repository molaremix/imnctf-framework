<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'name' => 'ImnTeam',
            'email' => 'team@imnctf.com',
            'password' => bcrypt('password'),
            'verified' => true,
        ]);
    }
}
