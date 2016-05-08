<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Logex extends Model {
    //这是个注释
	//
    protected $table = 'logex';

    public function user()
    {
        return $this->belongsTo('App\User', 'userid', 'id');
    }

}
