<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use DB;
use Auth;

class Information extends Model {

    protected $table = 'timesheet';

    /* In table not created 'updated_at' and 'created_at' field then write below code */
    public $timestamps = false;

    public function getTimesheetList($id = NULL) {
        //
        if($id){
            $result = timesheet::select('timesheet.*')
                        ->where('timesheet.id', '=', $id)
                        ->get(); 
        }else{
            $result = timesheet::select('timesheet.*','users.staffnumber','users.name','users.surname')
                        ->join('users','timesheet.worker_id','=','users.id')
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

    public function search_date_workerInfo1($request, $id = NULL) {        
        $fromDate = date('Y-m-d',  strtotime($request->input('start_date')));
        $toDate = date('Y-m-d',  strtotime($request->input('end_date')));
        $user_id =  $request->input('worker_id');

        $result = timesheet::select();
        /*if($name != ""){
            $result->where('worker_id', 'LIKE', '%'.$name.'%');
        }
        if($workplaces != ""){
            $result->where('timesheet.workplaces', 'LIKE', '%'.$workplaces.'%');
        }*/
        if($toDate != ""){
            $result->whereRaw("c_date >= ? AND c_date <= ?", 
                array($fromDate." 00:00:00", $toDate." 23:59:59")
            );
        }
        $results =  $result->where('timesheet.worker_id', '=', $user_id);
        $results =  $result->get();

        //dd($results);

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
        
		$fromDateTemp = explode('.',$postData['start_date']);
		$toDateTemp = explode('.',$postData['end_date']);
		
      //  $fromDate = date('Y-m-d',  strtotime($postData['start_date']));
		//$fromDate = date_format($postData['start_date'],"Y-m-d");
		$fromDate = $fromDateTemp[2].'-'.$fromDateTemp[1].'-'.$fromDateTemp[0];
        //$toDate = date('Y-m-d', strtotime($postData['end_date']));
		//$toDate = date_format($postData['end_date'],"Y-m-d");;
		$toDate = $toDateTemp[2].'-'.$toDateTemp[1].'-'.$toDateTemp[0];


        $result = timesheet::select('timesheet.*','users.staffnumber','users.name','users.surname','u2.name as supervisorname');
        $result->where('timesheet.workplaces', $workplace);
        $result->where('timesheet.missing_hour','!=', '0:00');
        if($toDate != ""){
            $result->whereRaw("c_date >= ? AND c_date <= ?", 
                array($fromDate." 00:00:00", $toDate." 23:59:59")
            );
        }
        $results =  $result->join('users','timesheet.worker_id','=','users.id')
                        ->leftjoin('users as u2', 'timesheet.supervisior_id', '=', 'u2.id')
                        ->where('timesheet.supervisior_reson','!='," ")->get();
 
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
        $result = timesheet::select('reason','start_time','end_time','pause_time','supervisior_reson')
                ->where('id','=',$id)
                ->get()->toarray();
        
        return $result;
    }
    
    public function editinformation($request ,$timesheetId){
        
        $objTime = Timesheet::find($timesheetId);
        $objTime->start_time = $request->input('timesheet_edit_start_time');
        $objTime->end_time = $request->input('timesheet_edit_end_time');
        $objTime->pause_time = $request->input('timesheet_edit_push_time');
        
        
       $working_time = (new Carbon($objTime->end_time))->diff(new Carbon($objTime->start_time))->format('%h:%I');
        $total_time=(new Carbon($working_time))->diff(new Carbon($objTime->pause_time))->format('%h:%I');
        $pause_times = (new Carbon(date($objTime->pause_time)))->format('h:i:s');
        $information=$request->input('inforamtion');
        //$main_total_time = (new Carbon($pause_times))->diff(new Carbon($total_time))->format('%h:%I');

        $policy_times = "09:00";
        $policy_total_time = (new Carbon($policy_times))->diff(new Carbon($total_time))->format('%h:%I');

        $objTime->missing_hour = $policy_total_time;
        $objTime->total_time = $total_time;
        $objTime->reason = $information;
        $objTime->updated_at = date('Y-m-d H:i:s');
        
        if ($objTime->save())
        {
            return TRUE;
        } else {
            return FALSE;
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
