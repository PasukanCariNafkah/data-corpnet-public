<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'name' => "NOC CorpNet",
            'email' => 'noc1@megavision.net.id',
            'password' => bcrypt('star_net2016'),
            'created_at' => Carbon::now()
        ];


        User::insert($users);
    }
}
