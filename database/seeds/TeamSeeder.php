<?php

use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
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
