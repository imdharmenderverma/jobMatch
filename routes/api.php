<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\api\v1'], function ($api) {

    $api->post('sign-up', 'AppUserController@signUp');
    $api->post('verify-sign-up-otp', 'AppUserController@verifyRegisterOtp');
    $api->post('sign-in', 'AppUserController@signIn');
    $api->post('forgot-password', 'AppUserController@forgotPassword');
    $api->post('reset-password', 'AppUserController@resetPassword');
    $api->post('verify-otp', 'AppUserController@verifyOtp');
    $api->post('resend-otp', 'AppUserController@resendOtp');
    $api->get('get-skills', 'SkillController@get');
    $api->get('get-terms-of-condition', 'CmsController@termsIndex');
    $api->get('get-privacy-policy', 'CmsController@privacyIndex');
    $api->get('get-faq', 'FaqController@get');

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('fcm-token-save', 'NotificationController@fcmTokenSave');
        Route::get('get-notification', 'NotificationController@getNotification');
        Route::get('get-statements', 'StatementController@get');
        Route::post('store-about-us', 'AppUserController@aboutUs');
        Route::post('store-skill', 'UserSkillController@store');
        Route::post('store-previous-experience', 'UserPortfolioController@store');
        Route::post('delete-previous-experience', 'UserPortfolioController@delete');
        Route::post('delete-portfolio', 'UserPortfolioController@deletePortfolio');
        Route::post('store-education', 'UserEducationController@store');
        Route::post('delete-education', 'UserEducationController@delete');
        Route::post('delete-certificate', 'UserEducationController@deleteCertificate');
        Route::post('save-user-statement', 'UserStatementController@store');
        Route::post('save-soft-skill-screen', 'UserSkillController@storeSoftSkillScreen');
        Route::get('get-user-skills', 'UserSkillController@get');
        Route::get('get-user-soft-skills', 'UserSkillController@getSoftSkill');
        Route::post('store-video', 'AppUserController@saveVideo');
        Route::post('logout', 'AppUserController@logout');

        Route::get('get-job', 'JobController@get');
        Route::get('get-user-apply-job', 'JobController@getApplyJob');
        Route::get('get-favorite-job', 'JobController@getFavJob');
        Route::post('apply-job', 'JobApplyUserController@store');
        Route::post('job-favorite', 'UserFavoriteJobController@store');
        Route::get('get-job-detail', 'JobController@getJobDetail');
        Route::get('get-matches-job', 'JobController@getMatchesJob');
        Route::get('get-user-information', 'AppUserController@getUserInformation');
        Route::post('save-not-interested-job', 'JobController@saveNotInterestedJob');
        Route::post('save-resume', 'JobController@saveResume');
        Route::post('save-cover-letter', 'JobController@saveCoverLetter');
        Route::post('store-help', 'HelpController@store');
        Route::post('inbox-help-users', 'HelpController@userStore');
        Route::post('delete-account', 'AppUserController@deleteAccount');
        Route::post('disable-job', 'AppUserController@disableJob');
        Route::post('save-device-token', 'AppUserController@saveDeviceToken');
        Route::post('get-user-notification', 'AppUserController@getNotification');
        Route::post('mark-as-notification', 'AppUserController@markAsNotification');
        Route::post('mark-all-notification', 'AppUserController@markAllNotification');
        Route::get('get-industry', 'SkillController@getIndustry');
        Route::get('get-previous-industry', 'SkillController@getPreviousIndustry');
        Route::get('get-industry-skill', 'SkillController@getIndustrySkill');
        Route::get('get-data', 'AppUserController@getData')->name('get-data');
        Route::post('resume-builder-subscription', 'AppUserController@resumeBuilderSubscription')->name('resume-builder-subscription');
        Route::get('get-my-resume', 'AppUserController@getMyResume')->name('get-my-resume');

        Route::get('get-user-payment-detail', 'AppUserController@getUserPaymentDetail')->name('get-user-payment-detail');
    });
});
