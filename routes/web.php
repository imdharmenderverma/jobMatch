<?php

use App\Http\Controllers\InboxController;
use App\Http\Controllers\AppUserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\StatementController;
use App\Http\Controllers\StatementSkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    echo '<script>alert("All Cache & Clear Success")</script>';
});
Route::get('resume-pdf', [UserController::class, 'ashleyMinkResumePDF']);
Route::get('resume-1-pdf', [UserController::class, 'michelleBelleResumePDF']);
Route::get('resume-2-pdf', [UserController::class, 'michelleDOEResumePDF']);



Route::get('/', function () {
    return view('home');
})->name('home');

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('privacy-policy-register', 'CmsController@registerPrivacyPolicy')->name('privacy-policy-register');
    Route::get('register', 'RegisterController@signUp')->name('register');
    Route::post('register-v1', 'RegisterController@signUpV1')->name('register-v1');
    Route::get('register-v2', 'RegisterController@index')->name('register-v2');
    Route::post('register-v2', 'RegisterController@signUpV2')->name('save-register-v2');
    Route::get('register-v3', 'RegisterController@signUpV3View')->name('register-v3');
    Route::get('verify-email/{id}', 'RegisterController@verifyEmail')->name('verify-email');
    Route::post('register-v3', 'RegisterController@signUpV3')->name('save-register-v3');

    Route::group(['prefix' => 'admin', 'middleware' => ['auth:web'], 'as' => 'admin.'], function () {

        Route::get('dashboard', 'AdminController@dashoard')->name('dashboard');
        Route::get('/get-salary-range/{id}', 'AdminController@getSalaryRange')->name('get-salary-range');

        Route::get('user-location-ajax', 'AdminController@userLocationAjaxDetail')->name('user-location-ajax');
        Route::resource('recruiter-users', UserController::class);
        Route::post('update-status', 'AppUserController@updateStatus')->name('update-status');
        Route::resource('app-users', AppUserController::class);
        Route::get('get-user-profile', 'AppUserController@getProfile')->name('get-user-profile');
        Route::post('update-recruiter-status', 'UserController@updateStatus')->name('update-recruiter-status');

        Route::resource('skill', SkillController::class);
        Route::resource('industries', IndustryController::class);
        Route::resource('statement', StatementController::class);
        Route::resource('faq', FaqController::class);
        Route::get('faq-data', 'FaqController@faqData')->name('faq-data');

        Route::resource('statement-skill', StatementSkillController::class);
        Route::resource('inbox', InboxController::class);
        Route::get('user-data', 'InboxController@userData')->name('user-data');
        Route::post('flag-update', 'InboxController@flagUpdate')->name('flag-update');

        Route::get('privacy-policy', 'CmsController@privacyIndex')->name('privacy-policy');
        Route::post('privacy-policy-update', 'CmsController@privacyUpdate')->name('privacy-policy-update');
        Route::get('terms-of-use', 'CmsController@termsIndex')->name('terms-of-use');
        Route::post('terms-of-use-update', 'CmsController@termsUpdate')->name('terms-of-use-update');

        Route::get('cms-index', 'CmsController@cmsIndex')->name('cms-index');
        Route::get('cms-data/{id}', 'CmsController@cmsData')->name('cms-data');
        Route::post('logout', 'RegisterController@logout')->name('logout');

        // Subscription routes
        Route::get('subscription', 'SubscriptionController@subscriptionListData')->name('subscription');
        Route::post('subscription-store', 'SubscriptionController@subscriptionStore')->name('subscribe.store');
        Route::get('/subscription-edit/{id}', 'SubscriptionController@subscriptionEdit')->name('subscription.edit');
        // Route::put('subscription-update/{id}', 'SubscriptionController@subscriptionUpdate')->name('subscribe.update');
        Route::put('/subscription-update', 'SubscriptionController@subscriptionUpdate')->name('subscription.update');
        Route::post('/status-update-subscription', 'SubscriptionController@statusUpdateSubscription')->name('status.update');

        Route::post('/subscription-delete', 'SubscriptionController@subscriptionDelete')->name('subscribe.delete');
    });

    Route::post('view-resume', 'JobController@viewResume')->name('view-resume');
    Route::post('view-cover-letter', 'JobController@viewCoverLetter')->name('view-cover-letter');
    Route::post('view-portfolio', 'JobController@viewPortfolio')->name('view-portfolio');
    Route::post('view-video', 'JobController@viewVideo')->name('view-video');

    Route::group(['prefix' => 'recruiter', 'as' => 'recruiter.'], function () {
        // Route::get('get-data', 'UserController@getData')->name('get-data');

        Route::get('login', 'RegisterController@loginV2')->name('login');
        Route::post('login', 'RegisterController@loginV2Save')->name('save-login');
        Route::get('forgot-password', 'RecruiterController@forgotPassword')->name('forgot-password');
        Route::post('forgot-password', 'RecruiterController@storeForgotPassword')->name('save-forgot-password');
        Route::get('reset-password/{token}', 'RecruiterController@resetPassword')->name('reset-password');
        Route::post('reset-password', 'RecruiterController@storeResetPassword')->name('save-reset-password');

        Route::group(['middleware' => ['auth:recruiter']], function () {
            Route::get('dashboard', 'RecruiterController@dashoard')->name('dashboard');
            Route::resource('jobs', JobController::class);
            Route::post('job-apply-user-status', 'JobController@updateJobApplyStatus')->name('job-apply-user-status');
            Route::resource('app-users', AppUserController::class);
            Route::get('jobPost', 'RecruiterController@jobPost')->name('jobPost');
            Route::get('jobPost/ajaxPagination', 'RecruiterController@jobListingAjax')->name('jobPostPagination');

            Route::get('inbox', 'InboxController@addInbox')->name('inbox');
            Route::post('inbox-store', 'InboxController@storeData')->name('inbox-store');

            Route::get('cms-index', 'CmsController@cmsIndexData')->name('cms-index');
            Route::get('cms-data/{id}', 'CmsController@cmsData')->name('cms-data');

            // Subscription routes
            Route::get('subscription', 'SubscriptionController@subscriptionList')->name('subscription');
            // Route::get('subscription', 'SubscriptionController@subscriptionAdd')->name('subscription');

            // payment checkout routes
            Route::get('/checkout/{id}', 'CheckoutController@index')->name('checkout');

            Route::get('faq-data', 'FaqController@faqIndexData')->name('faq-data');

            Route::get('job-export', 'JobController@export')->name('job-export');
            Route::post('get-skill', 'SkillController@getSkill')->name('get-skill');
            Route::post('get-child-industry', 'IndustryController@getChild')->name('get-child-industry');
            Route::post('update-job', 'JobController@updateStatus')->name('update-job');
            Route::post('save-job-fulfill', 'JobController@saveJobFulfill')->name('save-job-fulfill');
            Route::post('logout', 'RecruiterController@logout')->name('logout');
        });
    });

    // Route::group(['prefix' => 'appUser', 'as' => 'appUser.'], function () {

    //     Route::get('get-data', 'UserController@getData')->name('get-data');
    // });
});
