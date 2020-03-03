<?php

namespace App\Model;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Model\Timesheet;
use App\Model\Workerdetails;
use DB;
use Auth;

class Worker extends Model {

    protected $table = 'users';

    /* In table not created 'updated_at' and 'created_at' field then write below code */
    public $timestamps = false;

    public function timesheet() {
        return $this->hasMany('App\Model\Timesheet');
    }

    public function getWorkerList($request = NULL) {

        //$results = worker::with('timesheet')->get();
        // $result = worker::with('timesheet')->get();

        if ($request) {
            $startnewDate = date("Y-m-d", strtotime($request->input()['start_date']));
            $endnewDate = date("Y-m-d", strtotime($request->input()['end_date']));

            $result = worker::select('users.id', 'users.last_login', 'users.staffnumber', 'users.name', 'users.surname', 'users.isBlocked')
                    ->join('timesheet', 'users.id', '=', 'timesheet.worker_id')
                    ->where('timesheet.c_date', '>=', $startnewDate)
                    ->where('timesheet.c_date', '<=', $endnewDate)
                    ->groupBy('users.id')
                    ->get();
        } else {
            $result = worker::select('users.id', 'users.last_login', 'users.staffnumber', 'users.name', 'users.surname', 'users.isBlocked')
                    ->join('timesheet', 'users.id', '=', 'timesheet.worker_id')
                    ->groupBy('users.id')
                    ->get();
        }

        $res = $result->toarray();
        for ($i = 0; $i < count($res); $i++) {
            $qurey = "SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum , SEC_TO_TIME( SUM( TIME_TO_SEC( `pause_time` ) ) ) AS pausetime FROM timesheet where worker_id ='" . $res[$i]['id'] . "'";
            $totaltimes = DB::select(DB::raw($qurey));
            $result[$i]->total_houres = $totaltimes[0]->timeSum;
            $result[$i]->pausetime = $totaltimes[0]->pausetime;
        }





        for ($i = 0; $i < count($res); $i++) {
            $lastlogin = DB::table('timesheet')
                            ->where('worker_id', $res[$i]['id'])
                            ->orderBy('created_at', 'desc')->first();
            $result[$i]->lastlogin = $lastlogin->c_date;
        }

        return $result;
    }

    public function getWorkerListNew($request = NULL) {

        if ($request) {
            $startnewDate = date("Y-m-d", strtotime($request->input()['start_date']));
            $endnewDate = date("Y-m-d", strtotime($request->input()['end_date']));

            $result = worker::select('users.id', 'users.last_login', 'users.staffnumber', 'users.name', 'users.surname', 'users.isBlocked')
                    ->join('timesheet', 'users.id', '=', 'timesheet.worker_id')
                    ->where('timesheet.c_date', '>=', $startnewDate)
                    ->where('timesheet.c_date', '<=', $endnewDate)
                    ->groupBy('users.id')
                    ->orderBy('users.id', 'DESC')
                    ->get();
        } else {
            $result = worker::select('workerdetails.endContract', 'users.id', 'users.last_login', 'users.staffnumber', 'users.name', 'users.surname', 'users.isBlocked')
                    ->join('timesheet', 'users.id', '=', 'timesheet.worker_id')
                    ->leftjoin('workerdetails', 'workerdetails.workerId', '=', 'users.id')
                    ->groupBy('users.id')
                    ->orderBy('users.id', 'DESC')
                    ->get();
        }

        $res = $result->toarray();
        for ($i = 0; $i < count($res); $i++) {
            $qurey = "SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_time` ) ) ) AS timeSum , SEC_TO_TIME( SUM( TIME_TO_SEC( `pause_time` ) ) ) AS pausetime FROM timesheet where worker_id ='" . $res[$i]['id'] . "'";
            $totaltimes = DB::select(DB::raw($qurey));
            $result[$i]->total_houres = $totaltimes[0]->timeSum;
            $result[$i]->pausetime = $totaltimes[0]->pausetime;
        }





        for ($i = 0; $i < count($res); $i++) {
            $lastlogin = DB::table('timesheet')
                            ->where('worker_id', $res[$i]['id'])
                            ->orderBy('created_at', 'desc')->first();
            $result[$i]->lastlogin = $lastlogin->c_date;
        }

        return $result;
    }

    public function getWorkerList1($id = NULL) {
        $result = worker::select('users.*', 'users.surname as usersurname', 'users.name as username', 'users.workplaces as userworkplaces', 'users.type as usertype', 'users.staffnumber as userstaffnumber', 'users.id as userId', 'workerdetails.*')
                ->where('users.id', '=', $id)
                ->leftjoin('workerdetails', 'workerdetails.workerId', '=', 'users.id')
                ->get();
        return $result;
    }

    public function saveWorkerInfo($request) {

        $newpassword = ($request->input('password') != '') ? $request->input('password') : null;
        $newpass = Hash::make($newpassword);

        $objWorker = new worker();
        $objWorker->name = $request->input('name');
        $objWorker->surname = $request->input('surname');
        $objWorker->staffnumber = $request->input('staffnumber');
        $objWorker->password = $newpass;
        $objWorker->created_at = date('Y-m-d H:i:s');
        $objWorker->updated_at = date('Y-m-d H:i:s');
        $objWorker->type = $request->input('type');
        $workplaces = $request->input('workplaces');
        $objWorker->workplaces = implode(',', $workplaces);
        $objWorker->remember_token = Str::random(60);

        $objWorker->save();
        return TRUE;
    }

    public function saveNewWorkerInfo($request) {

        $newpassword = ($request->input('password') != '') ? $request->input('password') : null;
        $newpass = Hash::make($newpassword);

        $objWorker = new worker();
        $objWorker->name = $request->input('firstName');
        $objWorker->surname = $request->input('surname');
        $objWorker->staffnumber = $request->input('staffnumber');
        $objWorker->password = $newpass;
        $objWorker->created_at = date('Y-m-d H:i:s');
        $objWorker->updated_at = date('Y-m-d H:i:s');
        $objWorker->type = $request->input('type');
        $workplaces = $request->input('workplaces');
        $objWorker->workplaces = implode(',', $workplaces);
        $objWorker->remember_token = Str::random(60);
        if ($objWorker->save()) {
            $workerId = $objWorker->id;
            $objWorkerDetails = new Workerdetails();
            $objWorkerDetails->workerId = $workerId;
            $objWorkerDetails->staffnumber = $request->input('staffnumber');
            $objWorkerDetails->type = $request->input('type');
            $workplaces = $request->input('workplaces');
//        $objWorker->workplaces = implode(',', $workplaces);
            $objWorkerDetails->workplaces = implode(',', $workplaces);
            $objWorkerDetails->position = $request->input('position');
            $objWorkerDetails->employment = $request->input('employment');
            $objWorkerDetails->startContract = date("Y-m-d", strtotime($request->input('startContract')));
            $objWorkerDetails->endContract = date("Y-m-d", strtotime($request->input('endContract')));
            $objWorkerDetails->weekHours = $request->input('weekHours');
            $objWorkerDetails->workType = $request->input('workType');
            if ($request->input('workType') == 'hourly') {
                $objWorkerDetails->wage = $request->input('hourly');
            } else {
                $objWorkerDetails->wage = $request->input('fixed');
            }

            $objWorkerDetails->totalHolidays = $request->input('totalHolidays');
            $objWorkerDetails->cancelDate = $request->input('cancelDate');
            $objWorkerDetails->gender = $request->input('gender');
            $objWorkerDetails->firstName = $request->input('firstName');
            $objWorkerDetails->surname = $request->input('surname');
            $objWorkerDetails->dateofBirth = date("Y-m-d", strtotime($request->input('dateofBirth')));
            $objWorkerDetails->placeofBirth = $request->input('placeofBirth');
            $objWorkerDetails->nationality = $request->input('nationality');
            $objWorkerDetails->workPermit = date("Y-m-d", strtotime($request->input('workPermit')));
            $objWorkerDetails->residencePermit = date("Y-m-d", strtotime($request->input('residencePermit')));
            $objWorkerDetails->taxId = $request->input('taxId');
            $objWorkerDetails->socialSecurityNumber = $request->input('socialSecurityNumber');
            $objWorkerDetails->email = $request->input('email');
            $objWorkerDetails->password = $newpass;
            $objWorkerDetails->phoneNumber = $request->input('phoneNumber');
            $objWorkerDetails->mobile = $request->input('mobile');
            $objWorkerDetails->adresses = $request->input('adresses');
            $objWorkerDetails->postcodeCity = $request->input('postcodeCity');
            $objWorkerDetails->holderName = $request->input('name');
            $objWorkerDetails->bankName = $request->input('bankName');
            $objWorkerDetails->iban = $request->input('iban');
            $objWorkerDetails->note = $request->input('note');
            $objWorkerDetails->created_at = date('Y-m-d H:i:s');
            $objWorkerDetails->updated_at = date('Y-m-d H:i:s');
            if ($objWorkerDetails->save()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function updateWorkerInfo($request) {
        $workerId = $request->input('id');

        $workplaces = $request->input('workplaces');

        $objWorker = worker::find($workerId);
        $objWorker->name = $request->input('firstName');
        $objWorker->surname = $request->input('surname');
        $objWorker->updated_at = date('Y-m-d H:i:s');
        $objWorker->type = $request->input('type');
        $workplaces = $request->input('workplaces');
        $objWorker->workplaces = implode(',', $workplaces);
        $objWorker->save();
        if ($objWorker->save()) {
            $result = workerdetails::select('id')
                    ->where('workerId', '=', $workerId)
                    ->get();
            if (isset($result[0]->id)) {
                $result = workerdetails::find($result[0]->id)->delete();
            }
            $objWorkerDetails = new Workerdetails();
            $objWorkerDetails->workerId = $workerId;
            $objWorkerDetails->staffnumber = $request->input('staffnumber');
            $objWorkerDetails->type = $request->input('type');
            $workplaces = $request->input('workplaces');
//        $objWorker->workplaces = implode(',', $workplaces);
            $objWorkerDetails->workplaces = implode(',', $workplaces);
            $objWorkerDetails->position = $request->input('position');
            $objWorkerDetails->employment = $request->input('employment');
            $objWorkerDetails->startContract = date("Y-m-d", strtotime($request->input('startContract')));
            $objWorkerDetails->endContract = date("Y-m-d", strtotime($request->input('endContract')));
            $objWorkerDetails->weekHours = $request->input('weekHours');
            $objWorkerDetails->workType = $request->input('workType');
            if ($request->input('workType') == 'hourly') {
                $objWorkerDetails->wage = $request->input('hourly');
            } else {
                $objWorkerDetails->wage = $request->input('fixed');
            }

            $objWorkerDetails->totalHolidays = $request->input('totalHolidays');
            $objWorkerDetails->cancelDate = $request->input('cancelDate');
            $objWorkerDetails->gender = $request->input('gender');
            $objWorkerDetails->firstName = $request->input('firstName');
            $objWorkerDetails->surname = $request->input('surname');
            $objWorkerDetails->dateofBirth = date("Y-m-d", strtotime($request->input('dateofBirth')));
            $objWorkerDetails->placeofBirth = $request->input('placeofBirth');
            $objWorkerDetails->nationality = $request->input('nationality');
            $objWorkerDetails->workPermit = date("Y-m-d", strtotime($request->input('workPermit')));
            $objWorkerDetails->residencePermit = date("Y-m-d", strtotime($request->input('residencePermit')));
            $objWorkerDetails->taxId = $request->input('taxId');
            $objWorkerDetails->socialSecurityNumber = $request->input('socialSecurityNumber');
            $objWorkerDetails->email = $request->input('email');

            $objWorkerDetails->phoneNumber = $request->input('phoneNumber');
            $objWorkerDetails->mobile = $request->input('mobile');
            $objWorkerDetails->adresses = $request->input('adresses');
            $objWorkerDetails->postcodeCity = $request->input('postcodeCity');
            $objWorkerDetails->holderName = $request->input('name');
            $objWorkerDetails->bankName = $request->input('bankName');
            $objWorkerDetails->iban = $request->input('iban');
            $objWorkerDetails->note = $request->input('note');
            $objWorkerDetails->created_at = date('Y-m-d H:i:s');
            $objWorkerDetails->updated_at = date('Y-m-d H:i:s');
            if ($objWorkerDetails->save()) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        /* echo $workerId;
          exit; */

        $objWorker->save();
        return TRUE;
    }

    public function searchworkerInfo($request, $id = NULL) {

        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');


        $result = timesheet::select('timesheet.*', 'users.staffnumber', 'users.name', 'users.surname');
        /* if($name != ""){
          $result->where('worker_id', 'LIKE', '%'.$name.'%');
          }
          if($workplaces != ""){
          $result->where('timesheet.workplaces', 'LIKE', '%'.$workplaces.'%');
          } */
        if ($toDate != "") {
            $result->whereRaw("c_date >= ? AND c_date <= ?", array($fromDate . " 00:00:00", $toDate . " 23:59:59")
            );
        }

        $results = $result->join('users', 'timesheet.worker_id', '=', 'users.id')->get();

        //dd($results);


        return $results;
    }

}
