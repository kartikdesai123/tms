<?php

namespace App\Http\Controllers\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Information;
use App\Model\Users;
use App\Model\Workplaces;

class InformationSupervisorController extends Controller {
    
    public function __construct() {
        parent::__construct();
        $this->middleware('customer');
    }

    public function dashboard() {
        $data['serchbardetails']=['','',date("m"),date("Y")];
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;
        
        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;
        
        $objInformation = new Information();
        $objinformationList = $objInformation->getTimesheetListNew();
        $data['arrInformation'] = $objinformationList;
        $data['detail'] = $this->loginUser; 
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('superviseor/superviseor.js');
        $data['funinit'] = array('Superviseor.informationListInit()');
        return view('supervisor.information-list', $data);
    }
    
    public function informationsupervisoeredit(Request $request,$id=''){
        
         $data['detail'] = $this->loginUser; 
         
        if ($request->isMethod('post')) {
           $objInformation = new Information();
           $saveinformation=$objInformation->editinformation($request);
            
           if($saveinformation) {
                $return['status'] = 'success';
                $return['message'] = 'Information edit successfully.';
                $return['redirect'] = route('information_supervisor');
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
        $data['js'] = array('superviseor/superviseor.js');
        $data['funinit'] = array('Superviseor.editInit()');
        return view('supervisor.worker-edit-information', $data);
    }
    
    public function informationtimesheetedit(Request $request,$id=""){
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
                $return['message'] = 'timesheet updated successfully.';
                $return['redirect'] =  route('timesheet_list');
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
        $objInformation = new Information();
        $data['objinformationreason'] = $objInformation->getInformation($id);
        
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('superviseor/superviseor.js');
        $data['funinit'] = array('Superviseor.informationInit()');
        return view('supervisor.information_timesheetedit', $data);
    
    }
    
    public function informationsupervisoredit(Request $request,$id=''){
         $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
           $objInformation = new Information();
           $saveinformation=$objInformation->editinformationadmin($request,$id,$data['detail']['id']);
            
           if($saveinformation) {
                $return['status'] = 'success';
                $return['message'] = 'Information edit successfully.';
                $return['redirect'] = route('information_supervisor');
            }else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;  
        }
        $objInformation = new Information();
        $data['objinformationreason'] = $objInformation->getInformation($id);
        
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('superviseor/superviseor.js');
        $data['funinit'] = array('Superviseor.informationInit()');
        $data['id']=$id;
        return view('supervisor.informationtimesheetedit', $data);
        
    }
}
