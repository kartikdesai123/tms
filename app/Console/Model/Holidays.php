<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use DB;
use Auth;

class Holidays extends Model {

    protected $table = 'holidays';
    public function getDatesFromRange($start, $end) { 
      
        $Variable1 = strtotime($start); 
        $Variable2 = strtotime($end); 
        for ($currentDate = $Variable1; $currentDate <= $Variable2;  
                                        $currentDate += (86400)) { 

        $Store = date('Y-m-d', $currentDate); 
        $array[] = $Store; 
        } 
        return $array;
   }
   
    public function addHolidays($request){
        $time1 = strtotime($request->input('start_date'));
        $time2 = strtotime($request->input('end_date'));
        if($time1 > $time2){
            return "2" ;
        }else{
            $objHolidays = new Holidays();
            $objHolidays->user_Id = $request->input('nameWorker');
            $objHolidays->start_date = date("Y-m-d", strtotime($request->input('start_date')));
            $objHolidays->end_date = date("Y-m-d", strtotime($request->input('end_date')));
            $objHolidays->created_at = date('Y-m-d H:i:s');
            $objHolidays->updated_at = date('Y-m-d H:i:s');
            if($objHolidays->save()){
                
                $HolidayId =$objHolidays->id;
                $starttimeFormate = date("Y-m-d",strtotime($request->input('start_date')));
                $endtimeFormate = date("Y-m-d",strtotime($request->input('end_date')));
                $dateRange= $this->getDatesFromRange($starttimeFormate,$endtimeFormate);
                for($i = 0 ;$i < count($dateRange) ; $i++ ){
                    $objTimesheet = new Timesheet();
                    $objTimesheet->worker_id=$request->input('nameWorker');
                    $objTimesheet->c_date=$dateRange[$i];
                    $objTimesheet->start_time='0:00';
                    $objTimesheet->end_time='0:00';
                    $objTimesheet->pause_time='0:00';
                    $objTimesheet->total_time='0:00';
                    $objTimesheet->missing_hour='0:00';
                    $objTimesheet->reason=NULL;
                    $objTimesheet->supervisior_reson=NULL;
                    $objTimesheet->holidaysId=$HolidayId;
                    $objTimesheet->submitted=NULL;
                    $objTimesheet->isTImeSheet='no';
                    $objTimesheet->save();
                }
                return "1" ;
            }else{
                return "0" ;
            }
        }
    }
    
    public function holidayList($id = NULL){
        if ($id) {
            $result = Holidays::select('users.id as userId','holidays.*')
                        ->leftjoin('users', 'users.id', '=', 'holidays.user_Id')
                        ->where('holidays.id', '=', $id)
                        ->get();
        } else {
            $result = Holidays::select('users.name','users.surname','holidays.*')
                        ->leftjoin('users', 'users.id', '=', 'holidays.user_Id')
                        ->get();
        }
        return $result;
    }
    
    public function deleteHolidays($request){
        for($i=0;$i<count($request);$i++){
            $result = Holidays::find($request[$i])->delete();
            $result = Timesheet::where('holidaysId',$request[$i])
                      ->delete();
        }
        return true;
    }
    
    public function editHolidays($request){
        $time1 = strtotime($request->input('start_date'));
        $time2 = strtotime($request->input('end_date'));
        if($time1 > $time2){
            return "2" ;
        }else{
            $objDisease = Holidays::find($request->input('editId'));
            $objDisease->user_Id = $request->input('nameWorker');
            $objDisease->start_date = date("Y-m-d", strtotime($request->input('start_date')));
            $objDisease->end_date = date("Y-m-d", strtotime($request->input('end_date')));
            $objDisease->updated_at = date('Y-m-d H:i:s');
            if($objDisease->save()){ 
                $holidaysId=$request->input('editId');
                $result = Timesheet::where('holidaysId',$holidaysId)
                        ->delete();
                $starttimeFormate = date("Y-m-d",strtotime($request->input('start_date')));
                $endtimeFormate = date("Y-m-d",strtotime($request->input('end_date')));
                $dateRange= $this->getDatesFromRange($starttimeFormate,$endtimeFormate);
                for($i = 0 ;$i < count($dateRange) ; $i++ ){
                    $objTimesheet = new Timesheet();
                    $objTimesheet->worker_id=$request->input('nameWorker');
                    $objTimesheet->c_date=$dateRange[$i];
                    $objTimesheet->start_time='0:00';
                    $objTimesheet->end_time='0:00';
                    $objTimesheet->pause_time='0:00';
                    $objTimesheet->total_time='0:00';
                    $objTimesheet->missing_hour='0:00';
                    $objTimesheet->reason=NULL;
                    $objTimesheet->supervisior_reson=NULL;
                    $objTimesheet->holidaysId=$holidaysId;
                    $objTimesheet->submitted=NULL;
                    $objTimesheet->isTImeSheet='no';
                    $objTimesheet->save();
                }
                return "1" ;
            }else{
                return "0" ;
            }
        }
    }
    
    public function paidAction($request){
        $objHolidays = Holidays::find($request->input('id'));
        $objHolidays->isPaid = $request->input('value');
        $objHolidays->updated_at = date('Y-m-d H:i:s');
        if($objHolidays->save()){
//            Answer::where('question_id', 2)->update(['customer_id' => 1, 'answer' => 2]);
            $result = Timesheet::where('holidaysId',$request->input('id'))
                    ->update([
                        'isPaid' => $request->input('value'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
             if($result){
                 return true;
             }else{
                 return false;
             }
        }else{
            return false;
        }
    }
}
