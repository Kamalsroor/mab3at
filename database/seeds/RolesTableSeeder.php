<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert([
            [
                'name' => 'access-configuration',
                'label' => 'التحكم بالاعدادات',
                'guard_name' => 'api',
            ],
            [
                'name' => 'access-user',
                'label' => 'التحكم بالاعضاء',
                'guard_name' => 'api',
            ],
            [
                'name' => 'create-user',
                'label' => 'اضافة اعضاء',
                'guard_name' => 'api',
            ],
            [
                'name' => 'edit-user',
                'label' => 'تعديل اعضاء',
                'guard_name' => 'api',
            ],
            [
                'name' => 'delete-user',
                'label' => 'حذف اعضاء',
                'guard_name' => 'api',
            ],
            [
                'name' => 'access-branch',
                'label' => 'التحكم بالفروع',
                'guard_name' => 'api',
            ],
            [
                'name' => 'create-branch',
                'label' => 'اضافة الفروع',
                'guard_name' => 'api',
            ],
            [
                'name' => 'edit-branch',
                'label' => 'تعديل الفروع',
                'guard_name' => 'api',
            ],
            [
                'name' => 'delete-branch',
                'label' => 'حذف الفروع',
                'guard_name' => 'api',
            ],
            [
                'name' => 'access-customer',
                'label' => 'التحكم بالعملاء',
                'guard_name' => 'api',
            ],
            [
                'name' => 'create-customer',
                'label' => 'اضافة العملاء',
                'guard_name' => 'api',
            ],
            [
                'name' => 'edit-customer',
                'label' => 'تعديل العملاء',
                'guard_name' => 'api',
            ],
            [
                'name' => 'delete-customer',
                'label' => 'حذف العملاء',
                'guard_name' => 'api',
            ],
            [
                'name' => 'access-group',
                'label' => 'التحكم بالمجموعات',
                'guard_name' => 'api',
            ],
            [
                'name' => 'create-group',
                'label' => 'اضافة المجموعات',
                'guard_name' => 'api',
            ],
            [
                'name' => 'edit-group',
                'label' => 'تعديل المجموعات',
                'guard_name' => 'api',
            ],
            [
                'name' => 'delete-group',
                'label' => 'حذف المجموعات',
                'guard_name' => 'api',
            ],
            [
                'name' => 'access-category',
                'label' => 'التحكم بالفئات',
                'guard_name' => 'api',
            ],
            [
                'name' => 'create-category',
                'label' => 'اضافة الفئات',
                'guard_name' => 'api',
            ],
            [
                'name' => 'edit-category',
                'label' => 'تعديل الفئات',
                'guard_name' => 'api',
            ],
            [
                'name' => 'delete-category',
                'label' => 'حذف الفئات',
                'guard_name' => 'api',
            ],
        ]);


        \DB::table('roles')->delete();
        \DB::table('roles')->insert([
            [
                'name' => 'الاداره',
                'guard_name' => 'api',
            ],
            [
                'name' => 'user',
                'guard_name' => 'api',
            ],
        ]);
        $Role = Role::find(1)->syncPermissions(permission::all()->pluck('name')->all());
        
        
    }
}