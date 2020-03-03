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
use App\Model\Customer_id;

class Newcustomer extends Model {

    protected $table = 'newcustomer';

    public function addNewCusrtomer($request) {
        $data = $request->input();
        $temp_array = [];
        $temp_email_array = [];
        $lastcustomerno = '';
        for ($i = 0; $i < count($data['customerNumber']); $i++) {

            $result = Newcustomer::where('customerNo', $data['customerNumber'][$i])
                    ->count();
            if ($result != 0) {
                array_push($temp_array, $data['customerNumber'][$i]);
            } else {
                $email = Newcustomer::where('email', $data['email'][$i])
                        ->count();


                if ($email != 0) {
                    array_push($temp_email_array, $data['email'][$i]);
                } else {
                    $lastcustomerno = $data['customerType'][$i];
                    if ($data['remeber'] == "yes") {
                        $remeber = 'yes';
                    } else {
                        $remeber = 'no';
                    }

                    $objCustomer = new Newcustomer();
                    $objCustomer->customerNo = $data['customerNumber'][$i];
                    $objCustomer->customerType = $data['customerType'][$i];
                    $objCustomer->companyName = $data['companyName'][$i];
                    $objCustomer->address = $data['address'][$i];
                    $objCustomer->state = $data['state'][$i];
                    $objCustomer->telephone = $data['telephone'][$i];
                    $objCustomer->fax = $data['fax'][$i];
                    $objCustomer->email = $data['email'][$i];
                    $objCustomer->web = $data['web'][$i];
                    $objCustomer->taxNumber = $data['taxNumber'][$i];
                    $objCustomer->note = $data['note'][$i];
                    $objCustomer->registerDate = date('Y-m-d', strtotime($data['registerDate']));
                    $objCustomer->timeline = $data['timeline'];
                    $objCustomer->customer_status = $data['status'];
                    $objCustomer->updatedDate = date('Y-m-d', strtotime($data['lastUpdate']));
                    $objCustomer->purpose = $data['purpose'];
                    $objCustomer->reminder = $remeber;
                    $objCustomer->created_at = date("Y-m-d h:i:s");
                    $objCustomer->updated_at = date("Y-m-d h:i:s");
                    $res = $objCustomer->save();
                    if ($res) {
                        $Customercontact = new Customercontact();
                        $Customercontact->customerId = $objCustomer->id;
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
                    $objCustomerid = new Customer_id();
                    $objCustomerid->updateid($request->customerNumber);
                }
            }
        }
//        print_r($temp_array);
//        print_r($temp_email_array);


        if (!empty($temp_array) && !empty($temp_email_array)) {
            $cno = implode(",", $temp_array);
            $email = implode(",", $temp_email_array);
            $return['status'] = 'success';
            $return['message'] = 'Customer Created successfully.But customer number ' . $cno . ' already exits and ' . $email . ' emil address already exits.';
            $return['redirect'] = route('newCustomer');
        } else {
            if (empty($temp_array) && !empty($temp_email_array)) {
                $email = implode(",", $temp_email_array);
                $return['status'] = 'success';
                $return['message'] = 'Customer Created successfully.But ' . $email . ' emil address already exits.';
                $return['redirect'] = route('newCustomer');
            } else {
                if (!empty($temp_array) && empty($temp_email_array)) {
                    $cno = implode(",", $temp_array);
                    $return['status'] = 'success';
                    $return['message'] = 'Customer Created successfully.But customer number ' . $cno . ' already exits';
                    $return['redirect'] = route('newCustomer');
                } else {
                    $return['status'] = 'success';
                    $return['message'] = 'Customer Created successfully.';
                    $return['redirect'] = route('newCustomer');
                }
            }
        }
        return $return;
    }

    public function addNewCusrtomernew($request) {

        $result = Newcustomer::where('customerNo', $request->customerNumber)
                ->count();
        if ($result != 0) {
            return "customerno";
        } else {
            $email = Newcustomer::where('email', $request->email)
                    ->count();
            if ($email != 0) {
                return "email";
            } else {
                if ($request->remeber == "yes") {
                    $remeber = 'yes';
                } else {
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
                $objCustomer->registerDate = date('Y-m-d', strtotime($request->registerDate));
                $objCustomer->timeline = $request->timeline;
                $objCustomer->customer_status = $request->status;
                $objCustomer->updatedDate = date('Y-m-d', strtotime($request->lastUpdate));
                $objCustomer->purpose = $request->purpose;
                $objCustomer->reminder = $remeber;
                $objCustomer->created_at = date("Y-m-d h:i:s");
                $objCustomer->updated_at = date("Y-m-d h:i:s");
                $objCustomer->save();
                $number = count($request->firstName);
                if ($number > 0) {
                    for ($i = 0; $i < $number; $i++) {
                        $Customercontact = new Customercontact();
                        $Customercontact->customerId = $objCustomer->id;
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
                $objCustomerid = new Customer_id();
                $objCustomerid->updateid($request->customerNumber);
                return "inserted";
            }
        }
    }

    public function getCustomer() {
        $result = Newcustomer::get();
        return $result;
    }

    public function getCustomerNew() {
        $result = Newcustomer::select('newcustomer.id', 'newcustomer.customerNo', 'newcustomer.customerType', 'newcustomer.companyName', 'newcustomer.telephone', 'newcustomer.address', 'newcustomer.email', 'newcustomer.web', 'newcustomer.registerDate', 'newcustomer.timeLine', 'newcustomer.updatedDate', 'newcustomer.customer_status', 'customercontact.firstName', 'customercontact.lastName')
                ->leftjoin('customercontact', 'customercontact.customerId', '=', 'newcustomer.id')
                ->groupBy('newcustomer.id')
                ->get();
        return $result;
    }

    public function customerDetails($id = NULL) {
        $result = Newcustomer::select('newcustomer.*')
                ->where('newcustomer.id', '=', $id)
                ->get();
        return $result;
    }

    public function customerEdit($id = NULL) {
        $result = Newcustomer::select('*')
                ->where('id', '=', $id)
                ->get();
        return $result;
    }

    public function editNewCusrtomer($request) {

        $result = Newcustomer::where('customerNo', $request->customerNumber)
                ->where('id', '!=', $request->input('editId'))
                ->count();
        if ($result != 0) {
            return "customerno";
        } else {
            $email = Newcustomer::where('email', $request->email)
                    ->where('id', '!=', $request->input('editId'))
                    ->count();
            if ($email != 0) {
                return "email";
            } else {
                if ($request->input('remeber') == "yes") {
                    $remeber = 'yes';
                } else {
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
                $objCustomer->customer_status = $request->input('status');
                $objCustomer->purpose = $request->input('purpose');
                $objCustomer->reminder = $remeber;
                $objCustomer->updatedDate = date('Y-m-d', strtotime($request->input('lastUpdate')));

                $objCustomer->updated_at = date("Y-m-d h:i:s");
                $objCustomer->save();

                $deletecustomer = Customercontact::where('customerId', $request->input('editId'))->delete();

                $number = count($request->firstName);

                for ($i = 0; $i < $number; $i++) {

                    $Customercontact = new Customercontact();
                    $Customercontact->customerId = $request->input('editId');
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

    public function deleteNewCusrtomer($id) {
        $workplaceId = Workplacescustomer::select("id")
                ->where('customerid', $id)
                ->get();
        $data = Newcustomer::where('id', $id)->delete();
        Customercontact::where('customerId', $id)->delete();

        Workplacescustomer::where('customerid', $id)->delete();
        Workplacecontact::where('customerId', $workplaceId[0]->id)->delete();
        return true;
    }

    public function getdatatable($request) {

        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'newcustomer.customerNo',
            1 => 'newcustomer.customerType',
            2 => 'newcustomer.companyName',
            3 => 'newcustomer.telephone',
            4 => 'newcustomer.address',
            5 => 'newcustomer.email',
            6 => 'newcustomer.web',
            7 => 'newcustomer.registerDate',
            8 => 'newcustomer.timeLine',
        );

        $name = $request['data']['name'];
        $status = $request['data']['status'];
        $type = $request['data']['type'];
        $query = Newcustomer::from('newcustomer')
                ->leftjoin('customercontact', 'customercontact.customerId', '=', 'newcustomer.id');
//        print_r($name);print_r($status);print_r($type);die();
        if ($name != '') {
            $query->where('newcustomer.id', $name);
        }
        if ($status != '') {
            $query->where('newcustomer.customer_status', $status);
        }
        if ($type != '') {
            $query->where('newcustomer.customerType', $type);
        }

        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like', '%' . $searchVal . '%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%' . $searchVal . '%');
                        }
                    }
                }
            });
        }

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                ->take($requestData['length'])
                ->select('newcustomer.id', 'newcustomer.customerNo', 'newcustomer.customerType', 'newcustomer.companyName', 'newcustomer.telephone', 'newcustomer.address', 'newcustomer.email', 'newcustomer.web', 'newcustomer.registerDate', 'newcustomer.timeLine', 'newcustomer.updatedDate', 'newcustomer.customer_status')
                ->get();
        $data = array();
        $i = 0;
        foreach ($resultArr as $row) {

            $actionhtml = '';
            $actionhtml = '<a href="' . route('customer-details', $row["id"]) . '"><span class="c-tooltip c-tooltip--top" aria-label="' . trans("customer.view") . '"><i class="fa fa-eye"></i></span></a>
                            <a href="' . route('edit-customer', $row["id"]) . '"><span class="c-tooltip c-tooltip--top" aria-label="' . trans("customer.edit") . '"><i class="fa fa-edit"></i></span></a>
                            <a href="javascript:;" class="delete"  data-id="' . $row["id"] . '"><span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="' . trans("words.delete") . '"><i class="fa fa-trash-o" ></i></span></a>';


//            $objuser = new Newcustomer();
//            $status = $objuser->getstatus($row['registerDate'], $row['timeLine']);
//            if ($status == 'active') {
//                $status = '<i class="fa fa-circle" style="color:#34aa44;"></i>';
//            }
//            if ($status == 'verysoon') {
//                $status = '<i class="fa fa-circle" style="color:#fd9a18;"></i>';
//            } 
//            if ($status == 'inactive') {
//                $status = '<i class="fa fa-circle" style="color:#ed1c24;"></i>';
//            }
            if ($row['customerType'] == "private_customer") {
                $cus_type = 'Private Customer';
            } else {
                $cus_type = 'Corporate Customer';
            }
            if ($row['customer_status'] == 1) {
                $status = '<i class="fa fa-circle" style="color:#34aa44;"></i>';
            }
            if ($row['customer_status'] == 2) {
                $status = '<i class="fa fa-circle" style="color:#ed1c24;"></i>';
            }
            if ($row['customer_status'] == 3) {
                $status = '<i class="fa fa-circle" style="color:#fd9a18;"></i>';
            }
            $timeline = array('', '6 month', '1 Year', '2 year', '3 year', '4 year', '5 year');

            $i++;
            $nestedData = array();

            $nestedData[] = $row['customerNo'];
            $nestedData[] = $cus_type;
            $nestedData[] = $row['companyName'];
            $nestedData[] = $row['telephone'];
            $nestedData[] = $row['address'];
            $nestedData[] = $row['email'];
            $nestedData[] = $status;
            $nestedData[] = $row['web'];
            $nestedData[] = date('d.m.Y', strtotime($row['registerDate']));
            $nestedData[] = $timeline[$row['timeLine']];
            $nestedData[] = date('d.m.Y', strtotime($row['updatedDate']));
            $nestedData[] = $actionhtml;
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }

    public function getstatus($registerdate, $timeline) {

        $return = "false";
        if ($timeline == 1) {

            $endcontratDate = date('Y-m-d', strtotime("+6 months", strtotime($registerdate)));
            $alertData = date('Y-m-d', strtotime('-56 days', strtotime($endcontratDate)));
            $currentDate = date("Y-m-d");
        }
        if ($timeline == 2) {
            $endcontratDate = date('Y-m-d', strtotime("+12 months", strtotime($registerdate)));
            $alertData = date('Y-m-d', strtotime('-56 days', strtotime($endcontratDate)));
            $currentDate = date("Y-m-d");
        }
        if ($timeline == 3) {
            $endcontratDate = date('Y-m-d', strtotime("+24 months", strtotime($registerdate)));
            $alertData = date('Y-m-d', strtotime('-56 days', strtotime($endcontratDate)));
            $currentDate = date("Y-m-d");
        }
        if ($timeline == 4) {
            $endcontratDate = date('Y-m-d', strtotime("+36 months", strtotime($registerdate)));

            $alertData = date('Y-m-d', strtotime('-56 days', strtotime($endcontratDate)));
            $currentDate = date("Y-m-d");
        }
        if ($timeline == 5) {
            $endcontratDate = date('Y-m-d', strtotime("+48 months", strtotime($registerdate)));
            $alertData = date('Y-m-d', strtotime('-56 days', strtotime($endcontratDate)));
            $currentDate = date("Y-m-d");
        }
        if ($timeline == 6) {
            $endcontratDate = date('Y-m-d', strtotime("+60 months", strtotime($registerdate)));
            $alertData = date('Y-m-d', strtotime('-56 days', strtotime($endcontratDate)));
            $currentDate = date("Y-m-d");
        }


        if ($currentDate < $endcontratDate) {
            if ($currentDate > $alertData) {

                $status = 'verysoon';
            } else {
                $status = 'active';
            }
        } else {
            $status = 'inactive';
        }

        return $status;
    }

}
