<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use App\Model\Newcustomer;
use App\Model\Workplacecontact;
use App\Model\Workplacescustomer;
use DB;
use Auth;

use App\Model\Customercontact;


class Newcustomer extends Model {

    protected $table = 'newcustomer';
    
    public function addNewCusrtomer($request){
        $result = Newcustomer::where('customerNo',$request->customerNumber)
                ->count();
        if($result != 0){
            return "customerno";
        }else{
            $email = Newcustomer::where('email',$request->email)
                ->count();
            if($email != 0){
                return "email";
            }else{
                if($request->remeber == "yes"){
                    $remeber = 'yes';
                }else{
                    $remeber = 'no';
                }
                
                $objCustomer = new Newcustomer();
                $objCustomer->customerNo = $request->customerNumber;
                $objCustomer->customerType = $request->customerType;
                $objCustomer->companyName = $request->companyName;
                $objCustomer->address = $request->address;
                $objCustomer->state = $request->state;
                $objCustomer->telephone = $request->telephone;
                $objCustomer->fax = $request->fax;
                $objCustomer->email = $request->email;
                $objCustomer->web = $request->web;
                $objCustomer->taxNumber = $request->taxNumber;
                $objCustomer->note = $request->note;
                $objCustomer->registerDate =  date('Y-m-d', strtotime($request->registerDate));
                $objCustomer->timeline = $request->timeline;
                $objCustomer->updatedDate =  date('Y-m-d', strtotime($request->lastUpdate));
                $objCustomer->purpose = $request->purpose;
                $objCustomer->reminder = $remeber;
                $objCustomer->created_at = date("Y-m-d h:i:s");
                $objCustomer->updated_at = date("Y-m-d h:i:s");
                $objCustomer->save();
                $number = count($request->firstName);
                if ($number > 0) {
                    for ($i = 0; $i < $number; $i++) {
                        $Customercontact = new Customercontact();
                        $Customercontact->customerId =$objCustomer->id;
                        $Customercontact->gender = $request->input('gender')[$i];
                        $Customercontact->firstName = $request->input('firstName')[$i];
                        $Customercontact->lastName = $request->input('surName')[$i];
                        $Customercontact->telephone = $request->input('contacttelephone')[$i];
                        $Customercontact->fax = $request->input('contactfax')[$i];
                        $Customercontact->mobile = $request->input('mobile')[$i];
                        $Customercontact->email = $request->input('contactEmail')[$i];
                        $Customercontact->note = $request->input('contactnote')[$i];
                        $Customercontact->created_at = date("Y-m-d h:i:s");
                        $Customercontact->updated_at = date("Y-m-d h:i:s");
                        $Customercontact->save();
                    }
                }
                 return "inserted";
            }
        }
    }
    
    public function getCustomer()
    {
          $result = Newcustomer::get();
           return $result;
    }
    public function customerDetails($id = NULL)
    {
          $result = Newcustomer::select('newcustomer.*')
                        ->where('newcustomer.id', '=', $id)
                        ->get();
          return $result;
    }
    
    public function customerEdit($id = NULL)
    {        
        $result = Newcustomer::select('*')
                    ->where('id','=',$id)
                    ->get(); 
         return $result;
    }
    
      public function editNewCusrtomer($request){
          $result = Newcustomer::where('customerNo',$request->customerNumber)
                            ->where('id','!=',$request->input('editId'))
                            ->count();
            if($result != 0){
                return "customerno";
            }else{
                $email = Newcustomer::where('email',$request->email)
                          ->where('id','!=',$request->input('editId'))
                        ->count();
                if($email != 0){
                    return "email";
                }else{
                    if($request->input('remeber') == "yes"){
                        $remeber = 'yes';
                    }else{
                        $remeber = 'no';
                    }
                    $objCustomer = Newcustomer::find($request->input('editId'));
                    $objCustomer->customerNo = $request->input('customerNumber');
                    $objCustomer->customerType = $request->input('customerType');
                    $objCustomer->companyName = $request->input('companyName');
                    $objCustomer->address = $request->input('address');
                    $objCustomer->state = $request->input('state');
                    $objCustomer->telephone = $request->input('telephone');
                    $objCustomer->fax = $request->input('fax');
                    $objCustomer->email = $request->input('email');
                    $objCustomer->web = $request->input('web');
                    $objCustomer->taxNumber = $request->input('taxNumber');
                    $objCustomer->note = $request->input('note');
                    $objCustomer->registerDate = date('Y-m-d', strtotime($request->input('registerDate')));
                    $objCustomer->timeline = $request->input('timeline');
                    $objCustomer->purpose = $request->input('purpose');
                    $objCustomer->reminder = $remeber;
                    $objCustomer->updatedDate = date('Y-m-d', strtotime($request->input('lastUpdate')));

                    $objCustomer->updated_at = date("Y-m-d h:i:s");


                    $deletecustomer = Customercontact::where('customerId',$request->input('editId'))->delete();

                     $number = count($request->firstName);

                         for ($i = 0; $i < $number; $i++) {

                             $Customercontact = new Customercontact();
                             $Customercontact->customerId =$request->input('editId');
                             $Customercontact->gender = $request->input('gender')[$i];
                             $Customercontact->firstName = $request->input('firstName')[$i];
                             $Customercontact->lastName = $request->input('surName')[$i];
                             $Customercontact->telephone = $request->input('contacttelephone')[$i];
                             $Customercontact->fax = $request->input('contactfax')[$i];
                             $Customercontact->mobile = $request->input('mobile')[$i];
                             $Customercontact->email = $request->input('contactEmail')[$i];
                             $Customercontact->note = $request->input('contactnote')[$i];
                             $Customercontact->created_at = date("Y-m-d h:i:s");
                             $Customercontact->updated_at = date("Y-m-d h:i:s");
                             $Customercontact->save();
                         }
                      return "updtaed";
                }
            }
    }
    
    public function deleteNewCusrtomer($id)
    {
        $workplaceId =Workplacescustomer::select("id")
                    ->where('customerid',$id)
                    ->get();
           $data = Newcustomer::where('id',$id)->delete();
           Customercontact::where('customerId',$id)->delete();
           
           Workplacescustomer::where('customerid',$id)->delete();
           Workplacecontact::where('customerId',$workplaceId[0]->id)->delete();
            return true;
          
    }
}