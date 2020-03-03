<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use App\Model\Newcustomer;
use DB;
use Auth;

use App\Model\Customercontact;


class Workplacecontact extends Model {

    protected $table = 'workplacecontact';
    
     public function workplacecontactedit($id){
        $result = Workplacecontact::select("*")
                  ->where('customerId',$id)
                  ->get();
        
        return $result;
        
    }
}