<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model {

	//
    public function transaction()
    {
        return $this->belongsTo('App\Transaction', 'trans_id', 'id');
    }

}
