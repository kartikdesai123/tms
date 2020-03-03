<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Timesheet;
use App\Model\Information;
use Session;
use App\Http\Controllers\Controller;

class UserController extends Controller {
    
    public function __construct() {
        parent::__construct();
        //$this->middleware('web');
    }

    public function dashboard(Request $request) {
            $data['detail'] = $this->loginUser;

            $user_id = $this->loginUser['id'];
            $user = Users::find($user_id);

            //dd($user_id);

            //$objWorkplaces = new Workplaces();
            //$workplacesList = $objWorkplaces->getWorkplacesList();
            $data['arrWorkplaces'] = $user['workplaces'];

            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrWorker'] = $userList;


            $objTimesheet = new Timesheet();
            $timesheetList = $objTimesheet->getTimesheetList($user_id);
            $data['arrTimesheet'] = $timesheetList;
            
            
            $total_time = $objTimesheet->gettotaltime_worker($user_id = $this->loginUser['id']);
			/*code change by dhaval*/
			$last_login = $objUser->UpdatelastLogin($this->loginUser['id']);
            /*code change by dhaval*/
			$data['total_time'] = $total_time;
            
        if ($request->isMethod('post')) {
            /*print_r($request->input());
            exit;*/
            $workertimesheetList = $objUser->savetimesheetWorkerInfo($request); 
          
            if ($workertimesheetList=="Added") {
                $return['status'] = 'success';
                $return['message'] = 'Date and time created successfully.';
                $return['redirect'] =  route('worker-dashboard');
            } else {
                if($workertimesheetList=='dateAdded'){
                    $return['status'] = 'error';
                    $return['message'] = '2 objects same time not possible.';
                    $return['redirect'] =  route('worker-dashboard');
                }else{
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js');
        $data['funinit'] = array('TWorker.addInit()');
        return view('worker.dashboard', $data);
    }

    public function getworkersearchList(Request $request) {
         $objTimesheet = new Timesheet();
         $total_time = $objTimesheet->gettotaltime_worker_serch($request);
         $data['total_time'] = $total_time;
         
        $data['serchbardetails']=$request->input();
        $data['detail'] = $this->loginUser; 

        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        $user_id = $this->loginUser['id'];
        $user = Users::find($user_id);
        $data['arrWorkplaces'] = $user['workplaces'];

        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrWorker'] = $userList;


        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        $data['arrTimesheet'] = $timesheetList;

         if ($request->isMethod('post')) {
            $objTimesheet = new Information();
            $timesheetsearchList = $objTimesheet->search_date_workerInfo($request); 
            $data['arrTimesheet'] = $timesheetsearchList;
         }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js');
        $data['funinit'] = array('TWorker.addInit()');
        return view('worker.dashboard', $data);
    }
    
    public function workerinformationedit(Request $request,$id=''){
         $data['detail'] = $this->loginUser; 
         
        if ($request->isMethod('post')) {
           $objInformation = new Information();
           $saveinformation=$objInformation->editinformation($request,$id);
            
           if($saveinformation) {
                $return['status'] = 'success';
                $return['message'] = 'Information edit successfully.';
                $return['redirect'] = route('worker-dashboard');
            }else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        
        $objInformation = new Information();
        $data['objinformationreason'] = $objInformation->getInformation($id);
        $data['id']=$id;
        
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js');
        $data['funinit'] = array('TWorker.editInit()');
        return view('worker.worker-edit-information', $data);
    }
}