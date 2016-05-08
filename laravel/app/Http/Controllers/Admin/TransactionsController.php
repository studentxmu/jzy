<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Transaction;
use App\Detail, App\Finance, App\Logex;
use App\Car, App\Employee, App\Buyer, App\Buyercheck;
use Redirect, Input, Auth, Session, DB;

class TransactionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $transactions = Transaction::paginate(25);
        $jieTotalValue = Transaction::sum('value');
        $daiTotalValue = Transaction::sum('cost');
        $data = array(
            'transactions' => $transactions,
            'totalValue' => $jieTotalValue - $daiTotalValue,
        );
		return view('admin.transactions.index', $data);
	}

	public function latest($carid)
	{
        if (empty($carid)) {
            return Redirect::to('admin/transactions');
        }
        $car = Car::find($carid);
        if (empty($car)) {
            return Redirect::to('admin');
        }
        $transactions = Transaction::whereRaw('car_id = ?', array($carid))->orderBy('id', 'desc')->paginate(2);
        $jieTotalValue = Transaction::whereRaw('car_id = ?', array($carid))->sum('value');
        $daiTotalValue = Transaction::whereRaw('car_id = ?', array($carid))->sum('cost');
        $data = array(
            'transactions' => $transactions,
            'car' => $car,
            'totalValue' => $jieTotalValue - $daiTotalValue,
        );
		return view('admin.transactions.index', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($transid = 0)
	{
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
        $data = array(
            'types' => Transaction::$types,
            'oilTypes' => Transaction::$oilTypes,
            'roadTypes' => Transaction::$roadTypes,
            'roadTrips' => Transaction::$roadTrips,
            'peoples' => json_encode($peoples),
            'customers' => json_encode($customers),
            'trucks' => json_encode($trucks),
        );
        if (empty($transid)) {
            return view('admin.transactions.create', $data);
        } else {
            return view('admin.transactions.creatbak', $data);
        }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        //dd(Input::all());
        DB::beginTransaction();
        $transaction = new Transaction;
        $logex = new Logex;
        $transaction->happendate = Input::get('happendate');
        $transaction->employee_id = Input::get('driver');
        $driver2 = Input::get('driver2');
        if (empty($driver2)) {
            $transaction->employee2_id = 0;
        } else {
            $transaction->employee2_id = $driver2;
        }
        $baoxiao = Input::get('companyMoney');
        if (empty($baoxiao)) {
            $transaction->baoxiao = 0;
        } else {
            $transaction->baoxiao = $baoxiao;
        }
        $transaction->car_id = Input::get('truckNum');
        $transaction->buyer_id = Input::get('owner');
        $transaction->goodsname = Input::get('goodsName');
        $transaction->fromplace = Input::get('startPlace');
        $transaction->endplace = Input::get('endPlace');
        $transaction->returnplace = Input::get('returnPlace');
        $transaction->beginweight = Input::get('beginweight');
        $transaction->endweight = Input::get('endweight');
        $transaction->perprice = Input::get('perprice');
        $freightTotal = Input::get('freightTotal');
        if (empty($freightTotal)) {
            $transaction->value = 0;
        } else {
            $transaction->value = $freightTotal;
        }
        $payTotal = Input::get('payTotal');
        if (empty($payTotal)) {
            $transaction->cost = 0;
        } else {
            $transaction->cost = $payTotal;
        }

        $oilType = Input::get('oilType');
        $oilNum = Input::get('oilNum');
        $oilMoney = Input::get('oilMoney');
        $oilPer = Input::get('oilPer');
        $oilAddress = Input::get('oilAddress');
        $oilDate = Input::get('oilDate');
        $tollType = Input::get('tollType');
        $tollGoCome = Input::get('tollGoCome');
        $tollName = Input::get('tollName');
        $tollMoney = Input::get('tollMoney');
        $repairName = Input::get('repairName');
        $repairMoney = Input::get('repairMoney');
        $repairAddress = Input::get('repairAddress');
        $fineAddress = Input::get('fineAddress');
        $fineMoney = Input::get('fineMoney');
        $otherName = Input::get('otherName');
        $otherMoney = Input::get('otherMoney');
        $licheng = Input::get('licheng');
        $youhao = Input::get('youhao');
        $danjia = Input::get('danjia');

        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '运单录入';
        $logex->type = 'create';
        $logex->datafrom = 'null';
        $logex->datato = '';
        $logex->datato .= $transaction->toJson();

        if ($transaction->save()) {
            //insert finances
            $finance = new Finance;
            $finance->trans_id = $transaction->id;
            $finance->type_id = 1;
            $finance->status = 0;
            $finance->happendate = $transaction->happendate;
            $finance->car_id = $transaction->car_id;
            $finance->employee_id = $transaction->employee_id;
            $finance->employee2_id = $transaction->employee2_id;
            $finance->desc = $transaction->fromplace . "-" . $transaction->endplace . "-" . $transaction->returnplace . "(" . $transaction->buyer->name . ")" . $transaction->perprice . ", " . $transaction->cost;
            $finance->value = $transaction->value - $transaction->cost;
            $finance->save();
            $logex->datato .= $finance->toJson();

            //insert buyercheck
            $buyercheck = new Buyercheck;
            $buyercheck->trans_id = $transaction->id;
            $buyercheck->hedui = $buyercheck->kaipiao = $buyercheck->jiesuan = 0;
            $buyercheck->save();
            $logex->datato .= $buyercheck->toJson();

            //insert details
            if (!empty($oilMoney) && is_array($oilMoney)) {
                foreach ($oilType as $oilkey => $oilvalue) {
                    if (!empty($oilvalue) && !empty($oilMoney[$oilkey]) && !empty($oilDate[$oilkey])) {
                        $detail = new Detail;
                        $detail->trans_id = $transaction->id;
                        $detail->type_id = 1;
                        $detail->cate_id = $oilvalue;
                        $detail->desc = $oilNum[$oilkey];
                        $detail->value = $oilMoney[$oilkey];
                        $detail->address = $oilAddress[$oilkey];
                        $detail->happendate = $oilDate[$oilkey];
                        $detail->save();
                        $logex->datato .= $detail->toJson();
                    }
                }
            }

            if (!empty($tollMoney) && is_array($tollMoney)) {
                foreach ($tollType as $tollkey => $tollvalue) {
                    if (!empty($tollMoney[$tollkey])) {
                        $detail = new Detail;
                        $detail->trans_id = $transaction->id;
                        $detail->type_id = 2;
                        $detail->cate_id = $tollvalue;
                        $detail->trip_id = $tollGoCome[$tollkey];
                        $detail->value = $tollMoney[$tollkey];
                        $detail->address = $tollName[$tollkey];
                        $detail->happendate = $transaction->happendate;
                        $detail->save();
                        $logex->datato .= $detail->toJson();
                    }
                }
            }

            if (!empty($repairMoney) && is_array($repairMoney)) {
                foreach ($repairMoney as $repairkey => $repairvalue) {
                    if (!empty($repairMoney[$repairkey])) {
                        $detail = new Detail;
                        $detail->trans_id = $transaction->id;
                        $detail->type_id = 3;
                        $detail->value = $repairMoney[$repairkey];
                        $detail->address = $repairAddress[$repairkey];
                        $detail->happendate = $transaction->happendate;
                        $detail->save();
                        $logex->datato .= $detail->toJson();
                    }
                }
            }

            if (!empty($fineMoney) && is_array($fineMoney)) {
                foreach ($fineMoney as $finekey => $finevalue) {
                    if (!empty($fineMoney[$finekey])) {
                        $detail = new Detail;
                        $detail->trans_id = $transaction->id;
                        $detail->type_id = 4;
                        $detail->value = $fineMoney[$finekey];
                        $detail->address = $fineAddress[$finekey];
                        $detail->happendate = $transaction->happendate;
                        $detail->save();
                        $logex->datato .= $detail->toJson();
                    }
                }
            }

            if (!empty($otherMoney) && is_array($otherMoney)) {
                foreach ($otherName as $otherkey => $othervalue) {
                    if (!empty($otherName[$otherkey]) && !empty($otherMoney[$otherkey])) {
                        $detail = new Detail;
                        $detail->trans_id = $transaction->id;
                        $detail->type_id = 5;
                        $detail->address = $othervalue;
                        $detail->value = $otherMoney[$otherkey];
                        $detail->happendate = $transaction->happendate;
                        $detail->save();
                        $logex->datato .= $detail->toJson();
                    }
                }
            }

            if (!empty($danjia) && is_array($danjia)) {
                foreach ($danjia as $comkey => $comvalue) {
                    if (!empty($licheng[$comkey]) && !empty($youhao[$comkey]) && !empty($danjia[$comkey])) {
                        $detail = new Detail;
                        $detail->trans_id = $transaction->id;
                        $detail->type_id = 6;
                        $detail->address = $licheng[$comkey];
                        $detail->desc = $youhao[$comkey];
                        $detail->value = $danjia[$comkey];
                        $detail->happendate = $transaction->happendate;
                        $detail->save();
                        $logex->datato .= $detail->toJson();
                    }
                }
            }
            $logex->save();
            DB::commit();
            return Redirect::to('admin/transactions/create')->withErrors('添加成功！');
        } else {
            return Redirect::back()->withErrors('保存失败');
        }
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
        $transaction = Transaction::find($id);
        if (empty($transaction)) {
            abort(404);
        }
        $details = $transaction->details;
        $results = array();
        foreach ($details as $detail) {
            switch ($detail->type_id) {
                case 1 :
                    $results['chaiyou'][$detail->cate_id][] = array($detail->desc, $detail->value/$detail->desc, $detail->value, $detail->address, $detail->happendate);
                break;
                case 2 :
                    $results['guoqiao'][$detail->cate_id][$detail->trip_id][] = array($detail->address, $detail->value);
                break;
                case 3 :
                    $results['xiuche'][] = array($detail->value, $detail->address);
                break;
                case 4 :
                    $results['fakuan'][] = array($detail->address, $detail->value);
                break;
                case 5 :
                    $results['qita'][] = array($detail->address, $detail->value);
                break;
                case 6 :
                    $results['gongsi'][] = array($detail->address, $detail->desc, $detail->value, $detail->transaction->baoxiao);
                break;
            }
        }
        $data = array(
            'transaction' => $transaction,
            'details' => $details,
            'results' => $results,
            'types' => Transaction::$types,
            'oilTypes' => Transaction::$oilTypes,
            'roadTypes' => Transaction::$roadTypes,
            'roadTrips' => Transaction::$roadTrips,
        );
		return view('admin.transactions.show', $data);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $transaction = Transaction::find($id);
        if (empty($transaction)) {
            abort(404);
        }
        $details = $transaction->details;
        $results = array();
        foreach ($details as $detail) {
            switch ($detail->type_id) {
                case 1 :
                    $results['chaiyou'][$detail->cate_id][] = array($detail->desc, $detail->value/$detail->desc, $detail->value, $detail->address, $detail->happendate);
                break;
                case 2 :
                    $results['guoqiao'][$detail->cate_id][$detail->trip_id][] = array($detail->address, $detail->value);
                break;
                case 3 :
                    $results['xiuche'][] = array($detail->value, $detail->address);
                break;
                case 4 :
                    $results['fakuan'][] = array($detail->address, $detail->value);
                break;
                case 5 :
                    $results['qita'][] = array($detail->address, $detail->value);
                break;
                case 6 :
                    $results['gongsi'][] = array($detail->address, $detail->desc, $detail->value, $detail->transaction->baoxiao);
                break;
            }
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
        $data = array(
            'transaction' => $transaction,
            'details' => $details,
            'results' => $results,
            'types' => Transaction::$types,
            'oilTypes' => Transaction::$oilTypes,
            'roadTypes' => Transaction::$roadTypes,
            'roadTrips' => Transaction::$roadTrips,
            'peoples' => json_encode($peoples),
            'customers' => json_encode($customers),
            'trucks' => json_encode($trucks),
        );
		return view('admin.transactions.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        $transaction = Transaction::find($id);
        $logex = new Logex;
        $logex->datafrom = $transaction->toJson();
        $transaction->happendate = Input::get('happendate');
        $transaction->employee_id = Input::get('driver');
        $transaction->car_id = Input::get('truckNum');
        $transaction->buyer_id = Input::get('owner');
        $transaction->goodsname = Input::get('goodsName');
        $transaction->fromplace = Input::get('startPlace');
        $transaction->endplace = Input::get('endPlace');
        $transaction->returnplace = Input::get('returnPlace');
        $transaction->beginweight = Input::get('beginweight');
        $transaction->endweight = Input::get('endweight');
        $transaction->perprice = Input::get('perprice');
        $transaction->value = Input::get('freightTotal');
        $transaction->cost = Input::get('payTotal');

        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '运单修改';
        $logex->type = 'update';
        $logex->datato = $transaction->toJson();

        if ($transaction->save()) {
            $logex->save();
            $transaction->refreshMoney();
            return Redirect::to('admin/transactions')->withErrors('编辑成功！');
        } else {
            return Redirect::back()->withErrors('保存失败');
        }
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
        $transaction = Transaction::find($id);
        $details = $transaction->details;
        foreach ($details as $detail) {
            $detail->delete();
        }
        $finance = $transaction->finance;
        $finance->delete();
        $transaction->delete();
        $logex = new Logex;
        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '运单删除';
        $logex->type = 'delete';
        $logex->datafrom= $transaction->toJson();
        $logex->datato = 'null';
        $logex->save();
        return Redirect::back()->withErrors('删除成功');
	}

}
