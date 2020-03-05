<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Model\Information;
use App\Model\Timesheet;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class InformationController extends Controller {

    public function __construct() {
        parent::__construct();

        $this->middleware('admin');
        //$this->middleware('guest:admin', ['except' => ['subDashboard']]);
        //$this->middleware('guest:subadmin', ['except' => ['mainDashboard', 'subDashboard']]);
    }

    public function getInformationList(Request $request) {
        
        $request->session()->forget('holidaydata');
        $request->session()->forget('timedata');
        $request->session()->forget('diseasedata');
        if($request->session()->has('infodata')){
            $value = $request->session()->get('infodata');
            if ($value[0]['name'] != '') {$name = $value[0]['name']; }else{ $name = ''; }
            if ($value[0]['workplaces'] != '') {$workplaces = $value[0]['workplaces']; }else{ $workplaces = ''; }
            if ($value[0]['month'] != '') {$month = $value[0]['month']; }else{ $month = date('m'); }
            if ($value[0]['year'] != '') {$year = $value[0]['year']; }else{ $year = date('Y'); }
        }else{
            $name = '';
            $workplaces = '';
            $month = date('m');
            $year = date('Y');
        }
        $data['serchbardetails'] = [$name, $workplaces, $month, $year];

        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;

        $objInformation = new Information();
        $objinformationList = $objInformation->getAdminTimesheetListNew();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/information.js');
        $data['funinit'] = array('Information.listInit()');

        $data['arrInformation'] = $objinformationList;
        $data['detail'] = $this->loginUser;

        $userid = new Users;
        $getUserId = $userid->getUserId();
        $data['getUserId'] = $getUserId;

        return view('admin.information.information-list', $data);
    }

    public function deleteInformation($postData) {
        $result = Timesheet::find($postData['id'])->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Information Delete successfully.';
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
            case 'deleteInformation':
                $result = $this->deleteInformation($request->input('data'));
                break;

            case 'getdatatable':
                $objInformation = new Information();
                $list = $objInformation->newInformationdatable($request);
                echo json_encode($list);
                break;
        }
    }

    public function getInformationListsearch(Request $request) {
        
        $request->session()->forget('infodata');
        $infodata = array(
            'name' => $request->input('name'),
            'workplaces' => $request->input('workplaces'),
            'month' => $request->input('month'),
            'year' => $request->input('year'),
        );
        Session::push('infodata', $infodata);
        $data['serchbardetails'] = [$request->input('name'), $request->input('workplaces'), $request->input('month'), $request->input('year')];

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['arrWorkplaces'] = $workplacesList;
        $data['detail'] = $this->loginUser;

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/information.js');
        $data['funinit'] = array('Information.listInit()');

        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        $objTimesheet = new Timesheet();
        $timesheetList = $objTimesheet->getTimesheetList();
        if ($request->isMethod('get')) {
            $objTimesheet = new Information();
            $timesheetsearchList = $objTimesheet->searchinformationInfoNew($request);
            $data['arrInformation'] = $timesheetsearchList;
        }
        return view('admin.information.information-list', $data);
    }

    public function informationEdit(Request $request, $id = '') {

        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {

            $objInformation = new Information();
            $saveinformation = $objInformation->editinformationadmin($request, $id, $data['detail']['id']);

            if ($saveinformation) {
                $return['status'] = 'success';
                $return['message'] = 'Information edit successfully.';
                $return['redirect'] = route('information-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/information.js');
        $data['funinit'] = array('Information.editInit()');

        $objInformation = new Information();
        $data['objinformationreason'] = $objInformation->getInformation($id);
        $data['id'] = $id;
        return view('admin.information.information-edit', $data);
    }

}

//}app/Http/Controllers/Admin/InformationController.php
//           app/Http/Controllers/Customer/InformationSupervisorController.php
//           app/Model/Information.php
//           resources/views/admin/information/information-list.blade.php
