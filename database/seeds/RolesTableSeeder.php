<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'guard_name' => 'api',
                'created_at' => '2018-05-03 05:06:06',
                'updated_at' => '2018-05-03 05:06:06',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'user',
                'guard_name' => 'api',
                'created_at' => '2018-05-03 05:06:06',
                'updated_at' => '2018-05-03 05:06:06',
            ),
        ));
        
        
    }
}