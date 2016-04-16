<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Buyer, App\Buyercheck;
use App\Transaction;
use Redirect, Input, Auth, DB, Excel;

class BuyersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('admin.buyers.index')->withBuyers(Buyer::paginate(25));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.buyers.create');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function category()
	{
        $data = array(
            'buyers' => Buyer::all(),
        );
		return view('admin.buyers.category', $data);
	}

	public function exportall()
	{
        $filter = array('begindate', 'enddate', 'jiesuan', 'kaipiao', 'nojiesuan', 'hedui', 'download');
        foreach ($filter as $key) {
            $conditon[$key] = Input::get($key);
        }
        $sql = '1=1 ';
        $cond = array();
        $sqlcheck = '';
        $condcheck = array();
        $transactions = array();
        if (!empty($conditon['begindate'])) {
            $sql .= ' and happendate >= ? ';
            $cond[] = $conditon['begindate'];
        }
        if (!empty($conditon['enddate'])) {
            $sql .= ' and happendate <= ? ';
            $cond[] = $conditon['enddate'];
        }
        if (!empty($conditon['hedui'])) {
            $sqlcheck .= 'hedui = ? ';
            $condcheck[] = 1;
        }
        if (!empty($conditon['kaipiao'])) {
            if (!empty($conditon['hedui'])) {
                $sqlcheck .= ' and  ';
            }
            $sqlcheck .= 'kaipiao = ? ';
            $condcheck[] = 1;
        }
        if (!empty($conditon['jiesuan'])) {
            if (!empty($conditon['hedui']) || !empty($conditon['kaipiao'])) {
                $sqlcheck .= ' and  ';
            }
            $sqlcheck .= 'jiesuan = ? ';
            $condcheck[] = 1;
        }
        if (!empty($conditon['nojiesuan'])) {
            if (!empty($conditon['hedui']) || !empty($conditon['kaipiao']) || !empty($conditon['jiesuan'])) {
                $sqlcheck .= ' and  ';
            }
            $sqlcheck .= 'jiesuan = ? ';
            $condcheck[] = 0;
        }
        $token = Input::get('_token');
        if (!empty($token)) {
            if (!empty($sqlcheck)) {
                $transactions = Transaction::select(DB::raw('sum(value) as value, sum(beginweight) as begin, sum(endweight) as end, buyer_id'))->whereHas('buyercheck' , function($query) use($sqlcheck, $condcheck)
                        {
                        $query->whereRaw($sqlcheck, $condcheck);

                        })->whereRaw($sql, $cond)->groupBy('buyer_id')->get();
            } else {
                $transactions = Transaction::select(DB::raw('sum(value) as value, sum(beginweight) as begin, sum(endweight) as end, buyer_id'))->whereRaw($sql, $cond)->groupBy('buyer_id')->get();
            }
        }

        if ($conditon['download'] == true && count($transactions) !== 0) {
            $filename = "货主-账目记录";
            $cellData = array();
            $cellData[] = ['货主','装货数','卸货数','运费金额'];
            foreach ($transactions as $transaction) {
                $cellData[] = array (
                   $transaction->buyer->name,
                   $transaction->begin,
                   $transaction->end,
                   $transaction->value,
                );
            }
            Excel::create($filename, function($excel) use ($cellData){
                    $excel->sheet('score', function($sheet) use ($cellData){
                        $sheet->rows($cellData);
                        });
                    })->export('xls');
        }
        $data = array(
            'transactions' => $transactions,
            'condition' => $conditon,
        );
		return view('admin.buyers.exportall', $data);
	}

	public function latest($buyerid, $fromplace = '', $endplace = '')
	{
        if (empty($buyerid)) {
            return Redirect::to('admin/transactions');
        }
        $buyer = Buyer::find($buyerid);
        if (empty($buyer)) {
            return Redirect::to('admin');
        }
        $filter = array('begindate', 'enddate', 'jiesuan', 'kaipiao', 'nojiesuan', 'hedui', 'download');
        foreach ($filter as $key) {
            $conditon[$key] = Input::get($key);
        }
        $addressTypes = Transaction::whereRaw('buyer_id = ?', array($buyerid))->groupBy('fromplace', 'endplace')->select('fromplace', 'endplace')->get();
        $sql = '';
        $cond = array();
        $sqlcheck = '';
        $condcheck = array();
        if (!empty($buyerid)) {
            $sql .= 'buyer_id= ? ';
            $cond[] = $buyerid;
        }
        if (!empty($fromplace) && !empty($endplace)) {
            $sql .= ' and fromplace = ? and endplace = ?';
            $cond[] = $fromplace;
            $cond[] = $endplace;
        }
        if (!empty($conditon['begindate'])) {
            $sql .= ' and happendate >= ? ';
            $cond[] = $conditon['begindate'];
        }
        if (!empty($conditon['enddate'])) {
            $sql .= ' and happendate <= ? ';
            $cond[] = $conditon['enddate'];
        }
        if (!empty($sql)) {
            $transactions = Transaction::whereRaw($sql, $cond)->orderBy('id', 'asc')->paginate(25);
            $jieTotalValue = Transaction::whereRaw($sql, $cond)->sum('value');
            $beginTotalWeight = Transaction::whereRaw($sql, $cond)->sum('beginweight');
            $endTotalWeight = Transaction::whereRaw($sql, $cond)->sum('endweight');
        }
        if (!empty($conditon['hedui'])) {
            $sqlcheck .= 'hedui = ? ';
            $condcheck[] = 1;
        }
        if (!empty($conditon['kaipiao'])) {
            if (!empty($conditon['hedui'])) {
                $sqlcheck .= ' and  ';
            }
            $sqlcheck .= 'kaipiao = ? ';
            $condcheck[] = 1;
        }
        if (!empty($conditon['jiesuan'])) {
            if (!empty($conditon['hedui']) || !empty($conditon['kaipiao'])) {
                $sqlcheck .= ' and  ';
            }
            $sqlcheck .= 'jiesuan = ? ';
            $condcheck[] = 1;
        }
        if (!empty($conditon['nojiesuan'])) {
            if (!empty($conditon['hedui']) || !empty($conditon['kaipiao']) || !empty($conditon['jiesuan'])) {
                $sqlcheck .= ' and  ';
            }
            $sqlcheck .= 'jiesuan = ? ';
            $condcheck[] = 0;
        }
        if (!empty($sqlcheck)) {
            $transactionsquery = Transaction::whereHas('buyercheck' , function($query) use($sqlcheck, $condcheck)
            {
                $query->whereRaw($sqlcheck, $condcheck);
                
                })->whereRaw($sql, $cond);
            $transactions = $transactionsquery->orderBy('id', 'asc')->paginate(25);
            $jieTotalValue = $transactionsquery->sum('value');
            $beginTotalWeight = $transactionsquery->sum('beginweight');
            $endTotalWeight = $transactionsquery->sum('endweight');
        }

        if ($conditon['download'] == true && count($transactions) !== 0) {
            $filename = "货主-".$buyer->name."-账目记录";
            $cellData = array();
            $cellData[] = ['日期','车号','起始地','目的地','装货数','卸货数','单价','运费金额'];
            foreach ($transactions as $transaction) {
                $cellData[] = array (
                   $transaction->happendate,
                   $transaction->car->code,
                   $transaction->fromplace,
                   $transaction->endplace,
                   $transaction->beginweight,
                   $transaction->endweight,
                   $transaction->perprice,
                   $transaction->value,
                );
            }
            Excel::create($filename, function($excel) use ($cellData){
                    $excel->sheet('score', function($sheet) use ($cellData){
                        $sheet->rows($cellData);
                        });
                    })->export('xls');
        }
        $data = array(
            'transactions' => $transactions,
            'buyer' => $buyer,
            'totalValue' => $jieTotalValue,
            'beginTotalWeight' => $beginTotalWeight,
            'endTotalWeight' => $endTotalWeight,
            'addressTypes' => $addressTypes,
            'condition' => $conditon,
        );
		return view('admin.buyers.latest', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
        $this->validate($request, [
            'name'  => 'required|min:2',
        ]);
        $buyer = new Buyer;
        $buyer->name = Input::get('name');
        $buyer->alpha = Input::get('alpha');
        $buyer->firstalpha = Input::get('firstalpha');
        $buyer->address = Input::get('address');
        $buyer->infomation = Input::get('infomation');
        $buyer->campany = Input::get('campany');
        $buyer->telephone = intval(Input::get('telephone'));
        $buyer->phonenum = Input::get('phonenum');

        if ($buyer->save()) {
            return Redirect::to('admin/buyers')->withErrors('添加成功！');
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
        return view('admin.buyers.show')->withBuyer(Buyer::find($id));
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
        return view('admin.buyers.edit')->withBuyer(Buyer::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//
        $this->validate($request, [
            'name'  => 'required|min:2',
        ]);
        $buyer = Buyer::find($id);
        $buyer->name = Input::get('name');
        $buyer->alpha = Input::get('alpha');
        $buyer->firstalpha = Input::get('firstalpha');
        $buyer->address = Input::get('address');
        $buyer->infomation = Input::get('infomation');
        $buyer->campany = Input::get('campany');
        $buyer->telephone = Input::get('telephone');
        $buyer->phonenum = Input::get('phonenum');

        if ($buyer->save()) {
            return Redirect::to('admin/buyers')->withErrors('添加成功！');
        } else {
            return Redirect::back()->withErrors('保存失败');
        }
	}

	public function setstatus()
	{
		//
        $transids = Input::get('trans_id');
        $heduis = Input::get('hedui');
        $kaipiaos = Input::get('kaipiao');
        $jiesuans = Input::get('jiesuan');
        $buyerid = Input::get('buyerid');
        $comments = Input::get('comments');
        if (empty($transids)) {
            return Redirect::back()->withErrors('没有选中任何记录');
        }
        foreach ($transids as $key => $transid) {
            $buyercheck = Buyercheck::where('trans_id', '=', $transid)->take(1)->get();
            if (!empty($buyercheck) && isset($buyercheck[0])) {
                $buyercheck = $buyercheck[0];
            }
            if (empty($buyercheck->id)) {
                $buyercheck = new Buyercheck;
            }
            $buyercheck->trans_id = $transid;
            $buyercheck->comment = $comments[$key];
            $buyercheck->hedui = $buyercheck->kaipiao = $buyercheck->jiesuan = 0;
            if (!empty($heduis)) {
                foreach ($heduis as $hedui) {
                    if ($hedui == $transid) {
                        $buyercheck->hedui = 1;
                    }
                }
            }
            if (!empty($kaipiaos)) {
                foreach ($kaipiaos as $kaipiao) {
                    if ($kaipiao == $transid) {
                        $buyercheck->kaipiao = 1;
                    }
                }
            }
            if (!empty($jiesuans)) {
                foreach ($jiesuans as $jiesuan) {
                    if ($jiesuan == $transid) {
                        $buyercheck->jiesuan = 1;
                    }
                }
            }
            $buyercheck->save();
        }
        return Redirect::to('admin/buyers/latest/'.$buyerid)->withErrors('添加成功！');
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
        $buyer = Buyer::find($id);
        $buyer->delete();
        return Redirect::back()->withErrors('删除成功');
	}

        /*
        if (!empty($fromplace) && !empty($endplace)) {
            $transactions = Transaction::whereRaw('buyer_id = ? and fromplace = ? and endplace = ?', array($buyerid, $fromplace, $endplace))->orderBy('id', 'asc')->paginate(25);
            $jieTotalValue = Transaction::whereRaw('buyer_id = ? and fromplace = ? and endplace = ?', array($buyerid, $fromplace, $endplace))->sum('value');
        } else {
            $transactions = Transaction::whereRaw('buyer_id = ?', array($buyerid))->orderBy('id', 'asc')->paginate(25);
            $jieTotalValue = Transaction::whereRaw('buyer_id = ?', array($buyerid))->sum('value');
               $querys = DB::table('transactions')
               ->join('buyerchecks', function($join)
               {
               $join->on('transactions.id', '=', 'buyerchecks.trans_id');
               })
               ->join('cars', function($join)
               {
               $join->on('transactions.car_id', '=', 'cars.id');
               })
               ->whereRaw('buyer_id = ?', array($buyerid))
               ->select('transactions.id', 'buyerchecks.hedui', 'buyerchecks.kaipiao', 'buyerchecks.jiesuan', 'transactions.car_id', 'transactions.beginweight', 'transactions.value', 'transactions.perprice', 'transactions.endweight', 'transactions.happendate', 'transactions.employee_id', 'transactions.buyer_id', 'transactions.goodsname', 'transactions.fromplace', 'transactions.endplace', 'transactions.returnplace', 'cars.code as carname');

               $jieTotalValue = $querys->sum('transactions.value');
               $transactions = $querys->orderBy('transactions.id', 'asc')->paginate(25);
        }
            */
}
