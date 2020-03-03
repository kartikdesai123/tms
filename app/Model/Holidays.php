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
        for ($currentDate = $Variable1; $currentDate <= $Variable2; $currentDate += (86400)) {

            $Store = date('Y-m-d', $currentDate);
            $array[] = $Store;
        }
        return $array;
    }

    public function addHolidays($request) {
        $time1 = strtotime($request->input('start_date'));
        $time2 = strtotime($request->input('end_date'));
        if ($time1 > $time2) {
            return "2";
        } else {
            $objHolidays = new Holidays();
            $objHolidays->user_Id = $request->input('nameWorker');
            $objHolidays->start_date = date("Y-m-d", strtotime($request->input('start_date')));
            $objHolidays->end_date = date("Y-m-d", strtotime($request->input('end_date')));
            $objHolidays->created_at = date('Y-m-d H:i:s');
            $objHolidays->updated_at = date('Y-m-d H:i:s');
            if ($objHolidays->save()) {

                $HolidayId = $objHolidays->id;
                $starttimeFormate = date("Y-m-d", strtotime($request->input('start_date')));
                $endtimeFormate = date("Y-m-d", strtotime($request->input('end_date')));
                $dateRange = $this->getDatesFromRange($starttimeFormate, $endtimeFormate);
                for ($i = 0; $i < count($dateRange); $i++) {
                    $objTimesheet = new Timesheet();
                    $objTimesheet->worker_id = $request->input('nameWorker');
                    $objTimesheet->c_date = $dateRange[$i];
                    $objTimesheet->start_time = '0:00';
                    $objTimesheet->end_time = '0:00';
                    $objTimesheet->pause_time = '0:00';
                    $objTimesheet->total_time = '0:00';
                    $objTimesheet->missing_hour = '0:00';
                    $objTimesheet->reason = NULL;
                    $objTimesheet->supervisior_reson = NULL;
                    $objTimesheet->holidaysId = $HolidayId;
                    $objTimesheet->submitted = NULL;
                    $objTimesheet->isTImeSheet = 'no';
                    $objTimesheet->save();
                }
                return "1";
            } else {
                return "0";
            }
        }
    }

    public function holidayList($id = NULL) {
        if ($id) {
            $result = Holidays::select('users.id as userId', 'holidays.*')
                    ->leftjoin('users', 'users.id', '=', 'holidays.user_Id')
                    ->where('holidays.id', '=', $id)
                    ->get();
        } else {
            $result = Holidays::select('users.name', 'users.surname', 'holidays.*')
                    ->leftjoin('users', 'users.id', '=', 'holidays.user_Id')
                    ->get();
        }
        return $result;
    }

    public function deleteHolidays($request) {
        for ($i = 0; $i < count($request); $i++) {
            $result = Holidays::find($request[$i])->delete();
            $result = Timesheet::where('holidaysId', $request[$i])
                    ->delete();
        }
        return true;
    }

    public function editHolidays($request) {
        $time1 = strtotime($request->input('start_date'));
        $time2 = strtotime($request->input('end_date'));
        if ($time1 > $time2) {
            return "2";
        } else {
            $objDisease = Holidays::find($request->input('editId'));
            $objDisease->user_Id = $request->input('nameWorker');
            $objDisease->start_date = date("Y-m-d", strtotime($request->input('start_date')));
            $objDisease->end_date = date("Y-m-d", strtotime($request->input('end_date')));
            $objDisease->updated_at = date('Y-m-d H:i:s');
            if ($objDisease->save()) {
                $holidaysId = $request->input('editId');
                $result = Timesheet::where('holidaysId', $holidaysId)
                        ->delete();
                $starttimeFormate = date("Y-m-d", strtotime($request->input('start_date')));
                $endtimeFormate = date("Y-m-d", strtotime($request->input('end_date')));
                $dateRange = $this->getDatesFromRange($starttimeFormate, $endtimeFormate);
                for ($i = 0; $i < count($dateRange); $i++) {
                    $objTimesheet = new Timesheet();
                    $objTimesheet->worker_id = $request->input('nameWorker');
                    $objTimesheet->c_date = $dateRange[$i];
                    $objTimesheet->start_time = '0:00';
                    $objTimesheet->end_time = '0:00';
                    $objTimesheet->pause_time = '0:00';
                    $objTimesheet->total_time = '0:00';
                    $objTimesheet->missing_hour = '0:00';
                    $objTimesheet->reason = NULL;
                    $objTimesheet->supervisior_reson = NULL;
                    $objTimesheet->holidaysId = $holidaysId;
                    $objTimesheet->submitted = NULL;
                    $objTimesheet->isTImeSheet = 'no';
                    $objTimesheet->save();
                }
                return "1";
            } else {
                return "0";
            }
        }
    }

    public function paidAction($request) {
        $objHolidays = Holidays::find($request->input('id'));
        $objHolidays->isPaid = $request->input('value');
        $objHolidays->updated_at = date('Y-m-d H:i:s');
        if ($objHolidays->save()) {
//            Answer::where('question_id', 2)->update(['customer_id' => 1, 'answer' => 2]);
            $result = Timesheet::where('holidaysId', $request->input('id'))
                    ->update([
                'isPaid' => $request->input('value'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getdatatable($request) {

        $requestData = $_REQUEST;

        $columns = array(
            // datatable column index  => database column name
            0 => 'holidays.id',
            1 => 'users.name',
            2 => 'users.surname',
        );

        $worker = $request['data']['workerId'];
        $month = $request['data']['month'];
        $year = $request['data']['year'];
        if ($request['data']['month'] == '' || $request['data']['month'] == NULL) {
            $month = date('m');
        } else {
            $month = $request['data']['month'];
        }
        if ($request['data']['year'] == '' || $request['data']['year'] == NULL) {
            $year = date('Y');
        } else {
            $year = $request['data']['year'];
        }
        
        $query = Worker::from('holidays')
                ->leftjoin('users', 'users.id', '=', 'holidays.user_Id');
        
        if ($worker != "") {
            $query->where('holidays.user_Id', $worker);
        }

        if ($month != "" && $year == "") {
            $query->where('holidays.start_date', 'LIKE', '%-' . $month . '-%');
        }

        if ($month == "" && $year != "") {
            $query->where('holidays.start_date', 'LIKE', $year . '-%');
        }

        if ($month != "" && $year != "") {
            $query->where('holidays.start_date', 'LIKE', $year . '-' . $month . '-%');
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
                ->select('users.name', 'users.surname', 'holidays.*')
                ->get();

        $res = $resultArr->toarray();
        $data = [];
//       print_r($res); exit();
        foreach ($res as $row) {

            $actionhtml = '<a href="' . route('edit-holidays', $row['id']) . '"><span class="c-tooltip c-tooltip--top"  aria-label="Edit"><i class="fa fa-edit" ></i></span></a>
                           <a href="javascript:;" class="delete"  data-id="' . $row['id'] . '"><span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="Delete"><i class="fa fa-trash-o" ></i></span></a>';

            $date2 = date("d.m.Y", strtotime($row['end_date']));
            $date1 = date("d.m.Y", strtotime($row['start_date']));
            $diff = date_diff(date_create($date1), date_create($date2));

            if ($row["isPaid"] == "paid") {
                $submitted = '<input value="' . $row["id"] . '" type="checkbox" class="paidBtn" checked/>';
            } else {
                $submitted = '<input value="' . $row["id"] . '" type="checkbox" class="paidBtn"/>';
            }


            $nestedData = array();
            $nestedData[] = '<input value="' . $row['id'] . '"  name="delete[]"  type="checkbox" class="deleteClass multiCheckBox"/>';
            $nestedData[] = $row['name'] . ' ' . $row['surname'];
            $nestedData[] = date("d.m.Y", strtotime($row['start_date']));
            $nestedData[] = date("d.m.Y", strtotime($row['end_date']));
            $nestedData[] = $diff->format("%a") + 1;
            $nestedData[] = $submitted;
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

}
