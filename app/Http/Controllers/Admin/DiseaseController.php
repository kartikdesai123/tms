<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Worker;
use App\Model\Timesheet;
use App\Model\Information;
use App\Model\workplaces;
use App\Model\Disease;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use APP;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Session;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class DiseaseController extends Controller {

    public function __construct() {
        parent::__construct();

        $this->middleware('admin');
        //$this->middleware('guest:admin', ['except' => ['subDashboard']]);
        //$this->middleware('guest:subadmin', ['except' => ['mainDashboard', 'subDashboard']]);
    }

    public function dieseaseList(Request $request) {

        $request->session()->forget('holidaydata');
        $request->session()->forget('timedata');
        $request->session()->forget('infodata');
        if($request->session()->has('diseasedata')){
            $value = $request->session()->get('diseasedata');
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
            $objDisease = new Disease();
            $result = $objDisease->addDiesease($request);
            if ($result == '1') {
                $return['status'] = 'success';
                $return['message'] = 'Disease add successfully.';
                $return['redirect'] = route('disease');
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

        $objDiseaseList = new Disease();
        $data['diseaseList'] = $objDiseaseList->diseaseList();
        $data['css'] = array();

        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/dieseaseList.js');
        $data['funinit'] = array('DieseaseList.listInit()');

        $data['detail'] = $this->loginUser;
        return view('admin.disease.disease-list', $data);
    }

    public function getDiseaseListsearch(Request $request) {
        
        $request->session()->forget('diseasedata');
        $diseasedata = array(
            'name' => $request->input('name'),
            'month' => $request->input('month'),
            'year' => $request->input('year'),
        );
        Session::push('diseasedata', $diseasedata);
        
        $data['string'] = $_SERVER['QUERY_STRING'];
        $data['serchbardetails'] = [$request->input('name'),$request->input('month'), $request->input('year')];

        $objUser = new Users();
        $userList = $objUser->gtUsrLlistNew();
        $data['arrUser'] = $userList;

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/dieseaseList.js');
        $data['funinit'] = array('DieseaseList.listInit()');
        $data['detail'] = $this->loginUser;

        return view('admin.disease.disease-list', $data);
    }

    public function editdieseaseList(Request $request, $id) {

        $objUser = new Users();
        $userList = $objUser->gtUsrLlist();
        $data['arrUser'] = $userList;

        if ($request->isMethod('post')) {
            $objDisease = new Disease();
            $result = $objDisease->editDiesease($request);
            if ($result == '1') {
                $return['status'] = 'success';
                $return['message'] = 'Disease edied successfully.';
                $return['redirect'] = route('disease');
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

        $objDiseaseList = new Disease();
        $data['diseaseList'] = $objDiseaseList->diseaseList($id);

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/dieseaseList.js');
        $data['funinit'] = array('DieseaseList.listEdit()');
        $data['detail'] = $this->loginUser;
        return view('admin.disease.disease-edit', $data);
    }

    public function deletedieseaseList(Request $request) {
        $objDisease = new Disease();
        if ($request->input('delete')) {
            $result = $objDisease->deleteDiesease($request->input('delete'));
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Disease deleted successfully.';
                $return['redirect'] = route('disease');
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

    public function submitAction(Request $request) {
        $objDisease = new Disease();
        $result = $objDisease->submitAction($request);
        if ($result) {
            $return['status'] = 'success';
            if ($request->input('value') == "submited") {
                $return['message'] = 'Disease submited successfully.';
            } else {
                $return['message'] = 'Disease not submited successfully.';
            }

//            $return['redirect'] = route('disease');
        } else {
            $return['status'] = 'error';
            $return['message'] = 'something will be wrong.';
        }
        echo json_encode($return);
        exit;
    }

    public function deletedisease($postData) {
        Timesheet::where('diseaseId', $postData['id'])->delete();
        $result = Disease::find($postData['id'])->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Disease Delete successfully.';
            $return['redirect'] = route('disease');
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
            case 'deletedisease':
                $result = $this->deletedisease($request->input('data'));
                break;

            case 'getdatatable':
                $objDiseaseList = new Disease();
                $list = $objDiseaseList->getdatatable($request);
                echo json_encode($list);
                break;
        }
    }

}
