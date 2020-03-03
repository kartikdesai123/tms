<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Worker;
use App\Model\Information;
use App\Model\Timesheet;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Illuminate\Http\Request;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class WorkerController extends Controller {

    public function __construct() {
        parent::__construct();

        $this->middleware('admin');
        //$this->middleware('guest:admin', ['except' => ['subDashboard']]);
        //$this->middleware('guest:subadmin', ['except' => ['mainDashboard', 'subDashboard']]);
    }

    public function getWorkerList() {
        
        $objWorker = new Worker();
        $workerList = $objWorker->getWorkerList();
        //dd($workerList);exit;
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/worker.js');
        $data['funinit'] = array('Worker.listInit()');
     
        $data['arrWorker'] = $workerList;
       
        $data['detail'] = $this->loginUser;
        return view('admin.worker.worker-list', $data);
    }
	
	public function addWorker(Request $request) {
        $data['detail'] = $this->loginUser;

        $objWorker = new Worker();
        $workerList = $objWorker->getWorkerList();
        $data['arrWorker'] = $workerList;

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        if ($request->isMethod('post')) {
//            print_r($request->input());exit;

			/*code by dhaval*/
			$staffstatus = $objUser->GetUserByStaffNumber($request->input('staffnumber'));
			if ($staffstatus)
			{
				$return['status'] = 'error';
                $return['message'] = 'Staff number already taken';
				echo json_encode($return);
            	exit;	
			}
			/*code by dhaval*/
			
            $workerList = $objWorker->saveWorkerInfo($request); 
            if ($workerList) {
                $return['status'] = 'success';
                $return['message'] = 'Worker created successfully.';
                $return['redirect'] =  route('worker-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/worker.js');
        $data['funinit'] = array('Worker.addInit()');
        return view('admin.worker.worker-add', $data);
    }
    public function editWorker($userId , Request $request) {
        $data['detail'] = $this->loginUser;

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        if ($request->isMethod('post')) {
//            print_r($request->input());exit;
            $objWorker = new Worker();
            $workerList = $objWorker->updateWorkerInfo($request);
            if ($workerList) {
                $return['status'] = 'success';
                $return['message'] = 'Update Worker successfully.';
                $return['redirect'] =  route('worker-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/worker.js');
        $data['funinit'] = array('Worker.editInit()');
        
        $objMuck = new Worker();
        $muckDetail = $objMuck->getWorkerList1($userId);
        $data['workerDetail'] = $muckDetail;
        
        return view('admin.worker.worker-edit', $data);
    }
    
    public function deleteWorker($postData) {
        
        Timesheet::where('worker_id',$postData['id'])->delete();
        $result = Worker::find($postData['id'])->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Worker Delete successfully.';
            $return['redirect'] = route('worker-list');
        } else {
            $return['status'] = 'error';
            $return['message'] = 'something will be wrong.';
        }
        echo json_encode($return);
        exit;
    }
    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'deleteWorker':
                $result = $this->deleteWorker($request->input('data'));
                break;
        }
    }
    public function getWorkerListsearch(Request $request) {
        
        $data['dates']=[$request->input()['start_date'],$request->input()['end_date']];
        $objWorker = new Worker();
        $workerList = $objWorker->getWorkerList($request);
        //dd($workerList);exit;
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/worker.js');
        $data['funinit'] = array('Worker.listInit()');
     
        $data['arrWorker'] = $workerList;
        
        $data['detail'] = $this->loginUser;

        $userid = new Users;
        $getUserId = $userid->getUserId();
        $data['getUserId'] = $getUserId;


        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;


        $data['detail'] = $this->loginUser;
        return view('admin.worker.worker-list', $data);
    }
   

}