<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use App\Model\Newcustomer;
use App\Model\Customercontact;
use DB;
use Auth;

class Customercontact extends Model {

    protected $table = 'customercontact';
    
    public function customercontactedit($id){
        $result = Customercontact::select("*")
                  ->where('customerId',$id)
                  ->get();
        return $result;
    }
   
}
