<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Workday extends Model {

	//
    protected $fillable = ['begintime', 'endtime', 'comment', 'employee_id'];

}
