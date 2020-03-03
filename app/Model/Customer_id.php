<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer_id extends Model {

    protected $table = 'customer_id';

    public function getcustomer_id() {

        $resutl = Customer_id::all();
        return $resutl;
    }

    public function updateid($id) {

        $result = Customer_id::find(1);
        $result->customer_id = $id;
        $result->updated_at = date("Y-m-d h:i:s");
        $result->save();
    }

}
