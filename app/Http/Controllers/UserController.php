<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Timesheet;
use App\Model\Information;
use App\Model\Disease;
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
            $data['serchbardetails']=['workplaces'=>'','month'=>date('m'),'year'=>date('Y')];
            
            $objWorkplaces = new Workplaces();
            $workplacesList = $objWorkplaces->getWorkplacesList();
            $data['workplacesList']=$workplacesList;
            $data['arrWorkplaces'] = $user['workplaces'];
            
            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrWorker'] = $userList;

            $objTimesheet = new Timesheet();
            $timesheetList = $objTimesheet->getTimesheetListNewWorkerNew($user_id);
            $data['arrTimesheet'] = $timesheetList;
            
            $total_time = $objTimesheet->gettotaltime_worker_new($user_id = $this->loginUser['id']);
            $last_login = $objUser->UpdatelastLogin($this->loginUser['id']);
            $data['total_time'] = $total_time;
            
        if ($request->isMethod('post')) {
            
            $workertimesheetList = $objUser->savetimesheetWorkerInfo($request); 
            
            if ($workertimesheetList=="Added") {
                $return['status'] = 'success';
                $return['message'] = 'Date and time created successfully.';
                $return['redirect'] =  route('worker-dashboard');
            } else 
                {
                    if($workertimesheetList=='timeissue'){
                        $return['status'] = 'error';
                        $return['message'] = 'End time always garter then start time';
                    }else{
                        if($workertimesheetList=='wrongPauseTime'){
                            $return['status'] = 'error';
                            $return['message'] = "You can't use pause time more then working time";
                        }else{
                            if($workertimesheetList=='dateAdded'){
                                $return['status'] = 'error';
                                $return['message'] = 'Date and time already added.';  
                            }else{
                                if($workertimesheetList == 'sameTIme'){
                                    $return['status'] = 'error';
                                    $return['message'] = 'Working time cant be same like pause time';  
                                }else{
                                    if($workertimesheetList == 'wrongTime'){
                                        $return['status'] = 'error';
                                        $return['message'] = 'End time always grater then strat time.';  
                                    }else{
                                        $return['status'] = 'error';
                                        $return['message'] = 'something will be wrong.';  
                                    }
                                }   
                            }
                            
                        }
                    }
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array('timepicker.css');
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js','timepicker.js');
        $data['funinit'] = array('TWorker.addInit()');
        return view('worker.dashboard', $data);
    }

    public function getworkersearchList(Request $request) {
        
        $data['serchbardetails']=$request->input();
        $data['detail'] = $this->loginUser; 
        
        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['workplacesList']=$workplacesList;
        $user_id = $this->loginUser['id']; 
        $user = Users::find($user_id);
        
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;
        $user = Users::find($user_id);
        $data['arrWorkplaces'] = $user['workplaces'];

        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrWorker'] = $userList;


        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        $data['arrTimesheet'] = $timesheetList;
        
         if ($request->isMethod('get')) {
            $objTimesheet = new Timesheet();
            $total_time = $objTimesheet->totalTimeWorker($request,$user_id);
            $data['total_time'] = $total_time;
        
            $objTimesheet = new Information();
            $timesheetsearchList = $objTimesheet->search_date_workerInfo($user_id,$request); 
            $data['arrTimesheet'] = $timesheetsearchList;
         }
         
        $data['css'] = array('timepicker.css');
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js','timepicker.js');
        $data['funinit'] = array('TWorker.addInit()');
        return view('worker.dashboard', $data);
    }
    
    public function workerinformationedit(Request $request,$id=''){
        $data['detail'] = $this->loginUser; 
        
        if ($request->isMethod('post')) {
           
           $objInformation = new Information();
           $workertimesheetList=$objInformation->editinformation($request,$id);
            
            if ($workertimesheetList=="Added") {
                $return['status'] = 'success';
                $return['message'] = 'Date and time created successfully.';
                $return['redirect'] =  route('worker-dashboard');
            }else{
                    if($workertimesheetList=='timeissue'){
                        $return['status'] = 'error';
                        $return['message'] = 'End time always garter then start time';
                    }else{
                        if($workertimesheetList=='wrongPauseTime'){
                            $return['status'] = 'error';
                            $return['message'] = "You can't use pause time more then working time";
                        }else{
                            if($workertimesheetList=='dateAdded'){
                                $return['status'] = 'error';
                                $return['message'] = 'Date and time already added.';  
                            }else{
                                if($workertimesheetList == 'sameTIme'){
                                    $return['status'] = 'error';
                                    $return['message'] = 'Working time cant be same like pause time';  
                                }else{
                                    if($workertimesheetList == 'wrongTime'){
                                        $return['status'] = 'error';
                                        $return['message'] = 'End time always grater then strat time.';  
                                    }else{
                                        $return['status'] = 'error';
                                        $return['message'] = 'something will be wrong.';  
                                    }
                                }   
                            }
                            
                        }
                    }
            }
            echo json_encode($return);
            exit;
        }
        $objInformation = new Information();
        $data['objinformationreason'] = $objInformation->getInformation($id);
        $data['id']=$id;
        
        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['workplacesList']=$workplacesList;
        
        $data['css'] = array('timepicker.css');
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js','timepicker.js');
        $data['funinit'] = array('TWorker.editInit()');
        
        return view('worker.worker-edit-information', $data);
    }

    public function disease(Request $request){
        $data['detail'] = $this->loginUser; 
        $user_id = $this->loginUser['id'];
        
        
        $objDiseaseList=new Disease();
        $data['diseaseList']=$objDiseaseList->diseaseList($user_id);
        if ($request->isMethod('post')) {
            
        }
        $data['css'] = array('timepicker.css');
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/disease.js','timepicker.js');
        $data['funinit'] = array('Disease.Init()');
        return view('worker.diseaselist', $data);
    }
    
}