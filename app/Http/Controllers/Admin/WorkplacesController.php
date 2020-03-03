<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Workplaces;
use App\Model\Timesheet;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Route;
use Illuminate\Http\Request;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class WorkplacesController extends Controller {

    public function __construct() {
        parent::__construct();

        $this->middleware('admin');
        //$this->middleware('guest:admin', ['except' => ['subDashboard']]);
        //$this->middleware('guest:subadmin', ['except' => ['mainDashboard', 'subDashboard']]);
    }

    public function getWorkplacesList() {

        $objWorkplaces = new Workplaces();
        $workplacesList = $objWorkplaces->getWorkplacesList();
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/workplaces.js');
        $data['funinit'] = array('Workplaces.listInit()');

        $data['arrWorkplaces'] = $workplacesList;
        $data['detail'] = $this->loginUser;
        return view('admin.workplaces.workplaces-list', $data);
    }

    public function addWorkplaces(Request $request) {
        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
//            print_r($request->input());exit;
            $objWorkplaces = new Workplaces();
            $workplacesList = $objWorkplaces->saveWorkplacesInfo($request);
            if ($workplacesList) {
                $return['status'] = 'success';
                $return['message'] = 'Workplaces created successfully.';
                $return['redirect'] = route('workplaces-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/workplaces.js');
        $data['funinit'] = array('Workplaces.addInit()');
        return view('admin.workplaces.workplaces-add', $data);
    }

    public function editWorkplaces($userId, Request $request) {
        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
//            print_r($request->input());exit;
            $objWorkplaces = new Workplaces();
            $objWorkplacesList = $objWorkplaces->updateWorkplacesInfo($request);
            if ($objWorkplacesList) {
                $return['status'] = 'success';
                $return['message'] = 'Update Workplaces successfully.';
                $return['redirect'] = route('workplaces-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }

        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/workplaces.js');
        $data['funinit'] = array('Workplaces.editInit()');

        $objMuck = new Workplaces();
        $muckDetail = $objMuck->getWorkplacesList($userId);
        $data['workplacesDetail'] = $muckDetail;

        return view('admin.workplaces.workplaces-edit', $data);
    }

    public function deleteWorkplaces($postData) {

        $getWorkplace = Workplaces::where('id', $postData['id']);
        $a = $getWorkplace->get();
        $workPalceName = $a[0]['company'];
        $deleteTimesheet = Timesheet::where('workplaces', $workPalceName)->delete();

        $result = $getWorkplace->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Workplaces Delete successfully.';
            $return['redirect'] = route('workplaces-list');
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
            case 'deleteWorkplaces':
                $result = $this->deleteWorkplaces($request->input('data'));
                break;

            case 'getdatatable':
                $objWorkplaces = new Workplaces();
                $list = $objWorkplaces->getworkplacedatatable();
                echo json_encode($list);
                break;
        }
    }

    public function delWorkplaces($postData) {
        $delete_id = $postData['id'];
        $cname = $postData['name'];
        Timesheet::whereIn('workplaces', $cname)->delete();

        $result = Workplaces::whereIn('id', $delete_id)
                ->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Workplace has been deleted successfully.';
            $return['redirect'] = route('workplaces-list');
        } else {
            $return['status'] = 'error';
            $return['message'] = 'something will be wrong.';
        }
        echo json_encode($return);
        exit;
    }

    public function ajaxActions(Request $request) {
        $action = $request->input('action');
        switch ($action) {
            case 'delWorkplaces':
                $result = $this->delWorkplaces($request->input('data'));
                break;
        }
    }

}
