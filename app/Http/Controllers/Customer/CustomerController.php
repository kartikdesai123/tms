<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Timesheet;
use App\Http\Controllers\Controller;
use App\Model\Information;

class CustomerController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->middleware('customer');
    }

    public function dashboard(Request $request) {
            $data['serchbardetails']=['workplaces'=>'','month'=>date('m'),'year'=>date('Y')];
            
            $data['detail'] = $this->loginUser;
            $user_id = $this->loginUser['id'];
            $user = Users::find($user_id);

            $data['arrWorkplaces'] = $user['workplaces'];

            $objUser = new Users();
            $userList = $objUser->gtUsrLlist();
            $data['arrWorker'] = $userList;


            $objTimesheet = new Timesheet();
            $timesheetList = $objTimesheet->getTimesheetListNewWorker($user_id);
            $data['arrTimesheet'] = $timesheetList;
            
            $data['totaltime'] = $objTimesheet->getTotallTime($user_id);
            $last_login = $objUser->UpdatelastLogin($this->loginUser['id']);
           
        if ($request->isMethod('post')) {
           
            $workertimesheetList = $objUser->savetimesheetWorkerInfo($request); 
            
            
            if ($workertimesheetList=="Added") {
                $return['status'] = 'success';
                $return['message'] = 'Date and time created successfully.';
                $return['redirect'] =  route('customer-dashboard');
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

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js');
        $data['funinit'] = array('TWorker.addInitSuper()');
        return view('supervisor.dashboard', $data);
    }  
	
	public function supervisorinformationedit(Request $request,$id=''){
            $data['detail'] = $this->loginUser; 
            $data['user_id'] = $this->loginUser['id'];
            
            $objWorkplaces = new Workplaces();
            $workplacesList = $objWorkplaces->getWorkplacesList();
            $data['workplacesList']=$workplacesList;
        if ($request->isMethod('post')) {
           $objInformation = new Information();
           $workertimesheetList=$objInformation->editinformation($request,$id);
            
            if ($workertimesheetList=="Added") {
                $return['status'] = 'success';
                $return['message'] = 'Date and time created successfully.';
                $return['redirect'] =  route('customer-dashboard');
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
        
        $objInformation = new Information();
        $data['objinformationreason'] = $objInformation->getInformation($id);
        $data['id']=$id;
        
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('worker/tworker.js');
        $data['funinit'] = array('TWorker.editInit()');
        return view('supervisor.worker-edit-information', $data);
    }  
}