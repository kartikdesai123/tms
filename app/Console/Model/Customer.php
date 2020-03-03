<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class Customer extends Model {

    protected $table = 'customers';

    public function getCustomerList($id = NULL) {
        if ($id) {
            $result = Customer::select('users.*')->where('users.id', '=', $id)->get();
        } else {
            $result = Customer::get();
        }
        return $result;
    }

    public function saveCustomerInfo($request) {
//        print_r($request->input());
//        exit;
//        $newpassword = ($request->input('password') != '') ? $request->input('password') : null;
//        $newpass = Hash::make($newpassword);
        $result = Customer::where('email', $request->input('email'))->get()->count();
        $return = '';
        if ($result == 0) {
            $objUser = new Customer();
            $objUser->first_name = $request->input('first_name');
            $objUser->last_name = $request->input('last_name');
            $objUser->email = $request->input('email');
            $objUser->packet = $request->input('pacet');
            $objUser->customer_number = $request->input('customer_number');
            $objUser->company_name = $request->input('company_name');
            $objUser->telephone = $request->input('telephone');
            $objUser->created_at = date('Y-m-d H:i:s');
            $objUser->updated_at = date('Y-m-d H:i:s');
            $objUser->save();
            $return = TRUE;
        } else {
            $return = false;
        }
        return $return;
    }

    public function updateCustomerInfo($request) {
        $userId = $request->input('custId');
        $result = Customer::where('id','!=', $userId)->where('email', $request->input('email'))->get()->count();
        $return = '';
        if ($result == 0) {
            $objEditUser = Customer::find($userId);
            $objEditUser->first_name = $request->input('first_name');
            $objEditUser->last_name = $request->input('last_name');
            $objEditUser->email = $request->input('email');
            $objEditUser->packet = $request->input('pacet');
            $objEditUser->customer_number = $request->input('customer_number');
            $objEditUser->company_name = $request->input('company_name');
            $objEditUser->telephone = $request->input('telephone');
            $objEditUser->save();
            $return = TRUE;
        } else {
            $return = false;
        }
        return $return;
    }

}
