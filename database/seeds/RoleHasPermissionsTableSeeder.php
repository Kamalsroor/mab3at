<?php

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 12,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 14,
                'role_id' => 1,
            ),
            2 => 
            array (
                'permission_id' => 16,
                'role_id' => 1,
            ),
            3 => 
            array (
                'permission_id' => 17,
                'role_id' => 1,
            ),
            4 => 
            array (
                'permission_id' => 12,
                'role_id' => 2,
            ),
        ));
        
        
    }
}