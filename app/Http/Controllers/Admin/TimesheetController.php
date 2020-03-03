<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Timesheet;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class TimesheetController extends Controller {

    public function __construct() {
        parent::__construct();

        $this->middleware('admin');
        //$this->middleware('guest:admin', ['except' => ['subDashboard']]);
        //$this->middleware('guest:subadmin', ['except' => ['mainDashboard', 'subDashboard']]);
    }

    public function getTimesheetList(Request $request) {
        
        $request->session()->forget('holidaydata');
        $request->session()->forget('infodata');
        $request->session()->forget('diseasedata');
        $value = $request->session()->get('timedata');
        if ($value[0]['name'] != '') {$name = $value[0]['name']; }else{ $name = ''; }
        if ($value[0]['workplaces'] != '') {$workplaces = $value[0]['workplaces']; }else{ $workplaces = ''; }
        if ($value[0]['month'] != '') {$month = $value[0]['month']; }else{ $month = date('m'); }
        if ($value[0]['year'] != '') {$year = $value[0]['year']; }else{ $year = date('Y'); }

        $data['serchbardetails'] = [$name, $workplaces, $month, $year];
        
        $data['detail'] = $this->loginUser;
        $data['string'] = '';
        $objUser = new Users();
        $userList = $objUser->gtUsrLlistNew();
        $data['arrUser'] = $userList;

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetListNew();

        $total_time = $objTimesheet->gettotaltimeNew();
        $data['total_time'] = $total_time;

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.listInit()');

        $data['arrTimesheet'] = $timesheetList;

        return view('admin.timesheet.timesheet-list', $data);
    }

    public function getTimesheetListsearch(Request $request) {

        $request->session()->forget('timedata');
        $timedata = array(
            'name' => $request->input('name'),
            'workplaces' => $request->input('workplaces'),
            'month' => $request->input('month'),
            'year' => $request->input('year'),
        );
        Session::push('timedata', $timedata);
        
        $data['string'] = $_SERVER['QUERY_STRING'];
        $data['serchbardetails'] = [$request->input('name'), $request->input('workplaces'), $request->input('month'), $request->input('year')];

        $objUser = new Users();
        $userList = $objUser->gtUsrLlistNew();
        $data['arrUser'] = $userList;

        $objTimesheet = new Timesheet();
        $total_time = $objTimesheet->gettotaltime($request);
        $data['total_time'] = $total_time;

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;



        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.listInit()');
        $data['detail'] = $this->loginUser;

        if ($request->isMethod('get')) {
            $objTimesheet = new Timesheet();
            $timesheetsearchList = $objTimesheet->searchtimesheetInfoNewAdmin($request);
            $data['arrTimesheet'] = $timesheetsearchList;
        }

        return view('admin.timesheet.timesheet-list', $data);
    }

//    ==================================================================================

    public function getTimesheetmodeldata() {

        $data['detail'] = $this->loginUser;
        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        $data['arrTimesheet'] = $timesheetList;
        return view('admin.timesheet.timesheet-add', $data);
    }

    /* public function addTimesheet(Request $request) {

      $data['detail'] = $this->loginUser;
      $objUser = new Users();
      $userList = $objUser->gtUsrLlist();
      $data['arrUser'] = $userList;

      $objWorkplaces = new Workplaces();
      $workplacesList = $objWorkplaces->getWorkplacesList();
      $data['arrWorkplaces'] = $workplacesList;

      $objTimesheet = new Timesheet();
      $timesheetList = $objTimesheet->getTimesheetList();
      $data['arrTimesheet'] = $timesheetList;

      if ($request->isMethod('post')) {
      //print_r($request->input());exit;
      $timesheetList = $objTimesheet->saveTimesheetInfo($request);
      if ($timesheetList) {
      $return['status'] = 'success';
      $return['message'] = 'Date & Time created successfully.';
      $return['redirect'] =  route('timesheet-list');
      } else {
      $return['status'] = 'error';
      $return['message'] = 'something will be wrong.';
      }
      echo json_encode($return);
      exit;
      }

      $data['css'] = array();
      $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
      $data['js'] = array('admin/timesheet.js');
      $data['funinit'] = array('Timesheet.addInit()');
      return view('admin.timesheet.timesheet-add', $data);
      } */

    public function editTimesheet(Request $request, $timesheetId) {
        $string = $data['string'] = $_SERVER['QUERY_STRING'];
        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['workplacesList'] = $workplacesList;
        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
            $objWorkplaces = new Timesheet();
            $workertimesheetList = $objWorkplaces->updateTimeSheetAdminNew($request, $timesheetId);

            if ($workertimesheetList == "Added") {
                $return['status'] = 'success';
                $return['message'] = 'Date and time created successfully.';
                if ($string == NULL) {
                    $return['redirect'] = route('timesheet-list');
                } else {
                    $return['redirect'] = route('timesheet-list-search', [$string]);
                }
            } else {
                if ($workertimesheetList == 'timeissue') {
                    $return['status'] = 'error';
                    $return['message'] = 'End time always garter then start time';
                } else {
                    if ($workertimesheetList == 'wrongPauseTime') {
                        $return['status'] = 'error';
                        $return['message'] = "You can't use pause time more then working time";
                    } else {
                        if ($workertimesheetList == 'dateAdded') {
                            $return['status'] = 'error';
                            $return['message'] = 'Date and time already added.';
                        } else {
                            if ($workertimesheetList == 'sameTIme') {
                                $return['status'] = 'error';
                                $return['message'] = 'Working time cant be same like pause time';
                            } else {
                                if ($workertimesheetList == 'wrongTime') {
                                    $return['status'] = 'error';
                                    $return['message'] = 'End time always grater then strat time.';
                                } else {
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
        $data['js'] = array('admin/timesheet.js');
        $data['funinit'] = array('Timesheet.editInit()');

        $objMuck = new Timesheet();
        $muckDetail = $objMuck->getTimesheetListAdmin($timesheetId);
        $data['timesheetDetail'] = $muckDetail;

        return view('admin.timesheet.timesheet-edit', $data);
    }

    public function deleteTimesheet($postData) {
        $result = Timesheet::find($postData['id'])->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Date & Time Delete successfully.';
            $return['redirect'] = route('timesheet-list');
        } else {
            $return['status'] = 'error';
            $return['message'] = 'something will be wrong.';
        }
        echo json_encode($return);
        exit;
    }

    public function infodeleteTimesheet($postData) {
        $result = Timesheet::find($postData['id'])->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Date & Time Delete successfully.';
            $return['redirect'] = route('information-list');
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
            case 'deleteTimesheet':
                $result = $this->deleteTimesheet($request->input('data'));
                break;

            case 'infodeleteTimesheet':
                $result = $this->infodeleteTimesheet($request->input('data'));
                break;

            case 'getdatatable':
                $objTimesheet = new Timesheet();
                $list = $objTimesheet->gettimesheetdatatable($request);
                echo json_encode($list);
                break;
        }
    }

}
