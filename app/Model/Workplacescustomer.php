<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use App\Model\Newcustomer;
use DB;
use Auth;
use App\Model\Workplacecontact;

class Workplacescustomer extends Model {

    protected $table = 'workplacescustomer';

    public function addWorkplacescustomer($request) {
        $email = Workplacescustomer::where("email",$request->email)
                 ->count();
        if($email != 0){
            return "email";
        }else{
            $worker = implode(",",$request->input('responsibleWorker'));
            
            $objworkplaceCustomer = new Workplacescustomer();
            $objworkplaceCustomer->customerid = $request->customerID;
            $objworkplaceCustomer->workplaceName = $request->workplaceName;
            $objworkplaceCustomer->address = $request->address;
            $objworkplaceCustomer->state = $request->state;
            $objworkplaceCustomer->telephone = $request->telephone;
            $objworkplaceCustomer->fax = $request->fax;
            $objworkplaceCustomer->email = $request->email;
            $objworkplaceCustomer->web = $request->web;
            $objworkplaceCustomer->responsibleWorker = $worker;
            $objworkplaceCustomer->note = $request->note;
            $objworkplaceCustomer->save();
           
            $number = count($request->firstName);
            if ($number > 0) {
                for ($i = 0; $i < $number; $i++) {
                    $section = new Workplacecontact();
                    $section->customerId = $objworkplaceCustomer->id;
                    $section->gender = $request->input('gender')[$i];
                    $section->firstName = $request->input('firstName')[$i];
                    $section->lastName = $request->input('surName')[$i];
                    $section->telephone = $request->input('contacttelephone')[$i];
                    $section->fax = $request->input('contactfax')[$i];
                    $section->mobile = $request->input('mobile')[$i];
                    $section->email = $request->input('contactEmail')[$i];
                    $section->note = $request->input('contactnote')[$i];
                    $section->save();
                }
            }
            return "inserted"; 
        }
       
    }
    
    public function workplaceDetails($id)
    {
          $result = Workplacescustomer::where("customerid",$id)
                  ->get();
          return $result;
    }
     public function deleteWorkplacescustomer()
    {
          $data = Workplacescustomer::where('id',$id)->delete();
          
           Workplacecontact::where('customerId',$id)->delete();
           
           return true;
          
    }
    
      public function workplaceEdit($id = NULL)
    {        
        $result = Workplacescustomer::select('*')
                    ->where('id','=',$id)
                    ->get(); 
         return $result;
    }
      public function editWorkplacescustomer($id = NULL)
    {        
        $result = Workplacescustomer::select('*')
                    ->where('id','=',$id)
                    ->get(); 
         return $result;
    }
    
      public function WorkplacescustomerEdit($request){
          
       $countresponce = count($request->responsibleWorker);
        
        
           if ($request->responsibleWorker == null) {
                    $str = " ";
                } else {
                    $number = count($request->responsibleWorker);
                    if ($number > 0) {
                        $str = "";
                        for ($i = 0; $i < $number; $i++) {

                                $str =  $str.",".$request->responsibleWorker[$i];
                                
                        }
                    } else {
                        $str = " ";
                    }
                }
                
                
        $request->responsibleWorker = $str;
        
        $objCustomer = Workplacescustomer::where('id',$request->customerNo)->update([
        "customerNo"=>$request->customerNo,
        "workplaceName" => $request->workplaceName,
        "address" => $request->address,
        "state" => $request->state,
        "telephone" => $request->telephone,
        "fax" =>$request->fax,
        "email" => $request->email,
        "web" => $request->web,
        "responsibleWorker" => $str,
        "note" => $request->note
        ]);
        
        $deletecustomer = Workplacecontact::where('customerId',$request->customerNo)->delete();
        
        $number = count($request->firstName);
        if ($number > 0) {
            for ($i = 0; $i < $number; $i++) {
                $section = new Customercontact();
                $section->customerId =$request->customerNo;
                $section->gender = $request->input('gender')[$i];
                $section->firstName = $request->input('firstName')[$i];
                $section->lastName = $request->input('surName')[$i];
                $section->telephone = $request->input('contacttelephone')[$i];
                $section->fax = $request->input('contactfax')[$i];
                $section->mobile = $request->input('mobile')[$i];
                $section->email = $request->input('contactEmail')[$i];
                $section->note = $request->input('contactnote')[$i];
                $section->save();
            }
        }
      
         return true;
    }
    
    public function editDetailsWorkplacescustomer($request){
        $workplace_id = $request->input('workplace_id');
        $email = Workplacescustomer::where("email",$request->email)
                ->where("id","!=",$workplace_id)
                ->count();
       
        if($email != 0){
            return "email";
        }else{
            $worker = implode(",",$request->input('responsibleWorker'));
            $objworkplaceCustomer = Workplacescustomer::find($workplace_id);
            $objworkplaceCustomer->workplaceName = $request->workplaceName;
            $objworkplaceCustomer->address = $request->address;
            $objworkplaceCustomer->state = $request->state;
            $objworkplaceCustomer->telephone = $request->telephone;
            $objworkplaceCustomer->fax = $request->fax;
            $objworkplaceCustomer->email = $request->email;
            $objworkplaceCustomer->web = $request->web;
            $objworkplaceCustomer->responsibleWorker = $worker;
            $objworkplaceCustomer->note = $request->note;
            $objworkplaceCustomer->save();
            
            $result = Workplacecontact::where('customerId',$workplace_id)->delete();
            $number = count($request->input('firstName'));
            
            if ($number > 0) {
                for ($i = 0; $i < $number; $i++) {
                    $section = new Workplacecontact();
                    $section->customerId = $objworkplaceCustomer->id;
                    $section->gender = $request->input('gender')[$i];
                    $section->firstName = $request->input('firstName')[$i];
                    $section->lastName = $request->input('surName')[$i];
                    $section->telephone = $request->input('contacttelephone')[$i];
                    $section->fax = $request->input('contactfax')[$i];
                    $section->mobile = $request->input('mobile')[$i];
                    $section->email = $request->input('contactEmail')[$i];
                    $section->note = $request->input('contactnote')[$i];
                    $section->save();
                }
            }
            return "updated"; 
             
        }
       
    }
    
    public function deleteWorkplace($id){
        $result = Workplacescustomer::where('id',$id)
                        ->delete();
        if($result){
            $res = Workplacecontact::where('customerId',$id)
                        ->delete();
            if($res){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}
