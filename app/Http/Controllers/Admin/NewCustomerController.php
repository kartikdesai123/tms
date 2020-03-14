<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Model\Workplaces;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Illuminate\Http\Request;
use App\Model\Newcustomer;
use App\Model\Customercontact;
use App\Model\Workplacescustomer;
use App\Model\Workplacecontact;
use App\Model\Customer_id;
use Illuminate\Support\Facades\Session;

class NewCustomerController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    public function index(Request $request) {

        $objcustomer = new Newcustomer();
        $customerList = $objcustomer->getCustomerNew();

        $data['detail'] = $this->loginUser;
        $data['css'] = array();
        $data['js'] = array('admin/newCustomer.js');
        $data['funinit'] = array('NewCustomer.init()');
        $data['arrCustomer'] = $customerList;

        $request->session()->forget('holidaydata');
        $request->session()->forget('timedata');
        $request->session()->forget('infodata');
        $request->session()->forget('diseasedata');
        if($request->session()->has('customerdata')){
            $value = $request->session()->get('customerdata');
            if ($value[0]['name'] != '') { $name = $value[0]['name']; } else { $name = ''; }
            if ($value[0]['status'] != '') { $status = $value[0]['status']; } else { $status = ''; }
            if ($value[0]['type'] != '') { $type = $value[0]['type']; } else { $type = ''; }
        }else{
            $name = '';
            $status = '';
            $type = '';
        }
        $data['serchbardetails'] = [$name, $status, $type];

        return view('admin.newCustomer.index', $data);
    }

    public function getCustomerListsearch(Request $request) {

        $request->session()->forget('customerdata');
        $customerdata = array(
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'type' => $request->input('type'),
        );
        Session::push('customerdata', $customerdata);
//        $value = $request->session()->get('customerdata');
//        print_r($value);die();
        $data['serchbardetails'] = [$request->input('name'), $request->input('type'), $request->input('status'),];
//        print_r($data['serchbardetails']);die();
        $objcustomer = new Newcustomer();
        $customerList = $objcustomer->getCustomerNew();
        $data['detail'] = $this->loginUser;
        $data['css'] = array();
        $data['js'] = array('admin/newCustomer.js');
        $data['funinit'] = array('NewCustomer.init()');
        $data['arrCustomer'] = $customerList;

        return view('admin.newCustomer.index', $data);
    }

    public function add(Request $request) {
        if ($request->isMethod('post')) {

            $objNewcustomer = new Newcustomer();
            $result = $objNewcustomer->addNewCusrtomer($request);
            echo json_encode($result);
            exit;
        }
        $objcustomer_id = new Customer_id();
        $data['customer_id'] = $objcustomer_id->getcustomer_id();
//        print_r($data['customer_id']);die();
        $data['detail'] = $this->loginUser;
        $data['css'] = array();
        $data['js'] = array('admin/newCustomer.js');
        $data['funinit'] = array('NewCustomer.add()');
        return view('admin.newCustomer.add', $data);
    }

    public function edit(Request $request, $id) {

        if ($request->isMethod('post')) {

            $objNewcustomer = new Newcustomer();
            $result = $objNewcustomer->editNewCusrtomer($request);
            if ($result == "updtaed") {
                $return['status'] = 'success';
                $return['message'] = 'Customer Updated successfully.';
                $return['redirect'] = route('newCustomer');
            }
            if ($result == "customerno") {
                $return['status'] = 'error';
                $return['message'] = 'Customer number already exists.';
            }
            if ($result == "email") {
                $return['status'] = 'error';
                $return['message'] = 'Customer email already exists.';
            }
            echo json_encode($return);
            exit;
        }
        $objNewcustomer = new Newcustomer();
        $data['customerviewList'] = $objNewcustomer->customerEdit($id);

        $objCustomercontact = new Customercontact();
        $data['customercontactedit'] = $objCustomercontact->customercontactedit($id);

        $data['detail'] = $this->loginUser;
        $data['css'] = array();
        $data['js'] = array('admin/newCustomer.js');
        $data['funinit'] = array('NewCustomer.edit()');

        return view('admin.newCustomer.edit', $data);
    }

    public function ajaxAction(Request $request) {

        $action = $request->input('action');
        switch ($action) {

            case 'getdatatable':
                $objcustomer = new Newcustomer();
                $list = $objcustomer->getdatatable($request);
                echo json_encode($list);
                break;

            case 'addContract':
                $data['details'] = $request->input('lastcus_no');
                $resultList = view('admin.newCustomer.addContact', $data)->render();
                echo $resultList;
                exit;
            case 'addWorkplaces':
                $details = $request->input('data');
                $resultList = view('admin.newCustomer.addWorkplaces')->render();
                echo $resultList;
                exit;
            case 'addWorkplaceContact':
                $details = $request->input('data');
                $resultList = view('admin.newCustomer.addworkplaceContact')->render();
                echo $resultList;
                exit;

            case 'deleteCustomer':
                $data = $request->input('data');
                $objNewcustomer = new Newcustomer();
                $result = $objNewcustomer->deleteNewCusrtomer($data['id']);
//                Customercontact::where('customerId', $data['id'])->delete();
                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Customer deleted successfully.';
                    $return['redirect'] = route('newCustomer');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                exit;
        }
    }

    /* workplace details data functions */

    public function add_workplacedetails(Request $request) {

        if ($request->isMethod('post')) {

            $objNewcustomer = new Workplacescustomer();
            $result = $objNewcustomer->addWorkplacescustomer($request);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Disease successfully.';
                $return['redirect'] = route('worker-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['detail'] = $this->loginUser;
        $data['css'] = array();
        $data['js'] = array('admin/newCustomer.js');
        $data['funinit'] = array('NewCustomer.add()');
        return view('admin.newCustomer.add', $data);
    }

    public function delete_workplace(Request $request, $id = NULL) {

        $objNewcustomer = new Workplacescustomer();
        $result = $objNewcustomer->deleteWorkplacescustomer($id);
        //  Customercontact::where('customerId',$id)->delete();
        if ($result) {
            $return['status'] = 'success';
            $return['message'] = 'Worker Delete successfully.';
            $return['redirect'] = route('worker-list');
        } else {
            $return['status'] = 'error';
            $return['message'] = 'something will be wrong.';
        }

        $objNewcustomer = new Workplacescustomer();
        $customerviewList = $objNewcustomer->workplaceDetails($id);

        $data['detail'] = $this->loginUser;
        $data['css'] = array();
        $data['js'] = array('admin/newCustomer.js');
        $data['funinit'] = array('NewCustomer.add()');
        $data['arrCustomer'] = $customerviewList;
        return view('admin.newCustomer.customerDetails', $data);
    }

    public function edit_workplace(Request $request) {

        if ($request->isMethod('post')) {

            $objNewcustomer = new Workplacescustomer();
            $result = $objNewcustomer->WorkplacescustomerEdit($request);
            if ($result) {
                $return['status'] = 'success';
                $return['message'] = 'Disease Edited successfully.';
                $return['redirect'] = route('worker-list');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;

//            print_r($request->input());
//            die();
        }
//        $objNewcustomer = new Workplacescustomer();
//        $data['workeList'] = $objNewcustomer->workplaceEdit($id);
//
//        $objCustomercontact = new Workplacecontact();
//        $data['customercontactedit'] = $objCustomercontact->workplacecontactedit($id);

        $data['detail'] = $this->loginUser;
        $data['css'] = array();
        $data['js'] = array('admin/newCustomer.js');
        $data['funinit'] = array('NewCustomer.add()');

        return view('admin.newCustomer.customerDetails', $data);
    }

}
