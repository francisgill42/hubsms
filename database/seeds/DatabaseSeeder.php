<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(UserSeeder::class);

        $users = [ 
            [
                'master' => 1,
                'first_name' => 'master',
                'middle_name' => '',
                'last_name' => '',
                'email' => 'master@erp.com',
                'password' => bcrypt('secret')
            ]
        ];

        \DB::table('users')->insert($users);
      
    }
}
