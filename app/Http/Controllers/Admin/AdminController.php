<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Worker;
use App\Model\Timesheet;
use App\Model\Information;
use App\Model\workplaces;
use App\Model\Holidays;
use App\Model\Disease;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use PDF;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class AdminController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    public function dashboard(Request $request) {
        $data['detail'] = $this->loginUser;
        
        $objUser = new Users();
        $userList = $objUser->gtBeststafflist();
        
        $objWorkplaces = new workplaces();
        $data['getWorkPlace'] = $objWorkplaces->getWorkplacesnew();
        
        $objUser = new Users();
	$data['getStaff'] = $objUser->newgetDashboradStaff();
        
        $data['arrBeststaff'] = $userList;
        
        $data['months'] = $postData['months']=date('m');
        $data['year'] = $postData['year']=date("Y"); 
        
        $year = date("Y");
        $objTimesheet = new Timesheet();
        $data['countDisease'] = $objTimesheet->getDisease($year);
        
        $objTimesheet = new Timesheet();
        $data['countHolidays'] = $objTimesheet->getholidays($year);
        
        $objTimeheet = new Information();
        $data['arrInformation'] = $objTimeheet->getNewInfoDataBytoday();
        
        $data['css'] = array();
        $data['plugincss'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');        
        
        $data['js'] = array('admin/dashboard.js');
        $data['funinit'] = array('Dashboard.init()');
        return view('admin.dashboard', $data);
    }

    public function getUserData(Request $request) {
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/customer.js');
        $data['funinit'] = array('Customer.listInit()');
        $data['arrUser'] = $userList;
        $data['detail'] = $this->loginUser;
        return view('admin.user.user-list', $data);
    }

    public function addUser(Request $request) {
        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
//            print_r($request->input());exit;
            $objUser = new Users();
            $userList = $objUser->saveUserInfo($request);
            if ($userList) {
                $return['status'] = 'success';
                $return['message'] = 'User created successfully.';
                $return['jscode'] = 'setTimeout(function(){location.reload();},1000)';
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/customer.js');
        $data['funinit'] = array('Customer.addInit()');


        return view('admin.user.add-user', $data);
    }

    public function editUser($userId, Request $request) {
        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
//            print_r($request->input());exit;
            $objUser = new Users();
            $userList = $objUser->updateUserInfo($request);
            if ($userList) {
                $return['status'] = 'success';
                $return['message'] = 'User Edit successfully.';
                $return['redirect'] = route('user-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/customer.js');
        $data['funinit'] = array('Customer.editInit()');

        $objMuck = new Users();
        $muckDetail = $objMuck->gtUsrLlist($userId);
        $data['userDetail'] = $muckDetail;

        return view('admin.user.edit-user', $data);
    }

    public function deleteUser($postData) {
        $result = Users::find($postData['id'])->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'User Delete successfully.';
            $return['redirect'] = route('user-list');
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
            case 'deleteUser':
                $result = $this->deleteUser($request->input('data'));
                break;
            
            case 'workplacedatatable':
               
                $objTimeheet = new Timesheet();
                $list = $objTimeheet->workplacedatatable($request['data']);
                echo json_encode($list);
                break;
            case 'newInformation':
                $objTimeheet = new Information();
                $list = $objTimeheet->newInformation_Datable($request['data']);
                echo json_encode($list);
                break;
            
            case 'staffIdHolidayList':
                $temp=$request->input('data');
                $year = $temp['yearHoliday'];
                if($temp['staffId'] == '' || $temp['staffId'] == NULL ){
                    $objTimesheet = new Timesheet();
                    $data['countDisease'] = $objTimesheet->getHolidays($year);
                    $resultList = view('admin.dashboard.staffIdHolidaysListAll', $data)->render();
                    
                    echo $resultList;
                    exit;
                }else{
                    $objTimeheet = new Timesheet();
                    $data['resultList'] = $objTimeheet->staffIdHolidyasList($request->input('data'));
                    $resultList = view('admin.dashboard.staffIdholidaysList', $data)->render();
                    echo $resultList;
                    exit;
                    break;
                }
                
            case 'staffIdDiseaseList':
                $temp=$request->input('data');
                $year = $temp['yearDisease'];
                if($temp['staffId'] == '' || $temp['staffId'] == NULL ){
                    $objTimesheet = new Timesheet();
                    $data['countDisease'] = $objTimesheet->getDisease($year);
                    $resultList = view('admin.dashboard.staffIdDiseaseListAll', $data)->render();
                    
                    echo $resultList;
                    exit;
                }else{
                    $objTimeheet = new Timesheet();
                    $data['resultList'] = $objTimeheet->staffIdDiseaseList($request->input('data'));
                    $resultList = view('admin.dashboard.staffIdDiseaseList', $data)->render();
                    echo $resultList;
                    exit;
                    break; 
                }
                
            case 'selectstautusworker':
                $data = $request->input('data') ;
//                print_r($request->input('selectstautusworker'));
//                die();
                $objUser = new Users();
                $data['resultList'] = $objUser->newgetDashboradStaffshorting($data['selectstautusworker']);
                
                $resultList = view('admin.dashboard.selectstautusworker', $data)->render();
                echo $resultList;
                exit;
                
            case 'selectstatus':                
                $data = $request->input('data') ;                
                $objUser = new Users();
                $data['resultList'] = $objUser->newgetDashboradStaffshortingbystatus($data['selectstatus']);                
                $resultList = view('admin.dashboard.selectstatus', $data)->render();
                echo $resultList;
                exit;
                
            case 'getStaffData':                
                $data = $request->input('data') ;       
                
                $objTimeheet = new Timesheet();
                $resultList = $objTimeheet->getStaffListDataDatatble($data);
                echo json_encode($resultList);
                break;
//                $objUser = new Users();
//                $data['resultList'] = $objUser->newgetDashboradStaffshortingbystatus($data['selectstatus']);                
//                $resultList = view('admin.dashboard.selectstatus', $data)->render();
//                echo $resultList;
//                exit;
            
            case 'getBestStaffData':
                $objTimeheet = new Timesheet();
                $arrTimeheet = $objTimeheet->getBestStaffData($request->input('data'));
                echo json_encode($arrTimeheet);
                exit;
                break;
            case 'getRestWorkPlace':
                $objTimeheet = new Timesheet();
                $arrTimeheet = $objTimeheet->getRestWorkplace($request->input('data'));
                echo json_encode($arrTimeheet);
                exit;
                break;
            case 'getWorkplaceListData':
                $this->getWorkplaceList($request->input('data'));
                break;
            case 'getStaffListData':
                $this->getStaffListData($request->input('data'));
                break;
            case 'getNewInfoData':
                $this->getNewInfoData($request->input('data'));
                break;
            case 'getNewInfoDataBydate':
                $this->getNewInfoDataBydate($request->input('data'));
                break;
        }
    }

    public function getWorkplaceList($param) {
        $objTimeheet = new Timesheet();
        $data['arrTimeheet'] = $objTimeheet->getWorkplaceListData($param);
        $totaltime = $objTimeheet->getWorkplaceTotalTime($param);
        $resultList = $totaltime;
        echo $totaltime;
        exit;
    }
    
    public function getStaffListData($param) {
        
        $objTimeheet = new Timesheet();
        $data['arrTimeheet'] = $objTimeheet->getStaffListData($param);
        $data['totaltime'] = $objTimeheet->getStaffTotalTime($param);
        $data['holidays'] = $objTimeheet->getStaffTotalHolidays($param);
        $data['disease'] = $objTimeheet->getStaffTotalDisease($param);
//        $resultList = view('admin.dashboard.staff-list', $data)->render();
        echo json_encode($data);
        exit;
    }
    
    public function workplacePDF(){
        
        $param = $_GET;
        $objTimeheet = new Timesheet();
        $data['arrTimeheet'] = $objTimeheet->getWorkplaceListData($param);
        $data['totaltime'] = $objTimeheet->getWorkplaceTotalTime($param);
        $pdf = PDF::loadView('admin.pdf.workplace', $data);
        //  $pdf = PDF::loadView('admin.invoice.invoice-pdfV2');
        return $pdf->stream();
        exit;
    }
    
    public function staffworkPDF(){
        
        $param = $_GET;
        $objTimeheet = new Timesheet();
	$objUsers = new Users();
        $data['arrTimeheet'] = $objTimeheet->getStaffListData($param);
        
        $data['totaltime'] = $objTimeheet->getStaffTotalTime($param);
        
        $data['holidays'] = $objTimeheet->getStaffTotalHolidays($param);
        $data['disease'] = $objTimeheet->getStaffTotalDisease($param);
	
        $data ['empdata'] = $objUsers->gtUsrname($param);
        $pdf = PDF::loadView('admin.pdf.staffwork', $data);
        //  $pdf = PDF::loadView('admin.invoice.invoice-pdfV2');
        return $pdf->stream();
        exit;
    }
    public function infoBydatePDF(){
        
        $param = $_GET;
        $objTimeheet = new Information();
        $data['arrInformation'] = $objTimeheet->getNewInfoDataBydateNew($param);
        
        $pdf = PDF::loadView('admin.pdf.infobydatepdf', $data);
        //  $pdf = PDF::loadView('admin.invoice.invoice-pdfV2');
        return $pdf->stream();
        exit;
    }
    public function getNewInfoData($param){
        
        
        $objTimeheet = new Information();
        $data['arrInformation'] = $objTimeheet->getNewInfoData($param);
        
        $resultList = view('admin.dashboard.getnewinfo', $data)->render();
        echo $resultList;
        exit;
    }
    public function getNewInfoDataBydate($param){
        
        $objTimeheet = new Information();
        $data['arrInformation'] = $objTimeheet->getNewInfoDataBydatenew($param);
        
        $resultList = view('admin.dashboard.getnewinfo', $data)->render();
        echo $resultList;
        exit;
    }

}