<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use App\Model\Information;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use DB;
use Auth;

class Information extends Model {

    protected $table = 'timesheet';

    /* In table not created 'updated_at' and 'created_at' field then write below code */
    public $timestamps = false;
    public function get_time_difference($time1, $time2){
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
    
    
    public function getTimesheetList($id = NULL) {
        //
        if($id){
            $result = timesheet::select('timesheet.*')
                        ->where('timesheet.id', '=', $id)
                        ->get(); 
        }else{
            $result = timesheet::select('timesheet.*','users.staffnumber','users.name','users.surname')
                        ->join('users','timesheet.worker_id','=','users.id')
                        ->where('timesheet.isTImeSheet', '=', 'yes')
                        ->get(); 
        }
        
        return $result;
    }
    
    public function getTimesheetListNew($id = NULL) {
        //
        $month=date('m');
        $year=date("Y");
        if($id){
            $result = timesheet::select('timesheet.*')
                        ->where('timesheet.id', '=', $id)
                        ->get(); 
        }else{
            $result = timesheet::select('timesheet.*','users.staffnumber','users.name','users.surname')
                        ->join('users','timesheet.worker_id','=','users.id')
                        ->where('timesheet.isTImeSheet', '=', 'yes')
                        ->where('timesheet.c_date', 'LIKE', $year .'-' . $month . '-%')
                        ->get(); 
        }
        
        return $result;
    }
    
    
    public function getAdminTimesheetList() {
//        ->leftjoin('users as u1', 'services.user_id', '=', 'u1.id')
//        ->leftjoin('users as u2', 'services.insurer', '=', 'u2.id')
            $result = timesheet::select('timesheet.*','u1.staffnumber','u1.name','u1.surname','u2.name as sup_name','u2.surname as sup_surname','u2.id as sup_id')
                        ->leftjoin('users as u1', 'timesheet.worker_id', '=', 'u1.id')
                        ->leftjoin('users as u2', 'timesheet.supervisior_id', '=', 'u2.id')
                        ->where('timesheet.supervisior_reson','!='," ")
                        ->get(); 
               
        return $result;
    }
    
    public function getAdminTimesheetListNew() {
        $month=date('m');
        $year=date("Y");
        $result = timesheet::select('timesheet.*','u1.staffnumber','u1.name','u1.surname','u2.name as sup_name','u2.surname as sup_surname','u2.id as sup_id')
                ->leftjoin('users as u1', 'timesheet.worker_id', '=', 'u1.id')
                ->leftjoin('users as u2', 'timesheet.supervisior_id', '=', 'u2.id')
                ->where('timesheet.supervisior_reson','!='," ")
                ->where('timesheet.c_date', 'LIKE', $year .'-' . $month . '-%')
                ->get(); 
        return $result;
    }
    
    public function searchinformationInfo($request, $id = NULL) {
      
        $name=$request->input()['name'];
        $workplaces=$request->input()['workplaces'];
        
        $fromDate = date("Y-m-d",strtotime($request->input()['start_date']));
        $toDate = date("Y-m-d",strtotime($request->input()['end_date']));


        $result = timesheet::select('timesheet.*','users.staffnumber','users.name');
        if($name != ""){
            $result->where('worker_id', 'LIKE', '%'.$name.'%');
        }
        if($workplaces != ""){
            $result->where('timesheet.workplaces', 'LIKE', '%'.$workplaces.'%');
        }
        if($toDate != ""){
            $result->whereRaw("c_date >= ? AND c_date <= ?", 
                array($fromDate." 00:00:00", $toDate." 23:59:59")
            );
        }
        $results =  $result->join('users','timesheet.worker_id','=','users.id')->get();

        return $results;
    }
    
    public function searchinformationInfoNew($request) {
            
            $name=$request->input('name');
            $workplaces= $request->input('workplaces');
            $month = $request->input('month');
            $year = $request->input('year');
            
                $result = timesheet::select('timesheet.*','users.staffnumber','users.name','users.surname')
                        ->join('users','timesheet.worker_id','=','users.id')
                        ->where('timesheet.isTImeSheet', '=', 'yes');
                if ($name != "") {
                    $result->where('worker_id', 'LIKE', '%' . $name . '%');
                }
                if ($workplaces != "") {
                    $result->where('timesheet.workplaces', 'LIKE', '%' . $workplaces . '%');
                }

                if ($month != "" && $year == "") {
                    $result->where('timesheet.c_date', 'LIKE', '%-' . $month . '-%');
                }

                if ($month == "" && $year != "") {
                    $result->where('timesheet.c_date', 'LIKE', $year . '-%');
                }

                if ($month != "" && $year != "") {
                    $result->where('timesheet.c_date', 'LIKE', $year . '-'.$month.'-%');
                }
                return $result->get();
        }
    
    
    public function search_date_workerInfo($id = NULL ,$request) {        
        
        $workplaces= $request->input('workplaces');
        $month = $request->input('month');
        $year = $request->input('year');
        
//        3
        $result = timesheet::select('timesheet.*')
                  ->where('worker_id',$id);
        
        if ($workplaces != "") {
            $result->where('workplaces', $workplaces);
        }
        
        if ($month != "" && $year == "") {
            $result->where('c_date', 'LIKE', '%-' . $month . '-%');
        }
        
        if ($month == "" && $year != "") {
            $result->where('c_date', 'LIKE', $year . '-%');
        }
        
        if ($month != "" && $year != "") {
            $result->where('c_date', 'LIKE', $year . '-'.$month.'-%');
        }
        
        
        $results=$result->get();
        return $results;
    }
    

    public function getNewInfoData($postData){
        
        $month = $postData['months'];
        $year = $postData['year'];
        
        $fromDate = date($year . '-' . $month . '-01');
        $toDate = date($year . '-' . $month . '-31');


        $result = timesheet::select('timesheet.*','users.staffnumber','users.name');
        $result->where('missing_hour', '0:00');
        if($toDate != ""){
            $result->whereRaw("c_date >= ? AND c_date <= ?", 
                array($fromDate." 00:00:00", $toDate." 23:59:59")
            );
        }
        
        $results =  $result->join('users','timesheet.worker_id','=','users.id')->get();
 
        return $results;
    }
    
    public function getNewInfoDataBydate($postData){
        
        
        $workplace = $postData['workplace'];
        $month = $postData['month'];
        $year = $postData['year'];
        
        $result = timesheet::select('timesheet.*','users.staffnumber','users.name','users.surname','u2.name as supervisorname','u2.surname as supervisorsurname');
        if($workplace != "All"){
            $result->where('timesheet.workplaces', $workplace); 
        }
        $result->where('timesheet.missing_hour','!=', '0:00');
         if($month != NULL && $year == NULL ){
             $result->where('c_date', 'LIKE','%-'.$month.'-%');
         }
         
         if($month == NULL && $year != NULL ){
             $result->where('c_date', 'LIKE',$year.'-%');
         }
         
         if($month != NULL && $year != NULL ){
             $result->where('c_date', 'LIKE',$year.'-'.$month.'-%');
         }
        

        
        $results =  $result->join('users','timesheet.worker_id','=','users.id')
                        ->leftjoin('users as u2', 'timesheet.supervisior_id', '=', 'u2.id')
                        ->where('timesheet.supervisior_reson','!='," ")
                        ->get();
 
        return $results;
    }
    
    public function getNewInfoDataBytoday(){
        
        
        $fromDate = date('Y-m-d');
        
        $result = timesheet::select('timesheet.*','users.staffnumber','users.name');
        $result->where('timesheet.missing_hour','!=', '0:00');
        if($fromDate != ""){
            $result->whereRaw("c_date >= ? AND c_date <= ?", 
                array($fromDate." 00:00:00", $fromDate." 23:59:59")
            );
        }
        
        $results =  $result->join('users','timesheet.worker_id','=','users.id')->get();
 
        return $results;
    }
    
    public function getInformation($id){
        $result = timesheet::select('*')
                ->where('id','=',$id)
                ->get()->toarray();
        
        return $result;
    }
    
    public function editinformation($request ,$timesheetId){
         
            if(strtotime($request->input('end_time'))<=strtotime($request->input('start_time'))) {
                return "wrongTime";
            }else {
                $date=date('Y-m-d', strtotime($request->input()['start_date']));
                $start_time = $request->input('start_time');
                $end_time = $request->input('end_time');
                
                $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time <= "'.$start_time.':00" AND  end_time >= "'.$start_time.':00" AND NOT id="'.$timesheetId.'"';
                $users=DB::select(DB::raw($qeury));
                if($users[0]->total > 0){
                    return "dateAdded";
                }else{                
                    $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time <= "'.$end_time.':00" AND  end_time >= "'.$end_time.':00" AND NOT id="'.$timesheetId.'"';
                    $usersNew=DB::select(DB::raw($qeury));
                    if($usersNew[0]->total > 0){
                        return "dateAdded";
                    }else{
                        $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time >= "'.$start_time.':00" AND  end_time <= "'.$end_time.':00" AND NOT id="'.$timesheetId.'"';
                        $userNew=DB::select(DB::raw($qeury));
                            if($userNew[0]->total > 0){
                               return "dateAdded";                     
                            }else{                  
                                $working_time1 = (new Carbon($request->input('end_time')))->diff(new Carbon($request->input('start_time')))->format('%h:%I');
                                $total_time1=(new Carbon($working_time1))->diff(new Carbon($request->input('pause_time')))->format('%h:%I');

                            if(strtotime($working_time1) < strtotime($total_time1)){
                                return "wrongPauseTime";
                            }else{
                                $objUser = Timesheet::find($timesheetId);
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
            
//            die();
//            $date=date('Y-m-d', strtotime($request->input('timesheet_edit_date')));
//            $start_time = substr($request->input('start_time'),0,5);
//            $end_time = substr($request->input('end_time'),0,5);
//            $objUser = Timesheet::find($timesheetId);
//            $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time <= "'.$start_time.':00" AND  end_time >= "'.$start_time.':00" AND NOT id="'.$timesheetId.'" ';
//            $users=DB::select(DB::raw($qeury));
//            
//            if($users[0]->total > 0){
//                return "dateAdded";
//            }else{
//                
//                $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time <= "'.$end_time.':00" AND  end_time >= "'.$end_time.':00" AND NOT id="'.$timesheetId.'" ';
//                $usersNew=DB::select(DB::raw($qeury));
//                
//                if($usersNew[0]->total > 0){
//                    return "dateAdded";
//                }else{
////                    $qeury = 'SELECT count(*) as total  FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time >= "'.$start_time.':00" AND  end_time <= "'.$end_time.':00" AND NOT id="'.$timesheetId.'" ';
////                    $userNew=DB::select(DB::raw($qeury));
////                     if($userNew[0]->total > 0){
////                        return "dateAdded";                     
////                     }else{                     
//                            $working_time1 = (new Carbon($request->input('end_time')))->diff(new Carbon($request->input('start_time')))->format('%h:%I');
//                            $total_time1=(new Carbon($working_time1))->diff(new Carbon($request->input('pause_time')))->format('%h:%I');
//
//                        if(strtotime($working_time1) < strtotime($total_time1)){
//                            return "wrongPauseTime";
//                        }else{
//                            
//                            $objUser->worker_id = $request->input('worker_id');
//                            $objUser->c_date = $date;
//                            $objUser->start_time = $request->input('start_time');
//                            $objUser->end_time = $request->input('end_time');
//                            $objUser->pause_time = $request->input('pause_time');
//                            $objUser->reason = $request->input('reason');
//                            
//                            $working_time = $this->get_time_difference($request->input('start_time').":00",$request->input('end_time').":00");
//                            $total_time=(new Carbon($working_time))->diff(new Carbon($objUser->pause_time))->format('%h:%I');
//                            $pause_times = (new Carbon(date($objUser->pause_time)))->format('h:i:s');
//                            if($total_time == "0:00"){
//                                return "sameTIme";
//                            }
//                            $policy_times = "09:00";
//                            $policy_total_time = (new Carbon($policy_times))->diff(new Carbon($total_time))->format('%h:%I');
//
//                            $objUser->missing_hour = $policy_total_time;
//                            $objUser->total_time = $total_time;
//
//                            $objUser->created_at = date('Y-m-d H:i:s');
//                            $objUser->updated_at = date('Y-m-d H:i:s');
//                            $objUser->save();
//                            return "Added";
//                        }
////                    }
//                }
//            }
    }
    
    public function editinformation_new($request ,$timesheetId){
           
            $date=date('Y-m-d', strtotime($request->input('timesheet_edit_date')));
            $start_time = substr($request->input('start_time'),0,5);
            $end_time = substr($request->input('end_time'),0,5);
            $objUser = Timesheet::find($timesheetId);
            $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time <= "'.$start_time.':00" AND  end_time >= "'.$start_time.':00" AND NOT id="'.$timesheetId.'" ';
            $users=DB::select(DB::raw($qeury));
            if($users[0]->total > 0){
                return "dateAdded";
            }else{
                
//                $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time <= "'.$end_time.':00" AND  end_time >= "'.$end_time.':00" AND NOT id="'.$timesheetId.'" ';
//                $usersNew=DB::select(DB::raw($qeury));
//                if($usersNew[0]->total > 0){
//                    return "dateAdded";
//                }else{
                    $qeury = 'SELECT count(*) as total FROM `timesheet` WHERE `c_date` = "'.$date.'" and `worker_id`="'.$request->input('worker_id').'" AND  start_time >= "'.$start_time.':00" AND  end_time <= "'.$end_time.':00" AND NOT id="'.$timesheetId.'" ';
                    $userNew=DB::select(DB::raw($qeury));
                     if($userNew[0]->total > 0){
                        return "dateAdded";                     
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
//                }
            }
    }
    
    public function editinformationadmin($request ,$timesheetId,$sup_id){
        
        $objTime = Timesheet::find($timesheetId);
        
        $objTime->supervisior_reson = $request->input('sup_reason');
        $objTime->supervisior_id = $sup_id;
        $objTime->updated_at = date('Y-m-d H:i:s');
        
        if ($objTime->save())
        {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
