<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
use Auth;
use App\Model\UserHasPermission;
use App\Model\Sendmail;
use App\Model\OrderInfo;
use App\Model\Worker;
use PDF;

class Users extends Model {

    protected $table = 'users';
    
    public function get_time_difference($time1, $time2)
    {
        $time1 = strtotime("1/1/1980 $time1");
        $time2 = strtotime("1/1/1980 $time2");
        if ($time2 < $time1)
        {
                $time2 = $time2 + 86400;
        }
        $sec = $time2 - $time1 ;
        $min = $sec/60 ;
        $hours = ($min - ($min%60))/60 ;
        
        $minitues = $min%60 ;
        if(strlen($hours) < 2){
            $hours="0".$hours;
        }
        if($hours == 0){
            $hours="00";
        }
        
        if(strlen($minitues) < 2){
            $minitues="0".$minitues;
        }
        if($minitues == 0){
            $minitues="00";
        }
        return $hours.":".$minitues;
    }

    public function gtUsrLlist($id = NULL) {
        if($id){
            $result = Users::select('users.*')
                        ->where('users.id', '=', $id)
                        ->get();
        }else{
            $result = Users::select('*')->where('type','!=','ADMIN')
                    ->get();
        }
        return $result;
    }
    
    public function gtUsrLlistNew($id = NULL) {
        if($id){
            $result = Users::select('users.*')
                        ->where('id', '=', $id)
                        ->where('isBlocked', '=','unblocked')
                        ->orderBy('name','ASC')
                        ->get();
        }else{
            $result = Users::select('*')
                    ->where('type','!=','ADMIN')
                    ->where('isBlocked',  '=','unblocked')
                    ->orderBy('name','ASC')
                    ->get();
        }
        return $result;
    }

    public function gtBeststafflist($id = NULL) {
        if($id){
            $result = Users::orderBy('name', 'ASC')
                    ->get();
        }else{
            $result = worker::select('users.id','users.staffnumber','users.name','users.surname',
                            DB::raw('SUM(total_time) as total_houres')
                        )
                        ->join('timesheet','users.id','=','timesheet.worker_id')
                        ->groupBy('timesheet.worker_id')
                        ->get();
        }
        
        return $result;
    }

    public function saveUserInfo($request) {

        $newpassword = ($request->input('password') != '') ? $request->input('password') : null;
        $newpass = Hash::make($newpassword);
        $objUser = new Users();
        $objUser->name = $request->input('first_name');
        $objUser->email = $request->input('email');
        $objUser->type = '0';
        $objUser->password = $newpass;
        $objUser->created_at = date('Y-m-d H:i:s');
        $objUser->updated_at = date('Y-m-d H:i:s');
        $objUser->save();
        return TRUE;
    }

    public function savetimesheetWorkerInfo($request) {
         
           
            if(strtotime($request->input('end_time'))<=strtotime($request->input('start_time'))) {
                return "wrongTime";
            } else {
                $date=date('Y-m-d', strtotime($request->input()['select_date']));
                $start_time = $request->input('start_time');
                $end_time = $request->input('end_time');
                $objUser = new timesheet();
                $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time <= "'.$start_time.':00" AND  end_time >= "'.$start_time.':00" ';
                $users=DB::select(DB::raw($qeury));
                if($users[0]->total > 0){
                    return "dateAdded";
                }else{                
                    $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time <= "'.$end_time.':00" AND  end_time >= "'.$end_time.':00" ';
                    $usersNew=DB::select(DB::raw($qeury));
                    if($usersNew[0]->total > 0){
                        return "dateAdded";
                    }else{
                        $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time >= "'.$start_time.':00" AND  end_time <= "'.$end_time.':00" ';
                        $userNew=DB::select(DB::raw($qeury));
                            if($userNew[0]->total > 0){
                               return "dateAdded";                     
                            }else{                     
                                $working_time1 = (new Carbon($request->input('end_time')))->diff(new Carbon($request->input('start_time')))->format('%h:%I');
                                $total_time1=(new Carbon($working_time1))->diff(new Carbon($request->input('pause_time')))->format('%h:%I');

                            if(strtotime($working_time1) < strtotime($total_time1)){
                                return "wrongPauseTime";
                            }else{
                                $objUser->worker_id = $request->input('worker_id');
                                $objUser->c_date = $date;
                                $objUser->workplaces = $request->input('workplaces');
                                $objUser->start_time = $request->input('start_time');
                                $objUser->end_time = $request->input('end_time');
                                $objUser->pause_time = $request->input('pause_time');
                                $objUser->reason = $request->input('reason');

                                $working_time = $this->get_time_difference($request->input('start_time').":00",$request->input('end_time').":00");
                                $total_time=(new Carbon($working_time))->diff(new Carbon($objUser->pause_time))->format('%h:%I');
                                $pause_times = (new Carbon(date($objUser->pause_time)))->format('h:i:s');
                                if($total_time == "0:00"){
                                    return "sameTIme";
                                }
                                $policy_times = "09:00";
                                $policy_total_time = (new Carbon($policy_times))->diff(new Carbon($total_time))->format('%h:%I');

                                $objUser->missing_hour = $policy_total_time;
                                $objUser->total_time = $total_time;

                                $objUser->created_at = date('Y-m-d H:i:s');
                                $objUser->updated_at = date('Y-m-d H:i:s');
                                $objUser->save();
                                return "Added";
                            }
                        }
                    }
                }
            }
        }

    public function updateUserInfo($request) {
        //print_r($request->input('user_id'));
        $userId = $request->input('user_id');
        $objUser = Users::find($userId);
        $objUser->name = $request->input('first_name');
        $objUser->type = '0';
        $objUser->updated_at = date('Y-m-d H:i:s');
        $objUser->save();
        return TRUE;
    }

    public function saveEditUserInfo($request) {
        $userId = $request->input('id');
        $objUser = Users::find($userId);
        $objUser->name = $request->input('name');
        $objUser->surname = $request->input('surname');

        if ($objUser->save()) {
            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function saveEditUserPassword($id, $password) {
        return Users::where('id', '=', $id)->update(['password' => Hash::make($password)]);
    }

    public function getUserId(){
        $result = Users::get();
        return $result;
    }
    
     public function getStaff() {
        $result = Users::pluck('name', 'id')->toArray();
        return $result;
    }
     public function getDashboradStaff() {
        $result = Users::where('type', '!=', 'ADMIN')->pluck('name', 'id')->toArray();
        
        return $result;
    }
	
	/*code by dhaval*/
	public function UpdatelastLogin($id)
	{
		return Users::where('id', '=', $id)->update(['last_login' => date('Y-m-d')]);
	}
	
	public function GetUserByStaffNumber($staff_number)
	{
		$result = Users::where('staffnumber', '=', $staff_number)->pluck('name', 'id')->toArray();
        
        return $result;
		
	}
	
	
	public function gtUsrname($postData) {
	$id = $postData['staffId'];
        if($id){
            $result = Users::select('users.name','users.surname')
                        ->where('users.id', '=', $id)
                        ->get();
            
        }else{
            $result = Users::get();
        }
        
        return $result[0]->name.' '.$result[0]->surname;
    }
	
	public function newgetDashboradStaff() {
      //  $result = Users::where('type', '!=', 'ADMIN')->pluck('name', 'id')->toArray();
	  
            $result = Users::select('users.name','users.surname', 'users.id',"workerdetails.endContract")
                                ->leftjoin("workerdetails","workerdetails.workerId","=","users.id")
                                ->where('users.type', '!=', 'ADMIN')
                                ->where('users.isBlocked',  '=','unblocked')
                                ->orderBy('users.name', 'asc')
                                ->get();
            $i = 0;
            foreach($result as $key => $value){
                $res = '';
                $objUser = new Users();
                $res = $objUser->activeinactiveuser($value->endContract);
                $result[$i]->status = $res;
                $i++;
            }
            
        return $result;
    }
    public function activeinactiveuser($date){
            $endcontratDate = date('Y-m-d',strtotime($date));
            $alertData = date('Y-m-d', strtotime('-56 days', strtotime($date)));
            $currentDate = date("Y-m-d");

            if($currentDate < $endcontratDate){
                    if($currentDate > $alertData){
                        
                        $status =  'verysoon';
                    }
                    else{
                        $status =  'active';
                    }
            }else{
                $status =  'inactive';
            }
            return $status;
    }

    public function newgetDashboradStaffshorting($id) {
           
      //  $result = Users::where('type', '!=', 'ADMIN')->pluck('name', 'id')->toArray();
          if($id != "all"){
              $result = Users::select('users.name','users.surname', 'users.id',"workerdetails.endContract")
                            ->join("workerdetails","workerdetails.workerId","=","users.id")
                            ->where('users.type', '!=', 'ADMIN')
                            ->where('users.id',$id)
                            ->where('users.isBlocked',  '=','unblocked')
                            ->orderBy('users.name', 'asc')
                            ->get();
          }else{
              $result = Users::select('users.name','users.surname', 'users.id',"workerdetails.endContract")
                            ->join("workerdetails","workerdetails.workerId","=","users.id")
                            ->where('users.type', '!=', 'ADMIN')
                            ->where('users.isBlocked',  '=','unblocked')
                            ->orderBy('users.name', 'asc')
                            ->get();
          }
	  
        return $result;
    }
    
	public function newgetDashboradStaffshortingbystatus($status) {
           $result = Users::select('users.name','users.surname', 'users.id',"workerdetails.endContract")
                              ->join("workerdetails","workerdetails.workerId","=","users.id")
                              ->where('users.type', '!=', 'ADMIN')
                              ->where('users.isBlocked',  '=','unblocked')
                              ->orderBy('users.name', 'asc')
                              ->get();
	  
        return $result;
    }
	
	/*code by dhaval*/
    
        public function blockWorker($request){
           return Users::where('id', '=',$request['id'])->update(['isBlocked' => "blocked"]);
        }
        
        public function unblockWorker($request){
           return Users::where('id', '=',$request['id'])->update(['isBlocked' => "unblocked"]);
        }
}
