<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 12,
                'name' => 'access-user',
                'label' => 'التحكم بالاعضاء',
                'guard_name' => 'api',
                'created_at' => '2020-01-30 20:39:33',
                'updated_at' => '2020-01-30 20:39:33',
            ),
            1 => 
            array (
                'id' => 14,
                'name' => 'access-configuration',
                'label' => 'التحكم بالاعدادات',
                'guard_name' => 'api',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 16,
                'name' => 'create-user',
                'label' => 'اضافة عضو',
                'guard_name' => 'api',
                'created_at' => '2020-01-30 22:57:14',
                'updated_at' => '2020-01-30 22:57:14',
            ),
            3 => 
            array (
                'id' => 17,
                'name' => 'edit-user',
                'label' => 'تعديل الاعضاء',
                'guard_name' => 'api',
                'created_at' => '2020-01-30 22:59:06',
                'updated_at' => '2020-01-30 22:59:06',
            ),
            4 => 
            array (
                'id' => 18,
                'name' => 'delete-user',
                'label' => 'حذف الاعضاء',
                'guard_name' => 'api',
                'created_at' => '2020-01-30 22:59:26',
                'updated_at' => '2020-01-30 22:59:26',
            ),
        ));
        
        
    }
}