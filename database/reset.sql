-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 24, 2019 at 02:37 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravue`
--

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `numeric_value`, `text_value`, `is_private`) VALUES
(1, 'color_theme', NULL, 'green', 0),
(2, 'direction', NULL, 'ltr', 0),
(3, 'locale', NULL, 'en', 0),
(4, 'timezone', NULL, 'Asia/Kolkata', 0),
(5, 'notification_position', NULL, 'toast-bottom-right', 0),
(6, 'date_format', NULL, 'DD-MM-YYYY', 0),
(7, 'time_format', NULL, 'H:mm', 0),
(8, 'page_length', 10, NULL, 0),
(9, 'driver', NULL, 'log', 0),
(10, 'from_address', NULL, 'hello@example.com', 0),
(11, 'from_name', NULL, 'Hello', 0),
(12, 'token_lifetime', 120, NULL, 0),
(13, 'reset_password_token_lifetime', 30, NULL, 0),
(14, 'activity_log', 1, NULL, 0),
(15, 'email_log', 1, NULL, 0),
(16, 'reset_password', 1, NULL, 0),
(17, 'registration', 1, NULL, 0),
(18, 'mode', 0, NULL, 0),
(19, 'footer_credit', NULL, 'Designed with love by ScriptMint', 0),
(20, 'multilingual', 1, NULL, 0),
(21, 'ip_filter', 1, NULL, 0),
(22, 'email_template', 1, NULL, 0),
(23, 'message', 1, NULL, 0),
(24, 'backup', 1, NULL, 0),
(25, 'todo', 1, NULL, 0),
(26, 'show_user_menu', 1, NULL, 0),
(27, 'show_todo_menu', 1, NULL, 0),
(28, 'show_message_menu', 1, NULL, 0),
(29, 'show_configuration_menu', 1, NULL, 0),
(30, 'show_backup_menu', 1, NULL, 0),
(31, 'show_email_template_menu', 1, NULL, 0),
(32, 'show_email_log_menu', 1, NULL, 0),
(33, 'show_activity_log_menu', 1, NULL, 0),
(34, 'company_name', NULL, 'ScriptMint', 0),
(35, 'contact_person', NULL, 'John Doe', 0),
(36, 'address_line_1', NULL, 'Address Line 1', 0),
(37, 'address_line_2', NULL, 'Address Line 2', 0),
(38, 'city', NULL, 'City', 0),
(39, 'state', NULL, 'State', 0),
(40, 'zipcode', NULL, 'Zipcode', 0),
(41, 'country', NULL, 'Country', 0),
(42, 'phone', NULL, 'Phone', 0),
(43, 'fax', NULL, 'Fax', 0),
(44, 'email', NULL, 'hello@scriptmint.com', 0),
(45, 'website', NULL, 'https://scriptmint.com', 0),
(46, 'password_strength_meter', 1, NULL, 0),
(47, 'email_verification', 1, NULL, 0),
(48, 'account_approval', 1, NULL, 0),
(49, 'terms_and_conditions', 1, NULL, 0),
(50, 'two_factor_security', 0, NULL, 0),
(51, 'recaptcha', 0, NULL, 0),
(52, 'recaptcha_key', NULL, '', 0),
(53, 'recaptcha_secret', NULL, '', 0),
(54, 'login_recaptcha', 0, NULL, 0),
(55, 'reset_password_recaptcha', 0, NULL, 0),
(56, 'register_recaptcha', 0, NULL, 0),
(57, 'social_login', 0, NULL, 0),
(58, 'lock_screen', 1, NULL, 0),
(59, 'lock_screen_timeout', 5, NULL, 0),
(60, 'login_throttle', 1, NULL, 0),
(61, 'login_throttle_attempt', 5, NULL, 0),
(62, 'login_throttle_timeout', 10, NULL, 0),
(63, 'https', 1, NULL, 0),
(64, 'error_display', 0, NULL, 0),
(65, 'maintenance_mode', 0, NULL, 0),
(66, 'maintenance_mode_message', NULL, 'The system is under maintenance.', 0),
(67, 'sidebar_logo', NULL, NULL, 0),
(68, 'github_login', 1, NULL, 0),
(69, 'github_client', NULL, '07909dbb97bbf578d4ad', 1),
(70, 'github_secret', NULL, '815e2562a36410e681c5f86bed3e15f8a9ec345b', 1),
(71, 'github_redirect_url', NULL, 'https://laravue.scriptmint.com/auth/github/callback', 0),
(72, 'social_login', 1, NULL, 0),
(73, 'sidebar', NULL, 'mini', 0);

--
-- Dumping data for table `email_logs`
--

INSERT INTO `email_logs` (`id`, `module`, `module_id`, `to_address`, `from_address`, `subject`, `body`, `created_at`, `updated_at`) VALUES
(1, 'user', '2', 'marry.jen@example.com', 'hello@example.com', 'Welcome Email User | ScriptMint', '<div style=\"margin:0px; background: #f8f8f8; \">\r\n  <div width=\"100%\" style=\"background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;\">\r\n    <div style=\"max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px\">\r\n      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%; margin-bottom: 20px\">\r\n        <tbody>\r\n          <tr>\r\n            <td style=\"vertical-align: top; padding-bottom:30px;\" align=\"center\"><img src=\"http://laravue/images/default_main_logo.png\"></td>\r\n          </tr>\r\n          <tr>\r\n            <td><h5 style=\"text-align:center;\">Account Created</h5></td>\r\n          </tr>\r\n        </tbody>\r\n      </table>\r\n      <div style=\"padding: 40px; background: #fff;\">\r\n        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">\r\n          <tbody>\r\n            <tr>\r\n              <td style=\"border-bottom:1px solid #f6f6f6;\"><h1 style=\"font-size:14px; font-family:arial; margin:0px; font-weight:bold;\">Dear Marry Jen,</h1>\r\n                <p style=\"margin-top:0px; color:#bbbbbb;\">Welcome to our company. Your account has been created. Please use below credentials to log into your account:</p><table class=\"table table-bordered\"><tbody><tr><td>Email</td><td>marry.jen@example.com</td></tr><tr><td>Password</td><td>abcd1234</td></tr></tbody></table><p style=\"margin-top:0px; color:#bbbbbb;\"><br></p></td>\r\n            </tr>\r\n            <tr>\r\n              <td style=\"padding:10px 0 30px 0;\"><p>Have a Good Day!</p>\r\n                <b>- Best Wishes (ScriptMint)</b> </td>\r\n            </tr>\r\n          </tbody>\r\n        </table>\r\n      </div>\r\n      <div style=\"text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px\">\r\n        <p> ScriptMint <br>\r\n        hello@scriptmint.com | Phone | https://scriptmint.com</p>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n', '2018-05-03 08:41:01', '2018-05-03 08:41:01');

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `is_default`, `name`, `slug`, `category`, `subject`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 'Welcome Email User', 'welcome-email-user', 'user', 'Welcome Email User | [COMPANY_NAME]', '<div style=\"margin:0px; background: #f8f8f8; \">\r\n  <div width=\"100%\" style=\"background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;\">\r\n    <div style=\"max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px\">\r\n      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%; margin-bottom: 20px\">\r\n        <tbody>\r\n          <tr>\r\n            <td style=\"vertical-align: top; padding-bottom:30px;\" align=\"center\">[COMPANY_LOGO]</td>\r\n          </tr>\r\n          <tr>\r\n            <td><h5 style=\"text-align:center;\">Account Created</h5></td>\r\n          </tr>\r\n        </tbody>\r\n      </table>\r\n      <div style=\"padding: 40px; background: #fff;\">\r\n        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">\r\n          <tbody>\r\n            <tr>\r\n              <td style=\"border-bottom:1px solid #f6f6f6;\"><h1 style=\"font-size:14px; font-family:arial; margin:0px; font-weight:bold;\">Dear [NAME],</h1>\r\n                <p style=\"margin-top:0px; color:#bbbbbb;\">Welcome to our company. Your account has been created. Please use below credentials to log into your account:</p><table class=\"table table-bordered\"><tbody><tr><td>Email</td><td>[EMAIL]</td></tr><tr><td>Password</td><td>[PASSWORD]</td></tr></tbody></table><p style=\"margin-top:0px; color:#bbbbbb;\"><br></p></td>\r\n            </tr>\r\n            <tr>\r\n              <td style=\"padding:10px 0 30px 0;\"><p>Have a Good Day!</p>\r\n                <b>- Best Wishes ([COMPANY_NAME])</b> </td>\r\n            </tr>\r\n          </tbody>\r\n        </table>\r\n      </div>\r\n      <div style=\"text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px\">\r\n        <p> [COMPANY_NAME] <br>\r\n        [COMPANY_EMAIL] | [COMPANY_PHONE] | [COMPANY_WEBSITE]</p>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n', NULL, NULL),
(2, 1, 'Anniversary Email User', 'anniversary-email-user', 'user', 'Wish You a Very Happy Anniversary [NAME] | [COMPANY_NAME]', '<div style=\"margin:0px; background: #f8f8f8; \">\r\n  <div width=\"100%\" style=\"background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;\">\r\n    <div style=\"max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px\">\r\n      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%; margin-bottom: 20px\">\r\n        <tbody>\r\n          <tr>\r\n            <td style=\"vertical-align: top; padding-bottom:30px;\" align=\"center\">[COMPANY_LOGO]</td>\r\n          </tr>\r\n          <tr>\r\n            <td><h5 style=\"text-align:center;\">Happy Anniversary</h5></td>\r\n          </tr>\r\n        </tbody>\r\n      </table>\r\n      <div style=\"padding: 40px; background: #fff;\">\r\n        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">\r\n          <tbody>\r\n            <tr>\r\n              <td style=\"border-bottom:1px solid #f6f6f6;\"><h1 style=\"font-size:14px; font-family:arial; margin:0px; font-weight:bold;\">Dear [NAME],</h1>\r\n                <p style=\"margin-top:0px; color:#bbbbbb;\">We wish you a Very Happy Anniversary.</p></td>\r\n            </tr>\r\n            <tr>\r\n              <td style=\"padding:10px 0 30px 0;\"><p>Have a Good Day!</p>\r\n                <b>- Best Wishes ([COMPANY_NAME])</b> </td>\r\n            </tr>\r\n          </tbody>\r\n        </table>\r\n      </div>\r\n      <div style=\"text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px\">\r\n        <p> [COMPANY_NAME] <br>\r\n        [COMPANY_EMAIL] | [COMPANY_PHONE] | [COMPANY_WEBSITE]</p>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n', NULL, NULL),
(3, 1, 'Birthday Email User', 'birthday-email-user', 'user', 'Happy Birthday [NAME] | [COMPANY_NAME]', '<div style=\"margin:0px; background: #f8f8f8; \">\r\n  <div width=\"100%\" style=\"background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;\">\r\n    <div style=\"max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px\">\r\n      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%; margin-bottom: 20px\">\r\n        <tbody>\r\n          <tr>\r\n            <td style=\"vertical-align: top; padding-bottom:30px;\" align=\"center\">[COMPANY_LOGO]</td>\r\n          </tr>\r\n          <tr>\r\n            <td><h5 style=\"text-align:center;\">Happy Birthday</h5></td>\r\n          </tr>\r\n        </tbody>\r\n      </table>\r\n      <div style=\"padding: 40px; background: #fff;\">\r\n        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">\r\n          <tbody>\r\n            <tr>\r\n              <td style=\"border-bottom:1px solid #f6f6f6;\"><h1 style=\"font-size:14px; font-family:arial; margin:0px; font-weight:bold;\">Dear [NAME],</h1>\r\n                <p style=\"margin-top:0px; color:#bbbbbb;\">We wish you a Very Happy Birthday.</p></td>\r\n            </tr>\r\n            <tr>\r\n              <td style=\"padding:10px 0 30px 0;\"><p>Have a Good Day!</p>\r\n                <b>- Best Wishes ([COMPANY_NAME])</b> </td>\r\n            </tr>\r\n          </tbody>\r\n        </table>\r\n      </div>\r\n      <div style=\"text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px\">\r\n        <p> [COMPANY_NAME] <br>\r\n        [COMPANY_EMAIL] | [COMPANY_PHONE] | [COMPANY_WEBSITE]</p>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n', NULL, NULL);

--
-- Dumping data for table `locales`
--

INSERT INTO `locales` (`id`, `name`, `locale`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', '2018-05-03 03:06:06', '2018-05-03 03:06:06');

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `uuid`, `is_draft`, `from_user_id`, `to_user_id`, `subject`, `body`, `is_important_by_sender`, `is_important_by_receiver`, `is_read`, `is_deleted_by_sender`, `is_deleted_by_receiver`, `reply_id`, `has_attachment`, `upload_token`, `created_at`, `updated_at`) VALUES
(1, 'e7489275-4d69-473c-88fa-4c76644e1d75', 0, 1, 2, 'How it works?', '<p>Hi Marry,</p><p>Lets see how message module is working. Let me know if you get any messages!</p>', 0, 1, 0, 0, 0, NULL, 1, 'e3e11d2b-3992-4a94-9e7f-e76c2bef7a35', '2018-05-03 08:43:10', '2018-05-03 08:44:37'),
(2, '6d664f51-b850-4eb3-93da-6f34e3acdaba', 0, 2, 1, 'Re: How it works?', '<p>Hey John,</p><p>Its awesome. I got the message with attachment.</p>', 0, 0, 0, 0, 0, 1, 0, '27ce03c8-1f1c-4599-adbf-9a13fc03704f', '2018-05-03 08:44:34', '2018-05-03 08:44:34');

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2);

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'access-configuration', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(2, 'list-user', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(3, 'create-user', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(4, 'edit-user', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(5, 'delete-user', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(6, 'force-reset-user-password', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(7, 'email-user', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(8, 'change-status-user', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(9, 'access-message', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(10, 'access-todo', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(11, 'enable-login', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06');

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `first_name`, `last_name`, `provider`, `provider_unique_id`, `gender`, `avatar`, `phone`, `date_of_birth`, `date_of_anniversary`, `address_line_1`, `address_line_2`, `city`, `state`, `zipcode`, `country_id`, `facebook_profile`, `twitter_profile`, `google_plus_profile`, `linkedin_profile`, `created_at`, `updated_at`) VALUES
(1, 1, 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-03 08:37:13', '2018-05-03 08:37:13'),
(2, 2, 'Marry', 'Jen', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Address Line 1', 'Address Line 2', 'City', 'State', 'Zipcode', '111', NULL, NULL, NULL, NULL, '2018-05-03 08:41:01', '2018-05-03 08:41:01');

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06'),
(2, 'user', 'api', '2018-05-03 03:06:06', '2018-05-03 03:06:06');

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2);

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `user_id`, `title`, `description`, `status`, `date`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sample Todo', 'This is sample todo.', 0, '2018-05-08', NULL, '2018-05-03 08:41:45', '2018-05-03 08:41:45'),
(2, 1, 'Another Sample Todo', 'Lets make it completed.', 1, '2018-04-20', '2018-05-03 14:12:04', '2018-05-03 08:42:01', '2018-05-03 08:42:04');

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `uuid`, `user_id`, `module`, `module_id`, `upload_token`, `user_filename`, `filename`, `is_temp_delete`, `status`, `created_at`, `updated_at`) VALUES
(1, '7bd24b17-cbf0-47b5-ae25-8f3132662e1a', 1, 'message', 1, 'e3e11d2b-3992-4a94-9e7f-e76c2bef7a35', 'Test pdf.pdf', 'uploads/message/4GOxm6oQUvS7BOqHb0o48SGf50fYH6l6A2dlRNuc.pdf', 0, 1, '2018-05-03 08:43:08', '2018-05-03 08:43:10');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `activation_token`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'john.doe@example.com', '$2y$10$gYHGhoDA2XMNlF6Kb4uZBenZZRfX6wJXIw8iMCWL73vDEtC8oYjBm', '0f9a307b-012c-4acf-a3e4-388e6f75d1a5', 'activated', NULL, '2018-05-03 08:37:13', '2019-07-24 13:13:41'),
(2, 'marry.jen@example.com', '$2y$10$YYnTaxzt0jCCRYcaeAikFuZsuoWTBc5BhyfnjENfaMXexuX/S/fAq', 'c86a2828-e154-42af-a7b3-67eca276bf3b', 'activated', NULL, '2018-05-03 08:41:01', '2019-07-24 13:14:51');

--
-- Dumping data for table `user_preferences`
--

INSERT INTO `user_preferences` (`id`, `user_id`, `locale`, `sidebar`, `direction`, `color_theme`, `created_at`, `updated_at`) VALUES
(1, 1, 'en', 'mini', 'ltr', 'green', '2018-05-03 08:37:13', '2019-07-24 13:13:49'),
(2, 2, NULL, NULL, NULL, NULL, '2018-05-03 08:41:01', '2018-05-03 08:41:01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
