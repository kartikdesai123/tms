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
                    ->orderBy('workplaces.company','ASC')
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
        $result = workplaces::pluck('company', 'company')
                ->toArray();

        return $result;
    }

    public function getWorkplacesnew() {
        $result = workplaces::select("company")
                ->orderBy('company', 'ASC')
                ->get();

        return $result;
    }

    public function getworkplacedatatable() {

        $requestData = $_REQUEST;

        $columns = array(
            // datatable column index  => database column name
            0 => 'workplaces.id',
            2 => 'workplaces.company',
            3 => 'workplaces.adresses',
        );

        $query = workplaces::from('workplaces');

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
                ->select('id','company','adresses')
                ->get();
        $data = [];
        $res = $resultArr->toarray();
//       print_r($res); exit();
        foreach ($res as $row) {
            
            $actionhtml = '<a href="'.route("workplaces-edit",$row['id']) .'"><span class="c-tooltip c-tooltip--top"  aria-label="Edit"><i class="fa fa-edit" ></i></span></a>
                           <a href="javascript:;" class="delete"  data-id="'.$row['id'].'"><span class="c-tooltip c-tooltip--top" data-toggle="modal" data-target="#deleteModel" aria-label="Delete"><i class="fa fa-trash-o"></i></span</a>';
//                            
            $nestedData = array();
            $nestedData[] = '<input class="case" type="checkbox" name="delid[]" data-name="'.$row['company'].'" value="'.$row['id'].'" />';
            $nestedData[] =  $row['id'] ;
            $nestedData[] =  $row['company'] ;
            $nestedData[] =  $row['adresses'] ;
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
