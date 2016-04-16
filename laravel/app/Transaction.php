<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Detail, App\Finance;

class Transaction extends Model {

	//
    protected $table = 'transactions';

    public static $types = array(
        '1' => '柴油',
        '2' => '过路',
        '3' => '修车',
        '4' => '罚款',
        '5' => '其他',
        '6' => '公司报销柴油',
    );

    public static $oilTypes = array(
        '1' => '车队',
        '2' => '柴油卡',
        '3' => '现金',
    );

    public static $roadTypes = array(
        '1' => '现金',
        '2' => 'ETC',
    );

    public static $roadTrips = array(
        '1' => '往',
        '2' => '返',
    );

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }

    public function employee2()
    {
        return $this->belongsTo('App\Employee', 'employee2_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo('App\Car', 'car_id', 'id');
    }

    public function buyer()
    {
        return $this->belongsTo('App\Buyer', 'buyer_id', 'id');
    }

    public function details()
    {
        return $this->hasMany('App\Detail', 'trans_id', 'id');
    }

    public function finance()
    {
        return $this->hasOne('App\Finance', 'trans_id', 'id');
    }

    public function buyercheck()
    {
        return $this->hasOne('App\Buyercheck', 'trans_id', 'id');
    }

    public function etc()
    {
        $details = $this->details;
        $totalcost = 0;
        foreach ($details as $detail) {
            if ($detail->type_id == 2 && $detail->cate_id == 2)
                $totalcost += $detail->value;
        }
        return $totalcost;
    }

    public function refreshMoney()
    {
        //refresh self
        $details = $this->details;
        $totalcost = 0;
        foreach ($details as $detail) {
            if ($detail->type_id == 1) continue;
            $totalcost += $detail->value;
        }
        $this->cost = $totalcost;
        $this->save();
        $finance = $this->finance;
        $finance->happendate = $this->happendate;
        $finance->car_id = $this->car_id;
        $finance->employee_id = $this->employee_id;
        $finance->desc = $this->fromplace . "-" . $this->endplace . "-" . $this->returnplace . "(" . $this->buyer->name . ")" . $this->perprice . ", " . $this->cost;
        $finance->value = $this->value - $this->cost;
        $finance->save();
    }
}
