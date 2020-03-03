<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Illuminate\Http\Request;
use App\Model\Newcustomer;
use App\Model\Customercontact;
use App\Model\Workplacescustomer;
use App\Model\Workplacecontact;

//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Http\Request;

class CustomerWorkplaceController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('admin');
    }

    public function customerDetails(Request $request, $id) {

        $objcustomer = new Newcustomer();
        $Customer = $objcustomer->customerDetails($id);

        $objNewcustomer = new Workplacescustomer();
        $customerviewList = $objNewcustomer->workplaceDetails($id);
        $data['customerId'] = $id;

        $objCustomercontact = new Workplacecontact();
        $arrCustomer_contact = $objCustomercontact->workplacecontactedit($id);

        $objCustomercontact = new Customercontact();
        $data['customercontactedit'] = $objCustomercontact->customercontactedit($id);

        $data['detail'] = $this->loginUser;
        $data['css'] = array();

        $data['js'] = array('admin/customerWorkplace.js');
        $data['funinit'] = array('CustomerWorkplace.init()');

        $data['customer'] = $Customer;
        $data['arrCustomer'] = $customerviewList;
        $data['arrCustomer_contact'] = $arrCustomer_contact;

        return view('admin.newCustomer.customerDetails', $data);
    }
    
    public function add_workplacedetails(Request $request){
     
        $objWorkplacescustomer = new Workplacescustomer();
        $result = $objWorkplacescustomer->addWorkplacescustomer($request);
        
        if ($result == "inserted") {
            $return['status'] = 'success';
            $return['message'] = 'Workplace Created successfully.';
            $return['redirect'] = route('customer-details',$request->input('customerID'));
        }
        if ($result == "email") {
            $return['status'] = 'error';
            $return['message'] = 'Customer email already exists.';
        }
        echo json_encode($return);
        exit;
        
    }
    public function edit_workplacedetails(Request $request){
        
        $objWorkplacescustomer = new Workplacescustomer();
        $result = $objWorkplacescustomer->editDetailsWorkplacescustomer($request);
        
        if ($result == "updated") {
            $return['status'] = 'success';
            $return['message'] = 'Workplace updated successfully.';
            $return['redirect'] = route('customer-details',$request->input('workplace_id'));
        }
        if ($result == "email") {
            $return['status'] = 'error';
            $return['message'] = 'Customer email already exists.';
        }
        echo json_encode($return);
        exit;
        
    }

    public function ajaxAction(Request $request) {

        $action = $request->input('action');
        switch ($action) {
            case 'addContract':
                $details = $request->input('data');
                $resultList = view('admin.newCustomer.addContact')->render();
                echo $resultList;
                exit;
            case 'workplacedelete':
                
                $details = $request->input('data');
                $cus_id = $details['customerId'] ;
                
                $id=$details['id'];
                $objWorkplace = new Workplacescustomer();
                $result = $objWorkplace->deleteWorkplace($id);
                if ($result) {
                    $return['status'] = 'success';
                    $return['message'] = 'Workplace Created successfully.';
                    $return['redirect'] = route('customer-details',$cus_id);
                }else{
                    $return['status'] = 'error';
                    $return['message'] = 'Customer email already exists.';
                }
                echo json_encode($return);
                exit;
                
            case 'viewworkplacecustomer':
                $details = $request->input('data');
                
                $objNewcustomer= new Workplacescustomer();
                $data['workplace_customer']= $objNewcustomer->editWorkplacescustomer($details);
                $objNewcustomer= new Workplacecontact();
                $data['workplace_contact']= $objNewcustomer->workplacecontactedit($details);
                $objcustomer = new Newcustomer();
                $customerList = $objcustomer->getCustomer();
                $data['arrCustomer'] = $customerList;
                $resultList = view('admin.newCustomer.view_workplace', $data)->render();
                echo $resultList;
                exit;
             case 'editworkplacecustomer':
                $details = $request->input('data');
                $objNewcustomer= new Workplacescustomer();
                $data['workplace_customer']= $objNewcustomer->editWorkplacescustomer($details['workplace_id']);
               
               
                $objNewcustomer= new Workplacecontact();
                $data['workplace_contact']= $objNewcustomer->workplacecontactedit($details['workplace_id']);
//               print_r($data['workplace_contact'][0]->gender);
//               die();
                $objcustomer = new Newcustomer();
                $customerList = $objcustomer->getCustomer();
                $data['arrCustomer'] = $customerList;
                $resultList = view('admin.newCustomer.edit_workplace', $data)->render();
                echo $resultList;
                exit;
            
        }
    }

}
