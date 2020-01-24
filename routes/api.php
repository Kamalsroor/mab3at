<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/check', 'AuthController@check');
    Route::post('/register', 'AuthController@register');
    Route::get('/activate/{token}', 'AuthController@activate');
    Route::post('/password', 'AuthController@password');
    Route::post('/validate-password-reset', 'AuthController@validatePasswordReset');
    Route::post('/reset', 'AuthController@reset');
    Route::post('/social/token', 'SocialLoginController@getToken');
});

Route::get('/configuration/variable', 'ConfigurationController@getConfigurationVariable');

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('/auth/refresh', 'AuthController@refresh');
    Route::post('/auth/me', 'AuthController@me');
    Route::post('/auth/logout', 'AuthController@logout');
    Route::post('/auth/lock', 'AuthController@lock');
    Route::get('/user/preference/pre-requisite', 'UserController@preferencePreRequisite');
    Route::post('/user/preference', 'UserController@preference');
    Route::post('/demo/message', 'HomeController@demoMessage');

    Route::post('/change-password', 'AuthController@changePassword');

    Route::post('/upload', 'UploadController@upload');
    Route::post('/upload/extension', 'UploadController@getAllowedExtension');
    Route::post('/upload/image', 'UploadController@uploadImage');
    Route::post('/upload/fetch', 'UploadController@fetch');
    Route::post('/upload/{id}', 'UploadController@destroy');

    Route::get('/dashboard', 'HomeController@dashboard');

    Route::get('/configuration', 'ConfigurationController@index');
    Route::post('/configuration', 'ConfigurationController@store');
    Route::post('/configuration/logo/{type}', 'ConfigurationController@uploadLogo');
    Route::delete('/configuration/logo/{type}/remove', 'ConfigurationController@removeLogo');
    Route::get('/fetch/lists', 'ConfigurationController@fetchList');

    Route::post('/backup', 'BackupController@store');
    Route::get('/backup', 'BackupController@index');
    Route::delete('/backup/{id}', 'BackupController@destroy');

    Route::get('/locale', 'LocaleController@index');
    Route::post('/locale', 'LocaleController@store');
    Route::get('/locale/{id}', 'LocaleController@show');
    Route::patch('/locale/{id}', 'LocaleController@update');
    Route::delete('/locale/{id}', 'LocaleController@destroy');
    Route::post('/locale/fetch', 'LocaleController@fetch');
    Route::post('/locale/translate', 'LocaleController@translate');
    Route::post('/locale/add-word', 'LocaleController@addWord');

    Route::get('/role', 'RoleController@index');
    Route::get('/role/{id}', 'RoleController@show');
    Route::post('/role', 'RoleController@store');
    Route::delete('/role/{id}', 'RoleController@destroy');

    Route::get('/permission', 'PermissionController@index');
    Route::get('/permission/assign/pre-requisite', 'PermissionController@preRequisite');
    Route::get('/permission/{id}', 'PermissionController@show');
    Route::post('/permission', 'PermissionController@store');
    Route::delete('/permission/{id}', 'PermissionController@destroy');
    Route::post('/permission/assign', 'PermissionController@assignPermission');

    Route::get('/ip-filter', 'IpFilterController@index');
    Route::get('/ip-filter/{id}', 'IpFilterController@show');
    Route::post('/ip-filter', 'IpFilterController@store');
    Route::patch('/ip-filter/{id}', 'IpFilterController@update');
    Route::delete('/ip-filter/{id}', 'IpFilterController@destroy');

    Route::get('/email-template', 'EmailTemplateController@index');
    Route::post('/email-template', 'EmailTemplateController@store');
    Route::get('/email-template/{id}', 'EmailTemplateController@show');
    Route::patch('/email-template/{id}', 'EmailTemplateController@update');
    Route::delete('/email-template/{id}', 'EmailTemplateController@destroy');
    Route::get('/email-template/{category}/lists', 'EmailTemplateController@lists');
    Route::get('/email-template/{id}/content', 'EmailTemplateController@getContent');

    Route::get('/todo', 'TodoController@index');
    Route::get('/todo/{id}', 'TodoController@show');
    Route::post('/todo', 'TodoController@store');
    Route::patch('/todo/{id}', 'TodoController@update');
    Route::delete('/todo/{id}', 'TodoController@destroy');
    Route::post('/todo/{id}/status', 'TodoController@toggleStatus');

    Route::get('/user/pre-requisite', 'UserController@preRequisite');
    Route::get('/user/profile/pre-requisite', 'UserController@profilePreRequisite');
    Route::get('/user', 'UserController@index');
    Route::get('/user/{id}', 'UserController@show');
    Route::post('/user', 'UserController@store');
    Route::post('/user/{id}/status', 'UserController@updateStatus');
    Route::patch('/user/{id}', 'UserController@update');
    Route::patch('/user/{id}/contact', 'UserController@updateContact');
    Route::patch('/user/{id}/social', 'UserController@updateSocial');
    Route::patch('/user/{id}/force-reset-password', 'UserController@forceResetPassword');
    Route::patch('/user/{id}/email', 'UserController@sendEmail');
    Route::post('/user/profile/update', 'UserController@updateProfile');
    Route::post('/user/profile/avatar/{id}', 'UserController@uploadAvatar');
    Route::delete('/user/profile/avatar/remove/{id}', 'UserController@removeAvatar');
    Route::delete('/user/{uuid}', 'UserController@destroy');

    Route::get('/message/compose/pre-requisite', 'MessageController@preRequisite');
    Route::post('/message/statistics', 'MessageController@statistics');
    Route::post('/message/compose', 'MessageController@store');
    Route::post('/message/reply', 'MessageController@reply');
    Route::get('/message/{uuid}/reply', 'MessageController@loadReply');
    Route::get('/message/draft', 'MessageController@getDraftList');
    Route::get('/message/{uuid}/draft', 'MessageController@getDraft');
    Route::get('/message/inbox', 'MessageController@getInboxList');
    Route::get('/message/sent', 'MessageController@getSentList');
    Route::get('/message/important', 'MessageController@getImportantList');
    Route::get('/message/trash', 'MessageController@getTrashList');
    Route::delete('/message/{uuid}/draft', 'MessageController@destroyDraft');
    Route::post('/message/{uuid}/trash', 'MessageController@trash');
    Route::post('/message/{uuid}/restore', 'MessageController@restore');
    Route::delete('/message/{id}/delete', 'MessageController@destroy');
    Route::get('/message/{uuid}', 'MessageController@show');
    Route::post('/message/{uuid}/important', 'MessageController@toggleImportant');

    Route::get('/email-log', 'EmailLogController@index');
    Route::get('/email-log/{id}', 'EmailLogController@show');
    Route::delete('/email-log/{id}', 'EmailLogController@destroy');

    Route::get('/activity-log', 'ActivityLogController@index');
    Route::delete('/activity-log/{id}', 'ActivityLogController@destroy');

    Route::get('/branch', 'BranchController@index');
    Route::get('/branch/stock', 'BranchController@Stock');
    Route::get('/branch/stock/{id}', 'BranchController@getStockByBranch');
    
    Route::post('/branch', 'BranchController@store');
    Route::get('/branch/pre-requisite', 'BranchController@preRequisite');
    Route::get('/branch/{id}', 'BranchController@show');
    Route::patch('/branch/{id}', 'BranchController@update');
    Route::delete('/branch/{id}', 'BranchController@destroy');



    Route::get('/customer', 'CustomerController@index');
    Route::post('/customer', 'CustomerController@store');
    Route::get('/customer/pre-requisite', 'CustomerController@preRequisite');
    Route::get('/customer/{id}', 'CustomerController@show');
    Route::patch('/customer/{id}', 'CustomerController@update');
    Route::delete('/customer/{id}', 'CustomerController@destroy');
    Route::get('/customer/{id}/account/{amount}', 'CustomerController@getCustomerAccount');
    Route::get('/customers/statement', 'CustomerController@getStatement');
    Route::get('/customers/statement/{id}', 'CustomerController@getStatementByCustomer');

    

    Route::get('/category', 'CategoryController@index');
    Route::post('/category', 'CategoryController@store');
    Route::get('/category/pre-requisite', 'CategoryController@preRequisite');
    Route::get('/category/{id}', 'CategoryController@show');
    Route::patch('/category/{id}', 'CategoryController@update');
    Route::delete('/category/{id}', 'CategoryController@destroy');

    Route::get('/group', 'GroupController@index');
    Route::post('/group', 'GroupController@store');
    Route::get('/group/pre-requisite', 'GroupController@preRequisite');
    Route::get('/group/{id}', 'GroupController@show');
    Route::patch('/group/{id}', 'GroupController@update');
    Route::delete('/group/{id}', 'GroupController@destroy');

    Route::get('/product', 'ProductController@index');
    Route::post('/product', 'ProductController@store');
    Route::get('/product/pre-requisite', 'ProductController@preRequisite');
    Route::get('/product/{id}', 'ProductController@show');
    Route::patch('/product/{id}', 'ProductController@update');
    Route::delete('/product/{id}', 'ProductController@destroy');
    Route::get('/product/{id}/{price}/', 'ProductController@getProductWithPrice');
    Route::get('/product/{sriral}/sriral/{type}', 'ProductController@checkSriral');
    
    Route::post('/product/CheckSrirals', 'ProductController@CheckSrirals');


    Route::get('/debenture_cashing', 'DebentureCashingController@index');
    Route::post('/debenture_cashing', 'DebentureCashingController@store');
    Route::get('/debenture_cashing/pre-requisite', 'DebentureCashingController@preRequisite');
    Route::get('/debenture_cashing/{id}', 'DebentureCashingController@show');
    Route::patch('/debenture_cashing/{id}', 'DebentureCashingController@update');
    Route::delete('/debenture_cashing/{id}', 'DebentureCashingController@destroy');

    Route::get('/debenture_deposit', 'DebenturesDepositController@index');
    Route::post('/debenture_deposit', 'DebenturesDepositController@store');
    Route::get('/debenture_deposit/pre-requisite', 'DebenturesDepositController@preRequisite');
    Route::get('/debenture_deposit/{id}', 'DebenturesDepositController@show');
    Route::patch('/debenture_deposit/{id}', 'DebenturesDepositController@update');
    Route::delete('/debenture_deposit/{id}', 'DebenturesDepositController@destroy');

    Route::get('/purchases_bill', 'PurchasesBillController@index');
    Route::post('/purchases_bill', 'PurchasesBillController@store');
    Route::get('/purchases_bill/pre-requisite', 'PurchasesBillController@preRequisite');
    Route::get('/purchases_bill/{id}', 'PurchasesBillController@show');
    Route::patch('/purchases_bill/{id}', 'PurchasesBillController@update');
    Route::delete('/purchases_bill/{id}', 'PurchasesBillController@destroy');

    Route::get('/sales_bill', 'SalesBillController@index');
    Route::post('/sales_bill', 'SalesBillController@store');
    Route::get('/sales_bill/pre-requisite', 'SalesBillController@preRequisite');
    Route::get('/sales_bill/{id}', 'SalesBillController@show');
    Route::patch('/sales_bill/{id}', 'SalesBillController@update');
    Route::delete('/sales_bill/{id}', 'SalesBillController@destroy');

    Route::get('/account_adjustment', 'AccountAdjustmentController@index');
    Route::post('/account_adjustment', 'AccountAdjustmentController@store');
    Route::get('/account_adjustment/pre-requisite', 'AccountAdjustmentController@preRequisite');
    Route::get('/account_adjustment/{id}', 'AccountAdjustmentController@show');
    Route::patch('/account_adjustment/{id}', 'AccountAdjustmentController@update');
    Route::delete('/account_adjustment/{id}', 'AccountAdjustmentController@destroy');
});
