<?php

use Illuminate\Database\Seeder;

class ConfigTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('config')->delete();
        
        \DB::table('config')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'color_theme',
                'numeric_value' => NULL,
                'text_value' => 'green',
                'is_private' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'direction',
                'numeric_value' => NULL,
                'text_value' => 'ltr',
                'is_private' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'locale',
                'numeric_value' => NULL,
                'text_value' => 'en',
                'is_private' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'timezone',
                'numeric_value' => NULL,
                'text_value' => 'Africa/Cairo',
                'is_private' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'notification_position',
                'numeric_value' => NULL,
                'text_value' => 'toast-top-right',
                'is_private' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'date_format',
                'numeric_value' => NULL,
                'text_value' => 'DD-MM-YYYY',
                'is_private' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'time_format',
                'numeric_value' => NULL,
                'text_value' => 'H:mm',
                'is_private' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'page_length',
                'numeric_value' => 10,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'driver',
                'numeric_value' => NULL,
                'text_value' => 'log',
                'is_private' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'from_address',
                'numeric_value' => NULL,
                'text_value' => 'hello@example.com',
                'is_private' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'from_name',
                'numeric_value' => NULL,
                'text_value' => 'Hello',
                'is_private' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'token_lifetime',
                'numeric_value' => 120,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'reset_password_token_lifetime',
                'numeric_value' => 120,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'activity_log',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'email_log',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'reset_password',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'registration',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'mode',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'footer_credit',
                'numeric_value' => NULL,
                'text_value' => 'Designed with love by Kamal sroor',
                'is_private' => 0,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'multilingual',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'ip_filter',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'email_template',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'message',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'backup',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'todo',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'show_user_menu',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'show_todo_menu',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'show_message_menu',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'show_configuration_menu',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'show_backup_menu',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'show_email_template_menu',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'show_email_log_menu',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'show_activity_log_menu',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'company_name',
                'numeric_value' => NULL,
                'text_value' => 'Alam Stores',
                'is_private' => 0,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'contact_person',
                'numeric_value' => NULL,
                'text_value' => 'John Doe',
                'is_private' => 0,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'address_line_1',
                'numeric_value' => NULL,
                'text_value' => 'Address Line 1',
                'is_private' => 0,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'address_line_2',
                'numeric_value' => NULL,
                'text_value' => 'Address Line 2',
                'is_private' => 0,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'city',
                'numeric_value' => NULL,
                'text_value' => 'City',
                'is_private' => 0,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'state',
                'numeric_value' => NULL,
                'text_value' => 'State',
                'is_private' => 0,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'zipcode',
                'numeric_value' => NULL,
                'text_value' => 'Zipcode',
                'is_private' => 0,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'country',
                'numeric_value' => NULL,
                'text_value' => 'Country',
                'is_private' => 0,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'phone',
                'numeric_value' => NULL,
                'text_value' => 'Phone',
                'is_private' => 0,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'fax',
                'numeric_value' => NULL,
                'text_value' => 'Fax',
                'is_private' => 0,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'email',
                'numeric_value' => NULL,
                'text_value' => 'hello@scriptmint.com',
                'is_private' => 0,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'website',
                'numeric_value' => NULL,
                'text_value' => 'https://scriptmint.com',
                'is_private' => 0,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'password_strength_meter',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'email_verification',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'account_approval',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'terms_and_conditions',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'two_factor_security',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'recaptcha',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'recaptcha_key',
                'numeric_value' => NULL,
                'text_value' => '',
                'is_private' => 0,
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'recaptcha_secret',
                'numeric_value' => NULL,
                'text_value' => '',
                'is_private' => 0,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'login_recaptcha',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'reset_password_recaptcha',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'register_recaptcha',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'social_login',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'lock_screen',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'lock_screen_timeout',
                'numeric_value' => 5,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'login_throttle',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'login_throttle_attempt',
                'numeric_value' => 5,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'login_throttle_timeout',
                'numeric_value' => 10,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'https',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'error_display',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'maintenance_mode',
                'numeric_value' => 0,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'maintenance_mode_message',
                'numeric_value' => NULL,
                'text_value' => 'The system is under maintenance.',
                'is_private' => 0,
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'sidebar_logo',
                'numeric_value' => NULL,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'github_login',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'github_client',
                'numeric_value' => NULL,
                'text_value' => '07909dbb97bbf578d4ad',
                'is_private' => 1,
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'github_secret',
                'numeric_value' => NULL,
                'text_value' => '815e2562a36410e681c5f86bed3e15f8a9ec345b',
                'is_private' => 1,
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'github_redirect_url',
                'numeric_value' => NULL,
                'text_value' => 'https://laravue.scriptmint.com/auth/github/callback',
                'is_private' => 0,
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'social_login',
                'numeric_value' => 1,
                'text_value' => NULL,
                'is_private' => 0,
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'sidebar',
                'numeric_value' => NULL,
                'text_value' => 'mini',
                'is_private' => 0,
            ),
        ));
        
        
    }
}