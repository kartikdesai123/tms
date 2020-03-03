<?php

/**
 * Controller Name: UpdateProfileController
 * Descripation: Use to manage user profile 
 * Created date: 17 AUG 2017
 */

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Route;
use Illuminate\Http\Request;
use Config;

class UpdateProfileController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function editProfile(Request $request) {

        $data['detail'] = $this->loginUser;
        if ($request->isMethod('post')) {
            
            $objuseredit = new Users();
            $edituserinfo = $objuseredit->saveEditUserInfo($request);
            if ($edituserinfo) {
                $return['status'] = 'success';
                $return['message'] = 'User Info Edit successfully.';
                $return['redirect'] = route('admin-dashboard');
            } else {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
                $return['redirect'] = route('admin-dashboard');
            }
            echo json_encode($return);
            exit;
        }
        $data['css'] = array();
        $data['pluginjs'] = array('jQuery/jquery.validate.min.js');
        $data['js'] = array('admin/updateprofile.js');
        $data['funinit'] = array('Updateprofile.edit_init()');

        return view('admin.userprofile.user-edit', $data);
    }

    public function changepassword(Request $request) {

        $data['detail'] = $this->loginUser;

        if ($request->isMethod('post')) {
            $id = $request->input('id');
            $loginUserpassword = Auth()->guard('admin')->user()->password;
            $currentpassword = $request['currentpassword'];
            $newpassword = $request['newpassword'];
            $hashedpaasword = Hash::make($currentpassword);

            if (Hash::check($currentpassword, $loginUserpassword)) 
            {
                $objuserpasswordedit = new Users();
                $updatepassword = $objuserpasswordedit->saveEditUserPassword($id, $newpassword);
                $return['status'] = 'success';
                $return['message'] = 'User Password successfully Changed.';
                $return['redirect'] = route('admin-dashboard');
            }
            else
            {
                $return['status'] = 'error';
                $return['message'] = 'Old password Does Not Match !!.';
                $return['redirect'] = route('admin-dashboard');
            }
            echo json_encode($return);
            exit;
        }
         return view('admin.worker.worker-list');
    }

}
