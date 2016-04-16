<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model {

	//
    public static $types = array(
        1 => '运输车',
        2 => '公务车',
        3 => '加油车',
    );

    public static $brands = array(
        1 => '东风牌DFL4240AX2A',
        2 => '东风牌DFL4250AX2A',
        3 => '豪泺',
        4 => '奥龙',
        5 => '解放',
    );

    public static $assurances = array(
        1 => '太平保险',
        2 => '平安保险',
        3 => '人保',
    );

    public static $companys = array(
        1 => '金正阳物流',
        2 => '中汇通物流',
        3 => '金正阳运输队',
    );
}
