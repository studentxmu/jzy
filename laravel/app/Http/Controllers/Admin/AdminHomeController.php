<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Detail, App\Finance, App\Transaction;
use App\Car, App\Employee, App\Buyer;
use Redirect, Input, Auth, Session;

class AdminHomeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $cars = Car::where('status', '<', date('Y'))->get();
        foreach ($cars as $key => $car) {
            $nowM = date('m');
            $carM = date('m', strtotime($car->buytime));
            if (!($carM >= $nowM && $carM <= $nowM + 2)) {
                unset($cars[$key]);
            }
        }
        $todocars = count($cars);
        $jieTotalValue = Finance::whereRaw('type_id = ? and status = 0', array(1))->sum('value');
        $daiTotalValue = Finance::whereRaw('type_id = ? and status = 1', array(1))->sum('value');
        $value_traffic = $jieTotalValue - $daiTotalValue;
        $jieTotalValue = Finance::whereRaw('type_id = ? and status = 0', array(2))->sum('value');
        $daiTotalValue = Finance::whereRaw('type_id = ? and status = 1', array(2))->sum('value');
        $value_campany = $jieTotalValue - $daiTotalValue;
        $data = array(
            'employee_count' => Employee::count(),
            'car_count' => Car::count(),
            'todo_count' => $todocars,
            'value_traffic' => $value_traffic,
            'value_campany' => $value_campany,
        );
        return view('AdminHome', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
	}

}
