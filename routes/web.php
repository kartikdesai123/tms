<?php



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







Route::get('/', function() {

            return Redirect::to('index');

        });

//Route::get('/', function() { return Redirect::to('login'); });




Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

Route::get('/', function () {
    return Redirect::to('login');
});

Route::match(['get', 'post'], 'index', ['as' => 'login', 'uses' => 'LoginController@auth']);
Route::match(['get', 'post'], 'createpassword', ['as' => 'createpassword', 'uses' => 'LoginController@createpassword']);

Route::match(['get', 'post'], 'login', ['as' => 'login', 'uses' => 'LoginController@auth']);

Route::match(['get', 'post'], 'logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);

Route::match(['get', 'post'], 'register', ['as' => 'register', 'uses' => 'LoginController@auth']);

Route::match(['get', 'post'], 'cronmail', ['as' => 'cronmail', 'uses' => 'LoginController@cronmail']);

Route::match(['get', 'post'], 'testingmail', ['as' => 'testingmail', 'uses' => 'LoginController@testingmail']);


Route::match(['get', 'post'], 'sendalertmail', ['as' => 'sendalertmail', 'uses' => 'LoginController@sendalertmail']);



$userPrefix = "";

            Route::group(['prefix' => $userPrefix, 'middleware' => ['auth']], function() {

    

            Route::match(['get', 'post'], 'worker/worker-dashboard', ['as' => 'worker-dashboard', 'uses' => 'UserController@dashboard']);

            Route::match(['get', 'post'], '/worker/workerdash-search-list', ['as' => 'workerdash-search-list', 'uses' => 'UserController@getworkersearchList']);

            Route::match(['get', 'post'], '/worker/information-worker-edit/{id}', ['as' => 'information-worker-edit', 'uses' => 'UserController@workerinformationedit']);
		
            Route::match(['get', 'post'], 'worker/worker-disease', ['as' => 'worker-disease', 'uses' => 'UserController@disease']);
			

        });



$customerPrefix = "";

        Route::group(['prefix' => $customerPrefix, 'middleware' => ['customer']], function() {

            Route::match(['get', 'post'], '/supervisor/supervisor-dashboard', ['as' => 'customer-dashboard', 'uses' => 'Customer\CustomerController@dashboard']);

            Route::match(['get', 'post'], '/supervisor/information_supervisor', ['as' => 'information_supervisor', 'uses' => 'Customer\InformationSupervisorController@dashboard']);

            Route::match(['get', 'post'], '/supervisor/timesheet_list', ['as' => 'timesheet_list', 'uses' =>'Customer\TimesheetSupervisorController@timesheet_list']);

            Route::match(['get', 'post'], '/supervisor/timesheet-search', ['as' => 'timesheet-search', 'uses' => 'Customer\TimesheetSupervisorController@getsearchTimesheetList']);

            

            Route::match(['get', 'post'], '/supervisor/information-search-list', ['as' => 'information-search-list', 'uses' => 'Customer\TimesheetSupervisorController@getsearchInformationList']);            

            Route::match(['get', 'post'], '/supervisor/dash-search-list', ['as' => 'dash-search-list', 'uses' => 'Customer\TimesheetSupervisorController@getdassearchInformationList']);

            

            Route::match(['get', 'post'], '/supervisor/information-supervisoer-edit/{id}', ['as' => 'information-supervisoer-edit', 'uses' => 'Customer\InformationSupervisorController@informationsupervisoeredit']);

            

            Route::match(['get', 'post'], '/supervisor/information-timesheet-edit/{id}', ['as' => 'information-timesheet-edit', 'uses' => 'Customer\InformationSupervisorController@informationtimesheetedit']);

            Route::match(['get', 'post'], '/supervisor/informationsupervisoredit/{id}', ['as' => 'informationsupervisoredit', 'uses' => 'Customer\InformationSupervisorController@informationsupervisoredit']);
			
            Route::match(['get', 'post'], '/supervisor/information-supervisor-edit/{id}', ['as' => 'information-supervisor-edit', 'uses' => 'Customer\CustomerController@supervisorinformationedit']);
            
            

        });



$ageentPrefix = "";

Route::group(['prefix' => $ageentPrefix, 'middleware' => ['agent']], function() {

            Route::match(['get', 'post'], '/agent/agent-dashboard', ['as' => 'agent-dashboard', 'uses' => 'Agent\AgentController@dashboard']);

        });



$adminPrefix = "";

Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function() {

//            add-customer   
            Route::match(['get', 'post'], '/admin/customer', ['as' => 'newCustomer', 'uses' => 'Admin\NewCustomerController@index']);
            Route::match(['get', 'post'], '/admin/customer-details/{id}', ['as' => 'customer-details', 'uses' => 'Admin\CustomerWorkplaceController@customerDetails']);
            Route::match(['get', 'post'], '/admin/add-customer', ['as' => 'add-customer', 'uses' => 'Admin\NewCustomerController@add']);
            Route::match(['get', 'post'], '/admin/edit-customer/{id}', ['as' => 'edit-customer', 'uses' => 'Admin\NewCustomerController@edit']);
            Route::match(['get', 'post'], '/admin/delete-customer/{id}', ['as' => 'delete-customer', 'uses' => 'Admin\NewCustomerController@delete']);
            Route::match(['get', 'post'], '/admin/add-contract', ['as' => 'add-contract', 'uses' => 'Admin\NewCustomerController@ajaxAction']);
            Route::match(['get', 'post'], '/admin/add-workplaces', ['as' => 'add-workplaces', 'uses' => 'Admin\NewCustomerController@ajaxAction']);
            
            
            
            
            Route::match(['get', 'post'], '/admin/newcustomer-ajaxAction', ['as' => 'newcustomer-ajaxAction', 'uses' => 'Admin\NewCustomerController@ajaxAction']);
            
            Route::match(['get', 'post'], '/admin/add-workplaceContact', ['as' => 'add-workplaceContact', 'uses' => 'Admin\NewCustomerController@ajaxAction']);
            Route::match(['get', 'post'], '/admin/add_workplacedetails', ['as' => 'add_workplacedetails', 'uses' => 'Admin\CustomerWorkplaceController@add_workplacedetails']);
            Route::match(['get', 'post'], '/admin/edit_workplacedetails', ['as' => 'edit_workplacedetails', 'uses' => 'Admin\CustomerWorkplaceController@edit_workplacedetails']);
            Route::match(['get', 'post'], '/admin/delete-workplace', ['as' => 'delete-workplace', 'uses' => 'Admin\NewCustomerController@delete_workplace']);
            Route::match(['get', 'post'], '/admin/edit-workplace', ['as' => 'edit-workplace', 'uses' => 'Admin\NewCustomerController@edit_workplace']);
            
            Route::match(['get', 'post'], '/admin/newcustomerWorkplace-ajaxAction', ['as' => 'newcustomerWorkplace-ajaxAction', 'uses' => 'Admin\CustomerWorkplaceController@ajaxAction']);
            

            Route::match(['get', 'post'], '/admin/admin-dashboard', ['as' => 'admin-dashboard', 'uses' => 'Admin\AdminController@dashboard']);

            Route::match(['get', 'post'], '/admin/dashboard/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\AdminController@ajaxAction']);
            
            Route::match(['get', 'post'], '/admin/dashboard-ajaxAction', ['as' => 'dashboard-ajaxAction', 'uses' => 'Admin\AdminController@ajaxAction']);

            

            Route::match(['get', 'post'], '/admin/workplacepdf', ['as' => 'workplacepdf', 'uses' => 'Admin\AdminController@workplacePDF']);

            Route::match(['get', 'post'], '/admin/staffworkpdf', ['as' => 'staffworkpdf', 'uses' => 'Admin\AdminController@staffworkPDF']);

            Route::match(['get', 'post'], '/admin/infoBydatePDF', ['as' => 'infoBydatePDF', 'uses' => 'Admin\AdminController@infoBydatePDF']);

            

            Route::match(['get', 'post'], '/admin/user-list', ['as' => 'user-list', 'uses' => 'Admin\AdminController@getUserData']);

            Route::match(['get', 'post'], '/admin/add-user', ['as' => 'add-user', 'uses' => 'Admin\AdminController@addUser']);

            Route::match(['get', 'post'], '/admin/edit-user/{id}', ['as' => 'edit-user', 'uses' => 'Admin\AdminController@editUser']);

            Route::match(['get', 'post'], 'user/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\AdminController@ajaxAction']);



            Route::match(['get', 'post'], '/admin/system-user-list', ['as' => 'system-user-list', 'uses' => 'Admin\SystemuserController@getUserData']);

            Route::match(['get', 'post'], '/admin/system-add-user', ['as' => 'system-add-user', 'uses' => 'Admin\SystemuserController@addUser']);

            Route::match(['get', 'post'], '/admin/system-edit-user/{id}', ['as' => 'system-edit-user', 'uses' => 'Admin\SystemuserController@editUser']);



            Route::match(['get', 'post'], '/admin/customer-list', ['as' => 'customer-list', 'uses' => 'Admin\CustomerController@getCustomerData']);
            
            Route::match(['get', 'post'], '/admin/customer-list-search', ['as' => 'customer-list-search', 'uses' => 'Admin\NewCustomerController@getCustomerListsearch']);
            
            Route::match(['get', 'post'], '/admin/customer-add', ['as' => 'customer-add', 'uses' => 'Admin\CustomerController@addCustomer']);

            Route::match(['get', 'post'], '/admin/customer-edit/{id}', ['as' => 'customer-edit', 'uses' => 'Admin\CustomerController@editCustomer']);



            Route::match(['get', 'post'], '/admin/product-list', ['as' => 'product-list', 'uses' => 'Admin\ProductController@getProdctList']);

            Route::match(['get', 'post'], '/admin/product-add', ['as' => 'product-add', 'uses' => 'Admin\ProductController@addProduct']);

            Route::match(['get', 'post'], '/admin/product-edit/{id}', ['as' => 'product-edit', 'uses' => 'Admin\ProductController@editProduct']);

            Route::match(['get', 'post'], '/admin/product/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\ProductController@ajaxAction']);
     /* disease routes */
            Route::match(['get', 'post'], '/admin/disease', ['as' => 'disease', 'uses' => 'Admin\DiseaseController@dieseaseList']);
            Route::match(['get', 'post'], '/admin/edit-disease/{id}', ['as' => 'edit-disease', 'uses' => 'Admin\DiseaseController@editdieseaseList']);
            Route::match(['get', 'post'], '/admin/disease-delete', ['as' => 'disease-delete', 'uses' => 'Admin\DiseaseController@deletedieseaseList']);
            Route::match(['get', 'post'], '/admin/submitAction', ['as' => 'submitAction', 'uses' => 'Admin\DiseaseController@submitAction']);
            Route::match(['get', 'post'], '/admin/disease/ajaxAction', ['as' => 'disease-ajaxAction', 'uses' => 'Admin\DiseaseController@ajaxAction']);
            Route::match(['get', 'post'], '/admin/disease-list-search', ['as' => 'disease-list-search', 'uses' => 'Admin\DiseaseController@getDiseaseListsearch']);
            
            Route::match(['get', 'post'], '/admin/paidAction', ['as' => 'paidAction', 'uses' => 'Admin\holidayController@paidAction']);
            /* Workplaces route */
//            
            Route::match(['get', 'post'], '/admin/holiday', ['as' => 'holiday', 'uses' => 'Admin\holidayController@holidayList']);
            Route::match(['get', 'post'], '/admin/holidays-delete', ['as' => 'holidays-delete', 'uses' => 'Admin\holidayController@deleteHolidaysList']);
            Route::match(['get', 'post'], '/admin/edit-holidays/{id}', ['as' => 'edit-holidays', 'uses' => 'Admin\holidayController@editHolidaysList']);
            Route::match(['get', 'post'], '/admin/holiday/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\holidayController@ajaxAction']);
            Route::match(['get', 'post'], '/admin/holiday-list-search', ['as' => 'holiday-list-search', 'uses' => 'Admin\holidayController@getHolidayListsearch']);
            
            Route::match(['get', 'post'], '/admin/workplaces-list', ['as' => 'workplaces-list', 'uses' => 'Admin\WorkplacesController@getWorkplacesList']);

            Route::match(['get', 'post'], '/admin/workplaces-add', ['as' => 'workplaces-add', 'uses' => 'Admin\WorkplacesController@addWorkplaces']);

            Route::match(['get', 'post'], '/admin/workplaces-edit/{id}', ['as' => 'workplaces-edit', 'uses' => 'Admin\WorkplacesController@editWorkplaces']);

            Route::match(['get', 'post'], '/admin/workplaces/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\WorkplacesController@ajaxAction']);

            Route::match(['get', 'post'], '/admin/workplaces/ajaxActions', ['as' => 'ajaxActions', 'uses' => 'Admin\WorkplacesController@ajaxActions']);

            Route::match(['get', 'post'], '/admin/workplaces-list/delWorkplaces', ['as' => 'delWorkplaces', 'uses' => 'Admin\WorkplacesController@delWorkplaces']);



            /* Worker route */



            Route::match(['get', 'post'], '/admin/worker-list/{id?}', ['as' => 'worker-list', 'uses' => 'Admin\WorkerController@getWorkerList']);

            Route::match(['get', 'post'], '/admin/worker-add', ['as' => 'worker-add', 'uses' => 'Admin\WorkerController@addWorker']);

            Route::match(['get', 'post'], '/admin/worker-edit/{id}/{pageno}', ['as' => 'worker-edit', 'uses' => 'Admin\WorkerController@editWorker']);

            Route::match(['get', 'post'], '/admin/worker/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\WorkerController@ajaxAction']);
            Route::match(['get', 'post'], '/admin/worker-ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\WorkerController@ajaxAction']);

            Route::match(['get', 'post'], '/admin/worker-list-search', ['as' => 'worker-list-search', 'uses' => 'Admin\WorkerController@getWorkerListsearch']);



            /* Timesheet route */

            Route::match(['get', 'post'], '/admin/timesheet-list', ['as' => 'timesheet-list', 'uses' => 'Admin\TimesheetController@getTimesheetList']);

            Route::match(['get', 'post'], '/admin/timesheet-list-search', ['as' => 'timesheet-list-search', 'uses' => 'Admin\TimesheetController@getTimesheetListsearch']);

            Route::match(['get', 'post'], '/admin/timesheet-edit/{id}', ['as' => 'timesheet-edit', 'uses' => 'Admin\TimesheetController@editTimesheet']);

            Route::match(['get', 'post'], '/admin/timesheet/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\TimesheetController@ajaxAction']);

            /* Information route */
            Route::match(['get', 'post'], '/admin/information-list', ['as' => 'information-list', 'uses' => 'Admin\InformationController@getInformationList']);
            
            Route::match(['get', 'post'], '/admin/information/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'Admin\InformationController@ajaxAction']);

            Route::match(['get', 'post'], '/admin/informatiion-list-search', ['as' => 'information-list-search', 'uses' => 'Admin\InformationController@getInformationListsearch']);

            Route::match(['get', 'post'], '/admin/information-edit/{id}', ['as' => 'information-edit', 'uses' => 'Admin\InformationController@informationEdit']);

            /* Profile route */

            Route::match(['get', 'post'], 'update-profile', ['as' => 'update-profile', 'uses' => 'Admin\UpdateProfileController@editProfile']);

            Route::match(['get', 'post'], 'update-change-password', ['as' => 'update-change-password', 'uses' => 'Admin\UpdateProfileController@changepassword']);
            //Workplace Route
            Route::match(['get', 'post'], '/admin/workplacecustomer-ajaxcall', ['as' => 'workplacecustomer-ajaxcall', 'uses' => 'Admin\CustomerWorkplaceController@ajaxAction']);
            Route::match(['get', 'post'], '/admin/workplacecustomer-ajaxcall', ['as' => 'workplacecustomer-ajaxcall', 'uses' => 'Admin\CustomerWorkplaceController@ajaxAction']);
        });







