<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\security\SubscriptionManageController;
use App\Http\Controllers\security\PlanController;
use App\Http\Controllers\security\StripeManageController;
use App\Http\Controllers\security\SettingsManageController;



///////////////////
use App\Http\Controllers\security\JobRepetationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*   
     https://techsolutionstuff.com/post/laravel-9-stripe-payment-gateway-integration



 *   **** https://www.codesolutionstuff.com/laravel-8-stripe-subscription-tutorial-using-cashier-example/
 *   Stripe subscription --> https://www.itsolutionstuff.com/post/laravel-cashier-stripe-subscription-example-tutorialexample.html 
 *   
*/

/**
 *     rukeqomace@mailinator.com
*/

Route::get('/', function () {
    return view('security.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');

Route::group(['prefix' => 'admin'], function(){    
    Route::get("/login", [App\Http\Controllers\AdminController::class, 'login'])->middleware('admin.guest')->name("admin.login");
    Route::post("/login", [App\Http\Controllers\AdminController::class, 'login'])->middleware('admin.guest')->name("admin.login.check");
    Route::get("/register", [App\Http\Controllers\AdminController::class, 'register'])->middleware('admin.guest')->name("admin.register");
    Route::post("/register", [App\Http\Controllers\AdminController::class, 'register'])->middleware('admin.guest')->name("admin.register.submit");

    Route::get("/dashboard", [App\Http\Controllers\AdminController::class, 'dashboard'])->middleware('admin.auth')->name("admin.dashboard");
    Route::get("/clients", [App\Http\Controllers\ClientController::class, 'adminclientlist'])->middleware('admin.auth')->name('admin.client.list');  
    Route::get("/securities", [App\Http\Controllers\SecurityController::class, 'adminsecuritylist'])->middleware('admin.auth')->name('admin.security.list');  
    Route::get("/security/add", [App\Http\Controllers\SecurityController::class, 'adminsecurityadd'])->middleware('admin.auth')->name('admin.security.add');  
    Route::post("/security/add", [App\Http\Controllers\SecurityController::class, 'adminsecurityadd'])->middleware('admin.auth')->name('admin.security.insert');  
    Route::get("/security/update/{updateid}", [App\Http\Controllers\SecurityController::class, 'adminsecurityupdate'])->middleware('admin.auth')->name('admin.security.update');  
    Route::post("/security/update", [App\Http\Controllers\SecurityController::class, 'adminsecurityupdate'])->middleware('admin.auth')->name('admin.security.update.insert');  
    Route::get("/security/delete/{deleteid}", [App\Http\Controllers\SecurityController::class, 'adminsecuritydelete'])->middleware('admin.auth')->name('admin.security.delete');  

    Route::get("/guards", [App\Http\Controllers\GuardController::class, 'adminguardlist']) -> middleware('admin.auth') -> name('admin.guard.list');
    Route::get("/guard/update/{updateid}", [App\Http\Controllers\GuardController::class, 'adminguardupdate']) -> middleware('admin.auth') -> name('admin.guard.update');
    Route::post("/guard/update", [App\Http\Controllers\GuardController::class, 'adminguardupdate']) -> middleware('admin.auth') -> name('admin.guard.update.success');
    Route::get("/guard/delete/{deleteid}", [App\Http\Controllers\GuardController::class, 'adminguarddelete']) -> middleware('admin.auth') -> name('admin.guard.delete');

   
    Route::get("/client/update/{updateid}", [App\Http\Controllers\ClientController::class, 'adminclientupdate'])->middleware('admin.auth')->name('admin.client.update');
    Route::post("/client/update", [App\Http\Controllers\ClientController::class, 'adminclientupdate'])->middleware('admin.auth')->name('admin.client.update.insert');
    Route::get("/client/delete/{deleteid}", [App\Http\Controllers\ClientController::class, 'adminclientdelete'])->middleware('admin.auth')-> name('admin.client.delete');

    Route::get("/subscriptions", [App\Http\Controllers\SubscriptionController::class, 'adminsubscriptionlist'])->middleware('admin.auth') -> name('admin.subscription.list');
    Route::get("/subscription/add", [App\Http\Controllers\SubscriptionController::class, 'adminsubscriptionadd'])->middleware('admin.auth') -> name('admin.subscription.add');
    Route::post("/subscription/add", [App\Http\Controllers\SubscriptionController::class, 'adminsubscriptionadd'])->middleware('admin.auth') -> name('admin.subscription.add.success');
    Route::get("/subscription/update/{updateid}", [App\Http\Controllers\SubscriptionController::class, 'adminsubscriptionupdate'])->middleware('admin.auth') -> name('admin.subscription.update');
    Route::post("/subscription/update", [App\Http\Controllers\SubscriptionController::class, 'adminsubscriptionupdate'])->middleware('admin.auth') -> name('admin.subscription.update.success');
    Route::get("/subscription/delete/{deleteid}", [App\Http\Controllers\SubscriptionController::class, 'adminsubscriptiondelete'])->middleware('admin.auth') -> name('admin.subscription.delete');
    
    Route::get('/job/schedule', [App\Http\Controllers\JobschedulerController::class, 'adminjobschedule'])->middleware('admin.auth')->name('admin.schedule.list');
    Route::get('/job/schedule/update/{updateid}', [App\Http\Controllers\JobschedulerController::class, 'adminjobscheduleupdate'])->middleware('admin.auth')->name('admin.schedule.update');
    Route::post('/job/schedule/update', [App\Http\Controllers\JobschedulerController::class, 'adminjobscheduleupdate'])->middleware('admin.auth')->name('admin.schedule.update.success');
    Route::get('/job/schedule/delete/{deleteid}', [App\Http\Controllers\JobschedulerController::class, 'adminjobscheduledelete'])->middleware('admin.auth')->name('admin.schedule.delete');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->middleware('admin.auth')->name('admin.logout');

    // profile..
    Route::get('profile', [ProfileController::class, 'adminProfile'])->middleware('admin.auth')->name('admin.profile');
    Route::post('profile/update/{id}', [ProfileController::class, 'adminProfileUpdate'])->middleware('admin.auth')->name('admin.profile.update');



    ///////////////////
    Route::get('settings/update/{key}', [SettingsManageController::class, 'settings_update'])->middleware('admin.auth')->name('admin.settings.update');
    Route::post('settings/update/action/{id}', [SettingsManageController::class, 'settings_update_action'])->middleware('admin.auth')->name('admin.settings.update.action');

    // for settings update

}); 
Route::group(['prefix' => 'security'], function(){
    Route::get("/login", [App\Http\Controllers\SecurityController::class, 'login'])->middleware('security.guest')->name("security.login");
    Route::get("/register", [App\Http\Controllers\SecurityController::class, 'register'])->middleware('security.guest')->name("security.register");
    Route::post("/register", [App\Http\Controllers\SecurityController::class, 'register'])->middleware('security.guest')->name("security.register.submit");
    Route::post("/login", [App\Http\Controllers\SecurityController::class, 'login'])->middleware('security.guest')->name("security.login.check");
    
    
    
Route::middleware(['isSubscribed'])->group(function () {
    Route::get("/dashboard", [App\Http\Controllers\SecurityController::class, 'dashboard'])->middleware('security.auth')->name("security.dashboard");
    Route::get("/client", [App\Http\Controllers\ClientController::class, 'securityclientlist'])->middleware('security.auth')->name("security.client.list");

    Route::get("/client/add", [App\Http\Controllers\ClientController::class, 'securityclientadd'])->middleware('security.auth')->name("security.client.add");
    Route::post("/client/add", [App\Http\Controllers\ClientController::class, 'securityclientadd'])->middleware('security.auth')->name("security.client.insert");
    Route::get("/client/update/{updateid}", [App\Http\Controllers\ClientController::class, 'securityclientupdate'])->middleware('security.auth')->name("security.client.update");
    Route::post("/client/update", [App\Http\Controllers\ClientController::class, 'securityclientupdate'])->middleware('security.auth')->name("security.client.update.success");
    Route::get("/client/delete/{deleteid}", [App\Http\Controllers\ClientController::class, 'securityclientdelete'])->middleware('security.auth')->name("security.client.delete");


    Route::get("/guards", [App\Http\Controllers\GuardController::class, 'securityguardlist'])->middleware('security.auth')->name('security.guard.list');
    Route::get("/guard/add", [App\Http\Controllers\GuardController::class, 'addsecurityguard'])->middleware(['security.auth', 'guardCheck'])->name('security.guard.add');
    Route::post("/guard/add", [App\Http\Controllers\GuardController::class, 'addsecurityguard'])->middleware('security.auth')->name('security.guard.insert');
    Route::get("/guard/update/{updateid}", [App\Http\Controllers\GuardController::class, 'updatesecurityguard'])->middleware('security.auth')->name('security.guard.update');
    Route::post("/guard/update", [App\Http\Controllers\GuardController::class, 'updatesecurityguard'])->middleware('security.auth')->name('security.guard.update.success');
    Route::get("/guard/delete/{deleteid}", [App\Http\Controllers\GuardController::class, 'deletesecurityguard'])->middleware('security.auth')->name('security.guard.delete');
    Route::get("/schedule", [App\Http\Controllers\JobschedulerController::class, 'securityjob'])-> middleware('security.auth')->name('security.job.list');
    Route::get("/schedule/add", [App\Http\Controllers\JobschedulerController::class, 'securityjobadd'])-> middleware('security.auth')->name('security.job.add');
    Route::post("/schedule/add", [App\Http\Controllers\JobschedulerController::class, 'securityjobadd'])-> middleware('security.auth')->name('security.job.add.success');
    Route::get("/schedule/update/{updateid}", [App\Http\Controllers\JobschedulerController::class, 'securityjobupdate'])-> middleware('security.auth')->name('security.job.update');
    Route::post("/schedule/update", [App\Http\Controllers\JobschedulerController::class, 'securityjobupdate'])-> middleware('security.auth')->name('security.job.update.success');
    Route::get("/schedule/delete/{deleteid}", [App\Http\Controllers\JobschedulerController::class, 'securityjobdelete'])-> middleware('security.auth')->name('security.job.delete');
    Route::get("/tracking/history", [App\Http\Controllers\TrackingController::class, 'list'])->middleware('security.auth')->name('security.tracking.list');
    Route::get("/track/{trackingid}", [App\Http\Controllers\TrackingController::class, 'track'])->middleware('security.auth')->name('security.track');
    Route::get("/get-location", [App\Http\Controllers\TrackingController::class, 'getlocation'])->middleware('security.auth');

    Route::get("/logout", [App\Http\Controllers\SecurityController::class, 'logout'])-> middleware('security.auth')->name('security.logout');
    Route::get('/payroll', [App\Http\Controllers\PayrollController::class, 'payroll']) ->middleware('security.auth')->name('security.payroll');

    Route::get('payroll/print/{id}', [App\Http\Controllers\PayrollController::class, 'payroll_print'])->middleware('security.auth')->name('print');

    // profile..
    Route::get('profile', [ProfileController::class, 'securityprofile'])->middleware('security.auth')->name('security.profile');
    Route::post('profile/update/{id}', [ProfileController::class, 'securityProfileUpdate'])->middleware('security.auth')->name('security.profile.update');

    // Reports..
    Route::get('reports/page', [ReportController::class, 'security_reports'])->middleware('security.auth')->name('security.reports');
    Route::get('attendance/reports/{id}', [ReportController::class, 'attendance_reports'])->middleware('security.auth')->name('security.attendance.reports');

    // for job schedule..
    Route::get('fetch-user-details', [App\Http\Controllers\JobschedulerController::class, 'fetch_user_details'])->name('fetch-user-details');
    
    // for repeat job..
    Route::get('repeat-job/{id}/{extension}', [JobRepetationController::class, 'repeat_job'])->name('repeat-job');
    Route::get('job/repetation/history/{client}/{security}/{job_id}', [JobRepetationController::class, 'repetation_history'])->name('security.job.repetation.history');

    Route::get('fetch-clients-address', [App\Http\Controllers\ClientController::class, 'fetch_client_address'])->name('security.client.addresses');

    /**
     * 
    */

    Route::get('client-multiple-address-delete/{id}', [App\Http\Controllers\ClientController::class, 'del_multiple_Add'])->name('security.client.multiple.addresses.delete');
 
    /**
     * Guard tracking routes
    */

    Route::get('view/active/guards/{client_id}', [App\Http\Controllers\TrackingController::class, 'view_guards'])->middleware('security.auth')->name('security.view.active.guards');
    Route::get('view/active/guards/tracking/{client_id}/{job_id}', [App\Http\Controllers\TrackingController::class, 'guards_tracking'])->middleware('security.auth')->name('security.view.active.guards.tracking');


    Route::get('cron-test', [App\Http\Controllers\TrackingController::class, 'cron_test'])->name('security\cron-test');
});


    // Subscription Module.. (stripe)
    
    Route::get('plans', [PlanController::class, 'index'])->name('security.subscription.plans');
    Route::get('plans/{plan}', [PlanController::class, 'show'])->name("plans.show");
    Route::post('subscription', [PlanController::class, 'subscription'])->name("subscription.create");

    // stripe product..
    Route::get('stripe/product/add', [StripeManageController::class, 'product_add'])->name('stripe/product/add');
    Route::get('stripe/product/all', [StripeManageController::class, 'product_all'])->name('stripe/product/all');
    Route::get('stripe/product/update', [StripeManageController::class, 'product_update'])->name('stripe/product/update');
    
    // stripe card details..
    Route::get('stripe/card/add', [StripeManageController::class, 'add_cards'])->name('stripe/card/add');

});

Route::group(['prefix' => 'client'], function(){
    Route::get("/login", [App\Http\Controllers\ClientController::class, 'login'])->middleware('client.guest')->name("client.login");
    Route::post("/register", [App\Http\Controllers\ClientController::class, 'register'])->middleware('client.guest')->name("client.register.submit");
    Route::post("/login", [App\Http\Controllers\ClientController::class, 'login'])->middleware('client.guest')->name("client.login.check");
    Route::get("/dashboard", [App\Http\Controllers\ClientController::class, 'dashboard'])->middleware('client.guest')->name("client.dashboard");
});