<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use DB;
use Auth;

class Timesheet extends Model {

    protected $table = 'timesheet';

    /* In table not created 'updated_at' and 'created_at' field then write below code */
    public $timestamps = false;
    
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
    
    public function getTimesheetList($id = NULL) {
        if ($id) {
            $result = timesheet::select('timesheet.*')
                    ->where('timesheet.worker_id', '=', $id)
                    ->get();
        } else {
            $result = timesheet::select('timesheet.*', 'users.staffnumber','users.name','users.surname')
                    ->join('users', 'timesheet.worker_id', '=', 'users.id')
                    ->get();
        }
        return $result;
    }
    
    public function getTimesheetListSupervisoer($id = NULL) {
        $month=date('m');
        $year=date("Y");
        if ($id) {
            $result = timesheet::select('timesheet.*')
                    ->where('timesheet.worker_id', '=', $id)
                    ->where('c_date', 'LIKE', $year.'-' . $month . '-%')
                    ->get();
        } else {
            $result = timesheet::select('timesheet.*', 'users.staffnumber','users.name','users.surname')
                    ->join('users', 'timesheet.worker_id', '=', 'users.id')
                    ->where('c_date', 'LIKE', $year.'-' . $month . '-%')
                    ->where('isTImeSheet', '=','yes')
                    ->get();
        }
        return $result;
    }

    public function getTimesheetListNewWorker($id = NULL){
        $month=date('m');
        $year=date("Y");
        if ($id) {
            $result = timesheet::select('timesheet.*')
                    ->where('timesheet.worker_id', '=', $id)
                    ->where('c_date', 'LIKE', $year.'-' . $month . '-%')
                    ->where('timesheet.isTImeSheet', '=','yes')
                    ->get();
        } else {
            $result = timesheet::select('timesheet.*', 'users.staffnumber','users.name','users.surname')
                    ->join('users', 'timesheet.worker_id', '=', 'users.id')
                    ->where('c_date', 'LIKE', $year.'-' . $month . '-%')
                    ->where('timesheet.isTImeSheet', '=','yes')
                    ->get();
        }
        return $result;
    }
    
    public function getTimesheetListNewWorkerNew($id = NULL){
        $month=date('m');
        $year=date("Y");
        if ($id) {
            $result = timesheet::select('timesheet.*')
                    ->where('timesheet.worker_id', '=', $id)
                    ->where('c_date', 'LIKE', $year.'-' . $month . '-%')
                    ->get();
        } else {
            $result = timesheet::select('timesheet.*', 'users.staffnumber','users.name','users.surname')
                    ->join('users', 'timesheet.worker_id', '=', 'users.id')
                    ->where('c_date', 'LIKE', $year.'-' . $month . '-%')
                    ->get();
        }
        return $result;
    }


    public function getTimesheetListNew(){
        $month=date('m');
        $year=date("Y");
        $result = timesheet::select('timesheet.*', 'users.staffnumber','users.name','users.surname')
                    ->join('users', 'timesheet.worker_id', '=', 'users.id')
                    ->where('timesheet.c_date', 'LIKE', $year.'-' . $month . '-%')
                    ->where('timesheet.isTImeSheet','yes')
                    ->where('users.isBlocked',  '=','unblocked')
                    ->get();
        return $result;
    }
    
    

    public function getTotallTime($id,$request = NULL){
        if($request){
           
            $workplaces=$request->input('workplaces');
            $month=$request->input('month');
            $year=$request->input('year');
            if($workplaces == "" || $workplaces === NULL){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where worker_id ='" .$id."' AND c_date LIKE '".$year."-".$month."-%'";
            }else{
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where worker_id ='" .$id."' AND workplaces ='" . $workplaces ."' AND c_date LIKE '".$year."-".$month."-%'";
            }
            
            $result=DB::select(DB::raw($qurey)); 
           
        }else{
         $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where worker_id =" .$id;
         $result=DB::select(DB::raw($qurey)); 
        }
        if($result[0]->timeSum == NULL){
            return "00:00:00";
        }else{
            $timeSum = explode(".", $result[0]->timeSum);

            return $timeSum[0] ;
        }
       
    }

    public function gettotaltime($request = NULL){
            
        if($request){
            
            $useId=$request->input()['name'];
            $workplace=$request->input()['workplaces'];
            $month=$request->input()['month'];
            $year=$request->input()['year'];
            
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where worker_id='".$useId."' AND workplaces='".$workplace."'";
            
//            4
            if($useId == "" && $workplace == "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet ";
            }
            
//            3
            
            if($useId == "" && $workplace == "" && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  c_date LIKE '%-".$month."-%'";
            }
            
            if($useId == "" && $workplace == "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-%'";
            }
            
            if($useId != "" && $workplace == "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$useId."'";
            }
            
            if($useId == "" && $workplace != "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$workplace."'";
            }
            
//          2
            
            if($useId == "" && $workplace == "" && $month != "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-".$month."-%'";
            }
            
            if($useId == ""  && $workplace != "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-%' AND workplaces='".$workplace."'";
            }
            
            if($useId == "" && $workplace != "" && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  c_date LIKE '%-".$month."-%' AND workplaces='".$workplace."'";
            }
            
           
            
            if($useId != "" &&  $workplace == "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-%' AND worker_id='".$useId."'";
            }
            
            if( $useId != "" && $workplace == ""  && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  c_date LIKE '%-".$month."-%' AND worker_id='".$useId."'";
            }
            
            if($useId != "" && $workplace != "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$workplace."' AND worker_id='".$useId."'";
            }
            
//            1
//            
            if($useId == "" && $workplace != "" && $month != "" && $year != ""){
                
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet  where c_date LIKE '".$year."-".$month."-%' AND workplaces='".$workplace."'";
            }
            
            if($useId != "" && $workplace == "" && $month != "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-".$month."-%' AND worker_id='".$useId."'";
            }
            
            if($useId != "" && $workplace != "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-%' AND worker_id='".$useId."' AND workplaces='".$workplace."'";
            }
            
            if($useId != "" && $workplace != "" && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '%-".$month."-%' AND worker_id='".$useId."' AND workplaces='".$workplace."'";
            }
            
            if($useId != "" && $workplace != "" && $month != "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE  '".$year."-".$month."-%' AND worker_id='".$useId."' AND workplaces='".$workplace."'";
            }
            
            $result=DB::select(DB::raw($qurey));
        }else{
            $month=date('m');
            $year=date("Y");
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-".$month."-%'";
            $result=DB::select(DB::raw($qurey));
        }
            if($result[0]->timeSum == NULL){
                return "00:00:00";
            }else{
                $timeSum = explode(".", $result[0]->timeSum);
                
                return $timeSum[0] ;
            }
           
        
    }
    
    public function gettotaltimeNew($request = NULL){
            
        if($request){
            $useId=$request->input()['name'];
            $workplace=$request->input()['workplaces'];
            $month=$request->input()['month'];
            $year=$request->input()['year'];
//            timesheet JOIN users ON timesheet.worker_id = users.id  where timesheet.
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM  timesheet JOIN users ON timesheet.worker_id = users.id  where timesheet.worker_id='".$useId."' AND timesheet.workplaces='".$workplace."' AND users.isBlocked = 'unblocked'";
            
//            4
            if($useId == "" && $workplace == "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where users.isBlocked = 'unblocked'";
            }
            
//            3
            
            if($useId == "" && $workplace == "" && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where  c_date LIKE '%-".$month."-%' AND users.isBlocked = 'unblocked'";
            }
            
            if($useId == "" && $workplace == "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where timesheet.c_date LIKE '".$year."-%' AND users.isBlocked = 'unblocked'";
            }
            
            if($useId != "" && $workplace == "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where  timesheet.worker_id='".$useId."' AND users.isBlocked = 'unblocked'";
            }
            
            if($useId == "" && $workplace != "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where  timesheet.workplaces='".$workplace."' AND users.isBlocked = 'unblocked'";
            }
            
//          2
            
            if($useId == "" && $workplace == "" && $month != "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where  timesheet.c_date LIKE '".$year."-".$month."-%' AND users.isBlocked = 'unblocked'";
            }
            
            if($useId == ""  && $workplace != "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where  timesheet.c_date LIKE '".$year."-%' AND timesheet.workplaces='".$workplace."' AND users.isBlocked = 'unblocked'";
            }
            
            if($useId == "" && $workplace != "" && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where  timesheet.c_date LIKE '%-".$month."-%' AND timesheet.workplaces='".$workplace."' AND users.isBlocked = 'unblocked'";
            }
            
           
            
            if($useId != "" &&  $workplace == "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id where timesheet.c_date LIKE '".$year."-%' AND timesheet.worker_id='".$useId."' AND users.isBlocked = 'unblocked'";
            }
            
            if( $useId != "" && $workplace == ""  && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where  timesheet.c_date LIKE '%-".$month."-%' AND timesheet.worker_id='".$useId."' AND users.isBlocked = 'unblocked'";
            }
            
            if($useId != "" && $workplace != "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id where  timesheet.workplaces='".$workplace."' AND timesheet.worker_id='".$useId."' AND users.isBlocked = 'unblocked'";
            }
            
//            1
//            
            if($useId == "" && $workplace != "" && $month != "" && $year != ""){
                
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where timesheet.c_date LIKE '".$year."-".$month."-%' AND timesheet.workplaces='".$workplace."' AND users.isBlocked = 'unblocked'";
            }
            
            if($useId != "" && $workplace == "" && $month != "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id where timesheet.c_date LIKE '".$year."-".$month."-%' AND timesheet.worker_id='".$useId."' AND users.isBlocked = 'unblocked'";
            }
            
            if($useId != "" && $workplace != "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id where timesheet.c_date LIKE '".$year."-%' AND timesheet.worker_id='".$useId."' AND timesheet.workplaces='".$workplace."' AND users.isBlocked = 'unblocked'";
            }
            
            if($useId != "" && $workplace != "" && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where timesheet.c_date LIKE '%-".$month."-%' AND timesheet.worker_id='".$useId."' AND workplaces='".$workplace."' AND users.isBlocked = 'unblocked'";
            }
            
            if($useId != "" && $workplace != "" && $month != "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where timesheet.c_date LIKE  '".$year."-".$month."-%' AND timesheet.worker_id='".$useId."' AND timesheet.workplaces='".$workplace."' AND users.isBlocked = 'unblocked'";
            }
            
            $result=DB::select(DB::raw($qurey));
        }else{
            $month=date('m');
            $year=date("Y");
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet JOIN users ON timesheet.worker_id = users.id  where timesheet.c_date LIKE '".$year."-".$month."-%' AND users.isBlocked = 'unblocked'";
            $result=DB::select(DB::raw($qurey));
        }
            if($result[0]->timeSum == NULL){
                return "00:00:00";
            }else{
                $timeSum = explode(".", $result[0]->timeSum);
                
                return $timeSum[0] ;
            }
             
    }
    
    
    
    public function getTimesheetListAdmin($id) {
       
            $result = timesheet::select('timesheet.*')
                    ->where('timesheet.id', '=', $id)
                    ->get();
        
        return $result;
    }

    public function searchtimesheetInfo($request, $id = NULL) {
        
        $name = $request->input()['name'];
        $workplaces = $request->input()['workplaces'];
        $month= $request->input()['month'];
        $year= $request->input()['year'];
        
        $result = timesheet::select('timesheet.*', 'users.staffnumber','users.name','users.surname')
                    ->join('users', 'timesheet.worker_id', '=', 'users.id');
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
        $result->where('isTImeSheet','yes');
        $results=$result->get();
        
        return $results;
    }
    
    public function searchtimesheetInfoNew($request, $id = NULL) {
        
        $name = $request->input()['name'];
        $workplaces = $request->input()['workplaces'];
        $month= $request->input()['month'];
        $year= $request->input()['year'];
        
        $result = timesheet::select('timesheet.*', 'users.staffnumber','users.name','users.surname')
                    ->join('users', 'timesheet.worker_id', '=', 'users.id');
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
        $result->where('timesheet.supervisior_reson','!='," ");
        $result->where('isTImeSheet','yes');
        $results=$result->get();
        
        return $results;
    }
    
    public function searchtimesheetInfoNewAdmin($request, $id = NULL) {
        
        $name = $request->input()['name'];
        $workplaces = $request->input()['workplaces'];
        $month= $request->input()['month'];
        $year= $request->input()['year'];
        
        $result = timesheet::select('timesheet.*', 'users.staffnumber','users.name','users.surname')
                    ->join('users', 'timesheet.worker_id', '=', 'users.id');
         if ($name != "") {
            $result->where('timesheet.worker_id',$name);
        }
        if ($workplaces != "") {
            $result->where('timesheet.workplaces',$workplaces);
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
        $result->where('timesheet.isTImeSheet','yes');
        $result->where('users.isBlocked','unblocked');
        $results=$result->get();
        return $results;
    }
    
    public function searchinformationInfo($request, $id = NULL) {
       
        $name = $request->input('name');
        $workplaces = $request->input('workplaces');
        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');
        


        $result = timesheet::select();
        if ($name != "") {
            $result->where('worker_id', 'LIKE', '%' . $name . '%');
        }
        if ($workplaces != "") {
            $result->where('timesheet.workplaces', 'LIKE', '%' . $workplaces . '%');
        }
        if ($toDate != "") {
            $result->whereRaw("c_date >= ? AND c_date <= ?", array($fromDate . " 00:00:00", $toDate . " 23:59:59")
            );
        }

        $results = $result->get();
        return $results;
    }
    
       
    public function getBestStaffData($postData) {
        
        $month = $postData['months'];
        $year = $postData['year'];
        $sql = timesheet::select('timesheet.*', 'users.name', 'users.staffnumber', DB::raw("SUM(timesheet.total_time) as totalTime"))
                ->join('users', 'timesheet.worker_id', '=', 'users.id')
                ->groupBy('timesheet.worker_id');
        if (!empty($year) && empty($month)) {
            $sql->where(function($sql) use($year) {
                        $sql->orWhere(function($sql) use($year) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-01-01'), date($year . '-12-31')]);
                                });
                    });
        } if (!empty($year) && !empty($month)) {
            $sql->where(function($sql) use($year, $month) {
                        $sql->orWhere(function($sql) use($year, $month) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-' . $month . '-01'), date($year . '-' . $month . '-31')]);
                                });
                    });
        }
        $sql->orderBy(DB::raw("SUM(timesheet.total_time)"), 'desc');
        $result = $sql->first();

        return $result;
    }
    
    public function getRestWorkplace($postData) {

        $month = $postData['months'];
        $year = $postData['year'];
        $sql = timesheet::select('timesheet.*', 'workplaces.adresses', DB::raw("SUM(timesheet.total_time) as totalTime"))
                ->join('workplaces', 'workplaces.company', '=', 'timesheet.workplaces')
                ->groupBy('timesheet.workplaces');
        if (!empty($year) && empty($month)) {
            $sql->where(function($sql) use($year) {
                        $sql->orWhere(function($sql) use($year) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-01-01'), date($year . '-12-31')]);
                                });
                    });
        } if (!empty($year) && !empty($month)) {
            $sql->where(function($sql) use($year, $month) {
                        $sql->orWhere(function($sql) use($year, $month) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-' . $month . '-01'), date($year . '-' . $month . '-31')]);
                                });
                    });
        }
        $sql->orderBy(DB::raw("SUM(timesheet.total_time)"), 'desc');
        $result = $sql->first();
//echo '<pre/>';print_r($result);exit;
        return $result;
    }
    
    public function getWorkplaceListData($postData) {
//        print_r($postData);exit;
        $month = $postData['months'];
        $year = $postData['year'];
        $staffId = $postData['name'];
        $sql = timesheet::select('timesheet.*','users.name','users.surname', 'workplaces.adresses')
                ->join('users', 'timesheet.worker_id', '=', 'users.id')
                ->join('workplaces', 'workplaces.company', '=', 'timesheet.workplaces');
            $sql->where('timesheet.workplaces', $staffId);
        if (!empty($year) && empty($month)) {
            $sql->where(function($sql) use($year) {
                        $sql->orWhere(function($sql) use($year) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-01-01'), date($year . '-12-31')]);
                                });
                    });
        } 
        if (!empty($year) && !empty($month)) {
            $sql->where(function($sql) use($year, $month) {
                        $sql->orWhere(function($sql) use($year, $month) {
                                    $sql->whereBetween('timesheet.c_date', [date($year . '-' . $month . '-01'), date($year . '-' . $month . '-31')]);
                                });
                    });
        }
        $result = $sql->get()->toArray();
        
        return $result;
    }
    
    public function getWorkplaceTotalTime($postData){
        
        $month = $postData['months'];
        $year = $postData['year'];
        $staffId = $postData['name'];
        if (!empty($year) && empty($month)) {
            $startdate=date($year . '-' . $month . '-01');
            $enddate=date($year . '-12-31');
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$staffId."' AND c_date BETWEEN '". $startdate ."'AND'". $enddate."'";
        }
        
         if (!empty($year) && !empty($month)) {
             $startdate=date($year . '-01-01');
             $enddate=date($year . '-' . $month . '-31');
             $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$staffId."' AND c_date BETWEEN '". $startdate ."'AND'". $enddate."'";
         }
         
          if (empty($year) && empty($month)) {
              $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$staffId."'";
          }
         
        $result=DB::select(DB::raw($qurey));
       
        if($result[0]->timeSum == NULL){
                return "00:00:00";
            }else{
                $timeSum = explode(".", $result[0]->timeSum);
                
                return $timeSum[0] ;
            }
    }

    public function getStaffListData($postData) {
        $month = $postData['months'];
        $year = $postData['year'];
        $staffId = $postData['staffId'];
        $shortBy = $postData['shortBy'];
        $sql = timesheet::select('timesheet.*','users.name','users.surname', 'workplaces.adresses')
                ->leftjoin('users', 'users.id', '=', 'timesheet.worker_id')
                ->leftjoin('workplaces', 'workplaces.company', '=', 'timesheet.workplaces');
        $sql->where('timesheet.worker_id', $staffId);
        $sql->orderBy($shortBy, 'ASC');    
        if (!empty($year) && empty($month)) {
            $sql->where('timesheet.c_date', 'LIKE', $year .'-%');
        }
        
        if (empty($year) && !empty($month)) {
            $sql->where('timesheet.c_date', 'LIKE', '%-' . $month . '-%');
        }
        
        if (!empty($year) && !empty($month)) {
           $sql->where('timesheet.c_date', 'LIKE', $year .'-' . $month . '-%');
        }
        
        $result = $sql->get()->toArray();
        return $result;
    }
    
    public function getStaffTotalTime($postData){
        
        $month = $postData['months'];
        $year = $postData['year'];
        $staffId = $postData['staffId'];
        
        if (!empty($year) && empty($month)) {
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$staffId."' AND c_date LIKE '".$year."-%'";
//            $sql->where('timesheet.c_date', 'LIKE', $year .'-%');
        }
        
        if (empty($year) && !empty($month)) {
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$staffId."' AND c_date LIKE '%-".$month."-%'";
//            $sql->where('timesheet.c_date', 'LIKE', '%-' . $month . '-%');
        }
        
        if (!empty($year) && !empty($month)) {
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$staffId."' AND c_date LIKE '".$year."-".$month."-%'";
//           $sql->where('timesheet.c_date', 'LIKE', $year .'-' . $month . '-%');
        }
        
        if (empty($year) && empty($month)) {
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$staffId."'";
        }
         
        $result=DB::select(DB::raw($qurey));
       
       
        if($result[0]->timeSum == NULL){
                return "00:00:00";
            }else{
                $timeSum = explode(".", $result[0]->timeSum);
                
                return $timeSum[0] ;
            }
    }

    public function getStaffTotalHolidays($postData){
        $month = $postData['months'];
        $year = $postData['year'];
        $staffId = $postData['staffId'];
        
        if (!empty($year) && empty($month)) {
            $qurey="SELECT id FROM timesheet where  worker_id='".$staffId."' AND c_date LIKE '".$year."-%' AND holidaysId IS NOT NULL";
//            $sql->where('timesheet.c_date', 'LIKE', $year .'-%');
        }
        
        if (empty($year) && !empty($month)) {
            $qurey="SELECT id FROM timesheet where  worker_id='".$staffId."' AND c_date LIKE '%-".$month."-%'AND holidaysId IS NOT NULL";
//            $sql->where('timesheet.c_date', 'LIKE', '%-' . $month . '-%');
        }
        
        if (!empty($year) && !empty($month)) {
            $qurey="SELECT id FROM timesheet where  worker_id='".$staffId."' AND c_date LIKE '".$year."-".$month."-%'AND holidaysId IS NOT NULL";
//           $sql->where('timesheet.c_date', 'LIKE', $year .'-' . $month . '-%');
        }
        
        if (empty($year) && empty($month)) {
            $qurey="SELECT id FROM timesheet where  worker_id='".$staffId."'AND holidaysId IS NOT NULL";
        }
        
        $result=DB::select(DB::raw($qurey));
        return count($result);
    }
    
    public function getStaffTotalDisease($postData){
        $month = $postData['months'];
        $year = $postData['year'];
        $staffId = $postData['staffId'];
        if (!empty($year) && empty($month)) {
            $qurey="SELECT id FROM timesheet where  worker_id='".$staffId."' AND c_date LIKE '".$year."-%' AND diseaseId IS NOT NULL";
//            $sql->where('timesheet.c_date', 'LIKE', $year .'-%');
        }
        
        if (empty($year) && !empty($month)) {
            $qurey="SELECT id FROM timesheet where  worker_id='".$staffId."' AND c_date LIKE '%-".$month."-%'AND diseaseId IS NOT NULL";
//            $sql->where('timesheet.c_date', 'LIKE', '%-' . $month . '-%');
        }
        
        if (!empty($year) && !empty($month)) {
            $qurey="SELECT id FROM timesheet where  worker_id='".$staffId."' AND c_date LIKE '".$year."-".$month."-%'AND diseaseId IS NOT NULL";
//           $sql->where('timesheet.c_date', 'LIKE', $year .'-' . $month . '-%');
        }
        
        if (empty($year) && empty($month)) {
            $qurey="SELECT id FROM timesheet where  worker_id='".$staffId."'AND diseaseId IS NOT NULL";
        }
        
        $result=DB::select(DB::raw($qurey));
        return count($result);
    }
    
    
    public function updateTimesheetAdmin($request,$timesheetId){
        print_r($request->input());
        die();
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
        $objTime->save();
        return TRUE;
    }
    
    public function updateTimeSheetAdminNew($request,$timesheetId){
            
            if(strtotime($request->input('end_time'))<=strtotime($request->input('start_time'))) {
                return "wrongTime";
            }else {
                $date=date('Y-m-d', strtotime($request->input('start_date')));
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

    public function gettotaltime_worker($id){
         $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$id."'";
         $result=DB::select(DB::raw($qurey));
         if($result[0]->timeSum == NULL){
                return "00:00:00";
            }else{
                $timeSum = explode(".", $result[0]->timeSum);
                
                return $timeSum[0] ;
            }
    }
    public function gettotaltime_worker_new($id){
        $month=date('m');
        $year=date("Y");
        $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$id."'AND c_date LIKE '".$year."-".$month."-%'";
        $result=DB::select(DB::raw($qurey));
        if($result[0]->timeSum == NULL){
                return "00:00:00";
            }else{
                $timeSum = explode(".", $result[0]->timeSum);
                
                return $timeSum[0] ;
            }
    }

    public function gettotaltime_worker_serch($request){
        
        $start_date=date('Y-m-d',  strtotime($request->input('start_date')));
        $end_date=date('Y-m-d',  strtotime($request->input('end_date')));
        $worker_id=$request->input('worker_id');
        
        $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$worker_id."' AND c_date >='".$start_date."' AND c_date <='".$end_date."'";
      
         $result=DB::select(DB::raw($qurey));
         
         if($result[0]->timeSum == NULL){
                return "00:00:00";
            }else{
                $timeSum = explode(".", $result[0]->timeSum);
                
                return $timeSum[0] ;
            }
        
    }

    public function totalTimeWorker($request,$id=NULL){
        if($request){
            
            $useId=$id;
            $workplace=$request->input()['workplaces'];
            $month=$request->input()['month'];
            $year=$request->input()['year'];
            
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where worker_id='".$useId."' AND workplaces='".$workplace."'";
            
//            4
            if($useId == "" && $workplace == "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet ";
            }
            
//            3
            
            if($useId == "" && $workplace == "" && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  c_date LIKE '%-".$month."-%'";
            }
            
            if($useId == "" && $workplace == "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-%'";
            }
            
            if($useId != "" && $workplace == "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  worker_id='".$useId."'";
            }
            
            if($useId == "" && $workplace != "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$workplace."'";
            }
            
//          2
            
            if($useId == "" && $workplace == "" && $month != "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-".$month."-%'";
            }
            
            if($useId == ""  && $workplace != "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-%' AND workplaces='".$workplace."'";
            }
            
            if($useId == "" && $workplace != "" && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  c_date LIKE '%-".$month."-%' AND workplaces='".$workplace."'";
            }
            
           
            
            if($useId != "" &&  $workplace == "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-%' AND worker_id='".$useId."'";
            }
            
            if( $useId != "" && $workplace == ""  && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  c_date LIKE '%-".$month."-%' AND worker_id='".$useId."'";
            }
            
            if($useId != "" && $workplace != "" && $month == "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where  workplaces='".$workplace."' AND worker_id='".$useId."'";
            }
            
//            1
//            
            if($useId == "" && $workplace != "" && $month != "" && $year != ""){
                
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet  where c_date LIKE '".$year."-".$month."-%' AND workplaces='".$workplace."'";
            }
            
            if($useId != "" && $workplace == "" && $month != "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-".$month."-%' AND worker_id='".$useId."'";
            }
            
            if($useId != "" && $workplace != "" && $month == "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '".$year."-%' AND worker_id='".$useId."' AND workplaces='".$workplace."'";
            }
            
            if($useId != "" && $workplace != "" && $month != "" && $year == ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE '%-".$month."-%' AND worker_id='".$useId."' AND workplaces='".$workplace."'";
            }
            
            if($useId != "" && $workplace != "" && $month != "" && $year != ""){
                $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet where c_date LIKE  '".$year."-".$month."-%' AND worker_id='".$useId."' AND workplaces='".$workplace."'";
            }
            
            $result=DB::select(DB::raw($qurey));
        }else{
            $qurey="SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum FROM timesheet";
            $result=DB::select(DB::raw($qurey));
        }
            if($result[0]->timeSum == NULL){
                return "00:00:00";
            }else{
                $timeSum = explode(".", $result[0]->timeSum);
                
                return $timeSum[0] ;
            }
    }
    
    public function getDisease($year){
            $result = timesheet::select('users.name','users.surname','timesheet.worker_id',DB::raw('count(*) as total'))
                                ->join('users', 'timesheet.worker_id', '=', 'users.id')
                                ->where('timesheet.isTImeSheet','no')
                                ->where('timesheet.diseaseId','!=',NULL)
                                ->where('users.type','WORKER')
                                ->where('timesheet.c_date','LIKE',$year.'-%')
                                ->orderBy('users.name', 'asc')
                                ->groupBy('timesheet.worker_id')
                                ->get();
            return $result;
    }
    
    public function getholidays($year){
            $result = timesheet::select('workerdetails.totalHolidays','users.name','users.surname','timesheet.worker_id',DB::raw('count(*) as total'))
                                ->join('users', 'timesheet.worker_id', '=', 'users.id')
                                ->leftjoin('workerdetails', 'users.id', '=', 'workerdetails.workerId')
                                ->where('timesheet.isTImeSheet','no')
                                ->where('timesheet.holidaysId','!=',NULL)
                                ->where('users.type','WORKER')
                                ->where('timesheet.isPaid','!=','paid')
                                ->where('timesheet.c_date','LIKE',$year.'-%')
                                ->groupBy('timesheet.worker_id')
                                ->orderBy('users.name', 'asc')
                                ->get();
            return $result;
    }
    
    public function staffIdDiseaseList($postData){
       
        $finalArray=[];
        $month=['01','02','03','04','05','06','07','08','09','10','11','12'];
        for($i = 0 ;$i < count($month) ; $i++){
            $result =[];
            $result = timesheet::select(DB::raw('count(*) as total'))
                                    ->join('users', 'timesheet.worker_id', '=', 'users.id')
                                    ->where('timesheet.isTImeSheet','no')
                                    ->where('timesheet.diseaseId','!=',NULL)
                                    ->where('users.type','WORKER')
                                    ->where('users.id',$postData['staffId'])
                                    ->where('timesheet.c_date','LIKE',$postData['yearDisease'].'-'.$month[$i].'-%')
                                    ->get()->toarray();
            $finalArray[$i] = $result[0]['total'] ;
        }
        return $finalArray;
    }
    
    public function staffIdHolidyasList($postData){
       
        $finalArray=[];
        $month=['01','02','03','04','05','06','07','08','09','10','11','12'];
        for($i = 0 ;$i < count($month) ; $i++){
            $result =[];
            $result = timesheet::select(DB::raw('count(*) as total'))
                                    ->join('users', 'timesheet.worker_id', '=', 'users.id')
                                    ->where('timesheet.isTImeSheet','no')
                                    ->where('timesheet.holidaysId','!=',NULL)
                                    ->where('users.type','WORKER')
                                    ->where('timesheet.isPaid','!=','paid')
                                    ->where('users.id',$postData['staffId'])
                                    ->where('timesheet.c_date','LIKE',$postData['yearHoliday'].'-'.$month[$i].'-%')
                                    ->get()->toarray();
            $finalArray[$i] = $result[0]['total'] ;
        }
        return $finalArray;
    }
}
