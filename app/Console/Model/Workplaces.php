<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class workplaces extends Model {

    protected $table = 'workplaces';

    /* In table not created 'updated_at' and 'created_at' field then write below code */
    public $timestamps = false;

    public function getWorkplacesList($id = NULL) {
        if ($id) {
            $result = workplaces::select('workplaces.*')
                    ->where('workplaces.id', '=', $id)
                    ->get();
        } else {
            $result = workplaces::get();
        }

        return $result;
    }

    public function saveWorkplacesInfo($request) {
        $objWorkplaces = new workplaces();
        $objWorkplaces->company = $request->input('company');
        $objWorkplaces->adresses = $request->input('adresses');
        $objWorkplaces->save();
        return TRUE;
    }

    public function updateWorkplacesInfo($request) {
        // print_r($request->input('workplaces_id'));
        // exit;
        $workplacesId = $request->input('workplaces_id');
        $objWorkplaces = workplaces::find($workplacesId);
        $objWorkplaces->company = $request->input('company');
        $objWorkplaces->adresses = $request->input('adresses');
        $objWorkplaces->save();
        return TRUE;
    }

    public function getWorkplaces() {
        $result = workplaces::pluck('company', 'company')->toArray();
        return $result;
    }

}
