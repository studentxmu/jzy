<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Catagory;
use App\Logex;
use Redirect, Input, Auth;

use Illuminate\Http\Request;

class CatagorysController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('admin.catagorys.index')->withCatagorys(Catagory::paginate(25));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.catagorys.create');
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
        $catagory = new Catagory;
        $logex = new Logex;
        $catagory->name = Input::get('name');
        $catagory->alpha = Input::get('alpha');
        $catagory->firstalpha = Input::get('firstalpha');
        $catagory->infomation = Input::get('infomation');
        $catagory->parent_id = Input::get('parent_id');
        $catagory->type_id = Input::get('type_id');
        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '货主录入';
        $logex->type = 'create';
        $logex->datafrom = 'null';
        $logex->datato = $catagory->toJson();
        if ($catagory->save()) {
            $logex->save();
            return Redirect::to('admin/catagorys')->withErrors('添加成功！');
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
        return view('admin.catagorys.show')->withCatagory(Catagory::find($id));
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
        return view('admin.catagorys.edit')->withCatagory(Catagory::find($id));
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
        $catagory = Catagory::find($id);
        $logex = new Logex;
        $logex->datafrom = $catagory->toJson();
        $catagory->name = Input::get('name');
        $catagory->alpha = Input::get('alpha');
        $catagory->firstalpha = Input::get('firstalpha');
        $catagory->infomation = Input::get('infomation');
        $catagory->parent_id = Input::get('parent_id');
        $catagory->type_id = Input::get('type_id');

        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '货主修改';
        $logex->type = 'update';
        $logex->datato = $catagory->toJson();

        if ($catagory->save()) {
            $logex->save();
            return Redirect::to('admin/catagorys')->withErrors('添加成功！');
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
        $catagory = Catagory::find($id);
        $catagory->delete();
        $logex = new Logex;
        $logex->userid = Auth::user()->id;
        $logex->time = time();
        $logex->what = '货主删除';
        $logex->type = 'delete';
        $logex->datafrom= $catagory->toJson();
        $logex->datato = 'null';
        $logex->save();
        return Redirect::back()->withErrors('删除成功');
	}

}
