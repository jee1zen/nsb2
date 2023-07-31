<?php

use App\Http\Controllers\Client\BidController;
use App\Http\Controllers\Client\CustomerController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login')->name('login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => true]);

Route::post('otp','SMS\SmsController@otp')->name('otp');
Route::post('otpt','SMS\SmsController@otpt')->name('otpt');
Route::post('otpCheck','SMS\SmsController@checkOTP')->name('otp.check');

Route::post('otp/email','Email\OtpController@OTP')->name('otp.email');
// Route::post('otpt/email','Email\SmsController@otpt')->name('otpt');
Route::post('otpCheck/email','Email\OtpController@checkOTP')->name('otp.email.check');


Route::post('userEmail','ValidationController@userEmailvalidation')->name('user.email.validation');

//joint holders kyc link
Route::get('jointKyc/{type}/{link}','Client\KYCController@jointKYC')->name('joint.kyc.index');

Route::get('password/expired', 'Auth\ExpiredPasswordController@expired')->name('password.expired');
Route::post('password/post_expired', 'Auth\ExpiredPasswordController@postExpired')->name('password.post_expired');

//reset Profile
Route::get('kyc/client/{type}','Client\KYCController@kycLink')->name('kyc.client');
Route::get('reset/{client_id}','Reset\ResetController@index')->name('reset.index');
Route::post('reset/{client_id}','Reset\ResetController@post')->name('reset.post');
Route::get('reset/{client_id}/reason','Reset\ResetController@reason')->name('reset.reason');

//existing customer
Route::get('migrateExisting/{client_id}','Admin\ExistingClientController@registerForm')->name('migrate.index');
Route::post('migrateExisting/{client_id}','Admin\ExistingClientController@register')->name('migrate.post');




// Admin



    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::redirect('/', '/login')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Assets
    Route::delete('assets/destroy', 'AssetsController@massDestroy')->name('assets.massDestroy');
    Route::resource('assets', 'AssetsController');

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Stocks
    //Route::delete('stocks/destroy', 'StocksController@massDestroy')->name('stocks.massDestroy');
    Route::resource('stocks', 'AssetsController')->only(['index', 'show']);

    //bank Tbill bond  records sync & view
    Route::get('csv','BankRecordController@index')->name('csv.index');
    Route::get('csv/clean','BankRecordController@clean')->name('csv.clean');
    Route::post('csv/import','BankRecordController@fileImport')->name('csv.import');
    Route::get('csv/sync','BankRecordController@synchronize')->name('csv.sync');
    Route::get('bankRecords/view','BankRecordController@viewRecords')->name('bankRecords.view');

    
    //bank Repo client  records sync & view
    Route::get('csv/repo','BankRepoController@index')->name('csv.repo.index');
    Route::get('csv/repo/clean','BankRepoController@clean')->name('csv.repo.clean');
    Route::post('csv/repo/import','BankRepoController@fileImport')->name('csv.repo.import');
    Route::get('csv/repo/sync','BankRepoController@synchronize')->name('csv.repo.sync');
    Route::get('bankRepos/view','BankRepoController@viewRecords')->name('bankRepos.view');

    Route::get('existingClient','ExistingClientController@index')->name('existing.index');
    Route::get('existingClient/filter','ExistingClientController@filter')->name('existing.filter');
    Route::post('existingClient/import','ExistingClientController@fileImport')->name('existing.import');
    Route::post('existingClient/mail','ExistingClientController@sendMail')->name('existing.mail');

    // Transactions
//    Route::delete('transactions/destroy', 'TransactionsController@massDestroy')->name('transactions.massDestroy');
    Route::post('transactions/{stock}/storeStock', 'TransactionsController@storeStock')->name('transactions.storeStock');
    Route::resource('transactions', 'TransactionsController')->only(['index']);

    //clients approval
    Route::get('clients','ApprovalController@index')->name('clients.index');
    Route::get('clients/show/{client}','ApprovalController@show')->name('clients.show');
    Route::post('clients/show/{client}','ApprovalController@process')->name('clients.process');
    Route::post('clients/check','ApprovalController@verify')->name('clients.verify');
    Route::post('clients/checkAll','ApprovalController@verifyAll')->name('clients.verify.all');
    Route::post('clients/verify_type/{client}','ApprovalController@verifyType')->name('clients.verifyType');
    Route::post('clients/sheduleMeeting/{client}','ApprovalController@sheduleMeeting')->name('clients.meeting');
    Route::post('clients/updateMeeting/{client}','ApprovalController@updateMeeting')->name('clients.meeting.update');
    Route::get('clients/pick/{client}','ApprovalController@pick')->name('clients.management.pick');
    Route::post('clients/updateRefEmail','ApprovalController@updateRefEmail')->name('clients.refemail.update');
    Route::get('clients/kycPrint/{client_id}','ApprovalController@kyc')->name('clients.kyc.print');
    Route::post('cilents/kycRemark','ApprovalController@kycRemark')->name('clients.kyc.remark');
    Route::post('clients/delete','ApprovalController@deleteClient')->name('clients.delete');
    Route::get('clients/dashboard/{client_id}','ApplicantsController@clientDashboard')->name('clients.dashboard');


    // Client Management
    Route::get('clients_management','ApplicantsController@index')->name('clients.management');
    Route::get('clients_management/{id}','ApplicantsController@fullProfile')->name('clients.profile');
    Route::get('clients_management/edit/{client}','ApplicantsController@edit')->name('clients.management.edit');
    Route::post('clients_management/update/{client}','ApplicantsController@update')->name('clients.management.basicInfo.update');
    Route::post('clients_management/employment/update/{client}','ApplicantsController@empUpdate')->name('clients.management.employmentInfo.update');
    Route::post('clients_management/jointHolder/update/{client}','ApplicantsController@jointUpdate')->name('clients.management.jointHolder.update');
    Route::post('clients_management/upload','ApplicantsController@upload')->name('clients.management.upload');
    Route::post('clients_management/govVerify/{client}','ApplicantsController@govVerifyDocUpload')->name('clients.management.gov');
    Route::post('clients_management/govVerifyApproval/{client}','ApplicantsController@govVerifyDocUploadApproval')->name('clients.management.gov.approval');
    Route::post('clients_management/moneyLVD/{client}','ApplicantsController@moneyLVDUpload')->name('clients.management.money');
    Route::post('clients_management/document/{client}','ApplicantsController@document')->name('clients.management.document');


    //stepcontrollers
    Route::get('stepControlling/investments','StepController@investmentsView')->name('stepControlling.investments.view');
    Route::get('stepControlling/investment/{id}/{investment_id}','StepController@investment')->name('stepControlling.investment.view');
    Route::post('stepControlling/investment/{id}/{investment_id}','StepController@investmentUpdate')->name('stepControlling.investment.update');


    //liveOTP
    Route::get('liveOtp/get','OTPViewController@index')->name('otps.view');

    // Withdraws 
    Route::get('withdraws','WithdrawController@withdraws')->name('withdraw.index');
    Route::get('withdraws/show/{id}','WithdrawController@withdrawShow')->name('withdraw.show');
    Route::post('withdraws/show/{id}','WithdrawController@withdrawProcess')->name('withdraw.process');

    // Reverse Repo
    Route::get('reverseRepos','ReverseRepoController@reverseRepo')->name('reverseRepo.index');
    Route::get('reverseRepo/show/{id}','ReverseRepoController@reverseRepoShow')->name('reverseRepo.show');
    Route::post('reverseRepo/show/{id}','ReverseRepoController@reverseRepoProcess')->name('reverseRepo.process');

    //Settle Reverse Repo..
    Route::get('settleReverseRepos','SettleReverseRepoController@index')->name('settleReverseRepo.index');
    Route::get('settleReverseRepo/show/{id}','SettleReverseRepoController@show')->name('settleReverseRepo.show');
    Route::post('settleReverseRepo/show/{id}','SettleReverseRepoController@process')->name('settleReverseRepo.process');
    


    // Investment Request
    Route::get('investmentRequest','InvestmentController@index')->name('newInvestment.index');
    Route::get('investmentRequest/show/{client_id}/{typeId}','InvestmentController@show')->name('newInvestment.show');
    Route::post('investmentRequest/update','InvestmentController@update')->name('investment.update');
    Route::post('investmentRequest/show/{client_id}/{typeId}','InvestmentController@process')->name('newInvestment.process');
    Route::post('investmentRequest/check','InvestmentController@verify')->name('clients.newInvestment.verify');
    Route::post('investmentRequest/checkAll','InvestmentController@verifyAll')->name('clients.newInvestment.verify.all');
    
    //syched records without instruction
    Route::get('instructionless','NonInstructedRecordsController@index')->name('noninstructed.index');
    Route::get('instructionless/show/{id}','NonInstructedRecordsController@show')->name('noninstructed.show');
    Route::post('instructionless/show/{id}','NonInstructedRecordsController@process')->name('noninstructed.process');
    Route::post('instructionless/store','NonInstructedRecordsController@store')->name('noninstructed.store');
    




    //Bid for Auction
    Route::get('bidforAuction','BidForAuctionController@index')->name('bid.index');
    Route::post('bidforAuction','BidForAuctionController@post')->name('bid.post');
    Route::get('bids','BidForAuctionController@bids')->name('bids');
    Route::get('bids/show/{id}','BidForAuctionController@bidShow')->name('bids.show');
    Route::post('bids/show/{id}','BidForAuctionController@bidProcess')->name('bids.process');

    //change Requests
    Route::get('changes','ChangeRequestController@index')->name('changes.index');
    Route::get('changes/show/{id}','ChangeRequestController@show')->name('changes.show');
    Route::post('changes/process','ChangeRequestController@process')->name('changes.process');


    //all client requests
    Route::get('allRequest','ClientRequestsController@allRequests')->name('allRequest');
    Route::get('allRequest/filter','ClientRequestsController@allRequestsFilter')->name('allRequest.filter');

    //investment info..
    Route::get('investmentInfo','InvestmentInfoController@index')->name('investment.info');
    Route::get('investmentInfo/filter','InvestmentInfoController@filter')->name('investment.info.filter');
    Route::get('investmentInfo/client/{id}','InvestmentInfoController@client')->name('investment.info.client');
    Route::get('investmentInfo/investment/{client_id}/{investment_id}','InvestmentInfoController@investment')->name('investment.info.investment');
    Route::get('investmentInfo/kyc/{client_id}/{investment_id}','InvestmentInfoController@kyc')->name('investment.info.kyc');

    //Bid info and printing
    Route::get('bidInfo','BidForAuctionController@bidForAuctionInfo')->name('bid.info');
    Route::get('bidInfo/{id}','BidForAuctionController@bidForAuctionApplication')->name('bid.application');



    //user Guide
    Route::get('userGuide','UserGuiceController@userGuide')->name('userGuide.index');
    Route::post('userGuide','UserGuiceController@userGuidePost')->name('userGuide.post');



    //Banks information
    Route::get('banks', 'BankController@index')->name('banks.index');
    Route::get('banks/edit/{id}','BankController@edit')->name('banks.edit');
    Route::get('banks/create','BankController@create')->name('banks.create');
    Route::post('banks/store','BankController@store')->name('banks.store');
    Route::post('banks/edit/{id}','BankController@update')->name('banks.post');
    Route::get('banks/addBranches/{id}','BankController@addBranches')->name('banks.branches');
    Route::post('banks/addBranches/{id}','BankController@updateBranches')->name('banks.storeBranches');
    Route::get('banks/deleteBranches/{id}','BankController@deleteBranch')->name('banks.deleteBranch');

    //inquries 
    Route::get('inquiries','ClientsController@inquiries')->name('inquiries.index');
    Route::get('inquiries/show/{id}','ClientsController@inquirieShow')->name('inquiries.show');


});

Route::group(['prefix' => 'client', 'as' => 'client.', 'namespace' => 'Client', 'middleware' => ['auth','password_expired']], function () {
  
    Route::get('staging','CustomerController@staging')->name('staging');

    Route::post('setAccount','CustomerController@selectAccount')->name('setAccount');

    Route::get('dashboard','CustomerController@index')->name('dashboard');
    Route::get('history','CustomerController@history')->name('history');

    //maturity  instructions
    Route::get('fundRequest','WithdrawController@requestForm')->name('fundRequest.form');
    Route::post('fundRequest','WithdrawController@store')->name('fundRequest.post');
    Route::get('requests','WithdrawController@requests')->name('requests');
    Route::post('requests/filter','WithdrawController@requestsfilter')->name('requests.filter');
    Route::get('fundRequest/requestProceed','WithdrawController@proceed')->name('requests.proceed');
    Route::post('fundRequest/requestProceed','WithdrawController@process')->name('requests.post');

    //add investments
    Route::get('addInvestment','RequestInvestmentController@index')->name('investment.index');
    Route::post('addInvestment/post','RequestInvestmentController@post')->name('investment.post');
    Route::get('addInvestment/form/{id}','RequestInvestmentController@form')->name('investment.form');
    Route::post('addInvestment/form/post/{id}','RequestInvestmentController@formPost')->name('investment.form.post');
    Route::get('addInvestment/proceed','RequestInvestmentController@proceed')->name('investment.proceed');
    Route::post('addInvestment/process','RequestInvestmentController@process')->name('investment.process');
    Route::get('listInvestment','RequestInvestmentController@list')->name('investment.list');


    //bank accounts
    Route::get('bankAccounts','CustomerController@bankAccounts')->name('bankAccounts.view');
    Route::get('bankAccounts/add','CustomerController@addBankAccount')->name('bankAccounts.add');
    Route::post('bankAccounts/add','CustomerController@bankAccountStore')->name('bankAccounts.store');


    //profile
    Route::get('profile','CustomerController@profile')->name('profile');
    Route::get('profileEdit', 'CustomerController@profileEdit')->name('profileEdit');

    //ReverseRepo..
    Route::get('reverseRepo/create','ReverseRepoController@create')->name('reverseRepo.create');
    Route::post('reverseRepo/create','ReverseRepoController@store')->name('reverseRepo.store');
    Route::get('reverseRepo/proceed','ReverseRepoController@proceed')->name('reverseRepo.proceed');
    Route::post('reverseRepo/process','ReverseRepoController@reverseRepoProcess')->name('reverseRepo.process');



    //settle ReverseRepo
    Route::get('settleReverseRepo/create','SettleReverseRepoController@create')->name('settleReverseRepo.create');
    Route::post('settleReverseRepo/create','SettleReverseRepoController@store')->name('settleReverseRepo.store');
    Route::get('settleReverseRepo/proceed','SettleReverseRepoController@proceed')->name('settleReverseRepo.proceed');
    Route::post('reverseRepo/process','SettleReverseRepoController@reverseRepoProcess')->name('settleReverseRepo.process');

    //customer edits currently blocked
    Route::post('clients_customer/update/{client}','CustomerController@customer_basicInfo_update')->name('basicInfo.update');
    Route::post('clients_customer/employment/update/{client}','CustomerController@customer_employmentInfo_update')->name('customer.employmentInfo.update');
    Route::post('clients_customer/jointHolder/update/{client}','CustomerController@customer_jointHolder_update')->name('customer.jointHolder.update');


    //kyc customer
    Route::get('kyc','KYCController@index')->name('kyc.index');
    Route::get('kyc/client/{type}','KYCController@clientForm')->name('kyc.client');
    Route::post('kyc/client/{type}','KYCController@store')->name('kyc.client.post');
    Route::get('kyc/joint/{joint_id}/{id}','KYCController@joint')->name('kyc.joint');
    Route::post('kyc/joint/{joint_id}/{id}','KYCController@jointStore')->name('kyc.joint.post');
    // Route::get('kyc/signature/{signature_id}','KYCController@signature')->name('kyc.signature');
    // Route::post('kyc/signature/{signature_id}','KYCController@signatureStore')->name('kyc.signature.post');
    Route::get('kyc/company/{company_id}/{type}','KYCController@company')->name('kyc.company');
    Route::post('kyc/company/{company_id}/{type}','KYCController@companyStore')->name('kyc.company.post');

    //bid for auction
    Route::get('bid','BidController@bid')->name('bid');
    Route::post('bid','BidController@bidPost')->name('bid.post');
    Route::get('bid/delete/{id}','BidController@bidDelete')->name('bid.Delete');
    Route::post('bid/set','BidController@bidSetPost')->name('bid.set.post');
    Route::get('bid/proceed','BidController@proceed')->name('bid.proceed');
    Route::post('bid/process','BidController@process')->name('bid.process');
    Route::get('bid/list','BidController@myBids')->name('bid.list');
    Route::post('bid/list/filter','BidController@myBidsFilter')->name('bid.filter');

    //users manual
    Route::get('userManual','CustomerController@userManual')->name('userManual');

    //inqueries and more
    Route::get('blank','CustomerController@blank')->name('blank');
    Route::get('inquiries','CustomerController@inquiries')->name('inquiries');
    Route::post('inquiries','CustomerController@inquiryPost')->name('inquiries.post');


    
});





Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});