<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use DB;
use Auth;

class Disease extends Model {

    protected $table = 'disease';
    
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

    public function addDiesease($request){
        $time1 = strtotime($request->input('start_date'));
        $time2 = strtotime($request->input('end_date'));
          
        
        if($time1 > $time2){
            return "2" ;
        }else{  
            $objDisease = new Disease();
            $objDisease->user_Id = $request->input('nameWorker');
            $objDisease->start_date = date("Y-m-d", strtotime($request->input('start_date')));
            $objDisease->end_date = date("Y-m-d", strtotime($request->input('end_date')));
            $objDisease->submited = 'not submited';
            $objDisease->created_at = date('Y-m-d H:i:s');
            $objDisease->updated_at = date('Y-m-d H:i:s');
            
            if($objDisease->save()){
                $dieseaId =$objDisease->id;
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
                    $objTimesheet->diseaseId=$dieseaId;
                    $objTimesheet->submitted='not submited';
                    $objTimesheet->isTImeSheet='no';
                    $objTimesheet->save();
                }
                return "1" ;
            }else{
                return "0" ;
            }
        }
    }
    
    public function diseaseList($id = NULL){
        if ($id) {
            $result = Disease::select('users.id as userId','disease.*')
                        ->leftjoin('users', 'users.id', '=', 'disease.user_Id')
                        ->where('disease.id', '=', $id)
                        ->get();
        } else {
            $result = Disease::select('users.name','users.surname','disease.*')
                        ->leftjoin('users', 'users.id', '=', 'disease.user_Id')
                        ->get();
        }
        return $result;
    }
    
    public function editDiesease($request){
      
//        $objDisease = new Disease();
        $time1 = strtotime($request->input('start_date'));
        $time2 = strtotime($request->input('end_date'));
        if($time1 > $time2){
            return "2" ;
        }else{ 
            $objDisease = Disease::find($request->input('editId'));
            $objDisease->user_Id = $request->input('nameWorker');
            $objDisease->start_date = date("Y-m-d", strtotime($request->input('start_date')));
            $objDisease->end_date = date("Y-m-d", strtotime($request->input('end_date')));
            $objDisease->updated_at = date('Y-m-d H:i:s');
            if($objDisease->save()){
                $dieseaId=$request->input('editId');
                $result = Timesheet::where('diseaseId',$dieseaId)
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
                    $objTimesheet->diseaseId=$dieseaId;
                    $objTimesheet->submitted='not submited';
                    $objTimesheet->isTImeSheet='no';
                    $objTimesheet->save();
                }
                return "1" ;
            }else{
                return "0" ;
            }
        }
    }
    
    public function deleteDiesease($request){
       
//         $result = Users::find($postData['id'])->delete();
        for($i=0;$i<count($request);$i++){
            $result = Disease::find($request[$i])->delete();
            $result = Timesheet::where('diseaseId',$request[$i])
                        ->delete();
        }
        return true;
    }
    
    public function submitAction($request){
        $objDisease = Disease::find($request->input('id'));
        $objDisease->submited = $request->input('value');
        $objDisease->updated_at = date('Y-m-d H:i:s');
//        return $objDisease->save();
        if($objDisease->save()){
//            Answer::where('question_id', 2)->update(['customer_id' => 1, 'answer' => 2]);
            $result = Timesheet::where('diseaseId',$request->input('id'))
                    ->update([
                        'submitted' => $request->input('value'),
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
