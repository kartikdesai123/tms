<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Worker;
use App\Model\Timesheet;
use App\Model\Information;
use App\Model\workplaces;
use App\Model\Disease;
use App\Model\Holidays;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Session;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class holidayController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    public function holidayList(Request $request) {
        
        $request->session()->forget('infodata');
        $request->session()->forget('timedata');
        $request->session()->forget('diseasedata');
        if($request->session()->has('holidaydata')){
            $value = $request->session()->get('holidaydata');
            if ($value[0]['name'] != '') {$name = $value[0]['name']; }else{ $name = ''; }
            if ($value[0]['month'] != '') {$month = $value[0]['month']; }else{ $month = date('m'); }
            if ($value[0]['year'] != '') {$year = $value[0]['year']; }else{ $year = date('Y'); }
        }else{
            $name = '';
            $month = date('m');
            $year = date('Y');
        }
        $data['serchbardetails'] = [$name, $month, $year];
        
        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        if ($request->isMethod('post')) {
            $objAddHolidays = new Holidays;
            $result = $objAddHolidays->addHolidays($request);
            if ($result == '1') {
                $return['status'] = 'success';
                $return['message'] = 'Holiday add successfully.';
                $return['redirect'] = route('holiday');
            }
            if ($result == '2') {
                $return['status'] = 'error';
                $return['message'] = 'Start date or end date worng. ';
            }

            if ($result == '0') {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }

            echo json_encode($return);
            exit;
        }

        $objAddHolidays = new Holidays;
        $data['holidayList'] = $objAddHolidays->holidayList();

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/holidayList.js');
        $data['funinit'] = array('HolidayList.listInit()');
        $data['detail'] = $this->loginUser;
        return view('admin.holiday.holiday-list', $data);
    }

    public function getHolidayListsearch(Request $request) {
        
        $request->session()->forget('holidaydata');
        $holidaydata = array(
            'name' => $request->input('name'),
            'month' => $request->input('month'),
            'year' => $request->input('year'),
        );
        Session::push('holidaydata', $holidaydata);
        
        $data['string'] = $_SERVER['QUERY_STRING'];
        $data['serchbardetails'] = [$request->input('name'), $request->input('month'), $request->input('year')];

        $objUser = new Users();
        $userList = $objUser->gtUsrLlistNew();
        $data['arrUser'] = $userList;

//        $objTimesheet = new Timesheet();
//        $total_time = $objTimesheet->gettotaltime($request);
//        $data['total_time'] = $total_time;

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/holidayList.js');
        $data['funinit'] = array('HolidayList.listInit()');
        $data['detail'] = $this->loginUser;

//        if ($request->isMethod('get')) {
//            $objTimesheet = new Timesheet();
//            $timesheetsearchList = $objTimesheet->searchtimesheetInfoNewAdmin($request);
//            $data['arrTimesheet'] = $timesheetsearchList;
//        }

        return view('admin.holiday.holiday-list', $data);
    }

    public function deleteHolidaysList(Request $request) {
        $objAddHolidays = new Holidays;
        if ($request->input('delete')) {
            $result = $objAddHolidays->deleteHolidays($request->input('delete'));
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Holidays deleted successfully.';
                $return['redirect'] = route('holiday');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
        } else {
            $return['status'] = 'error';
            $return['message'] = 'Please select disease';
        }
        echo json_encode($return);
        exit;
    }

    public function editHolidaysList(Request $request, $id) {

        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;
        if ($request->isMethod('post')) {
            $objAddHolidays = new Holidays;
            $result = $objAddHolidays->editHolidays($request);
            if ($result == '1') {
                $return['status'] = 'success';
                $return['message'] = 'Holiday edied successfully.';
                $return['redirect'] = route('holiday');
            }

            if ($result == '2') {
                $return['status'] = 'error';
                $return['message'] = 'Start date or end date worng. ';
            }

            if ($result == '0') {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $objInformation = new Information();
        $objinformationList = $objInformation->getAdminTimesheetList();

        $objAddHolidays = new Holidays();
        $data['holidayList'] = $objAddHolidays->holidayList($id);

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/holidayList.js');
        $data['funinit'] = array('HolidayList.listEdit()');
        $data['detail'] = $this->loginUser;
        return view('admin.holiday.holiday-edit', $data);
    }

    public function deleteholiday($postData) {
        Timesheet::where('holidaysId', $postData['id'])->delete();
        $result = Holidays::find($postData['id'])->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Holidays Delete successfully.';
            $return['redirect'] = route('holiday');
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
            case 'deleteholiday':
                $result = $this->deleteholiday($request->input('data'));
                break;
            case 'getdatatable':
                $objAddHolidays = new Holidays;
                $list = $objAddHolidays->getdatatable($request);
                echo json_encode($list);
                break;
        }
    }

    public function paidAction(Request $request) {
        $objDisease = new Holidays();
        $result = $objDisease->paidAction($request);
        if ($result) {
            $return['status'] = 'success';
            if ($request->input('value') == "paid") {
                $return['message'] = 'Paid holiday Added successfully.';
            } else {
                $return['message'] = 'Paid holiday removed successfully.';
            }

//            $return['redirect'] = route('holiday');
        } else {
            $return['status'] = 'error';
            $return['message'] = 'something will be wrong.';
        }
        echo json_encode($return);
        exit;
    }

}
