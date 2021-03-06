<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Finance;
use App\Catagory;
use App\Car;
use App\Buyer;
use App\Employee;
use App\Transaction;
use App\Logex;
use Redirect, Input, Auth, Session;

class FinancesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return Redirect::to('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function latest($typeid, $cateid = 0, $fiid = 0)
	{
        $types = Catagory::$types;
        if (!isset($types[$typeid])) {
            return Redirect::to('admin');
        }
        $catename = "";
        if (empty($cateid)) {
            $finances = Finance::whereRaw('type_id = ?', array($typeid))->orderBy('id', 'asc')->paginate(25);
            $jieTotalValue = Finance::whereRaw('type_id = ? and status = 0', array($typeid))->sum('value');
            $daiTotalValue = Finance::whereRaw('type_id = ? and status = 1', array($typeid))->sum('value');
            if (!empty($fiid)) {
                $jieTotalValue = Finance::whereRaw('type_id = ? and status = 0 and id <= ?', array($typeid, $fiid))->sum('value');
                $daiTotalValue = Finance::whereRaw('type_id = ? and status = 1 and id <= ?', array($typeid, $fiid))->sum('value');
                $leftmoney = $jieTotalValue - $daiTotalValue;
                $result = array('leftmoney' => $leftmoney);
                die(json_encode($result));
            }
        } else {
            if ($typeid == 999999999) {
                $car = Car::find($cateid);
                if (empty($car)) {
                    return Redirect::to('admin');
                }
                $finances = Finance::whereRaw('type_id = 1 and car_id = ?', array($cateid))->orderBy('id', 'asc')->paginate(25);
                $jieTotalValue = Finance::whereRaw('type_id = 1 and car_id = ? and status = 0', array($cateid))->sum('value');
                $daiTotalValue = Finance::whereRaw('type_id = 1 and car_id = ? and status = 1', array($cateid))->sum('value');
                $catename = $car->code;
                if (!empty($fiid)) {
                    $jieTotalValue = Finance::whereRaw('type_id = 1 and car_id = ? and status = 0 and id <= ?', array($cateid, $fiid))->sum('value');
                    $daiTotalValue = Finance::whereRaw('type_id = 1 and car_id = ? and status = 1 and id <= ?', array($cateid, $fiid))->sum('value');
                    $leftmoney = $jieTotalValue - $daiTotalValue;
                    $result = array('leftmoney' => $leftmoney);
                    die(json_encode($result));
                }
            } else {
                $cate = Catagory::find($cateid);
                if (empty($cate)) {
                    return Redirect::to('admin');
                }
                $finances = Finance::whereRaw('type_id = ? and cate_id = ?', array($typeid, $cateid))->orderBy('id', 'asc')->paginate(2);
                $jieTotalValue = Finance::whereRaw('type_id = ? and cate_id = ? and status = 0', array($typeid, $cateid))->sum('value');
                $daiTotalValue = Finance::whereRaw('type_id = ? and cate_id = ? and status = 1', array($typeid, $cateid))->sum('value');
                $catename = $cate->name;
                if (!empty($fiid)) {
                    $jieTotalValue = Finance::whereRaw('type_id = ? and cate_id = ? and status = 0 and id <= ?', array($typeid, $cateid, $fiid))->sum('value');
                    $daiTotalValue = Finance::whereRaw('type_id = ? and cate_id = ? and status = 1 and id <= ?', array($typeid, $cateid, $fiid))->sum('value');
                    $leftmoney = $jieTotalValue - $daiTotalValue;
                    $result = array('leftmoney' => $leftmoney);
                    die(json_encode($result));
                }
            }
        }
        Session::put('currentpage', $finances->currentPage());
        Session::put('category', $cateid);
        $data = array(
            'finances' => $finances,
            'typeid' => $typeid,
            'cateid' => $cateid,
            'types' => $types,
            'catename' => $catename,
            'totalValue' => $jieTotalValue - $daiTotalValue,
        );
        if (!Input::get('page')) {
            $url = $finances->url($finances->lastPage());
            return Redirect::to($url);
        }
		return view('admin.finances.latest', $data);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function category($typeid)
	{
        $types = Catagory::$types;
        if (!isset($types[$typeid])) {
            return Redirect::to('admin');
        }
        $catagorys = Catagory::where('type_id', '=', $typeid)->get();
        $data = array(
            'catagorys' => $catagorys,
            'types' => $types,
            'typeid' => $typeid,
            'cars' => Car::all(),
        );
		return view('admin.finances.category', $data);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function search()
	{
        $filter = array('begindate', 'enddate', 'carid', 'carcode', 'employeeid', 'employeename', 'buyerid', 'buyername', 'goodsname', 'desc', 'typeid', 'categoryid', 'categoryname');
        foreach ($filter as $key) {
            $conditon[$key] = Input::get($key);
        }
        $types = Catagory::$types;
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
        $catagorys = Catagory::All();
        $categorys = array();
        foreach ($catagorys as $catagory) {
            $categorys[] = array(
                $catagory->name,
                $catagory->alpha,
                $catagory->firstalpha,
                $catagory->id
            );
        }

        $sql = '';
        $cond = array();
        if (!empty($conditon['typeid'])) {
            $sql .= 'type_id = ? ';
            $cond[] = $conditon['typeid'];
        }
        if (!empty($conditon['carid'])) {
            $sql .= ' and car_id = ? ';
            $cond[] = $conditon['carid'];
        }
        if (!empty($conditon['employeeid'])) {
            $sql .= ' and employee_id = ? ';
            $cond[] = $conditon['employeeid'];
        }
        if (!empty($conditon['categoryid'])) {
            $sql .= ' and cate_id = ? ';
            $cond[] = $conditon['categoryid'];
        }
        if (!empty($conditon['begindate'])) {
            $sql .= ' and happendate >= ? ';
            $cond[] = $conditon['begindate'];
        }
        if (!empty($conditon['enddate'])) {
            $sql .= ' and happendate <= ? ';
            $cond[] = $conditon['enddate'];
        }
        if (!empty($conditon['buyername'])) {
            $sql .= " and `finances`.desc like '%".$conditon['buyername']."%' ";
        }
        if (!empty($conditon['desc'])) {
            $sql .= " and `finances`.desc like '%".$conditon['desc']."%' ";
        }
        $finances = $jieTotalValue = $daiTotalValue = '';
        if (!empty($sql)) {
            if (empty($conditon['typeid'])) {
                return Redirect::back()->withErrors('请输入财务类型');
            }
            $finances = Finance::whereRaw($sql, $cond)->orderBy('id', 'asc')->paginate(25);
            $jieTotalValue = Finance::whereRaw($sql.' and status = 0', $cond)->sum('value');
            $daiTotalValue = Finance::whereRaw($sql. ' and status = 1', $cond)->sum('value');
        }
        $data = array(
            'types' => Transaction::$types,
            'oilTypes' => Transaction::$oilTypes,
            'roadTypes' => Transaction::$roadTypes,
            'roadTrips' => Transaction::$roadTrips,
            'peoples' => json_encode($peoples),
            'customers' => json_encode($customers),
            'trucks' => json_encode($trucks),
            'categorys' => json_encode($categorys),
            'condition' => $conditon,
            'finances' => $finances,
            'totalValue' => $jieTotalValue - $daiTotalValue,
        );
		return view('admin.finances.search', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($typeid)
	{
		//
        $types = Catagory::$types;
        if (!isset($types[$typeid])) {
            return Redirect::to('admin');
        }
        $catagorys = Catagory::where('type_id', '=', $typeid)->get();
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
        $data = array(
            'catagorys' => $catagorys,
            'typeid' => $typeid,
            'types' => $types,
            'trucks' => json_encode($trucks),
        );
		return view('admin.finances.create', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $finance = new Finance;
        $logex = new Logex;
        $typeid = $finance->type_id = Input::get('type_id');
        $finance->happendate = Input::get('happendate');
        $cateid = $finance->cate_id = Input::get('cate_id');
        $carid =  Input::get('truckNum');
        if (!empty($carid)) {
            $finance->car_id = $carid;
        }
        $finance->desc = Input::get('desc');
        $finance->value = Input::get('jine');
        $finance->status = Input::get('status');

        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '财务录入';
        $logex->type = 'create';
        $logex->datafrom = 'null';
        $logex->datato = $finance->toJson();
    
        if ($finance->save()) {
            $logex->save();
            if ($cateid == 999999999) {
                return Redirect::to("admin/finances/latest/$cateid/$carid")->withErrors('添加成功！');
            } else {
                return Redirect::to("admin/finances/latest/$typeid/$cateid")->withErrors('添加成功！');
            }
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
        $data = array(
            'types' => Finance::$types,
            'assurances' => Finance::$assurances,
            'brands' => Finance::$brands,
            'companys' => Finance::$companys,
            'finance' => Finance::find($id),
        );
		return view('admin.finances.show', $data);
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
        $finance = Finance::find($id);
        $typeid = $finance->type_id;
        $types = Catagory::$types;
        if (!isset($types[$typeid])) {
            return Redirect::to('admin');
        }
        $catagorys = Catagory::where('type_id', '=', $typeid)->get();
        $data = array(
            'finance' => $finance,
            'catagorys' => $catagorys,
            'typeid' => $typeid,
            'types' => $types,
        );
		return view('admin.finances.edit', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $finance = Finance::find($id);
        $logex = new Logex;
        $logex->datafrom = $finance->toJson();
        $typeid = $finance->type_id = Input::get('type_id');
        $finance->happendate = Input::get('happendate');
        $cateid = $finance->cate_id = Input::get('cate_id');
        $finance->desc = Input::get('desc');
        $finance->value = Input::get('jine');
        $finance->status = Input::get('status');

        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '财务修改';
        $logex->type = 'update';
        $logex->datato = $finance->toJson();
    
        if ($finance->save()) {
            $logex->save();
            if (Session::has('currentpage') && Session::has('category')) {
                $currentpage = Session::pull('currentpage', 'default');
                $category = Session::pull('category', 'default');
                $url = "admin/finances/latest/$typeid/";
                if ($category) {
                    $url .= "$cateid/";
                }
                if ($currentpage) {
                    $url .= "?page=$currentpage";
                }
                return Redirect::to($url)->withErrors('编辑成功！');
            }
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
        $finance = Finance::find($id);
        $logex = new Logex;
        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '财务删除';
        $logex->type = 'delete';
        $logex->datafrom= $finance->toJson();
        $logex->datato = 'null';
        $logex->save();
        $finance->delete();
        return Redirect::back()->withErrors('删除成功');
	}

}
