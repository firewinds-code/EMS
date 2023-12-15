<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Reimbursement\Reimbursement;
use App\Http\Controllers\Acknowledgement\Acknowledgement;
use App\Http\Controllers\AuthController\AuthController;
use App\Http\Controllers\Holidaylist\Holidaylist;
use App\Http\Controllers\Anniversary\Anniversary;
use App\Http\Controllers\Profile;
use App\http\Controllers\AdminMaster;
use App\http\Controllers\DesignationController;
use App\http\Controllers\ClientController;
use App\http\Controllers\ProcessController;
use App\Http\Controllers\SalaryMaster\SalarycertificateController;
use App\Http\Controllers\TransferCertificate\TransferReport;
use App\Http\Controllers\Transfer\TransferController;
use App\Http\Controllers\Ithm\IthmController;
use App\Http\Controllers\Wmt\WmtController;
use App\Http\Controllers\MasterModule\ModulemasterController;
use App\Http\Controllers\Mmr\ModuleMasterReport;
use App\Http\Controllers\Drm\DynamicReportMaster;
use App\http\Controllers\Downtime\DowntimeController;
use App\Http\Controllers\EducationBoard;
use App\Http\Controllers\DistrictManageController;
use App\Http\Controllers\EducationSpecializationController;
use App\Http\Controllers\OJTDowntimeController;
use App\Http\Controllers\Issue\IssueMaster;
use App\Http\Controllers\Rmd\ReferenceMaster;
use App\Http\Controllers\MasterData\DataController;
use App\http\Controllers\BankMaster\BankmasterController;
use App\http\Controllers\SalarySlabController;
use App\http\Controllers\TestmasterController;
use App\Http\Controllers\AppraisalMasterController;
use App\Http\Controllers\Message\MessageController;

Route::post('Custome_Login', [AuthController::class, 'login_Emp'])->name('Custome_Login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['check.auth', 'check.ACK']], function () {
    /* Auth Route */
    Route::post('changePassword', [AuthController::class, 'changePassword'])->name('changePassword');
    Route::post('changeSec', [AuthController::class, 'changeSec'])->name('changeSec');
    /*   Devendra 08-09-2023            */
    Route::get('department', [AdminMaster::class, 'department'])->name('department');
    Route::post('save-department', [AdminMaster::class, 'saveDepartment'])->name('save-department');
    Route::get('delete-department/{id}', [AdminMaster::class, 'deleteDepartment'])->name('delete-department');
    Route::get('edit-department/{id}', [AdminMaster::class, 'editDepartment'])->name('edit-department');
    Route::post('update-department', [AdminMaster::class, 'updateDepartment'])->name('update-department');


    Route::get('designation', [DesignationController::class, 'designation'])->name('designation');
    Route::post('save-designation', [DesignationController::class, 'savedesignation'])->name('save-designation');
    Route::get('delete-designation/{id}', [DesignationController::class, 'deletedesignation'])->name('delete-designation');
    Route::get('edit-designation/{id}', [DesignationController::class, 'editdesignation'])->name('edit-designation');
    Route::post('update-designation', [DesignationController::class, 'updatedesignation'])->name('update-designation');


    Route::get('clients', [ClientController::class, 'clients'])->name('clients');
    Route::get('get-dropdown/{location_id}/{type}', [ClientController::class, 'getOtherField'])->name('get-dropdown');
    Route::get('get-department', [ClientController::class, 'getDepartment'])->name('get-department');
    Route::post('saveNewClient', [ClientController::class, 'saveNewClient'])->name('saveNewClient');
    Route::get('edit-client-details/{cmid}', [ClientController::class, 'editClientDetails'])->name('edit-client-details');

    Route::post('updateClient', [ClientController::class, 'updateClientDetails'])->name('updateClient');
    // Route::get('delete-designation/{id}',[DesignationController::class,'deletedesignation'])->name('delete-designation');
    // Route::get('edit-designation/{id}',[DesignationController::class,'editdesignation'])->name('edit-designation');
    // Route::post('update-designation',[DesignationController::class,'updatedesignation'])->name('update-designation');

    Route::get('process', [ProcessController::class, 'process'])->name('process');
    // Route::post('save-designation',[DesignationController::class,'savedesignation'])->name('save-designation');
    // Route::get('delete-designation/{id}',[DesignationController::class,'deletedesignation'])->name('delete-designation');
    Route::get('edit-process/{id}', [ProcessController::class, 'editProcess'])->name('edit-process');
    Route::post('update-client-process', [ProcessController::class, 'updateProcessStatus'])->name('update-client-process');

    Route::get('downtime-list', [DowntimeController::class, 'downtimeList'])->name('downtime-list');
    Route::get('edit-downtime/{id}', [DowntimeController::class, 'downtimeEdit'])->name('edit-downtime');
    Route::post('update-downtime', [DowntimeController::class, 'updateDowntime'])->name('update-downtime');

    Route::get('buddy-downtime-list', [DowntimeController::class, 'buddyDowntimeList'])->name('buddy-downtime-list');
    Route::get('buddy-downtime-process/{id}', [DowntimeController::class, 'buddyDowntimeProcess'])->name('buddy-downtime-process');
    Route::post('save-buddy-downtime', [DowntimeController::class, 'saveBuddyDowntime'])->name('save-buddy-downtime');
    Route::get('delete-buddy-downtime/{id}', [DowntimeController::class, 'deleteBuddyDowntime'])->name('delete-buddy-downtime');

    Route::get('education-board-list', [EducationBoard::class, 'educationBoardList'])->name('education-board-list');
    Route::get('edit-board/{id}', [EducationBoard::class, 'editBoard'])->name('edit-board');
    Route::post('save-board', [EducationBoard::class, 'updateBoard'])->name('save-board');

    Route::get('district-list', [DistrictManageController::class, 'districtList'])->name('district-list');
    Route::get('getState', [DistrictManageController::class, 'getState'])->name('getState');
    Route::get('edit-district/{id}', [DistrictManageController::class, 'editDistrict'])->name('edit-district');
    Route::post('save-update-district', [DistrictManageController::class, 'districtUpdateOrSave'])->name('save-update-district');

    Route::get('education-specialization-list', [EducationSpecializationController::class, 'list'])->name('education-specialization-list');
    Route::get('edit-education-specialization/{id}', [EducationSpecializationController::class, 'editEduSpecialization'])->name('edit-education-specialization');
    Route::post('save-update-specialization', [EducationSpecializationController::class, 'updateOrSave'])->name('save-update-specialization');
    // Route::get('education-specialization-list',[EducationSpecializationController::class , 'list'])->name('education-specialization-list');

    Route::get('get-ojt-list', [OJTDowntimeController::class, 'list'])->name('get-ojt-list');
    Route::get('get-location', [OJTDowntimeController::class, 'getLocation'])->name('get-location');
    Route::post('save-downtime-ojt', [OJTDowntimeController::class, 'saveDowntimeOjt'])->name('save-downtime-ojt');
    Route::get('ojt-downtime-process/{id}', [OJTDowntimeController::class, 'edtDowntimeOjt'])->name('ojt-downtime-process');

    Route::get('salary-slab-list', [SalarySlabController::class, 'list'])->name('salary-slab-list');
    Route::get('edit-salary-slab/{id}', [SalarySlabController::class, 'editSalarySlab'])->name('edit-salary-slab');
    Route::post('save-salary-slab', [SalarySlabController::class, 'saveOrUpdateSalarySlab'])->name('save-salary-slab');

    Route::get('appraisal-master', [AppraisalMasterController::class, 'appraisalMasterList'])->name('appraisal-master');

    /*   Devendra 08-09-2023     */


    /*for Manesh  Routes*/
    Route::get('transferreport', [TransferReport::class, 'viewtransferReport'])->name('transferreport');
    Route::post('transferreport', [TransferReport::class, 'gettransferReport'])->name('transferreport');


    /*for salary certificate master*/
    Route::get('salarymaster', [SalarycertificateController::class, 'viewsalarymaster'])->name('salarymaster');
    Route::post('salarymaster', [SalarycertificateController::class, 'storesalarymaster'])->name('salarymaster');
    Route::any('salarymasterdelete/{EmpID}', [SalarycertificateController::class, 'deletesalarymaster'])->name('deletesalary');

    /*For Bankmaster Master  Routes*/
    Route::any('bankmaster', [BankmasterController::class, 'view'])->name('bankmasterview');
    Route::post('addbank', [BankmasterController::class, 'addbank'])->name('addbank');
    Route::any('updatebank', [BankmasterController::class, 'updatebank'])->name('updatebank');
    Route::any('Save', [BankmasterController::class, 'save'])->name('Save');
    Route::get('editbank/{id}', [BankmasterController::class, 'editbank'])->name('editbank');


    /*For Test Master  Routes*/
    Route::any('testmaster', [TestmasterController::class, 'testview'])->name('testmaster');
    Route::post('processtest', [TestmasterController::class, 'process'])->name('processtest');
    Route::post('addtest', [TestmasterController::class, 'addtest'])->name('addtest');
    Route::get('edit-test/{id}', [TestmasterController::class, 'edit'])->name('edittest');
    Route::any('update', [TestmasterController::class, 'update'])->name('update');

    /*for Manesh  Routes*/


    /*for Manage module master master*/
    Route::post('addmodulemaster', [ModulemasterController::class, 'addmaster'])->name('addmodulemaster');
    Route::get('modulemaster', [ModulemasterController::class, 'viewmodulemaster'])->name('viewmodulemaster');
    Route::post('exceptionprocess', [ModulemasterController::class, 'process'])->name('exceptionprocess');
    Route::any('searchemp', [ModulemasterController::class, 'searchemp'])->name('searchemp');
    Route::any('uploadmodule', [ModulemasterController::class, 'uploadmodule'])->name('uploadmodule');
    Route::any('export', [ModulemasterController::class, 'export'])->name('export');


    /*For Employee Transfer Routes   for Ekta  Routes */
    Route::any('transfer/search', [TransferController::class, 'search'])->name('transfer.search');
    Route::post('/clientname', [TransferController::class, 'clientname'])->name('clientname');
    Route::post('/process', [TransferController::class, 'process'])->name('process');
    Route::post('/subprocess', [TransferController::class, 'subprocess'])->name('subprocess');
    Route::post('/reportTo', [TransferController::class, 'reportTo'])->name('reportTo');
    Route::post('save', [TransferController::class, 'save'])->name('save');



    /*For Reference Master Details Routes*/
    Route::get('rmdView', [ReferenceMaster::class, 'view'])->name('rmdView');
    Route::any('rmdUpdate', [ReferenceMaster::class, 'update'])->name('rmdUpdate');
    Route::post('rmdSave', [ReferenceMaster::class, 'save'])->name('rmdSave');
    Route::post('rmdAdd', [ReferenceMaster::class, 'add'])->name('rmdAdd');

    /*For Reference Registration Report Routes*/
    Route::any('rmdList', [ReferenceMaster::class, 'list'])->name('rmdList');

    /*For Reference Master Details Routes*/
    Route::get('issueView', [IssueMaster::class, 'view'])->name('issueView');
    Route::any('issueUpdate', [IssueMaster::class, 'update'])->name('issueUpdate');
    Route::post('issueSave', [IssueMaster::class, 'save'])->name('issueSave');
    Route::post('issueAdd', [IssueMaster::class, 'add'])->name('issueAdd');

    /*For Master Data Report Routes*/
    Route::get('masterDataView', [DataController::class, 'view'])->name('masterDataView');
    Route::any('getActiveData', [DataController::class, 'activeData'])->name('getActiveData');
    Route::any('getInactiveData', [DataController::class, 'inactiveData'])->name('getInactiveData');

    /*For IT Help Desk Routes*/
    Route::get('ithmView', [IthmController::class, 'view'])->name('view');
    Route::get('delete-email/{id}', [IthmController::class, 'deleteEmail'])->name('delete-email');
    Route::post('saveEmail', [IthmController::class, 'save'])->name('saveEmail');

    /*For Welcome Mail Template Routes*/
    Route::get('wmtView', [WmtController::class, 'view'])->name('wmtView');
    Route::post('wmtUpdate', [WmtController::class, 'update'])->name('wmtUpdate');

    /*For Module Master Report Routes*/
    Route::get('mmrView', [ModuleMasterReport::class, 'view'])->name('mmrView');

    /*For Dynamic Report Master Routes*/
    Route::get('drmView', [DynamicReportMaster::class, 'view'])->name('drmView');
    Route::get('get-edit-id/{id}', [DynamicReportMaster::class, 'getEditId'])->name('get-edit-id');
    Route::post('drmUpdate', [DynamicReportMaster::class, 'update'])->name('drmUpdate');

    /*For Dynamic Report Routes*/
    Route::get('drmList', [DynamicReportMaster::class, 'list'])->name('drmList');

    /*For Message Routes*/
    Route::any('messageView', [MessageController::class, 'view'])->name('messageView');
    Route::post('update-message', [MessageController::class, 'updateMessage'])->name('update-message');
    Route::get('get-data-by-admin/{date}', [MessageCgetFoodDataontroller::class, 'viewMessageByAdmin'])->name('get-data-by-admin');

    /*For Employee Transfer Routes   for Ekta  Routes */




    Route::get('expense/raise', [Reimbursement::class, 'viewRaise'])->name('raise'); //Viewe Blade
    /* For Food Route  */
    Route::get('getFoodData', [Reimbursement::class, 'getFoodData'])->name('getFoodData');
    Route::post('CreateRaiseFood', [Reimbursement::class, 'createReiseFood'])->name('CreateRaiseFood');
    Route::any('/food/delete', [Reimbursement::class, 'deleteRaiseFood'])->name('deleteFood');


    /* For Travel Route */
    Route::post('createReiseTravel', [Reimbursement::class, 'createReiseTravel'])->name('createReiseTravel');
    Route::get('getTravelData', [Reimbursement::class, 'getTravelData'])->name('getTravelData');
    Route::delete('/Travel/delete', [Reimbursement::class, 'deleteRaiseTravel'])->name('deleteTravel');

    /* For Hotel Route */

    Route::get('getHotelData', [Reimbursement::class, 'getHotelData'])->name('getHotelData');
    Route::get('getVisitedLocation', [Reimbursement::class, 'getVisitedLocation'])->name('getVisitedLocation');
    Route::get('getVisitedClientName', [Reimbursement::class, 'getVisitedClientName'])->name('getVisitedClientName');
    Route::post('createReiseHotel', [Reimbursement::class, 'createReiseHotel'])->name('createReiseHotel');
    Route::delete('/Hotel/delete', [Reimbursement::class, 'deleteRaiseHotel'])->name('deleteHotel');

    /* For Mobile Route */
    Route::get('getMobileData', [Reimbursement::class, 'getMobileData'])->name('getMobileData');
    Route::post('createReiseMobile', [Reimbursement::class, 'createReiseMobile'])->name('createReiseMobile');
    Route::delete('/Mobile/delete', [Reimbursement::class, 'deleteRaiseMobile'])->name('deleteMobile');

    /* For Miscellaneous  Route */
    Route::get('getMiscellaneousData', [Reimbursement::class, 'getMiscellaneousData'])->name('getMiscellaneousData');
    Route::post('createReiseMiscellaneous', [Reimbursement::class, 'createReiseMiscellaneous'])->name('createReiseMiscellaneous');
    Route::delete('/Miscellaneous/delete', [Reimbursement::class, 'deleteRaiseMiscellaneous'])->name('deleteMiscellaneous');
    Route::get('/get/CSAMobile', [Reimbursement::class, 'getDataFromCheckCSA'])->name('getCSAMobile');


    /*For Reviewer*/
    Route::get('expense/review', [Reimbursement::class, 'viewReview'])->name('review'); //Viewe Blade
    Route::post('expense/food', [Reimbursement::class, 'createReiseMiscellaneous'])->name('createReiseMiscellaneous');

    /*For Approve*/
    Route::get('expense/approve', [Reimbursement::class, 'viewApprove'])->name('approve'); //Viewe Blade


    /* For Report */
    Route::get('expense/report', [Reimbursement::class, 'viewReport'])->name('report'); //Viewe Blade
    Route::any('expense/get-report', [Reimbursement::class, 'getReport'])->name('getReport');

    /* For Holidaylist */
    Route::any('holidaylist', [Holidaylist::class, 'holidaylist'])->name('holidaylist');


    /*for Profile */
    Route::get('profile', [Profile::class, 'viewProfile'])->name('profile'); //Viewe Blade
    Route::post('profileDetails', [Profile::class, 'getAllDetails'])->name('profileDetails');


    /*for anniversary */
    Route::get('anniversary/birthday', [Anniversary::class, 'bdayList'])->name('birthday'); //Viewe Blade
    Route::get('anniversary/marriage', [Anniversary::class, 'marrigeList'])->name('marriage'); //Viewe Blade
    Route::get('anniversary/work', [Anniversary::class, 'workList'])->name('work'); //Viewe Blade













    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*For AcknowledgementS Routes*/
Route::get('acknowledge/covid', [Acknowledgement::class, 'viewCovidAcknowledge'])->name('covidAck'); //Viewe Blade
Route::POST('acknowledge/covidReq', [Acknowledgement::class, 'createWeeklyCovidAcknowledge'])->name('covidAckReq');