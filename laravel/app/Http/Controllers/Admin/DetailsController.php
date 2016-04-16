<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Detail, App\Finance, App\Transaction;
use App\Car, App\Employee, App\Buyer;
use Redirect, Input, Auth, Session, DB;

class DetailsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    //
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($transid)
	{
        $data = array(
            'types' => Transaction::$types,
            'oilTypes' => Transaction::$oilTypes,
            'roadTypes' => Transaction::$roadTypes,
            'roadTrips' => Transaction::$roadTrips,
            'transid' => $transid,
        );
		return view('admin.details.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $transid = Input::get('transid');
        $oilType = Input::get('oilType');
        $oilNum = Input::get('oilNum');
        $oilMoney = Input::get('oilMoney');
        $oilAddress = Input::get('oilAddress');
        $oilDate = Input::get('oilDate');
        $tollType = Input::get('tollType');
        $tollGoCome = Input::get('tollGoCome');
        $tollName = Input::get('tollName');
        $tollMoney = Input::get('tollMoney');
        $tollDate = Input::get('tollDate');
        $repairName = Input::get('repairName');
        $repairMoney = Input::get('repairMoney');
        $repairAddress = Input::get('repairAddress');
        $repairDate = Input::get('repairDate');
        $fineAddress = Input::get('fineAddress');
        $fineMoney = Input::get('fineMoney');
        $fineDate = Input::get('fineDate');
        $otherName = Input::get('otherName');
        $otherMoney = Input::get('otherMoney');
        $otherDate = Input::get('otherDate');

        foreach ($oilType as $oilkey => $oilvalue) {
            if (!empty($oilvalue) && !empty($oilMoney[$oilkey]) && !empty($oilDate[$oilkey])) {
                $detail = new Detail;
                $detail->trans_id = $transid;
                $detail->type_id = 1;
                $detail->cate_id = $oilvalue;
                $detail->desc = $oilNum[$oilkey];
                $detail->value = $oilMoney[$oilkey];
                $detail->address = $oilAddress[$oilkey];
                $detail->happendate = $oilDate[$oilkey];
                $detail->save();
            }
        }

        foreach ($tollType as $tollkey => $tollvalue) {
            if (!empty($tollMoney[$tollkey]) && !empty($tollDate[$tollkey])) {
                $detail = new Detail;
                $detail->trans_id = $transid;
                $detail->type_id = 2;
                $detail->cate_id = $tollvalue;
                $detail->trip_id = $tollGoCome[$tollkey];
                $detail->value = $tollMoney[$tollkey];
                $detail->address = $tollName[$tollkey];
                $detail->happendate = $tollDate[$tollkey];
                $detail->save();
            }
        }

        foreach ($repairName as $repairkey => $repairvalue) {
            if (!empty($repairName[$repairkey]) && !empty($repairMoney[$repairkey]) && !empty($repairDate[$repairkey])) {
                $detail = new Detail;
                $detail->trans_id = $transid;
                $detail->type_id = 3;
                $detail->desc = $repairvalue;
                $detail->value = $repairMoney[$repairkey];
                $detail->address = $repairAddress[$repairkey];
                $detail->happendate = $repairDate[$repairkey];
                $detail->save();
            }
        }

        foreach ($fineMoney as $finekey => $finevalue) {
            if (!empty($fineMoney[$finekey]) && !empty($fineDate[$finekey])) {
                $detail = new Detail;
                $detail->trans_id = $transid;
                $detail->type_id = 4;
                $detail->value = $fineMoney[$finekey];
                $detail->address = $fineAddress[$finekey];
                $detail->happendate = $fineDate[$finekey];
                $detail->save();
            }
        }

        foreach ($otherName as $otherkey => $othervalue) {
            if (!empty($otherName[$otherkey]) && !empty($otherMoney[$otherkey]) && !empty($otherDate[$otherkey])) {
                $detail = new Detail;
                $detail->trans_id = $transid;
                $detail->type_id = 5;
                $detail->address = $othervalue;
                $detail->value = $otherMoney[$otherkey];
                $detail->happendate = $otherDate[$otherkey];
                $detail->save();
            }
        }
        $transaction = Transaction::find($transid);
        $transaction->refreshMoney();
        return Redirect::to('admin/transactions/'.$transid)->withErrors('添加成功！');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function search()
	{
        $filter = array('begindate', 'enddate', 'carid', 'carcode', 'employeeid', 'employeename', 'buyerid', 'buyername', 'goodsname', 'fromplace', 'endplace', 'returnplace', 'desc', 'typeid', 'oiltypeid');
        foreach ($filter as $key) {
            $conditon[$key] = Input::get($key);
        }
        $types = Transaction::$types;
        if (!empty($conditon['typeid']) && !isset($types[$conditon['typeid']])) {
            return Redirect::to('admin');
        }

        $employees = Employee::All();
        $peoples = array();
        foreach ($employees as $employee) {
            $peoples[] = array(
                $employee->name,
                $employee->alpha,
                $employee->firstalpha,
                $employee->id
            );
        }
        $cars = Car::All();
        $trucks = array();
        foreach ($cars as $car) {
            $trucks[] = array(
                $car->code,
                strtolower($car->code),
                strtoupper($car->code),
                $car->id
            );
        }
        $buyers = Buyer::All();
        $customers = array();
        foreach ($buyers as $buyer) {
            $customers[] = array(
                $buyer->name,
                $buyer->alpha,
                $buyer->firstalpha,
                $buyer->id
            );
        }

        $sql = '';
        $cond = array();
        $sql .= '`details`.status = ? ';
        $cond[] = 0;

        if (!empty($conditon['oiltypeid'])) {
            $sql .= 'and `details`.cate_id = ? ';
            $cond[] = $conditon['oiltypeid'];
        }
        if (!empty($conditon['typeid'])) {
            $sql .= 'and `details`.type_id = ? ';
            $cond[] = $conditon['typeid'];
        }
        if (!empty($conditon['carid'])) {
            $sql .= ' and `transactions`.car_id = ? ';
            $cond[] = $conditon['carid'];
        }
        if (!empty($conditon['employeeid'])) {
            $sql .= ' and `transactions`.employee_id = ? ';
            $cond[] = $conditon['employeeid'];
        }
        if (!empty($conditon['buyerid'])) {
            $sql .= ' and `transactions`.buyer_id = ? ';
            $cond[] = $conditon['buyerid'];
        }
        if (!empty($conditon['begindate'])) {
            $sql .= ' and `details`.happendate >= ? ';
            $cond[] = strval($conditon['begindate']);
        }
        if (!empty($conditon['enddate'])) {
            $sql .= ' and `details`.happendate <= ? ';
            $cond[] = strval($conditon['enddate']);
        }
        if (!empty($conditon['desc'])) {
            $sql .= " and `details`.address like '%".$conditon['desc']."%' ";
        }
        $details = $sumvalue = '';
        if ($sql != '`details`.status = ? ') {
            $querys = DB::table('details')
                        ->join('transactions', function($join)
                                {
                                    $join->on('transactions.id', '=', 'details.trans_id');
                                })
                        ->join('cars', function($join)
                                {
                                    $join->on('transactions.car_id', '=', 'cars.id');
                                })
                        ->join('employees', function($join)
                                {
                                    $join->on('transactions.employee_id', '=', 'employees.id');
                                })
                        ->join('buyers', function($join)
                                {
                                    $join->on('transactions.buyer_id', '=', 'buyers.id');
                                })
                        ->whereRaw($sql, $cond)
                        ->select('details.id', 'details.trans_id', 'details.type_id', 'details.cate_id', 'details.desc', 'details.value', 'details.happendate', 'transactions.car_id', 'transactions.employee_id', 'transactions.buyer_id', 'transactions.goodsname', 'details.address', 'transactions.fromplace', 'transactions.endplace', 'transactions.returnplace', 'cars.code as carname', 'buyers.name as buyername', 'employees.name as employeename');

            $sumvalue = $querys->sum('details.value');
            $details = $querys->orderBy('details.id', 'desc')->paginate(500);
        }
        $data = array(
            'types' => Transaction::$types,
            'oilTypes' => Transaction::$oilTypes,
            'roadTypes' => Transaction::$roadTypes,
            'roadTrips' => Transaction::$roadTrips,
            'peoples' => json_encode($peoples),
            'customers' => json_encode($customers),
            'trucks' => json_encode($trucks),
            'condition' => $conditon,
            'details' => $details,
            'totalValue' => $sumvalue,
        );
		return view('admin.details.search', $data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $detail = Detail::find($id);
        $detail->delete();
        $transaction = $detail->transaction;
        $transaction->refreshMoney();
        return Redirect::back()->withErrors('删除成功');
	}

}
