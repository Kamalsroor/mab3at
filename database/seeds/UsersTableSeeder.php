<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'email' => 'john.doe@example.com',
                'password' => '$2y$10$cvrJtS0aPOEmTl2AQyEYl.wE/TYtfyViWk2Nux5E7qxhnK3C1ZHmq',
                'activation_token' => '0f9a307b-012c-4acf-a3e4-388e6f75d1a5',
                'status' => 'activated',
                'remember_token' => NULL,
                'created_at' => '2018-05-03 10:37:13',
                'updated_at' => '2019-07-24 15:13:41',
            ),
            1 => 
            array (
                'id' => 2,
                'email' => 'marry.jen@example.com',
                'password' => '$2y$10$YYnTaxzt0jCCRYcaeAikFuZsuoWTBc5BhyfnjENfaMXexuX/S/fAq',
                'activation_token' => 'c86a2828-e154-42af-a7b3-67eca276bf3b',
                'status' => 'activated',
                'remember_token' => NULL,
                'created_at' => '2018-05-03 10:41:01',
                'updated_at' => '2019-07-24 15:14:51',
            ),
        ));
        
        
    }
}