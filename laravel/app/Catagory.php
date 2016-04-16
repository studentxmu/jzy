<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model {

	//
    protected $table = 'catagorys';

    public static $types = array(
        1 => '车队科目',
        2 => '公司科目',
        999999999 => '车辆开支',
    );
}
