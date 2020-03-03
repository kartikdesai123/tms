<?php

namespace App\Model;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use App\Model\Workerdetails;
use DB;
use Auth;

class Workerdetails extends Model {

    protected $table = 'workerdetails';

    /* In table not created 'updated_at' and 'created_at' field then write below code */
    public $timestamps = false;

   
	
}
