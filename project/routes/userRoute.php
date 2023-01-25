<?php
use App\Http\Controllers;
use App\Http\Controllers\Deposit\AuthorizeController;
use App\Http\Controllers\Deposit\InstamojoController;
use App\Http\Controllers\Deposit\MollieController;
use App\Http\Controllers\Deposit\PaypalController;
use App\Http\Controllers\Deposit\PaytmController;
use App\Http\Controllers\Deposit\RazorpayController;
use App\Http\Controllers\Deposit\StripeController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\BeneficiaryController;
use App\Http\Controllers\Deposit\FlutterwaveController;
use App\Http\Controllers\Deposit\ManualController;
use App\Http\Controllers\Deposit\PaystackController;
use App\Http\Controllers\User\ForgotController;
use App\Http\Controllers\User\KYCController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\MoneyRequestController;
use App\Http\Controllers\User\OTPController;
use App\Http\Controllers\User\PricingPlanController;
use App\Http\Controllers\User\ReferralController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\SendController;
use App\Http\Controllers\User\TransferLogController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserDpsController;
use App\Http\Controllers\User\UserFdrController;
use App\Http\Controllers\User\UserLoanController;
use App\Http\Controllers\User\WireTransferController;
use App\Http\Controllers\User\WithdrawController;
use App\Http\Middleware\KYC;
use App\Http\Middleware\Otp;
use App\Models\Childcategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Subscription\AuthorizeController as SubAuthorizeController;
use App\Http\Controllers\Subscription\FlutterwaveController as SubFlutterwaveController;
use App\Http\Controllers\Subscription\InstamojoController as SubInstamojoController;
use App\Http\Controllers\Subscription\MollieController as SubMollieController;
use App\Http\Controllers\Subscription\PaypalController as SubPaypalController;
use App\Http\Controllers\Subscription\PaytmController as SubPaytmController;
use App\Http\Controllers\Subscription\RazorpayController as SubRazorpayController;
use App\Http\Controllers\Subscription\StripeController as SubStripeController;
use App\Http\Controllers\Subscription\SubscriptionController;
use App\Http\Controllers\User\DashboardController as AppDashboardController;
use App\Http\Controllers\User\OtherBankController as UserOtherBankController;
use App\Http\Controllers\User\LoginController as UserLoginController;


Route::prefix('user')->group(function() {

    Route::get('/login', [UserLoginController::class,'showLoginForm'])->name('user.login');
    Route::post('/login', [UserLoginController::class,'login'])->name('user.login.submit');

    Route::get('/otp', [OTPController::class,'showotpForm'])->name('user.otp');
    Route::post('/otp', [OTPController::class,'otp'])->name('user.otp.submit');

    Route::get('/register', [RegisterController::class,'showRegisterForm'])->name('user.register');
    Route::post('/register', [RegisterController::class,'register'])->name('user.register.submit');
    Route::get('/register/verify/{token}', [RegisterController::class,'token'])->name('user.register.token');

    Route::group(['middleware' => ['otp','banuser']],function () {

      Route::get('/dashboard', [UserController::class,'index'])->name('user.dashboard');
      Route::get('/username/{number}', [UserController::class,'username'])->name('user.username');
      Route::get('/transactions', [UserController::class,'transaction'])->name('user.transaction');
      Route::get('/export-pdf', [UserController::class,'generatePDF'])->name('user.export.pdf');

      Route::get('/two-factor', [UserController::class,'showTwoFactorForm'])->name('user.show2faForm');
      Route::post('/createTwoFactor', [UserController::class,'createTwoFactor'])->name('user.createTwoFactor');
      Route::post('/disableTwoFactor', [UserController::class,'disableTwoFactor'])->name('user.disableTwoFactor');

      Route::get('/profile', [UserController::class,'profile'])->name('user.profile.index');
      Route::post('/profile', [UserController::class,'profileupdate'])->name('user.profile.update');

      Route::get('/forgot', [ForgotController::class,'showforgotform'])->name('user.forgot');
      Route::post('/forgot', [ForgotController::class,'forgot'])->name('user.forgot.submit');

      Route::get('/kyc-form', [KYCController::class,'kycform'])->name('user.kyc.form');
      Route::post('/kyc-form', [KYCController::class,'kyc'])->name('user.kyc.submit');

      Route::group(['middleware'=>'kyc:Loan'],function(){
        Route::get('/loans', [UserLoanController::class,'index'])->name('user.loans.index');
        Route::get('/pending-loans', [UserLoanController::class,'pending'])->name('user.loans.pending');
        Route::get('/running-loans', [UserLoanController::class,'running'])->name('user.loans.running');
        Route::get('/paid-loans', [UserLoanController::class,'paid'])->name('user.loans.paid');
        Route::get('/rejected-loans', [UserLoanController::class,'rejected'])->name('user.loans.rejected');
        Route::get('/loan-plan', [UserLoanController::class,'loanPlan'])->name('user.loans.plan');
        Route::post('/loan-amount', [UserLoanController::class,'loanAmount'])->name('user.loan.amount');
        Route::post('/loan-request', [UserLoanController::class,'loanRequest'])->name('user.loan.request');
        Route::get('/loan-logs/{id}', [UserLoanController::class,'log'])->name('user.loans.logs');
      });

      Route::get('/dps', [UserDpsController::class,'index'])->name('user.dps.index');
      Route::get('/running-dps', [UserDpsController::class,'running'])->name('user.dps.running');
      Route::get('/matured-dps', [UserDpsController::class,'matured'])->name('user.dps.matured');
      Route::get('/dps-plan', [UserDpsController::class,'dpsPlan'])->name('user.dps.plan');
      Route::get('/dps-plan/{id}', [UserDpsController::class,'planDetails'])->name('user.dps.planDetails');
      Route::post('/dps-submit', [UserDpsController::class,'dpsSubmit'])->name('user.loan.dpsSubmit');
      Route::get('/dps-logs/{id}', [UserDpsController::class,'log'])->name('user.dps.logs');

      Route::get('/fdr', [UserFdrController::class,'index'])->name('user.fdr.index');
      Route::get('/running-fdr', [UserFdrController::class,'running'])->name('user.fdr.running');
      Route::get('/closed-fdr', [UserFdrController::class,'closed'])->name('user.fdr.closed');
      Route::get('/fdr-plan', [UserFdrController::class,'fdrPlan'])->name('user.fdr.plan');
      Route::post('/fdr-amount', [UserFdrController::class,'fdrAmount'])->name('user.fdr.amount');
      Route::post('/fdr-amount/request', [UserFdrController::class,'fdrRequest'])->name('user.fdr.request');

      Route::group(['middleware'=>'kyc:Request Money'],function(){
        Route::get('/money-request', [MoneyRequestController::class,'index'])->name('user.money.request.index');
        Route::get('/request-money/receive',[MoneyRequestController::class,'receive'])->name('user.request.money.receive');
        Route::get('/money-request/create', [MoneyRequestController::class,'create'])->name('user.money.request.create');
        Route::post('/money-request/store', [MoneyRequestController::class,'store'])->name('user.money.request.store');
        Route::post('/request/money/send/{id}', [MoneyRequestController::class,'send'])->name('user.request.money.send');
        Route::get('/money-request/details/{id}', [MoneyRequestController::class,'details'])->name('user.money.request.details');
      });

      Route::group(['middleware'=>'kyc:Wire Transfer'],function(){
        Route::get('wire-transfer',[WireTransferController::class,'index'])->name('user.wire.transfer.index');
        Route::get('wire-transfer/create',[WireTransferController::class,'create'])->name('user.wire.transfer.create');
        Route::post('wire-transfer/store',[WireTransferController::class,'store'])->name('user.wire.transfer.store');
        Route::get('/wire-transfers/show/{id}', [WireTransferController::class,'show'])->name('user.wire.transfer.show');
      });

      Route::group(['middleware'=>'kyc:Withdraw'],function(){
        Route::get('/withdraw', [WithdrawController::class,'index'])->name('user.withdraw.index');
        Route::get('/withdraw/create', [WithdrawController::class,'create'])->name('user.withdraw.create');
        Route::post('/withdraw/store', [WithdrawController::class,'store'])->name('user.withdraw.store');
        Route::get('/withdraw/{id}', [WithdrawController::class,'details'])->name('user.withdraw.details');
      });

      Route::group(['middleware'=>'kyc:Transfer'],function(){
        Route::get('/send-money',[SendController::class,'create'])->name('send.money.create');
        Route::post('/send-money',[SendController::class,'store'])->name('send.money.store');
        Route::get('/send/money/success',[SendController::class,'success'])->name('user.send.money.success');
        Route::get('/send/money/cancle',[SendController::class,'cancle'])->name('user.send.money.cancle');
        Route::get('/send-money/{number}',[SendController::class,'savedUser'])->name('send.money.savedUser');
        Route::post('/save-account',[SendController::class,'saveAccount'])->name('user.save.account');

        Route::get('tranfer-logs',[TransferLogController::class,'index'])->name('tranfer.logs.index');

        Route::get('/other-bank',[UserOtherBankController::class,'index'])->name('user.other.bank');
        Route::get('/other-bank/{id}',[UserOtherBankController::class,'othersend'])->name('user.other.send');
        Route::post('/other-bank/store', [UserOtherBankController::class,'store'])->name('user.other.send.store');

        Route::get('/beneficiaries', [BeneficiaryController::class,'index'])->name('user.beneficiaries.index');
        Route::get('/beneficiaries/create', [BeneficiaryController::class,'create'])->name('user.beneficiaries.create');
        Route::post('/beneficiaries/store', [BeneficiaryController::class,'store'])->name('user.beneficiaries.store');
        Route::get('/beneficiaries/show/{id}', [BeneficiaryController::class,'show'])->name('user.beneficiaries.show');
      });

      Route::get('/package',[PricingPlanController::class,'index'])->name('user.package.index');
      Route::get('/package/subscription/{id}',[PricingPlanController::class,'subscription'])->name('user.package.subscription');


      Route::get('/deposits',[DepositController::class,'index'])->name('user.deposit.index');
      Route::get('/deposit/create',[DepositController::class,'create'])->name('user.deposit.create');

      Route::post('/deposit/stripe-submit', [StripeController::class,'store'])->name('deposit.stripe.submit');

      Route::post('/deposit/paystack/submit', [PaystackController::class,'store'])->name('deposit.paystack.submit');

      Route::post('/paypal-submit', [PaypalController::class,'store'])->name('deposit.paypal.submit');
      Route::get('/paypal/deposit/notify', [PaypalController::class,'notify'])->name('deposit.paypal.notify');
      Route::get('/paypal/deposit/cancle', [PaypalController::class,'cancle'])->name('deposit.paypal.cancle');

      Route::post('/instamojo-submit',[InstamojoController::class,'store'])->name('deposit.instamojo.submit');
      Route::get('/instamojo-notify',[InstamojoController::class,'notify'])->name('deposit.instamojo.notify');

      Route::post('/deposit/paytm-submit', [PaytmController::class,'store'])->name('deposit.paytm.submit');
      Route::post('/deposit/paytm-callback', [PaytmController::class,'paytmCallback'])->name('deposit.paytm.notify');

      Route::post('/deposit/razorpay-submit', [RazorpayController::class,'store'])->name('deposit.razorpay.submit');
      Route::post('/deposit/razorpay-notify', [RazorpayController::class,'notify'])->name('deposit.razorpay.notify');

      Route::post('/deposit/molly-submit', [MollieController::class,'store'])->name('deposit.molly.submit');
      Route::get('/deposit/molly-notify', [MollieController::class,'notify'])->name('deposit.molly.notify');

      Route::post('/deposit/flutter/submit', [FlutterwaveController::class,'store'])->name('deposit.flutter.submit');
      Route::post('/deposit/flutter/notify', [FlutterwaveController::class,'notify'])->name('deposit.flutter.notify');

      Route::post('/authorize-submit', [AuthorizeController::class,'store'])->name('deposit.authorize.submit');
      Route::post('/deposit/manual-submit', [ManualController::class,'store'])->name('deposit.manual.submit');


      Route::post('/subscription/stripe-submit', [SubStripeController::class,'store'])->name('subscription.stripe.submit');
      Route::post('/subscription/free', [SubscriptionController::class,'store'])->name('subscription.free.submit');

      Route::post('/subscription/paypal-submit', [SubPaypalController::class,'store'])->name('subscription.paypal.submit');
      Route::get('/subscription/paypal/deposit/notify', [SubPaypalController::class,'notify'])->name('subscription.paypal.notify');
      Route::get('/subscription/paypal/deposit/cancle', [SubPaypalController::class,'cancle'])->name('subscription.paypal.cancle');

      Route::post('/subscription/instamojo-submit',[SubInstamojoController::class,'store'])->name('subscription.instamojo.submit');
      Route::get('/subscription/instamojo-notify',[SubInstamojoController::class,'notify'])->name('subscription.instamojo.notify');

      Route::post('/subscription/paytm-submit', [SubPaytmController::class,'store'])->name('subscription.paytm.submit');
      Route::post('/subscription/paytm-callback', [SubPaytmController::class,'paytmCallback'])->name('subscription.paytm.notify');

      Route::post('/subscription/razorpay-submit', [SubRazorpayController::class,'store'])->name('subscription.razorpay.submit');
      Route::post('/subscription/razorpay-notify', [SubRazorpayController::class,'notify'])->name('subscription.razorpay.notify');

      Route::post('/subscription/molly-submit', [SubMollieController::class,'store'])->name('subscription.molly.submit');
      Route::get('/subscription/molly-notify', [SubMollieController::class,'notify'])->name('subscription.molly.notify');

      Route::post('/subscription/flutter/submit', [SubFlutterwaveController::class,'store'])->name('subscription.flutter.submit');
      Route::post('/subscription/flutter/notify', [SubFlutterwaveController::class,'notify'])->name('subscription.flutter.notify');

      Route::post('/subscription/authorize-submit', [SubAuthorizeController::class,'store'])->name('subscription.authorize.submit');

      Route::get('/referrals',[ReferralController::class,'referred'])->name('user.referral.index');
      Route::get('/referral-commissions',[ReferralController::class,'commissions'])->name('user.referral.commissions');

      Route::get('/affilate/code', [UserController::class,'affilate_code'])->name('user-affilate-code');


      Route::get('/notf/show', 'User\NotificationController@user_notf_show')->name('customer-notf-show');
      Route::get('/notf/count','User\NotificationController@user_notf_count')->name('customer-notf-count');
      Route::get('/notf/clear','User\NotificationController@user_notf_clear')->name('customer-notf-clear');

      Route::get('admin/messages', [MessageController::class,'adminmessages'])->name('user.message.index');
      Route::get('admin/message/{id}', [MessageController::class,'adminmessage'])->name('user.message.show');
      Route::post('admin/message/post', [MessageController::class,'adminpostmessage'])->name('user.message.store');
      Route::get('admin/message/{id}/delete', [MessageController::class,'adminmessagedelete'])->name('user.message.delete1');
      Route::post('admin/user/send/message', [MessageController::class,'adminusercontact'])->name('user.send.message');
      Route::get('admin/message/load/{id}', [MessageController::class,'messageload'])->name('user.message.load');

      Route::get('/change-password', [UserController::class,'changePasswordForm'])->name('user.change.password.form');
      Route::post('/change-password', [UserController::class,'changePassword'])->name('user.change.password');
    });


    Route::get('/logout', [UserLoginController::class,'logout'])->name('user.logout');

  });
