<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('profiles')->delete();
        
        \DB::table('profiles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'provider' => NULL,
                'provider_unique_id' => NULL,
                'gender' => NULL,
                'avatar' => 'uploads/avatar/5e3327ef7d00b.jpg',
                'phone' => NULL,
                'date_of_birth' => NULL,
                'date_of_anniversary' => NULL,
                'address_line_1' => NULL,
                'address_line_2' => NULL,
                'city' => NULL,
                'state' => NULL,
                'zipcode' => NULL,
                'country_id' => NULL,
                'facebook_profile' => NULL,
                'twitter_profile' => NULL,
                'google_plus_profile' => NULL,
                'linkedin_profile' => NULL,
                'created_at' => '2018-05-03 10:37:13',
                'updated_at' => '2020-01-30 23:01:04',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'first_name' => 'Marry',
                'last_name' => 'Jen',
                'provider' => NULL,
                'provider_unique_id' => NULL,
                'gender' => NULL,
                'avatar' => NULL,
                'phone' => NULL,
                'date_of_birth' => NULL,
                'date_of_anniversary' => NULL,
                'address_line_1' => 'Address Line 1',
                'address_line_2' => 'Address Line 2',
                'city' => 'City',
                'state' => 'State',
                'zipcode' => 'Zipcode',
                'country_id' => '111',
                'facebook_profile' => NULL,
                'twitter_profile' => NULL,
                'google_plus_profile' => NULL,
                'linkedin_profile' => NULL,
                'created_at' => '2018-05-03 10:41:01',
                'updated_at' => '2018-05-03 10:41:01',
            ),
        ));
        
        
    }
}