<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Timesheet;
use App\Model\Information;
use App\Http\Controllers\Controller;

class TimesheetSupervisorController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->middleware('customer');
    }

    public function dashboard(Request $request) {
        
            $data['detail'] = $this->loginUser; 
            $objWorkplaces = new Workplaces();
            $workplacesList = $objWorkplaces->getWorkplacesList();
            $data['arrWorkplaces'] = $workplacesList;

            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrWorker'] = $userList;


            $objTimesheet = new Timesheet();
            $timesheetList = $objTimesheet->getTimesheetList();
            $data['arrTimesheet'] = $timesheetList;

        if ($request->isMethod('post')) {
            $workertimesheetList = $objUser->savetimesheetWorkerInfo($request); 
            if ($workertimesheetList=="Added") {
                $return['status'] = 'success';
                $return['message'] = 'Date and time created successfully.';
                $return['redirect'] =  route('worker-dashboard');
            } else {
                if($workertimesheetList=='dateAdded'){
                    $return['status'] = 'error';
                    $return['message'] = '2 objects same time not possible.';
                }else{
                    if($workertimesheetList=='timeissue'){
                        $return['status'] = 'error';
                        $return['message'] = 'End time always garter then start time';
                    }else{
                        if($workertimesheetList=='wrongPauseTime'){
                            $return['status'] = 'error';
                            $return['message'] = "You can't use pause time more then working time";
                        }else{
                            $return['status'] = 'error';
                            $return['message'] = 'something will be wrong.';
                        }
                    }
                }  
            }
            echo json_encode($return);
            exit;
        }
        
        
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js');
        $data['funinit'] = array('TWorker.addInit()');
        return view('supervisor.dashboard', $data);
    }
    public function timesheet_list(Request $request) {
        $data['serchlist']=['','',date('m'),date('Y')];
        
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;
        
        $objTimesheet = new Timesheet();
        $total_time = $objTimesheet->gettotaltime();
        $data['total_time'] = $total_time;
        
        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetListSupervisoer();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.listInitSuper()');
     
        $data['arrTimesheet'] = $timesheetList;
        
        $data['detail'] = $this->loginUser;

        if ($request->isMethod('post')) {
           $objTimesheet = new Timesheet();
           $timesheetsearchList = $objTimesheet->searchtimesheetInfo($request); 
           $data['arrTimesheet'] = $timesheetsearchList;
        }
        return view('supervisor.timesheet_list', $data);
    }
    public function getsearchTimesheetList(Request $request) {
        $input=$request->input();
        $data['serchlist']=[$input['name'],$input['workplaces'],$input['month'],$input['year']];
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;
        
        $objTimesheet = new Timesheet();
        $total_time = $objTimesheet->gettotaltime($request);
        $data['total_time'] = $total_time;
        
        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.listInitSuper()');
     
        $data['arrTimesheet'] = $timesheetList;
        $data['detail'] = $this->loginUser;

         if ($request->isMethod('get')) {
            $objTimesheet = new Timesheet();
            $timesheetsearchList = $objTimesheet->searchtimesheetInfo($request); 
            $data['arrTimesheet'] = $timesheetsearchList;
           
         }
        return view('supervisor.timesheet_list', $data);
    }

    public function getsearchInformationList(Request $request) {
            $input=$request->input();
            
            $data['serchbardetails']=[$input['name'],$input['workplaces'],$input['month'],$input['year']];
            $data['detail'] = $this->loginUser; 

            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrUser'] = $userList;

            $objWorkplaces = new Workplaces();
            $workplacesList = $objWorkplaces->getWorkplacesList();
            $data['arrWorkplaces'] = $workplacesList;

            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrWorker'] = $userList;
            $data['css'] = array();
            $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
            $data['js'] = array('superviseor/superviseor.js');
            $data['funinit'] = array('Superviseor.informationListInit()');

            $objTimesheet = new Timesheet();
            $timesheetList = $objTimesheet->getTimesheetList();
            $data['arrTimesheet'] = $timesheetList;
            
         if ($request->isMethod('get')) {
            $objTimesheet = new Information();
            $timesheetsearchList = $objTimesheet->searchinformationInfoNew($request); 
            $data['arrInformation'] = $timesheetsearchList;
         }
        return view('supervisor.information-list', $data);
    }

    public function getdassearchList(Request $request) {
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.listInit()');
     
        $data['arrTimesheet'] = $timesheetList;
        $data['detail'] = $this->loginUser;

         if ($request->isMethod('post')) {
            $objTimesheet = new Timesheet();
            $timesheetsearchList = $objTimesheet->searchtimesheetInfo($request); 
            $data['arrTimesheet'] = $timesheetsearchList;
         }
        return view('supervisor.dash-search-list', $data);

    }
//==================================================================================================================
    public function getdassearchInformationList(Request $request) {
//            print_r($request->input(''));exit;
            
            $data['serchbardetails']=['workplaces'=>$request->input('workplaces'),'month'=>$request->input('month'),'year'=>$request->input('year')];
            $data['detail'] = $this->loginUser; 
            $user_id = $this->loginUser['id'];
            $user = Users::find($user_id);
            
            $objTimesheet = new Timesheet();
            $data['totaltime'] = $objTimesheet->getTotallTime($user_id ,$request);
            
            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrUser'] = $userList;

            $objWorkplaces = new Workplaces();
            $workplacesList = $objWorkplaces->getWorkplacesList();
            $data['arrWorkplaces'] = $user['workplaces'];
            
            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrWorker'] = $userList;
            $timesheetList = $objTimesheet->getTimesheetList();
            $data['arrTimesheet'] = $timesheetList;

         if ($request->isMethod('get')) {
             
            $objTimesheet = new Information();
            $timesheetsearchList = $objTimesheet->search_date_workerInfo($user_id,$request); 
            $data['arrTimesheet'] = $timesheetsearchList;
         }
         $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js');
        $data['funinit'] = array('TWorker.addInitSuper()');
        return view('supervisor.dashboard', $data);
    }
    
}