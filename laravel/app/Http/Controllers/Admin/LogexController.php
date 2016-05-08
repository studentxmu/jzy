<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Logex;
use Redirect, Input, Auth, Session;

class LogexController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $logexs = Logex::orderBy('id', 'desc')->paginate(25);
        $data = array(
            'logexs' => $logexs,
        );
		return view('admin.logex.index', $data);
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

}
